<?php
class NodeClientGenerator extends ClientGeneratorFromXml
{
  /**
   * @var SimpleXMLElement
   */
  private $schemaXml;
  
  protected $enumTypes = "";
  protected $voClasses = "";
  protected $serviceClasses = "";
  protected $mainClass = "";
  
  /**
  * Constructor.
  * @param string $xmlPath path to schema xml.
  * @link http://www.kaltura.com/api_v3/api_schema.php
  */
  function NodeClientGenerator($xmlPath)
  {
    //set up the generator paths; path to schema xml and path to static source code files to copy.
    parent::ClientGeneratorFromXml($xmlPath, 'sources/node');
  }
  
  function getSingleLineCommentMarker()
  {
    return '//';
  }
  
  /**
  * Parses the higher-level of the schema, divide parsing to five steps:
  * Enum creation, Object (VO) classes, Services and actions, Main, and project file.
  */
  public function generate() 
  {  
    parent::generate();
  
    $this->schemaXml = new SimpleXMLElement(file_get_contents( $this->_xmlFile ));
    
    //parse object types
    foreach ($this->schemaXml->children() as $reflectionType) 
    {
      switch($reflectionType->getName())
      {
        case "enums":
          //create enum classes
          foreach($reflectionType->children() as $enums_node)
          {
            $this->writeEnum($enums_node);
          }
        break;
        case "classes":
          //create object classes
          foreach($reflectionType->children() as $classes_node)
          {
            $this->writeObjectClass($classes_node);
          }
        break;
        case "services":
          //implement services (api actions)
          foreach($reflectionType->children() as $services_node)
          {
            $this->writeService($services_node);
          }
          //write main class (if needed, this can also be included in the static sources folder if not dynamic)
          $this->writeMainClass($reflectionType->children());
        break;  
      }
    }
    $this->addFile('KalturaTypes.js', $this->enumTypes);
    $this->addFile('KalturaVO.js', $this->voClasses);
    $this->addFile('KalturaServices.js', $this->serviceClasses);
    $this->addFile('KalturaClient.js', $this->mainClass);
    //write project file (if needed, this can also be included in the static sources folder if not dynamic)
    $this->writeProjectFile();
  }
  
  /**
   * dump a given text to a given variable and end one line.
   * @param $addto   the parameter to add the text to.
   * @param $text   the text to add.
   */
  protected function echoLine(&$addto, $text = "")
  {
    $addto .= $text . "\n";
  }
  
  /**
   * util function to capitalize the first letter of a given text.
   * @param $wordtxt    the text to capitalize.
   */
  protected function upperCaseFirstLetter($wordtxt)
  {
    if (strlen($wordtxt) > 0)
      $wordtxt = strtoupper(substr($wordtxt, 0, 1)).substr($wordtxt, 1);
    return $wordtxt;
  }
  
  /**
  * Parses Enum (aka. types) classes.
  * @param $enumNode    the xml node from the api schema representing an enum.  
  */
  protected function writeEnum(SimpleXMLElement $enumNode)
  {
    $className = $enumNode->attributes()->name;
    $this->echoLine ($this->enumTypes, "\nvar $className = module.exports.$className = {");
    //parse the constants
    foreach($enumNode->children() as $child) {
      switch($enumNode->attributes()->enumType)
      {
        case "string":
          $this->echoLine ($this->enumTypes, $child->attributes()->name . " : \"" . $child->attributes()->value . "\",");
          break;
        default:
          $this->echoLine ($this->enumTypes, $child->attributes()->name . " : " . $child->attributes()->value . ",");
          break;
      } 
    }
    $this->echoLine ($this->enumTypes, "};");
  }
  
  /**
  * Parses Object (aka. VO) classes.
  * @param $classNode    the xml node from the api schema representing a type class (Value Object).
  */
  protected function writeObjectClass(SimpleXMLElement $classNode)
  {
    $classDesc = "/**\n";
    $classCode = "";
    $clasName = $classNode->attributes()->name;
    $this->echoLine ($classCode, "var util = require('util');");
    $this->echoLine ($classCode, "var kcb = require('./KalturaClientBase');");
    $this->echoLine ($classCode, "var $clasName = module.exports.$clasName = function(){");
    //parse the class properties
    foreach($classNode->children() as $classProperty) {
      $propType = $classProperty->attributes()->type;
      $propName = $classProperty->attributes()->name;
      $description = str_replace("\n", "\n *  ", $classProperty->attributes()->description); // to format multi-line descriptions
      $vardesc = " * @param  $propName  $propType    $description";
      if ($classProperty->attributes()->readOnly == '1')
        $vardesc .= " (readOnly)";
      else if ($classProperty->attributes()->insertOnly == '1')
        $vardesc .= " (insertOnly)";
      $classDesc .= "$vardesc.\n";
      $this->echoLine ($classCode, "  this.$propName = null;");
    }
    $classDesc .= " */";
    $classCode .= "};";
    $classCode = $classDesc . "\n" . $classCode;
    $this->echoLine ($this->voClasses, $classCode);
    //parse the class base class (parent in heritage)
    if($classNode->attributes()->base) {
      $parentClass = $classNode->attributes()->base;
      //$this->echoLine ($this->voClasses, "$clasName.prototype = new " . $parentClass . "();");
      $this->echoLine ($this->voClasses, "util.inherits($clasName, $parentClass);");
    } else {
      $this->echoLine ($this->voClasses, "util.inherits($clasName, kcb.KalturaObjectBase);");
    }
    $this->echoLine ($this->voClasses, "\n");
  }
  
  /**
  * Parses Services and actions (calls that can be performed on the objects).
  * @param $serviceNodes    the xml node from the api schema representing an api service.
  */
  protected function writeService(SimpleXMLElement $serviceNodes)
  {
    $serviceName = $serviceNodes->attributes()->name;
    $serviceClassName = "Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
    $serviceClass = "var $serviceClassName = module.exports.$serviceClassName = function(client){\n";
    $serviceClass .= "  this.init(client);\n";
    $serviceClass .= "}\n";
    $serviceClass .= "util.inherits($serviceClassName, kcb.KalturaServiceBase);\n";
    
    $serviceClassDesc = "/**\n";
    $serviceClassDesc .= " *Class definition for the Kaltura service: $serviceName.\n";
    $actionsList = " * The available service actions:\n";
    
    //parse the service actions
    foreach($serviceNodes->children() as $action) {
      
      if($action->result->attributes()->type == 'file')
        continue;
        
      $actionDesc = "/**\n";
      $description = str_replace("\n", "\n *  ", $action->attributes()->description); // to format multi-line descriptions
      $actionDesc .= " * $description.\n";
      $actionsList .= " * @action  ".$action->attributes()->name."  $description.\n";
      
      foreach($action->children() as $actionParam) {
        if($actionParam->getName() == "param" ) {
          $paramType = $actionParam->attributes()->type;
          $paramName = $actionParam->attributes()->name;
          $optionalp = (boolean)$actionParam->attributes()->optional;
          $defaultValue = trim($actionParam->attributes()->default);
          $enumType = $actionParam->attributes()->enumType;
          $description = str_replace("\n", "\n *  ", $actionParam->attributes()->description); // to format multi-line descriptions
          $info = array();
          if ($optionalp)
            $info[] = "optional";
          if ($enumType && $enumType != '')
            $info[] = "enum: $enumType";
          if ($defaultValue && $defaultValue != '')
            $info[] = "default: $defaultValue";
          if (count($info)>0)
            $infoTxt = ' ('.join(', ', $info).')';
          $vardesc = " * @param  $paramName  $paramType    {$description}{$infoTxt}";
          $actionDesc .= "$vardesc.\n";
        } else {
          $rettype = $actionParam->attributes()->type;
          $actionDesc .= " * @return  $rettype.\n";
        }
      }
      
      $actionDesc .= " */";
      $actionClass = $actionDesc . "\n";
      
      //create a service action
      $actionName = $action->attributes()->name;
      
      $paramNames = array('callback');
      foreach($action->children() as $actionParam)
        if($actionParam->getName() == "param" ) 
          $paramNames[] = $actionParam->attributes()->name;
      $paramNames = join(', ', $paramNames);
      
      // action method signature
      if (in_array($actionName, array("list", "clone", "delete"))) // because list & clone are preserved in PHP
        $actionSignature = "$serviceClassName.prototype.".$actionName."Action = function($paramNames)";
      else
        $actionSignature = "$serviceClassName.prototype.".$actionName." = function($paramNames)";
      
      $actionClass .= $actionSignature."{\n";
      
      //validate parameter default values
      foreach($action->children() as $actionParam) {
        if($actionParam->getName() != "param" )
          continue;
        if ($actionParam->attributes()->optional == '0')
          continue;
        
        $paramName = $actionParam->attributes()->name;
        switch($actionParam->attributes()->type)
        {
          case "string":
          case "float":
          case "int":
          case "bool":
          case "array":
            $defaultValue = strtolower($actionParam->attributes()->default);
            if ($defaultValue == 'false' || 
              $defaultValue == 'true' || 
              $defaultValue == 'null' || 
              is_numeric($defaultValue) )
                $defaultValue = $defaultValue;
            else 
              $defaultValue = '"'.$actionParam->attributes()->default.'"';
            break;
          default: //is Object
            $defaultValue = "null";
            break;
        }
        
        $actionClass .= "  if(!$paramName)\n";
        $actionClass .= "    $paramName = $defaultValue;\n";
      }
       
      $actionClass .= "  var kparams = {};\n";
      
      $haveFiles = false;
      //parse the actions parameters and result types
      foreach($action->children() as $actionParam) {
        if($actionParam->getName() != "param" ) 
          continue;
        $paramName = $actionParam->attributes()->name;
        if ($haveFiles === false && $actionParam->attributes()->type == "file") {
              $haveFiles = true;
              $actionClass .= "  kfiles = {};\n";
          }
        switch($actionParam->attributes()->type)
        {
          case "string":
          case "float":
          case "int":
          case "bool":
            $actionClass .= "  this.client.addParam(kparams, \"$paramName\", $paramName);\n";
            break;
          case "file":
            $actionClass .= "  this.client.addParam(kfiles, \"$paramName\", $paramName);\n";
            break;
          case "array":
            $extraTab = "";
            if ($actionParam->attributes()->optional == '1') {
              $actionClass .= "  if($paramName != null)\n";
              $extraTab = "  ";
            }
            $actionClass .= "{$extraTab}for(var index in $paramName)\n";
            $actionClass .= "{$extraTab}{\n";
            $actionClass .= "{$extraTab}  var obj = ${paramName}[index];\n";
            $actionClass .= "{$extraTab}  this.client.addParam(kparams, \"$paramName:\" + index, kcb.toParams(obj));\n";
            $actionClass .= "$extraTab}\n";
            break;
          default: //is Object
            if ($actionParam->attributes()->optional == '1') {
              $actionClass .= "  if ($paramName != null)\n  ";
            }
            $actionClass .= "  this.client.addParam(kparams, \"$paramName\", kcb.toParams($paramName));\n";
            break;
        }
      }
      if ($haveFiles)
        $actionClass .= "  this.client.queueServiceActionCall(\"$serviceName\", \"$actionName\", kparams, kfiles);\n";
      else
        $actionClass .= "  this.client.queueServiceActionCall(\"$serviceName\", \"$actionName\", kparams);\n";
      $actionClass .= "  if (!this.client.isMultiRequest())\n";
      $actionClass .= "    this.client.doQueue(callback);\n";
      $actionClass .= "}";
      $this->echoLine ($serviceClass, $actionClass);
    }
    $serviceClassDesc .= $actionsList;
    $serviceClassDesc .= "*/";
    $serviceClass = $serviceClassDesc . "\n" . $serviceClass;
    $this->echoLine ($this->serviceClasses, "var util = require('util');");
    $this->echoLine ($this->serviceClasses, "var kcb = require('./KalturaClientBase');");
    $this->echoLine ($this->serviceClasses, $serviceClass);
  }
  
  /**
  * Create the main class of the client library, may parse Services and actions.
  * initialize the service and assign to client to provide access to servcies and actions through the Kaltura client object.
  */
  protected function writeMainClass(SimpleXMLElement $servicesNodes)
  {
    $apiVersion = $this->schemaXml->attributes()->apiVersion;
  
    $this->echoLine($this->mainClass, "/**");
    $this->echoLine($this->mainClass, " * The Kaltura Client - this is the facade through which all service actions should be called.");
    $this->echoLine($this->mainClass, " * @param config the Kaltura configuration object holding partner credentials (type: KalturaConfiguration).");
    $this->echoLine($this->mainClass, " */");
    $this->echoLine($this->mainClass, "var util = require('util');");
    $this->echoLine($this->mainClass, "var kcb = require('./KalturaClientBase');");
    $this->echoLine($this->mainClass, "var kvo = require('./KalturaVO');");
    $this->echoLine($this->mainClass, "var ksvc = require('./KalturaServices');");
    $this->echoLine($this->mainClass, "var ktypes = require('./KalturaTypes');");
    $this->echoLine($this->mainClass, "var KalturaClient = module.exports.KalturaClient = function(config) {");
    $this->echoLine($this->mainClass, "  this.init(config);");
    $this->echoLine($this->mainClass, "};");
    $this->echoLine ($this->mainClass, "util.inherits(KalturaClient, kcb.KalturaClientBase);");
    $this->echoLine ($this->mainClass, "KalturaClient.prototype.apiVersion = \"$apiVersion\";");
    $this->echoLine ($this->mainClass, "module.exports.KalturaConfiguration = kcb.KalturaConfiguration;");
    
    foreach($servicesNodes as $service_node)
    {
      $serviceName = $service_node->attributes()->name;
      $serviceClassName = "ksvc.Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
      $this->echoLine($this->mainClass, "/**");
      $description = str_replace("\n", "\n *  ", $service_node->attributes()->description); // to format multi-line descriptions
      $this->echoLine($this->mainClass, " * " . $description);
      $this->echoLine($this->mainClass, " * @param $serviceClassName");
      $this->echoLine($this->mainClass, " */");
      $this->echoLine($this->mainClass, "KalturaClient.prototype.$serviceName = null;");
    }
    $this->echoLine($this->mainClass, "/**");
    $this->echoLine($this->mainClass, " * The client constructor.");
    $this->echoLine($this->mainClass, " * @param config the Kaltura configuration object holding partner credentials (type: KalturaConfiguration).");
    $this->echoLine($this->mainClass, " */");
    $this->echoLine($this->mainClass, "KalturaClient.prototype.init = function(config){");
    $this->echoLine($this->mainClass, "  //call the super constructor:");
    $this->echoLine($this->mainClass, "  kcb.KalturaClientBase.prototype.init.apply(this, arguments);");
    $this->echoLine($this->mainClass, "  //initialize client services:");
    foreach($servicesNodes as $service_node)
    {
      $serviceName = $service_node->attributes()->name;
      $serviceClassName = "ksvc.Kaltura".$this->upperCaseFirstLetter($serviceName)."Service";
      $this->echoLine($this->mainClass, "  this.$serviceName = new $serviceClassName(this);");
    }
    $this->echoLine($this->mainClass, "}");
  }
  
  /**
  * Create the project file (when needed).
  */
  protected function writeProjectFile()
  {
    //override to implement the parsing and file creation.
    //to add a new file, use: $this->addFile('path to new file', 'file contents');
    //echo "Create Project File.\n";
  }
}

import sys
import os
import re

def emptyProcessSegment(segment, state, context):
    return segment

########### simple replace patterns ###########
REPLACEMENTS = [
    ('.', '+'),
    ('->', '.'),
    ('::', '.'),
    ('&&', 'and'),
    ('||', 'or'),
    ('===', '=='),
    ('!==', '!='),
    ('$', ''),
    ('=>', ':'),
    ('--', ' -= 1'),
    ('++', ' += 1'),
    ('&', ''),
    ]

RE_CS_REPLACEMENTS = [
    (r'new\s+', ''),
    (r'\!(?!=)', 'not '),
    ]

WW_CS_REPLACEMENTS = [
    ('this', 'self'),
    ('strlen', 'len'),
    ('count', 'len'),
    ('elseif', 'elif'),
    ('__construct', '__init__'),
    ('var_dump', 'repr'),
    ('GLOBALS', 'globals()'),
    ('list', ''),
    ('intval', 'int'),
    ('print', 'sys.stdout.write'),
    ('rand', 'random.randint'),
    ]

WW_CI_REPLACEMENTS = [
    ('null', 'None'),
    ('false', 'False'),
    ('true', 'True'),
    ('__file__', '__file__'),
    ]

def doSimpleReplacements(block):
    if block == None:
        return None
    for (repWhat, repWith) in REPLACEMENTS:
        block = block.replace(repWhat, repWith)
    for (repWhat, repWith) in WW_CS_REPLACEMENTS:
        block = re.sub(r'\b' + repWhat + r'\b', repWith, block)
    for (repWhat, repWith) in WW_CI_REPLACEMENTS:
        block = re.compile(r'\b' + repWhat + r'\b', re.I).sub(repWith, block)
    for (repWhat, repWith) in RE_CS_REPLACEMENTS:
        block = re.sub(repWhat, repWith, block)
    return block

def simpleReplaceProcessSegment(segment, state, context):
    if state == PS_NORMAL:
        return doSimpleReplacements(segment)
    elif state == PS_ONELINE_COMMENT and segment.startswith('//'):
        return '#' + segment[2:]
    elif state == PS_MULTILINE_COMMENT:
        result = []
        segment = segment[2:-2]
        for curLine in segment.split('\n'):
            result.append('#%s' % curLine)
        return '\n'.join(result)
    elif state == PS_SIMPLE_STRING:
        if '\\' in segment:
            return 'r' + segment
        return segment
    elif state == PS_FORMAT_STRING:
        return processFormatString(segment)
    return segment

def simpleReplaceProcessBlock(block, context):
    context.append(block)

def simpleReplacements(block):
    context = []
    parseSection(block, simpleReplaceProcessSegment, simpleReplaceProcessBlock, context)
    return ''.join(context)

########### smart replace patterns ###########
def arrayReplaceFunc(matchedDict):
    arrayContent = matchedDict['<expr1>']
    curPos = 0
    while True:
        curPos = arrayContent.find('=>', curPos)
        if curPos < 0:
            return '[%s]' % simpleReplacements(arrayContent)
        if isValidExpression(arrayContent[:curPos]):
            return '{%s}' % simpleReplacements(arrayContent)
        curPos += 1

def importReplaceFunc(matchedDict):
    importContent = matchedDict['<expr1>']
    if (importContent.startswith("'") and importContent.endswith("'")) or \
       (importContent.startswith('"') and importContent.endswith('"')):
        importContent = importContent[1:-1]
    return 'from %s import *' % os.path.splitext(os.path.basename(importContent))[0]

DATE_FORMAT_REPLACEMENTS = {
    'Y': '%Y',
    'm': '%m',
    'd': '%d',
    'H': '%H',
    'i': '%M',
    's': '%S',
}

def dateReplaceFunc(matchedDict):
    formatString = matchedDict['<expr1>']
    for repWhat, repWith in DATE_FORMAT_REPLACEMENTS.items():
        formatString = formatString.replace(repWhat, repWith)
    if matchedDict.has_key('<expr2>'):
        return 'time.strftime(%s, time.localtime(%s))' % \
               (formatString, simpleReplacements(matchedDict['<expr2>']))
    return 'time.strftime(%s)' % formatString

def globalCallbackReplaceFunc(matchedDict):
    funcName = matchedDict['<expr1>']
    if funcName.startswith("'") and funcName.endswith("'"):
        funcName = funcName[1:-1]
    return funcName
    
def staticCallbackReplaceFunc(matchedDict):
    className = matchedDict['<expr1>']
    if className.startswith("'") and className.endswith("'"):
        className = className[1:-1]

    funcName = matchedDict['<expr2>']
    if funcName.startswith("'") and funcName.endswith("'"):
        funcName = funcName[1:-1]

    return '%s.%s' % (className, funcName)

REPLACE_PATTERNS = [
('[] = <expr1>',
     '.append(<expr1>)'),

    # forward counting for loops
('for ( <var1> = 0 ; <var1> < <expr2> ; <var1> ++ )',
    'for <var1> in xrange(<expr2>)'),

('for ( <var1> = <expr1> ; <var1> < <expr2> ; <var1> ++ )',
    'for <var1> in xrange(<expr1>, <expr2>)'),

('for ( <var1> = <expr1> ; <var1> <= <expr2> ; <var1> ++ )',
    'for <var1> in xrange(<expr1>, <expr2> + 1)'),

('for ( <var1> = <expr1> ; <var1> < <expr2> ; <var1> += <expr3> )',
    'for <var1> in xrange(<expr1>, <expr2>, <expr3>)'),

('for ( <var1> = <expr1> ; <var1> <= <expr2> ; <var1> += <expr3> )',
    'for <var1> in xrange(<expr1>, <expr2> + 1, <expr3>)'),

    # backward counting for loops
('for ( <var1> = <expr1> ; <var1> > <expr2> ; <var1> -- )',
    'for <var1> in xrange(<expr1>, <expr2>, -1)'),

('for ( <var1> = <expr1> ; <var1> >= <expr2> ; <var1> -- )',
    'for <var1> in xrange(<expr1>, <expr2> - 1, -1)'),

('for ( <var1> = <expr1> ; <var1> > <expr2> ; <var1> -= <expr3> )',
    'for <var1> in xrange(<expr1>, <expr2>, -<expr3>)'),

('for ( <var1> = <expr1> ; <var1> >= <expr2> ; <var1> -= <expr3> )',
    'for <var1> in xrange(<expr1>, <expr2> - 1, -<expr3>)'),

    # foreach loops
('foreach ( <expr1> as <var1> )',
    'for <var1> in <expr1>'),

('foreach ( <expr1> as <var1> => <var2> )',
    'for (<var1>, <var2>) in <expr1>.items()'),

('array_key_exists ( <expr1> , <expr2> )',
    '<expr2>.has_key(<expr1>)'),

('array_keys ( <expr1> )',
     '<expr1>.keys()'),

('array_merge ( <expr1> , <expr2> )',
     '<expr1> + <expr2>'),

('array_splice ( <expr1> , <expr2> , 1 )',
     '<expr1>.pop(<expr2>)'),

('array_splice ( <expr1> , <expr2> , 0, array ( <expr3> ) )',
     '<expr1>.insert(<expr2>, <expr3>)'),

('array_shift ( <expr1> )',
     '<expr1>.pop(0)'),

('is_int ( <expr1> )',
     'type(<expr1>) == type(0)'),

('explode( <expr1> , <expr2> )',
     '<expr2>.split(<expr1>)'),

('array_unique ( <var1> )',
     'list(set(<var1>))'),

('array_unique ( <var1> , SORT_STRING )',
     'list(set(<var1>))'),

('substr_compare ( <expr1> , <expr2> , <expr3> ) === 0',
     '<expr1>[<expr3>:] == <expr2>'),

('substr ( <expr1> , 0 , <expr3> )',
     '<expr1>[:<expr3>]'),

('substr ( <expr1> , <expr2> , <expr3> )',
     '<expr1>[<expr2>:<expr3>]'),

('in_array ( <expr1> , <expr2> )',
     '<expr1> in <expr2>'),

('call_user_func ( <expr1> ,',
     '<expr1>('),

('call_user_func ( <expr1> )',
     '<expr1>()'),

('sort ( <expr1> )',
     '<expr1>.sort()'),

('error_reporting ( <expr1> )',
     ''),

('ini_set ( <expr1> , <expr2> )',
     ''),

('require_once ( <expr1> )',
     importReplaceFunc),

("define ( ' <expr1> ' , <expr2> )",
     '<expr1> = <expr2>'),

('dictArray ( <expr1> )',
     '{<expr1>}'),

('array ( <expr1> )',
     arrayReplaceFunc),

('mktime ( <expr1> , <expr2> , <expr3> , <expr4> , <expr5> , <expr6> )',
     'time.mktime((<expr6>, <expr4>, <expr5>, <expr1>, <expr2>, <expr3>, 0, 0, 0))'),

('date ( <expr1> , <expr2> )',
     dateReplaceFunc),

('date ( <expr1> )',
     dateReplaceFunc),

('arrValues ( <expr1> )',
     '<expr1>.values()'),

('globalCallback ( <expr1> )',
    globalCallbackReplaceFunc),

('staticCallback ( <expr1> , <expr2> )',
    staticCallbackReplaceFunc),
]

########### smart pattern replace functions ###########
def isValidExpression(block):
    block = block.strip()
    if len(block) == 0:
        return True
    firstChar = block[0]
    if not firstChar in '$_-(.\'"' and not firstChar.isalnum():
        return False
    return parseSection(
        block,
        lambda segment, state, context: segment,
        lambda block, context: None,
        None)

def getExpressionLength(block, endMarker):
    curPos = 0
    while True:
        nextMarkerPos = block.find(endMarker, curPos)
        if nextMarkerPos < 0:
            return None
        nextMarkerEndPos = nextMarkerPos + len(endMarker)
        if endMarker.isalnum() and \
           ((nextMarkerPos > 0 and block[nextMarkerPos - 1].isalnum()) or \
            (nextMarkerEndPos < len(block) - 1 and block[nextMarkerEndPos + 1].isalnum())):
            curPos = nextMarkerPos + 1
            continue
        if isValidExpression(block[:nextMarkerPos]):
            return nextMarkerPos
        curPos = nextMarkerPos + 1

def tryReplaceSmartPattern(repWhat, repWith, block, startPos):
    curPos = startPos
    matchedDict = {}
    for curIndex in range(len(repWhat)):
        curRepWhat = repWhat[curIndex]
        if curIndex < len(repWhat) - 1:
            nextRepWhat = repWhat[curIndex + 1]
        else:
            nextRepWhat = None
            
        while curPos < len(block) and block[curPos].isspace():
            curPos += 1
        if curPos >= len(block):
            return None

        expected = None            
        if curRepWhat.startswith('<') and curRepWhat.endswith('>'):
            if matchedDict.has_key(curRepWhat):
                expected = matchedDict[curRepWhat]
            elif curRepWhat[1:].startswith('var'):
                if block[curPos] != '$':
                    return None
                varStartPos = curPos
                curPos += 1
                varName = getToken(block[curPos:])
                if len(varName) == 0:
                    return None
                matchedDict[curRepWhat] = '$%s' % varName
                curPos += len(varName)
            elif curRepWhat[1:].startswith('expr'):
                if nextRepWhat != None:
                    exprLength = getExpressionLength(block[curPos:], nextRepWhat)
                    if exprLength == None:
                        return None
                else:
                    exprLength = len(block[curPos:])
                exprData = block[curPos:(curPos + exprLength)].strip()
                curPos += exprLength
                matchedDict[curRepWhat] = exprData
        else:
            expected = curRepWhat

        if expected != None:            
            if block[curPos:(curPos + len(expected))] != expected:
                return None
            curPos += len(expected)

    if type(repWith) == type(''):
        result = repWith
        for (curRepWhat, curRepWith) in matchedDict.items():
            result = result.replace(curRepWhat, simpleReplacements(curRepWith))
    else:
        result = repWith(matchedDict)

    return (block[startPos:curPos], result)

def replaceSmartPatterns(block):
    replacements = []
    for (repWhat, repWith) in REPLACE_PATTERNS:
        repWhat = repWhat.split(' ')
        startMarker = repWhat[0]
        if startMarker.startswith('<var'):
            startMarker = '$'
        curPos = 0
        while True:
            curPos = block.find(startMarker, curPos)
            if curPos < 0:
                break
            curResult = tryReplaceSmartPattern(repWhat, repWith, block, curPos)
            curPos += 1
            if None == curResult:
                continue
            replacements.append(curResult)

    result = simpleReplacements(block)
    for (curRepWhat, curRepWith) in replacements:
        result = result.replace(simpleReplacements(curRepWhat), curRepWith)
        
    return result

class ParsingContext:
    def __init__(self, indent = 0, inClass = False):
        self.indent = indent
        self.inClass = inClass

    def isInClass(self):
        return self.inClass

    def enterClass(self):
        return ParsingContext(self.indent + 1, True)

    def incIndent(self):
        return ParsingContext(self.indent + 1)

    def getIndent(self):
        return '    ' * self.indent

    def indentedPrint(self, string):
        print self.getIndent() + string

def getToken(string):
    return re.match('^(\w*)', string).groups()[0]

def parseBlock(block):
    openBracePos = 0
    while True:
        openBracePos = block.find('{', openBracePos)
        if openBracePos < 0 or isValidExpression(block[:openBracePos]):
            break
        openBracePos += 1
    closeBracePos = block.rfind('}')
    if openBracePos >= 0 and closeBracePos >= 0:
        blockPrefix = block[:openBracePos].strip()
        innerBlock = block[(openBracePos + 1):closeBracePos].strip()
    else:
        blockPrefix = block.strip()
        innerBlock = None
    return (blockPrefix, innerBlock)

def processFormatString(segment):
    segment = segment[1:-1]
    formatString = ''
    formatArgs = []
    while True:
        nextPos = [segment.find('{'), segment.find('$')]
        nextPos = filter(lambda x: x >= 0, nextPos)
        if len(nextPos) == 0:
            formatString += segment
            break
        nextPos = min(nextPos)
        formatString += segment[:nextPos]
        if segment[nextPos] == '{':
            endPos = segment.find('}', nextPos)
            varName = segment[(nextPos + 1):endPos]
            segment = segment[(endPos + 1):]
        else:
            varName = re.match('^(\w+)', segment[(nextPos + 1):]).groups()[0]
            segment = segment[(nextPos + 1 + len(varName)):]
        formatArgs.append(replaceSmartPatterns(varName))
        formatString += '%s'
    if len(formatArgs) == 0:
        return '"%s"' % formatString
    return '"%s" %% (%s)' % (formatString, ', '.join(formatArgs))

def processFunctionArguments(arguments, addSelf):
    result = []
    if addSelf:
        result.append('self')
    for curArgument in arguments.split(','):
        curArgument = curArgument.strip()
        if len(curArgument) == 0:
            continue
        nameStart = curArgument.find('$')
        if curArgument[0] == '&':       # if a type was specified, this is not a mutable object so it's ok
            print '#WARNING: passing args by reference not supported (%s)' % curArgument
        result.append(simpleReplacements(curArgument[(nameStart + 1):]))
    return ', '.join(result)

def processFunction(firstToken, blockPrefix, innerBlock, context):
    nameAndArgs = blockPrefix[len(firstToken):].strip()
    argsStartPos = nameAndArgs.find('(')
    argsEndPos = nameAndArgs.rfind(')')
    nameAndSpecifiers = nameAndArgs[:argsStartPos].strip()
    nameAndSpecifiers = re.sub('\s+', ' ', nameAndSpecifiers).split(' ')
    functionName = replaceSmartPatterns(nameAndSpecifiers[-1])
    arguments = nameAndArgs[(argsStartPos + 1):argsEndPos]

    context.indentedPrint('def %s(%s):' % (functionName, processFunctionArguments(arguments, context.isInClass())))
    parseSection(innerBlock, emptyProcessSegment, processBlock, context.incIndent())

def processStaticFunction(firstToken, blockPrefix, innerBlock, context):
    nameAndArgs = blockPrefix[len(firstToken):].strip()     # XXXXXXXXX
    argsStartPos = nameAndArgs.find('(')
    argsEndPos = nameAndArgs.rfind(')')
    nameAndSpecifiers = nameAndArgs[:argsStartPos].strip()
    nameAndSpecifiers = re.sub('\s+', ' ', nameAndSpecifiers).split(' ')
    functionName = replaceSmartPatterns(nameAndSpecifiers[-1])
    arguments = nameAndArgs[(argsStartPos + 1):argsEndPos]

    context.indentedPrint('@staticmethod')
    context.indentedPrint('def %s(%s):' % (functionName, processFunctionArguments(arguments, False)))
    parseSection(innerBlock, emptyProcessSegment, processBlock, context.incIndent())

def processClass(firstToken, blockPrefix, innerBlock, context):
    nameAndExtends = blockPrefix[len(firstToken):].strip()
    context.indentedPrint('class %s:' % nameAndExtends)         # XXX extends not implmented
    parseSection(innerBlock, emptyProcessSegment, processBlock, context.enterClass())

def getArguments(block):
    argsStartPos = block.find('(')
    argsEndPos = block.rfind(')')
    return block[(argsStartPos + 1):argsEndPos]

def processFor(firstToken, blockPrefix, innerBlock, context):
    blockPrefix = replaceSmartPatterns(blockPrefix)
    arguments = getArguments(blockPrefix)
    forArgs = arguments.split(';')
    forArgs = map(lambda x: x.strip(), forArgs)
    if len(forArgs) != 3:   # already replaced by smart pattern
        if blockPrefix.endswith(';'):
            blockPrefix = blockPrefix[:-1]
        context.indentedPrint(blockPrefix + ':')
        if innerBlock != None:
            parseSection(innerBlock, emptyProcessSegment, processBlock, context.incIndent())
        else:
            context.incIndent().indentedPrint('pass')
        return        
        
    (loopStart, loopCond, loopInc) = forArgs
    if len(loopCond) == 0:
        loopCond = True

    context.indentedPrint(loopStart)
    context.indentedPrint('while (%s):' % loopCond)
    
    incContext = context.incIndent()
    if innerBlock != None:
        parseSection(innerBlock, emptyProcessSegment, processBlock, incContext)
    incContext.indentedPrint(loopInc)

BLOCK_PROCESS_MAP = {
    'function':processFunction,
    'static function':processStaticFunction,
    'class':processClass,
    'for':processFor,
    }

def processBlock(block, context):
    (blockPrefix, innerBlock) = parseBlock(block)
    processFunc = None
    for (curPrefix, curProcessFunc) in BLOCK_PROCESS_MAP.items():
        matchPattern = '^(%s)' % curPrefix.replace(' ', r'\s')
        curMatch = re.match(matchPattern, blockPrefix)
        if curMatch == None:
            continue

        firstToken = curMatch.groups()[0]        
        processFunc = curProcessFunc
        break
        
    if processFunc != None:
        processFunc(firstToken, blockPrefix, innerBlock, context)
    else:
        if blockPrefix.endswith(';'):
            blockPrefix = blockPrefix[:-1]
        if innerBlock != None:
            colon = ':'
        else:
            colon = ''
        context.indentedPrint(replaceSmartPatterns(blockPrefix + colon))
        if innerBlock != None:
            parseSection(innerBlock, emptyProcessSegment, processBlock, context.incIndent())

PS_ONELINE_COMMENT = 0
PS_MULTILINE_COMMENT = 1
PS_SIMPLE_STRING = 2
PS_FORMAT_STRING = 3
PS_NORMAL = 4

def parseSection(sectionData, processSegment, processBlock, context):
    braceCount = 0
    parentCount = 0
    brackCount = 0
    curSegment = ''
    curBlock = ''
    state = PS_NORMAL

    for curPos in xrange(len(sectionData)):
        if curPos > 0:
            prevCh = sectionData[curPos - 1]
        else:
            prevCh = None
        ch = sectionData[curPos]
        if curPos < len(sectionData) - 1:
            nextCh = sectionData[curPos + 1]
        else:
            nextCh = None

        newState = state
        lastBraceCount = braceCount
        if state == PS_NORMAL:  
            if ch == '{':
                braceCount += 1
            elif ch == '}':
                braceCount -= 1
            elif ch == '(':
                parentCount += 1
            elif ch == ')':
                parentCount -= 1
            elif ch == '[':
                brackCount += 1
            elif ch == ']':
                brackCount -= 1
            elif ch == ';':
                pass
            elif ch == '#' or (ch == '/' and nextCh == '/'):
                newState = PS_ONELINE_COMMENT
            elif ch == '/' and nextCh == '*':
                newState = PS_MULTILINE_COMMENT
            elif ch == "'":
                newState = PS_SIMPLE_STRING
            elif ch == '"':
                newState = PS_FORMAT_STRING

            if newState != state:
                curBlock += processSegment(curSegment, state, context)
                curSegment = ''
                state = newState
                
            curSegment += ch

            if braceCount == 0 and \
               parentCount == 0 and \
               brackCount == 0 and \
               (ch == ';' or lastBraceCount != 0):
                curBlock += processSegment(curSegment, state, context)
                curSegment = ''
                processBlock(curBlock, context)
                curBlock = ''
            
        else:
            if state == PS_ONELINE_COMMENT and ch == '\n':
                newState = PS_NORMAL
            elif state == PS_MULTILINE_COMMENT and ch == '/' and prevCh == '*':
                newState = PS_NORMAL
            elif state == PS_SIMPLE_STRING and ch == "'":
                newState = PS_NORMAL
            elif state == PS_FORMAT_STRING and ch == '"' and prevCh != '\\':
                newState = PS_NORMAL

            curSegment += ch

            if newState != state:
                curBlock += processSegment(curSegment, state, context)
                curSegment = ''
                if state in [PS_ONELINE_COMMENT, PS_MULTILINE_COMMENT] and \
                   braceCount == 0 and \
                   parentCount == 0 and \
                   brackCount == 0:
                    processBlock(curBlock, context)
                    curBlock = ''
                state = newState

    curBlock += processSegment(curSegment, state, context)
    processBlock(curBlock, context)

    return (braceCount == 0 and
            parentCount == 0 and
            brackCount == 0 and
            state == PS_NORMAL)

if __name__ == '__main__':
    if len(sys.argv) != 2:
        print 'Usage:\n\t%s <input php file>' % os.path.basename(__file__)
        sys.exit(1)
        
    inputFile = file(sys.argv[1], 'rb')
    inputData = inputFile.read()
    inputFile.close()

    inputData = inputData.replace('\r', '')
    inputData = inputData.replace('<?php', '')

    print '###### generated by PhPy.py ######'
    print 'import random'
    print 'import time'
    print 'import sys'
    print ''

    parseSection(inputData, emptyProcessSegment, processBlock, ParsingContext())

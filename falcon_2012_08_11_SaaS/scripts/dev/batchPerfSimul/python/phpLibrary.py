from PHPUnserialize import PHPUnserialize
import MySQLdb
import time

class Propel:
    @staticmethod
    def setConfiguration(newConfig):
        global config
        config = newConfig

    @staticmethod
    def setLogger(logger):
        pass

    @staticmethod
    def initialize():
        global conn
        dataSources = config['datasources']
        defaultConfig = dataSources['default']
        defaultConfig = dataSources[defaultConfig]
        connSettings = defaultConfig['connection']
        conn = MySQLdb.Connection(
            db=connSettings['database'],
            host=connSettings['hostspec'],
            user=connSettings['user'],
            passwd=connSettings['password'])

class Criteria:
    EQUAL = '='
    LESS_THAN = '<'
    GREATER_THAN = '>'
    GREATER_EQUAL = '>='
    IN = 'IN'

    def __init__(self):
        self.query = []
        self.order = ''
    
    def addAnd(self, colName, compVal, compRel):
        self.query.append((colName, compRel, compVal))

    def addAscendingOrderByColumn(self, colName):
        self.order = ' ORDER BY %s' % colName

    @staticmethod
    def formatSingleValue(value, columnType):
        if columnType == 'DATE':
            return "DATE('%s')" % value
        return str(value)

    def getQueryString(self, columnTypes):
        curQuery = []
        for (colName, compRel, compVal) in self.query:
            colType = columnTypes[colName]
            if type(compVal) == type([]):
                compVal = '(%s)' % (', '.join(map(lambda x: self.formatSingleValue(x, colType), compVal)))
            curQuery.append('%s %s %s' % (colName, compRel, self.formatSingleValue(compVal, colType)))
            
        return ' AND '.join(curQuery) + self.order

class BatchJobPeer:
    TABLE_NAME = 'batch_job'

    CREATED_AT = 'created_at'
    QUEUE_TIME = 'queue_time'
    FINISH_TIME = 'finish_time'
    JOB_TYPE = 'job_type'
    LAST_SCHEDULER_ID = 'last_scheduler_id'

    COLUMN_TYPES = {
        CREATED_AT: 'DATE',
        QUEUE_TIME: 'DATE',
        FINISH_TIME: 'DATE',
        JOB_TYPE: 'INT',
        LAST_SCHEDULER_ID: 'INT',
        }

    @staticmethod
    def doSelect(criteria):
        query = 'SELECT * FROM %s WHERE %s' % (BatchJobPeer.TABLE_NAME, criteria.getQueryString(BatchJobPeer.COLUMN_TYPES))
        cursor = conn.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute(query)
        result = []
        for curEntry in cursor.fetchall():
            result.append(BatchJob(curEntry))
        return result

    @staticmethod
    def clearInstancePool():
        pass

class mediaInfoPeer:
    TABLE_NAME = 'media_info'
    
    PRIMARY_KEY = 'id'
    
    @staticmethod
    def retrieveByPK(primKey):
        if primKey == None:
            return None
        query = 'SELECT * FROM %s WHERE %s=%s' % (mediaInfoPeer.TABLE_NAME, mediaInfoPeer.PRIMARY_KEY, primKey)
        cursor = conn.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute(query)
        return mediaInfo(cursor.fetchone())

    @staticmethod
    def clearInstancePool():
        pass

class kConvertJobData:
    def __init__(self, dataDict):
        self.dataDict = dataDict

    def getMediaInfoId(self):
        return self.dataDict['mediaInfoId']

def dateTimeToUnixTime(dateTime):
    return time.mktime(dateTime.timetuple())+(1e-6)*dateTime.microsecond

class BatchJob:
    BATCHJOB_STATUS_FINISHED = 5
    
    def __init__(self, dataDict):
        self.dataDict = dataDict
        
    def getCreatedAt(self, ignore):
        return dateTimeToUnixTime(self.dataDict['created_at'])

    def getQueueTime(self, ignore):
        return dateTimeToUnixTime(self.dataDict['queue_time'])

    def getFinishTime(self, ignore):
        return dateTimeToUnixTime(self.dataDict['finish_time'])

    def getDc(self):
        return self.dataDict['dc']

    def getId(self):
        return self.dataDict['id']

    def getEntryId(self):
        return self.dataDict['entry_id']

    def getPartnerId(self):
        return self.dataDict['partner_id']

    def getPriority(self):
        return self.dataDict['priority']

    def getExecutionAttempts(self):
        return self.dataDict['execution_attempts']

    def getStatus(self):
        return self.dataDict['status']

    def getData(self):
        return kConvertJobData(PHPUnserialize().unserialize(self.dataDict['data']))


class mediaInfo:
    def __init__(self, dataDict):
        self.dataDict = dataDict

    def getVideoDuration(self):
        return self.dataDict['video_duration']

    def getContainerDuration(self):
        return self.dataDict['container_duration']

class KalturaLog:
    @staticmethod
    def getInstance():
        return None

class BatchJobType:
    CONVERT = 0

def memory_get_usage():
    return 0

def getdate(theTime):
    timeTuple = time.localtime(theTime)
    return {
        'year':timeTuple[0],
        'mon':timeTuple[1],
        'mday':timeTuple[2],
        'hours':timeTuple[3],
        }

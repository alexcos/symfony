<?php
namespace G4\UtilBundle\Services\CouchLogging;
/**
 * This does not log to couch, but logs all to file, for easier debug purposes
 */
class LogFile extends CouchLogging implements CouchLoggingInterface
{
    private $folder = "/tmp/sy2-logs/";
    private $httpFile = "http.log";
    private $reswebFile = "resweb.log";
    private $memcacheFile = "memcache.log";
    private $otherFile = "other.log";

    /**
     * @param string $data
     */
    public function writeLog($data, $needId = false)
    {
        $dataArr = json_decode($data, true);
        $fileToWrite = $this->otherFile;

        switch($dataArr["type"])
        {
            case "RESWEB_IN_REQUEST": $fileToWrite = $this->reswebFile; break;
            case "RESWEB_RESPONSE": $fileToWrite = $this->reswebFile; break;
            case "HTTP_IN_REQUEST": $fileToWrite = $this->httpFile; break;
            case "HTTP_OUT_REQUEST": $fileToWrite = $this->httpFile; break;
            case "MEMCACHE_WRITE": $fileToWrite = $this->memcacheFile; break;
            case "MEMCACHE_READ": $fileToWrite = $this->memcacheFile; break;
        }

        file_put_contents($this->folder . $fileToWrite, $data . "\r\n\r\n", FILE_APPEND);
    }

    /**
     * this will create the files
     */
    public function createDatabase()
    {
         if (!file_exists($this->folder)) {
             mkdir($this->folder, 0777, true);
         }
        if (!file_exists($this->folder.$this->reswebFile)) {
             file_put_contents($this->folder.$this->reswebFile, "\r\n");
             chmod($this->folder.$this->reswebFile, 0666);
        }
        if (!file_exists($this->folder.$this->memcacheFile)) {
            file_put_contents($this->folder.$this->memcacheFile, "\r\n");
            chmod($this->folder.$this->memcacheFile, 0666);
        }
        if (!file_exists($this->folder.$this->httpFile)) {
            file_put_contents($this->folder.$this->httpFile, "\r\n");
            chmod($this->folder.$this->httpFile, 0666);
        }
        if (!file_exists($this->folder.$this->otherFile)) {
            file_put_contents($this->folder.$this->otherFile, "\r\n");
            chmod($this->folder.$this->otherFile, 0666);
        }
    }

}

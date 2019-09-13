<?php
/**
 * This class contains any methods deal DB
 * @version: 20160216
 * @author: Md Fahim Uddin
 */

class Lib_DB
{
    /**
     * database connection string
     * @var resource
     */
    private $PDO;

    /**
     * last statement handle
     * @var object
     */
    private $sth;

    /**
     * holds last error message
     * @var string
     */
    private $lastErrorMsg = '';

    /**
     * establish a new connect with the database
     */
    public function connectToDB()
    {
        $connInfo = $this->getDBInfo();
        $this->PDO = new PDO("mysql:host={$connInfo['dbHost']};dbname={$connInfo['dbName']}", $connInfo['dbUser'], $connInfo['dbPass']);
    }

    /**
     * get the database connection from the JSON file
     * @return array (database connection information)
     * @throws Exception
     */
    private function getDBInfo()
    {
        $connInfo = ZIT()->Lib_JSON->loadData('DB.json')->getData('db_' . APP_MODE);

        if ($connInfo === null || false) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . __LINE__ . ": Database connection information not found");
        }

        //check all mandatory params are defined
        $dbParams = array('dbHost', 'dbUser', 'dbPass', 'dbName');
        foreach ($dbParams as $param) {
            if (empty($connInfo[$param])) {
                throw new Exception('Location ' . get_class($this) . ' line # ' . __LINE__ . ": Database param '{$param}' not defined");
            }
        }

        return $connInfo;
    }

    /**
     * the reason for adding this extra layer is to make sure
     * that all queries get passed through one single point. this practice will give us power to
     * implement any extra checking on the query in the future
     * @param string $sql
     * @param string $callingScript (from the script this method get called)
     * @param string $callingLine (from the line this method get called)
     * @param array $params
     * @param bool $debug
     * @return object|false (false if any error occurred)
     */
    public function query($sql, $callingScript, $callingLine, $params = array(), $debug = false)
    {
        $identifier = "{$callingScript} line # $callingLine";

        //run the sql
        $this->sth = $this->PDO->prepare($sql);
        $this->sth->execute($params);

        //check for error
        $this->setLastError();

        //debug the last statement
        if ($debug === true) {
            echo "<br><strong>{$identifier}</strong><br />" . PHP_EOL;
            echo $sql . '<br>' . PHP_EOL;
            echo '<pre>'; print_r($params); echo '</pre><br>' . PHP_EOL;
            echo "<strong>Error:</strong> {$this->lastErrorMsg}<br />" . PHP_EOL;
            echo PHP_EOL . '<br>------------------------------------------------------------------------<br>' . PHP_EOL;
        }

        if (APP_MODE == 'test' && !empty($this->lastErrorMsg)) {
            echo "{$this->lastErrorMsg} in $sql in $identifier";
            exit();
        }
        return $this->sth;
    }

    /**
     * @return object|bool (false if any error is found)
     */
    private function setLastError()
    {
        //omit any error form the last statement
        $this->lastErrorMsg = '';

        $error = $this->sth->errorInfo();
        if (!empty($error[2])) {
            $this->lastErrorMsg = $error[2];

            $this->sth = false;
        }

        $this->sth;
    }

    /**
     * returns the error generated from the last statement
     * @return string
     */
    public function getLastError()
    {
        return $this->lastErrorMsg;
    }
}
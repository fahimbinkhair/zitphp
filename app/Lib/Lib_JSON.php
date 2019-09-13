<?php
/**
 * JSON parser
 * @author Md Fahim Uddin
 * @version 20160418
 */
final class Lib_JSON
{
    /**
     * key of $this->JSONData
     * @var string
     */
    private $keyName;

    /**
     * holds all data from JSON file
     * @var array
     */
    private $JSONData = array();

    /**
     * @param string $fileName (only file name no path)
     * @throws Exception
     * @return $this
     */
    final public function loadData($fileName)
    {
        $file = dirname(dirname(__FILE__)) . '/Configs/Configs_' . $fileName;
        if (!is_file($file)) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . __LINE__ . ": Can not find the file {$file}");
        }

        $this->keyName = preg_replace('([^\w])', '', basename($fileName)); //replace anything not letter, number, underscore
        if (!array_key_exists($this->keyName, $this->JSONData)) {
            if (false === ($jsonData = file_get_contents($file, true))) {
                throw new Exception('Location ' . get_class($this) . ' line # ' . __LINE__ . ": Can not read {$fileName}");
            }

            $this->JSONData[$this->keyName] = json_decode($jsonData, true);
        }

        return $this;
    }

    /**
     * get the value/section from the JSON file
     * @param string $section (key of the JSON array)
     * @param null $default (default value)
     * @return mixed
     */
    public function getData($section, $default = null)
    {
        $val = $default;
        if (array_key_exists($section, $this->JSONData[$this->keyName])) {
            $val = $this->JSONData[$this->keyName][$section];
        }

        return $val;
    }
}
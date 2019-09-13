<?php
/**
 * auto loader to load classes
 * @author Md. Fahim Uddin
 * @version 20160418
 */

/**
 * @return Lib_VirtualLoader
 */
function ZIT()
{
    $instance = new Lib_Loader;
    return $instance;
}

final class Lib_Loader
{
    /**
     * hold list of the defined classes
     * @var array
     */
    private static $_instances = array();

    /**
     * magic method to get class name
     * @param string className (name of the class to be invoked)
     * @return resource (class instance)
     */
    public function __get($className)
    {
        if (!array_key_exists($className, self::$_instances)) {
            self::$_instances[$className] = new $className;
        }

        return self::$_instances[$className];
    }

    /**
     * load classes
     * @param string className
     * @throws Exception
     */
    final public static function autoLoad($className)
    {
        $dirName = dirname(str_replace('_', DIRECTORY_SEPARATOR, $className));
        $fileName = "{$className}.php";
        require_once($dirName . DIRECTORY_SEPARATOR . $fileName);

        if (!class_exists($className)) {
            throw new Exception('Location: Lib_Loader line # ' . __LINE__ . ": Class {$className} not found in {$dirName}");
        }
    }
}

//register the auto loader
spl_autoload_register('Lib_Loader::autoLoad');

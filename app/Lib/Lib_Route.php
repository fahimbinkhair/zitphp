<?php
/**
 * parse Configs_Routes.json for expected route information
 * this class is a decorator for the class Lib_JSON
 * @author Md Fahim Uddin
 * @version 20160419
 */
final class Lib_Route
{
    /**
     * 3rd param of the preg_match to hold route sections
     * @var array
     */
    public $routeMatches = array();

    /**
     * @param string $path (the query string from the browser)
     * @return string
     * @throws Exception
     */
    public function getRoute($path)
    {
        $path = substr($path, -1) == '/' ? substr($path, 0, strlen($path) - 1) : $path; //take slash off from the end
        $path = $path == '' ? '/' : $path;
        $routes = ZIT()->Lib_JSON->loadData('Routes.json')->getData('routes');
        $route = null;

        foreach ($routes as $key => $value) {
            if (preg_match('(^' . $key . '$)i', $path, $this->routeMatches)) {
                $route = $value;
                break; //stop looping
            }
        }

        if ($route === null) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . __LINE__ . ": No route info found for {$path}");
        }

        return $route;
    }
}
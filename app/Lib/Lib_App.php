<?php
/**
 * loads the application
 * loads required controller, view and template
 * @author Md Fahim Uddin
 * @version 20160418
 */
final class Lib_App
{
    /**
     * hold the name of the controller
     * @var string
     */
    private $controller = '';

    /**
     * holds the name of the action
     * @var string
     */
    private $action = '';

    /**
     * load require controller, view and template
     */
    public function loadApp()
    {
        //get any user input
        ZIT()->Lib_Input->collectAllUserInputs();

        //connect with DB
        ZIT()->Lib_DB->connectToDB();

        //load the application
        $route = $this->getRoute();
        $this->setController($route);
        $this->setAction($route);

        if (empty($this->action)) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . ": Action name not found");
        }

        //load controller and action
        ZIT()->{$this->controller}->{$this->action}();

        //log this request
        ZIT()->Models_Logs->createLog();
    }

    /**
     * get the associated controller, view and template
     * @return array (returns empty array if path not found)
     */
    public function getRoute()
    {
        $path = ZIT()->Lib_Input->urlPath = $_GET['path'];
        $route = ZIT()->Lib_Route->getRoute($path);

        return $route;
    }

    /**
     * @param array $route
     * @throws Exception
     */
    private function setController($route)
    {
        $controller = isset($route['controller']) ? $route['controller'] : '';
        if (!preg_match('(^Controllers_.+$)', $controller)) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . ": Controller name '{$controller}' seems to be incorrect. The name should start with 'Controllers_'");
        }

        $this->controller = $controller;
    }


    /**
     * get the name of the current controller
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param array $route
     * @throws Exception
     */
    private function setAction($route)
    {
        $action = isset($route['action']) ? $route['action'] : '';
        if (!preg_match('(^action_.+$)', $action)) {
            throw new Exception('Location ' . get_class($this) . ' line # ' . ": Action name '{$action}' seems to be incorrect. The name should start with 'action_'");
        }

        $this->action = $action;
    }

    /**
     * get the name of the current action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * get the default template
     * @return string
     */
    public function getDefaultTemplate()
    {
        return 'default';
    }
}
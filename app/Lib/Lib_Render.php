<?php
/**
 * this class handles rendering data
 * @author Md Fahim Uddin
 * @version 20160425
 */
final class Lib_Render
{
    /**
     * holds the view file with full path
     * @var string
     */
    private $view;

    /**
     * holds the params need to be passed to the view
     * @var array
     */
    private $params = array();

    /**
     * @param string $view (path/to-view/view-name.php i.e. Views_more_path_into_viewName)
     * the "_" will be translated into "/" and ".php" will be added at the end
     * @param string $template (pass it if you want to override default template i.e. Templates_templateName.php)
     * @param array $params (i.e array('varName' => 'value'))
     * the key of $params will be available into the view i.e echo $varName
     * @throws Exception
     */
    public function toView($view, $template = null, $params = array())
    {
        $this->view = $this->getViewFile($view);
        $template = $this->getTemplateFile($template);
        $this->params = $this->checkParams($params);

        require_once ("{$template}");
    }

    /**
     * output JSON array
     * @param array $data
     */
    public function toJSON(array $data)
    {
        $jsonData = json_encode($data);
        echo $jsonData;
    }

    /**
     * get the view file with full path
     * @param string $view
     * @return string string
     * @throws Exception
     */
    private function getViewFile($view)
    {
        $controller = $this->getControllerName();
        $view = "Views_{$controller}_{$view}";
        $view = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . ZIT()->Lib_Helper->strToPath($view, true) . '.php';

        if (!is_file($view)) {
            throw new Exception('Location: ' . get_class($this) . ' line # ' . __LINE__ . ": No file found in {$view}");
        }

        return $view;
    }

    /**
     * get the name of the controller6 without word "Controllers_"
     * @return string
     */
    private function getControllerName()
    {
        $controller = ZIT()->Lib_App->getController();
        $controller = str_replace('Controllers_', '', $controller); //take "Controllers_" off
        return $controller;
    }

    /**
     * get the template to be displayed
     * @param string $template
     * @return string (template with full path)
     * @throws Exception
     */
    private function getTemplateFile($template)
    {
        $template = $template === null ? ZIT()->Lib_App->getDefaultTemplate() : $template;
        $template = ZIT()->Lib_Helper->strToPath("Templates_{$template}.php", true);
        $template = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $template;
        return $template;
    }

    /**
     * @param array $params
     * @return array
     * @throws Exception
     */
    private function checkParams($params)
    {
        if (!is_array($params)) {
            throw new Exception('Location: ' . get_class($this) . ' line # ' . __LINE__ . ": The 3rd param of the method toView must be an array");
        }

        return $params;
    }

    /**
     * this method include the view file to the application
     * you want to add this method into your template like ZIT()->Lib_Render->getView();
     */
    public function getView()
    {
        //convert $keys to $variable
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        require_once ("{$this->view}");
    }
}
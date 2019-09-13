<?php
/**
 * this class collects any input received from the browser i.e. POST, GET, PUT
 * @note POST params get priority over the GET params. And php://input get priority over everything
 * @author Md Fahim Uddin
 * @version 20160329
 */

final class Lib_Input
{
    /**
     * holds the current path from the URL i.e.
     * the full URL is http://www.abc.com/your-location
     * the value of this property will be "your-location".
     * The property is populated by Lib_App::getRoute
     * @var
     */
    public $urlPath;

    /**
     * holds any user input
     * @var array
     */
    private $userInput = array();

    /**
     * public interface of the class
     */
    public function collectAllUserInputs()
    {
        $this->getGetParams();
        $this->getPostParams();
        $this->getAJAXInput();
    }

    /**
     * get any get input came through GET
     */
    private function getGetParams()
    {
        if (!empty($_GET['qs'])) {
            $qs = json_decode(urldecode(rawurldecode($_GET['qs'])), true);
            foreach ($qs as $key => $value) {
                $this->userInput[$key] = $value;
            }
        }
    }

    /**
     * get any get input came through POST
     */
    private function getPostParams()
    {
        if (isset($_POST) && count($_POST) > 0) {
            foreach ($_POST as $key => $value) {
                $this->userInput[$key] = $value;
            }
        }
    }

    /**
     * get any user input submitted via AJAX request (usually POST request)
     */
    private function getAJAXInput()
    {
        $userInput = file_get_contents("php://input");
        if ($userInput != '') {
            $userInput = json_decode($userInput, true);
            if (is_array($userInput) && count($userInput) > 0) {
                foreach ($userInput as $key => $value) {
                    $this->userInput[$key] = $value;
                }
            }
        }
    }

    /**
     * @param string $param (form field name/query string variable name)
     * @param string $default (if empty; or the requested variable is not defined)
     * @return string (the value)
     */
    public function getInput($param, $default = '')
    {
        $value = $default;
        if (array_key_exists($param, $this->userInput)) {
            $value = $this->userInput[$param];
        }

        return $value;
    }

    /**
     * get all user input
     * @return array
     */
    public function getAllInputs()
    {
        return $this->userInput;
    }
}
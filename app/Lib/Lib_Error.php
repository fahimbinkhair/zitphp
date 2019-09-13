<?php
/**
 * Holds the errors need to be passed to the user
 * @author Md Fahim Uddin
 * @version 20160430
 */
class Lib_Error
{
    /**
     * holds all error
     * @var array (i.r array('identifier' => array('msg' => 'Error message', 'tracking' => 'tracking info i.e. from where the error is generated'))
     */
    private $errors = array();

    /**
     * @param string $identifier (array index)
     * @param string $msg (error message)
     * @param null|string $tracking (any information to help tracking the error i.e. from where the error is generated)
     */
    public function setError($identifier, $msg, $tracking = null)
    {
        $this->errors[$identifier] = array(
            'msg' => $msg,
            'tracking' => $tracking
        );
    }

    /**
     * @param string $identifier (array index)
     * @param string $infoType (i.e. msg or tracking)
     * @param bool $checkQs (check query string for this identifier)
     * @return string
     */
    public function printError($identifier, $infoType = 'msg', $checkQs = false)
    {
        $info = '';
        if (array_key_exists($identifier, $this->errors)) {
            if (!empty($this->errors[$identifier][$infoType])) {
                $info = $this->errors[$identifier][$infoType];
            }
        } elseif ($checkQs === true && array_key_exists($identifier, ZIT()->Lib_Input->getAllInputs())) {
            //check if passed by query-string
            $info = ZIT()->Lib_Input->getInput($identifier);
        }

        if ($info != '') {
            $info = "<div class=\"alert alert-danger\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>{$info}</strong></div>";
        }

        return $info;
    }

    /**
     * get all errors
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * get total number of error
     * @return int
     */
    public function getErrorNum()
    {
        return count($this->errors);
    }
}

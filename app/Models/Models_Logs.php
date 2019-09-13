<?php
/**
 * Handles communications with the logs table
 * @author Md Fahim Uddin
 * @version 20160511
 */
class Models_Logs
{
    /**
     * @return bool (true on success; else false)
     */
    public function createLog()
    {
        $flag = true;
        $userInput = array('userInput' => ZIT()->Lib_Input->getAllInputs());
        $error = array('error' => ZIT()->Lib_Error->getErrors());

        $sql = "INSERT INTO logs SET
                phpSessId = :phpSessId,
                controllerName = :controllerName,
                actionName = :actionName,
                remoteAddr = :remoteAddr,
                details = :details,
                status = 'active',
                createdAt = :createdAt";

        $params = array(
            ':phpSessId' => ZIT()->Services_Helper->getSessionId(),
            ':controllerName' => ZIT()->Lib_App->getController(),
            ':actionName' => ZIT()->Lib_App->getAction(),
            ':remoteAddr' => $_SERVER['REMOTE_ADDR'],
            ':details' => json_encode(array_merge($userInput, $error)),
            ':createdAt' => ZIT()->Lib_DateTime->dateTime->format('Y-m-d H:i:s')
        );

        if (false === ($sth = ZIT()->Lib_DB->query($sql, __FILE__, __LINE__, $params))) {
            $flag = false;
        }

        return $flag;
    }
}
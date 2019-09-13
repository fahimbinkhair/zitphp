<?php
/**
 * Handles communications with the sessions table
 * @author Md Fahim Uddin
 * @version 20160509
 */
class Models_Sessions
{
    /**
     * holds information about this admin
     * @var array
     */
    private $adminInfo = array();

    /**
     * @param bool $isLoggedIn
     * @return bool (true on success; else false)
     */
    public function createUpdateSession($isLoggedIn = false)
    {
        $flag = true;
        $fieldsToUpdate = "phpSessId = :phpSessId, userId = :userId, password = :password, ";
        $fieldsToUpdate .= "status='active', remoteAddr = :remoteAddr, updatedAt = :updatedAt";
        $fieldsToInsert = $fieldsToUpdate . ", createdAt = :createdAt";

        $params = array(
            ':phpSessId' => ZIT()->Services_Helper->getSessionId(),
            ':userId' => $isLoggedIn === false ? ZIT()->Lib_Input->getInput('email') : $this->getAdminInfo('userId'),
            ':password' => $isLoggedIn === false ? md5(ZIT()->Lib_Input->getInput('password')) : $this->getAdminInfo('password'),
            ':remoteAddr' => $_SERVER['REMOTE_ADDR'],
            ':createdAt' => ZIT()->Lib_DateTime->dateTime->format('Y-m-d H:i:s'),
            ':updatedAt' => ZIT()->Lib_DateTime->dateTime->format('Y-m-d H:i:s')
        );

        $sql = "INSERT INTO sessions SET {$fieldsToInsert} ON DUPLICATE KEY UPDATE {$fieldsToUpdate}";
        if (false === ($sth = ZIT()->Lib_DB->query($sql, __FILE__, __LINE__, $params))) {
            $flag = false;
        }

        return $flag;
    }

    /**
     * check is user has logged into the system
     */
    public function checkIsLoggedIn()
    {
        $this->setAdminInfo();
        $userId = $this->getAdminInfo('userId');
        $sessionStatus = $this->getAdminInfo('status');
        $adminStatus = $this->getAdminInfo('adminStatus');

        if (empty($userId) || $sessionStatus != 'active' || $adminStatus != 'active') {
            ZIT()->Lib_Helper->redirect('/Admin_AK', array('adminLoginError' => 'Sorry! You are not logged in'));
        } else {
            $this->createUpdateSession(true);
        }
    }

    /**
     * get this admin info
     */
    private function setAdminInfo()
    {
        $sql = "SELECT s.*, a.name, a.status AS adminStatus
                FROM sessions AS s INNER JOIN admin AS a ON s.userId = a.userId
                WHERE s.phpSessId = :phpSessId";

        $params = array(
            ':phpSessId' => ZIT()->Services_Helper->getSessionId()
        );

        if (false !== ($sth = ZIT()->Lib_DB->query($sql, __LINE__, __LINE__, $params))) {
            if ($sth->rowCount() > 0) {
                $this->adminInfo = $sth->fetch(PDO::FETCH_ASSOC);
            }
        }

//        print_r($this->adminInfo);
    }

    /**
     * @param null $infoType (i.e. name, userId, etc)
     * @return string|array
     */
    public function getAdminInfo($infoType = null)
    {
        $data = null;

        if (!empty($infoType)) {
            if (array_key_exists($infoType, $this->adminInfo)) {
                $data = $this->adminInfo[$infoType];
            }
        } else {
            $data = $this->adminInfo;
        }

        return $data;
    }
}
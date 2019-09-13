 from ubuntu
 <?php

/**
 * Handles communications with the admin table
 * @author Md Fahim Uddin
 * @version 20160103
 */
class Models_Admin
{
    /**
     * @return bool (true on success; else false)
     */
    public function checkAdminLogin()
    {
        $sql = "SELECT * FROM admin WHERE userId=:email AND password=:password LIMIT 1";
        $params = array(
            ':email' => ZIT()->Lib_Input->getInput('email'),
            ':password' => md5(ZIT()->Lib_Input->getInput('password'))
        );

        if (false === ($sth = ZIT()->Lib_DB->query($sql, __FILE__, __LINE__, $params))) {
            ZIT()->Lib_Error->setError('adminLoginError', 'Oops! something went wrong.');
            return false;
        }

        if ($sth->rowCount() == '1') {
            $qData = $sth->fetch(PDO::FETCH_ASSOC);
            if ($qData['status'] == 'inactive') {
                ZIT()->Lib_Error->setError('adminLoginError', 'Sorry! This account has been suspended. Please contact web-master.');
                return false;
            } elseif ($qData['status'] == 'active') {
                return true;
            }
        }

        ZIT()->Lib_Error->setError('adminLoginError', 'Sorry! No account found.');
        return false;
    }
}
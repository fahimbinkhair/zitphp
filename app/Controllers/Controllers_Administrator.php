<?php
/**
 * handles any thing related to administrator
 * @author Md Fahim Uddin
 * @version 20160517
 */
class Controllers_Administrator extends Lib_Controllers
{
    /**
     * add new admin
     */
    public function action_addAdministrator()
    {
        ZIT()->Models_Sessions->checkIsLoggedIn();

        if (ZIT()->Lib_Input->getInput('btnAdd') == 'Submit') {
            $this->validateAddAdmin();

            if (ZIT()->Lib_Error->getErrorNum() > 0) {
                $result['error'] = ZIT()->Lib_Error->getErrors();
                ZIT()->Lib_Render->toJSON($result);
            }
        } else {
            ZIT()->Lib_Render->toView('addAdmin', 'admin');
        }
    }

    /**
     * validate the fields while adding a new admin
     */
    private function validateAddAdmin()
    {
        $input = ZIT()->Lib_Input;
        $userId = $input->getInput('userId');
        $password = $input->getInput('password');
        $confirmPassword = $input->getInput('confirmPassword');
        $adminName = $input->getInput('adminName');

        if (empty($userId)) {
            ZIT()->Lib_Error->setError('userId', 'Please input user id (email address)');
        }

        if (empty($password)) {
            ZIT()->Lib_Error->setError('password', 'Please input password');
        } elseif (empty($confirmPassword)) {
            ZIT()->Lib_Error->setError('confirmPassword', 'Please input confirm password');
        } elseif ($password != $confirmPassword) {
            ZIT()->Lib_Error->setError('confirmPassword', 'Confirm password does not match with the password');
        }

        if (empty($adminName)) {
            ZIT()->Lib_Error->setError('adminName', 'Please input name');
        }
    }
}
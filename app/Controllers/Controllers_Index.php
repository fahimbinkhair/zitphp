<?php
/**
 * the default controller for both user and admin panel
 * @author Md Fahim Uddin
 * @version 20160419
 */
class Controllers_Index extends Lib_Controllers
{
    /**
     * to handle admin login window
     */
    public function action_adminLogin()
    {
        if (ZIT()->Lib_Input->getInput('btnSubmit') == 'Login') {
            if ('' == ($email = ZIT()->Lib_Input->getInput('email'))) {
                ZIT()->Lib_Error->setError('email', 'Please input email address');
            }

            if ('' == ($email = ZIT()->Lib_Input->getInput('password'))) {
                ZIT()->Lib_Error->setError('password', 'Please input password');
            }

            if (ZIT()->Lib_Error->getErrorNum() == 0) {
                if (true === ZIT()->Models_Admin->checkAdminLogin()) {
                    if (true === ZIT()->Models_Sessions->createUpdateSession()) {
                        ZIT()->Lib_Helper->redirect('/Admin_AK/home');
                    }
                }
            }
        }

        ZIT()->Lib_Render->toView('adminLogin', 'adminLogin');
    }
}
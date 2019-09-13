<?php
/**
 * handles admin dash board
 * @author Md Fahim Uddin
 * @version 20160503
 */
class Controllers_AdminDashBoard extends Lib_Controllers
{
    /**
     * to handle admin login window
     */
    public function action_index()
    {
        ZIT()->Models_Sessions->checkIsLoggedIn();

        ZIT()->Lib_Render->toView('adminDashBoard', 'admin');
    }
}
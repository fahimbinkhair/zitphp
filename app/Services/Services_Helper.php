<?php
/**
 * contains the contents may required into different part on the system
 * @author Md Fahim Uddin
 * @version 20160509
 */
class Services_Helper
{
    /**
     * @return string (current user's session id)
     */
    public function getSessionId()
    {
        $phpSesId = session_id();
        return $phpSesId;
    }
}
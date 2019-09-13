<?php
/**
 * virtual loader for the classes
 * this class simply a little trick to enable IDE to navigate through
 * the classes when they get called via ZIT()->Class_name
 * @property Lib_App $Lib_App
 * @property Lib_DB $Lib_DB
 * @property Lib_Error $Lib_Error
 * @property Lib_Helper $Lib_Helper
 * @property Lib_JSON $Lib_JSON
 * @property Lib_Route $Lib_Route
 * @property Lib_Render $Lib_Render
 * @property Lib_Input $Lib_Input
 * @property Lib_DateTime $Lib_DateTime
 *
 * @property Models_Admin $Models_Admin
 * @property Models_Sessions $Models_Sessions
 * @property Models_Logs $Models_Logs
 *
 * @property Services_Assets $Services_Assets
 * @property Services_AdminTopMenu $Services_AdminTopMenu
 * @property Services_Helper $Services_Helper
 */
class Lib_VirtualLoader extends Lib_Loader {}
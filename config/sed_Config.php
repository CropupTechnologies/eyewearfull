<?php

$config['SED_CONFIG']=1;


define('SED_EmailNotice_ToClient', 0);
define('SED_EmailNotice_ToSmartSupport', 1);
define('SED_ErrorLog_ClientLogFile', 1);
define('SED_ErrorLog_ClientAuditTrail', 0);
define('SED_ErroLog_ShowMessage', 0);

define('SED_USER_TYPE_USER', 30);
define('SED_USER_TYPE_ADMIN', 80);


//////Audit Trail - Action /////////

define("AUDITTRAIL_ADDNEW", 1);
define("AUDITTRAIL_VIEW", 2);
define("AUDITTRAIL_UPDATE", 3);
define("AUDITTRAIL_PRINT", 4);
define("AUDITTRAIL_DELETE", 5);
define("AUDITTRAIL_DOWNLOAD", 6);
define("AUDITTRAIL_ERROR", 7);
define("AUDITTRAIL_LOGIN", 8);
define("AUDITTRAIL_LOGOUT", 9);
define("AUDITTRAIL_EMAIL", 10);
define("AUDITTRAIL_SEARCH", 11);
define("AUDITTRAIL_WARNING", 12);
define("AUDITTRAIL_INFORMATION", 13);
define("AUDITTRAIL_NOTICE", 14);




$SED_Smart_LogFile_Path = "";
$SED_Smart_LogFile_Name = "SmartErrLog.txt";



$SED_Global_Email_ReturnAddress = "returnmail@smartedesigners.com";


/////////////////////////////////////////////////////////////////////////////////
// SED Error Email Notification Settings
/////////////////////////////////////////////////////////////////////////////////
$SED_ErrNotice_FromName = 'Smart Error Handler';
$SED_ErrNotice_FromAddress = "errorhandler@smartedesigners.com";

$SED_ErrNotice_ToName = "Smart Error Reporter";
$SED_ErrNotice_ToAddress = "errorreport@smartedesigners.com";

$SED_ErrNotice_ReturnPath = "";



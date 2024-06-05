<?php session_start();

require_once('enums/Country.php');
require_once('enums/Gender.php');
require_once('enums/Role.php');

require_once('classes/validation/AbstractRule.php');
require_once('classes/validation/CustomRule.php');
require_once('classes/validation/DateFormatRule.php');
require_once('classes/validation/EmailRule.php');
require_once('classes/validation/EnumRule.php');
require_once('classes/validation/EqualRule.php');
require_once('classes/validation/MaxLengthRule.php');
require_once('classes/validation/MinLengthRule.php');
require_once('classes/validation/RegexRule.php');
require_once('classes/validation/RequiredRule.php');

require_once('classes/DBConnection.php');
require_once('classes/AuthManager.php');
require_once('classes/FormValidator.php');
require_once('classes/AbstractModel.php');
require_once('classes/UserModel.php');

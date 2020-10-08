<?php

use Controllers\LoginController;

$login = LoginController::getInstance();

switch ($_POST['action']){
    case 'Login':
        echo trim($login->authenticate($_POST['AccountName'],$_POST['AccountPass']));
        break;
}

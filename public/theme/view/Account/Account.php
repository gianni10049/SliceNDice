<?php

use Controllers\AccountController;

$acc = AccountController::getInstance();

?>

<div id="AccountBox">
    <?php if (!$acc->AccountConnected()) {
        require(__DIR__ . '/Login.php');
    } else {
        require(__DIR__ . '/Visual.php');
    } ?>
</div>

<script src="/public/theme/JS/Account.js"></script>

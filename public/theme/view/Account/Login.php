<?php

use Controllers\AccountController;

$acc = AccountController::getInstance();

if (!$acc->AccountConnected()) {
    ?>

    <form method="POST" id="AccountLogin">

        <div class="input_box">
            <h3>
                <label for="AccountName">Nome Utente</label><br>
            </h3>
            <input type="text" name="AccountName" id="AccountName">
        </div>

        <div class="input_box">
            <h3>
                <label for="AccountPass">Password Utente</label><br>
            </h3>
            <input type="password" name="AccountPass" id="AccountPass">
        </div>

        <div class="input_box">
            <input type="hidden" name="action" value="Login">
            <input type="submit" value="Login">
        </div>

    </form>

<?php } ?>
<?php

# Call needed libraries
use Libraries\Security;
use Libraries\Template;

# Start needed classes
$tpl = new Template();
$sec = Security::getInstance();

if(!empty($_POST['body']['text'])){
    $content = $sec->HtmlFilter($_POST['body']['text']);
    $title = $sec->Filter($_POST['body']['title'],'Special');
} else{
    $content = '';
    $title = 'Contenuto non disponibile al momento.';
}


?>


<div class="container_page">

    <div class="header-main">
        <div class="site-branding">
            <p class="site-title">
                <a href="/" rel="home">Slice &amp; Dice</a>
            </p>
        </div>
        <div class="primary-menu">
            <?php require(__DIR__.'/menu.php'); ?>
        </div>
    </div>
    <div class="header-img">
        <img src="/assets/img/header-3.png">
    </div>

    <div class="central-box">

        <div class="content-title">
            <h1>
                <?=  $title; ?>
            </h1>
        </div>

        <div class="content-box">
            <?= $content ?>
        </div>

    </div>
</div>


<script src="/public/Layouts/mono-column-left/body.js"></script>
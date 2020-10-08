<?php

# Call needed libraries
use Libraries\Security;
use Libraries\Template;

# Start needed classes
$tpl = new Template();
$sec = Security::getInstance();


if(!empty($_POST['body']['text'])){
    $content = ($_POST['body']['is_link']) ?  $sec->Filter($_POST['body']['text'],'String') : $sec->HtmlFilter($_POST['body']['text']);
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
            <?php if(!$_POST['body']['is_link']) {
                echo $content;
            }else{
                require(ROOT.'/public/theme/view/'.$content);
            } ?>
        </div>

    </div>
</div>

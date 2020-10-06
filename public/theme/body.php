<?php

# Call needed libraries
use Libraries\Security;
use Libraries\Template;

# Start needed classes
$tpl = new Template();
$sec = Security::getInstance();


?>


<div class="container_page">

    <div class="header-main">
        <div class="site-branding">
            <p class="site-title">
                <a href="/" rel="home">Slice &amp; Dice</a>
            </p>
        </div>
        <div class="primary-menu">

            <ul class="first-menu">
                <li id="menu-item-550" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-540 current_page_item menu-item-550"><a href="https://www.slicendice.it/wp/f-a-q/" aria-current="page"><i class="fas fa-voicemail"></i><span>F.A.Q.</span></a></li>
                <li id="menu-item-550" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-540 current_page_item menu-item-550"><a href="https://www.slicendice.it/wp/f-a-q/" aria-current="page"><i class="fas fa-voicemail"></i><span>F.A.Q.</span></a></li>
                <li id="menu-item-550" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-540 current_page_item menu-item-550"><a href="https://www.slicendice.it/wp/f-a-q/" aria-current="page"><i class="fas fa-voicemail"></i><span>F.A.Q.</span></a></li>
                <li id="menu-item-550" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-540 current_page_item menu-item-550"><a href="https://www.slicendice.it/wp/f-a-q/" aria-current="page"><i class="fas fa-voicemail"></i></i><span>F.A.Q.</span></a></li>
                <li id="menu-item-550" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-540 current_page_item menu-item-550"><a href="https://www.slicendice.it/wp/f-a-q/" aria-current="page"><i class="fas fa-voicemail"></i></i><span>F.A.Q.</span></a></li>
                <?php

                # Foreach menu voice
                foreach ($tpl->MenuList('left') as $menu) {

                    # Filter data and print results
                    $id_menu = $sec->Filter($menu['id'], 'Int');
                    $text_menu = $sec->Filter($menu['text'], 'String');
                    $icon_menu = $sec->Filter($menu['icon'], 'String');
                    $clickable_menu = $sec->Filter($menu['clickable'], 'Bool');
                    $link_menu = $sec->Filter($menu['link'], 'String');
                    $class_menu = $tpl->GetContainerForLinks($sec->Filter($menu['link_container'], 'String'));
                    ?>


                    <li class="list-group-item">
                        <?php

                        # If menu is clickable print a tag
                        if ($clickable_menu){ ?>
                        <a href="<?= $link_menu; ?>" class="<?= $class_menu; ?>">
                            <?php } ?>
                            <div class="MenuVoice">
                                <div class="MenuImg">
                                    <i class="<?= $icon_menu; ?>"></i>
                                </div>
                                <div class="MenuVoiceText"><?= $text_menu; ?></div>
                            </div>
                            <?php if ($clickable_menu){ ?>
                        </a>
                    <?php } ?>

                        <div class="submenu svg-submenu">

                            <?php

                            # Foreach submenu voice
                            foreach ($tpl->SubMenuList($id_menu) as $submenu) {

                                # Filter data and print results
                                $id_submenu = $sec->Filter($submenu['id'], 'Int');
                                $text_submenu = $sec->Filter($submenu['text'], 'String');
                                $icon_submenu = $sec->Filter($submenu['icon'], 'String');
                                $clickable_submenu = $sec->Filter($submenu['clickable'], 'Bool');
                                $link_submenu = $sec->Filter($submenu['link'], 'String');
                                $class_submenu = $tpl->GetContainerForLinks($sec->Filter($submenu['link_container'], 'String'));

                                ?>
                                <div class="list-group-item">
                                    <?php if ($clickable_submenu){ ?>
                                    <a href="<?= $link_submenu; ?>" class="<?= $class_submenu; ?>">
                                        <?php } ?>
                                        <div class="SubmenuItem">
                                            <div class="MenuImg">
                                                <i class="<?= $icon_submenu; ?>"></i>
                                            </div>
                                            <div class="SubmenuText">
                                                <?= $text_submenu; ?>
                                            </div>
                                        </div>

                                        <?php if ($clickable_submenu){ ?>
                                    </a>
                                <?php } ?>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </li>
                <?php } ?>

            </ul>
        </div>

    </div>

    <div class="central-box">

        <div class="content-box">
            <?= $sec->HtmlFilter($_POST['body']); ?>
        </div>

    </div>
</div>


<script src="/public/Layouts/mono-column-left/body.js"></script>
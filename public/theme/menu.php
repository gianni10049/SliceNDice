<?php


# Call needed libraries
use Libraries\Security;
use Libraries\Template;

# Start needed classes
$tpl = new Template();
$sec = Security::getInstance();

?>


<ul class="first-menu">
    <?php

    # Foreach menu voice
    foreach ($tpl->MenuList() as $menu) {

        # Filter data and print results
        $id_menu = $sec->Filter($menu['id'], 'Int');
        $text_menu = $sec->Filter($menu['text'], 'String');
        $icon_menu = $sec->Filter($menu['icon'], 'String');
        $link_menu = $sec->Filter($menu['link'], 'String');
        $have_sub_menu = $tpl->MenuHaveSub($id_menu);
        $cls = ($have_sub_menu) ? 'sub-menu-open' : '';
        ?>


        <li class="list-group-item <?= $cls; ?>">


            <a href="<?= $link_menu; ?>">
                <i class="<?= $icon_menu; ?>"></i>
                <span class="MenuVoiceText"> <?= $text_menu; ?> </span>
                <?php if ($have_sub_menu) { ?>
                    <span class="arrow"><i class="fas fa-caret-down"></i> </span>
                <?php } ?>
            </a>
            <?php if ($have_sub_menu) { ?>
                <div class="submenu svg-submenu">

                    <?php

                    # Foreach submenu voice
                    foreach ($tpl->SubMenuList($id_menu) as $submenu) {

                        # Filter data and print results
                        $id_submenu = $sec->Filter($submenu['id'], 'Int');
                        $text_submenu = $sec->Filter($submenu['text'], 'String');
                        $icon_submenu = $sec->Filter($submenu['icon'], 'String');
                        $link_submenu = $sec->Filter($submenu['link'], 'String');
                        ?>
                        <div class="list-group-item">
                            <a href="<?= $link_submenu; ?>">
                                <!--<i class="<?= $icon_submenu; ?>"></i>-->
                                <span class="SubmenuText"> <?= $text_submenu; ?> </span>
                            </a>
                        </div>
                        <?php
                    } ?>

                </div>
            <?php } ?>
        </li>
    <?php } ?>

</ul>

<script src="/public/theme/JS/Menu.js"></script>
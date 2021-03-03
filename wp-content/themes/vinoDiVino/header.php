<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>

    <meta charset="utf-8">

    <title>
        <?= the_title() ?>
    </title>

    <meta name="description" content="">

    <meta name="keywords" content="">

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">

    <?php wp_head(); ?>

</head>



<body class="<?php $slug; ?>">

    <div class="wrapper">

        <header class="header">
            <div class="container-fluid">

                <div class="header__logo">
                    <a href="/">
                        <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            if (!isset($image)) :
                                echo '<img src="'.$image[0].'" class="logo"/>';
                            else :
                                echo '<img src="https://via.placeholder.com/120" alt="" class="logo">';
                            endif;
                        ?>
                        <span class="logo--name site-name"><?php bloginfo('name') ?></span>
                    </a>
                </div>


                <div class="header__nav nav">
                <?php wp_nav_menu( array(
                    'menu'            => 'main',
                    'theme_location'  => 'main',
                    'container'       => 'ul',
                    'echo'            => true,
                    'menu_class'      => 'nav__menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ) ); ?>
                </div>
                <!-- <div class="header__content"> -->
                <!-- </div> -->

              <div class="header__burger">
                <span></span>
                <span></span>
                <span></span>
              </div>

            </div>
        </header>
        <?php global $pageClass; ?>

        <main class="main page-main <?= $pageClass;?>">
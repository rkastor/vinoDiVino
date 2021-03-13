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

    <?php /**
     * Contact information
     */
    $phone1   = get_option('settings')['phone1'];
    $phone2   = get_option('settings')['phone2'];
    $email    = get_option('settings')['email'];
    $address  = get_option('settings')['address'];
    $fb       = get_option('settings')['fb'];
    $inst     = get_option('settings')['inst'];
    $workTime = get_option('settings')['work-time'];
    ?>
    

</head>



<body class="<?php $slug; ?>">

    <div class="wrapper">

        <header class="header">
            <div class="container-fluid">

                <div class="flex flex--wrap flex--justify-between">
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
                        </a>
                    </div>


                    <div class="header__nav nav">
                    <?php wp_nav_menu( array(
                        'menu'            => 'main',
                        'theme_location'  => 'main',
                        'container'       => 'ul',
                        'echo'            => true,
                        'menu_class'      => 'nav__menu flex flex--wrap flex--justify-between',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ) ); ?>
                    </div>

                    <?php if (!empty($phone1) || !empty($phone2) || !empty($fb) || !empty($inst) || !empty($address) || !empty($workTime)) : ?>
                    <div class="header__content flex flex--justify-between">
                        <div class="header__phones flex flex--column flex--justify-around">
                            <?php if (!empty($phone1)) : ?>
                                <a href="tel:<?php echo preg_replace("/\s+/", "", $phone1); ?>" title="Позвонить"><?php echo $phone1; ?></a>
                            <?php endif;
                                if (!empty($phone2)) : ?>
                                <a href="tel:<?php echo preg_replace("/\s+/", "", $phone2); ?>" title="Позвонить"><?php echo $phone2; ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="header__social">
                            <?php if (!empty($fb)) : ?>
                                <a href="<?php echo $phone1; ?>" title="Позвонить"><i class="fa fa-facebook"></i></a>
                            <?php endif;
                                if (!empty($inst)) : ?>
                                <a href="<?php echo $inst; ?>" title="Написать"><i class="fa fa-instagram"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="header__burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>
        </header>
        <?php global $pageClass; ?>

        <main class="main page-main <?= $pageClass;?>">
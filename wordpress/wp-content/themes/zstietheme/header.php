<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <!-- <title>ZSTiE Test</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="slider.css"> -->
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head();?>
</head>
<body <?php body_class();?>>

<div class="header-box">
    <div class="header-box-center d-flex flex-row justify-content-center align-content-xs-start">
        <header class="site-top">
            <!--<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class="site-top-logo">-->
            <div class="site-top-logo">
                <?php csl_CustomSiteLogo_show_logo(); ?>
            </div>
            <div class="site-top-header-container d-flex flex-column justify-content-center justify-content">
                <h1 class="site-top-header d-none d-md-block d-print-block"><?php bloginfo('description'); ?></h1>
                <h2 class="site-top-header-sub  d-block d-print-block">we Wrocławiu</h2>
                <h1 class="d-md-none site-top-header-mobile">ZSTiE</h1>
            </div>
            <!--<div class="site-top-links">
                <a href="#" class="site-top-link"><i class="fas fa-user"></i></a>
                <a href="#" class="site-top-link"><i class="fas fa-user"></i></a>
                <a href="#" class="site-top-link"><i class="fab fa-youtube"></i></a>
                <a href="#" class="site-top-link"><i class="fab fa-facebook-square"></i></a>
            </div>-->
        </header>
    </div>
</div>
<nav class="navbar navigation navbar-dark navbar-expand-lg sticky-top">
    <a class="navbar-brand" href="#">MENU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"  aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
    </button>

    <div class="collapse navbar-collapse search-bar-parrent" id="menu">
        <div class=" d-block d-lg-none" id="searchform"><?php get_search_form(); ?></div>
        <?php
        wp_nav_menu(
            array(
                'theme location' => 'top-menu',
                'menu_class' => ''
            )
        );
        ?>
        <div class="d-none d-lg-block searchform-desktop" id="searchform"><?php get_search_form(); ?></div>
    </div>
    
</nav>
<div class="cont">
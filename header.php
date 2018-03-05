<?php 
/**
 *  The template for displaying the header.
 **/
?>
<!DOCTYPE html>
<html lang="">

<head>
    <title><?php bloginfo( 'name' ); print ' | '; bloginfo( 'description' )?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    
    <!-- Font-awesome -->
    <script src="https://use.fontawesome.com/2192a1d789.js"></script>

    <?php wp_head() ?>
</head>

<body>
    <header class="main-header">
        <div class="container-fluid">

            <div class="site-logo col-6 col-md-3">
                <?php hp_custom_logo(); ?>
            </div>

            <div class="container-menu col-md-9">
                <nav class="main-nav">
                    <span id="close-menu" class="fa fa-times"></span>
                    <?php wp_nav_menu( array(
                        'menu'          => 'hotpage-menu',
                        'menu_class'    => 'hotpage-main-menu',
                        'menu_id'       => 'hotpage-menu',
                        'container'     => '',
                    ) ); ?>
                </nav>
            </div>

            <div class="col-6 btns-mobile">
                <span id="open-menu" class="fa fa-bars"></span>
            </div>

        </div>
    </header> <!-- /End header -->
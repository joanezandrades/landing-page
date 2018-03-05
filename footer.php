<?php 
/**
 *  The template for displaying the footer.
 * 
 */
?>

    <footer id="main-footer" class="">
        <div class="container-fluid">
            <div class="col-12 col-md-4">
                <?php the_custom_logo(); ?>
            </div>
            <div class="col-12 col-md-4">
                <!-- Add widget para captação de e-mails -->
                <?php 
                    if( dynamic_sidebar( 'widget_email_list' ) || is_active_sidebar( 'widget_email_list' ) ) :
                        
                        get_sidebar( 'widget_email_list' );

                    endif;
                ?>
            </div>
            <div class="col-12 col-md-4">
                <!-- Add menu institucional -->
                <?php 
                if( has_nav_menu( 'footer-menu' ) ) {
                    
                    wp_nav_menu( array( 
                        'menu' => 'footer-menu'
                    ) );
                }else{
                    echo 'Não encontramos o menu desejado';
                }
                ?>
            </div>
        </div>
    </footer>

    <script src="<?php echo get_template_directory_uri() . '/js/jquery.min.js' ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/js/slick.min.js' ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/js/script.js' ?>"></script>
    </body>
</html>
<?php
/**
 * @package hotpage
 * @version 1.0
 * @author Joanez Andrades
 * 
 * Configurações padrão do tema e registros de suporte para varias caracteristicas do wordpress
 * @func hotpage_setup
 * 
 * add supports
 * add image sizes
 * add navs
 * load _inc
 * load stylesheets css
 * load scripts js
 */
?>
<?php
if( ! function_exists( 'hotpage_setup' ) ) {

    add_action( 'after_setup_theme', 'hotpage_setup' );
    function hotpage_setup () {

        /**
         * -> Add supports
         * -> Add image sizes
         * -> Add register nav
         * -> Add Load de scripts css
         * -> Add Load de scripts js
         * -> Add Widgets 
         */ 

        /**
         * Add support thumbs
        */
        add_theme_support( 'post-thumbnails' );

        /**
         * Add posts formats
        */
        $postsFormats = array(
            'link',
            'video',
            'quote',
            'image',
            'gallery'
        );
        add_theme_support( 'post-formats', $postsFormats );

        /**
         * Custom Logo
        */
        $customLogo = array(
            'flex-width'    => true,
            'flex-height'   => true
        );
        add_theme_support( 'custom-logo', $customLogo );

        /**
         * HTML5 Support
        */
        $html5Support = array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        );
        add_theme_support( 'html5', $html5Support );

        /**
         * Custom background
        */
        $customBackground = array(
            'default-image' => '',
            'default-preset' => 'default',
            'default-position-x' => 'left',
            'default-position-y' => 'top',
            'default-size' => 'auto',
            'default-repeat' => 'repeat',
            'default-attachment' => 'scroll',
            'default-color' => '',
            'wp-head-callback' => '_custom_background_cb',
            'admin-head-callback' => '',
            'admin-preview-callback' => '',
        );
        add_theme_support( 'custom-background', $customBackground );

        /**
         * Add Image size
         */ 
        add_image_size( 'hotpage-full-size', 1366, 768, true );
        add_image_size( 'hotpage-icon-big', 148, 148, true );
        add_image_size( 'hotpage-icon-medium', 96, 96, true );
        add_image_size( 'hotpage-icon-small', 44, 44, true );

        /** 
         * Register Nav Menus
         */
        register_nav_menus( array(
            'main-menu'     => __('Main Menu', 'main-menu'),
            'footer-menu'   => __('Footer Menu', 'footer-menu')
        ) );

        /***
         * Include da template tags
        */
        include_once( '/_inc/template_tags.php' );

        /** 
         * WP Enqueue Stylesheets
         * */
        if( ! function_exists( 'hotpage_equeue_stylesheets' ) ) {

            add_action( 'wp_enqueue_scripts', 'hotpage_enqueue_stylesheets' );
            function hotpage_enqueue_stylesheets() {
                
                wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/css/slick.css', array(), 'all' );
                wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), '4.0.0', 'all' );
                wp_enqueue_style( 'bootstrap-grids', get_template_directory_uri() . '/css/bootstrap/bootstrap-grid.min.css', array(), '4.0.0', 'all' );
                wp_enqueue_style( 'reset-css-meyerweb', get_template_directory_uri() . '/css/reset.css', array(), '2.0', 'all' );
                wp_enqueue_style( 'hotpage-main', get_template_directory_uri() . '/css/main-style.css', array(), '1.0.0', 'all' );
            }
        }

        /**
         * WP Enqueue Scripts
        */
        if( ! function_exists( 'hotpage_enqueue_scripts' ) ) {

            add_action( 'wp_enqueue_scripts', 'hotpage_enqueue_scripts' );
            function hotpage_enqueue_scripts() {
                // wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.2.1', true );
                // wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js', array(), true );
                // wp_enqueue_script( 'main', get_template_directory_uri() . '/js/script.js', array('jquery'), true );
            }
        }

        /**
         * Register Widget vídeo on homepage
        */
        function product_video_homepage_init() {

            $args_widget = array(
                'name'          => 'Widget: Vídeo Homepage',
                'id'            => 'widget_video',
                'before_widget' => '<div class="">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2>',
                'after_title'   => '</h2>',
            );
            
            register_sidebar( $args_widget );
        }
        add_action( 'widgets_init', 'product_video_homepage_init' );

        /**
         * Register Price widget área
        */
        function product_price_widget_init() {

            register_sidebar( array(
                'name'          => 'Widget: Preço/valores',
                'id'            => 'widget_price_product',
                'before_widget' => '<div>',
                'after_widget'  => '</div>',
                'before_title'  => '<h1>',
                'after_title'   => '</h1>'
            ) );
        }
        add_action( 'widgets_init', 'product_price_widget_init' );

        /**
         * Register e-mail wiget area
        */
        function hotpage_email_list_widget() {

            register_sidebar( array(
                'name'          => 'Rodapé: Widget email',
                'id'            => 'widget_email_list',
                'before_widget' => '<div class="email_list">',
                'after_widget'  => '</div>',
                'before_title'  => '<p class="title-widget">',
                'after_title'   => '<p>'
            ) );
        }
        add_action( 'widgets_init', 'hotpage_email_list_widget' );
    }

}

/**
 * Adicionar post types personalizados
 * - Products - Produtos cadastrados para divulgação
 * - About Product - Posts Sobre o produto
 * - Tips - Posts Dicas
 * - Ensure - Posts Garantias
 * - FAQ - Posts Suporte
 */ 


/**
 * Products
 * @post-type: products
*/
add_action( 'init', 'products' );
function products() {

    $pluralName     = 'Produtos';
    $singularName   = 'Produto';

    $labels = array(

        'name'          => $pluralName,
        'singular_name' => $singularName,
        'add_new'       => 'Criar novo ' . $singularName,
        'add_new_item'  => 'Adicionar ' . $singularName,
        'edit_item'     => 'Editar ' . $singularName,
        'featured_image'=> 'Selecione a logo do seu produto',
    );

    $supports = array(

        'title',
        'editor',
        'thumbnail',
        'excerpt'
    );

    $args_products = array(

        'labels'    => $labels,
        'supports'  => $supports,
        'public'    => true,
        'menu_icon' => 'dashicons-star-filled'
    );

    register_post_type( 'products', $args_products );
}

/**
 * About Product
 * @post-type: about_product
*/
add_action( 'init', 'product_about' );
function product_about() {
    $pluralName = 'Informações';
    $singularName = 'Informação';

    $labels = array(
        'name'              => $pluralName,
        'singular_name'     => $singularName,
        'add_new'           => 'Nova ' . $singularName,
        'add_new_item'      => 'Adicionar ' . $singularName,
        'edit_itm'          => 'Editar ' . $singularName,
        'featured_image'    => 'Adicionar imagem'
    );

    $supports = array(
        'title',
        'excerpt',
        'thumbnail',
        'post-formats'
    );

    $register_post = array(
        'labels'    => $labels,
        'supports'  => $supports,
        'public'    => true,
        'menu_icon' => 'dashicons-sos'
    );

    register_post_type( 'product_about', $register_post );
}

/**
 * Product tips
 * @post-type: product_tips
*/
add_action( 'init', 'product_tips' );
function product_tips() {
    $pluralName = 'Dicas';
    $singularName = 'Dica';

    $labels = array(
        'name'              => $pluralName,
        'singular_name'     => $singularName,
        'add_new'           => 'Novo ' . $singularName,
        'add_new_item'      => 'Adicionar ' . $singularName,
        'edit_item'         => 'Editar ' . $singularName,
        'featured_image'    => 'Adicionar imagem destacada'
    );

    $supports = array(
        'title',
        'excerpt',
        'thumbnail',
        'post-formats'
    );

    $register_type = array(
        'labels'   => $labels,
        'supports'  => $supports,
        'public'    => true,
        'menu_icon' => 'dashicons-format-status'
    );
    
    register_post_type( 'product_tips', $register_type );
}

/**
 * Product FAQ
 * @post-type: product_faq
*/
add_action( 'init', 'product_faq' );
function product_faq() {
    $pluralName = 'Perguntas Frequentes';
    $singularName = 'FAQ';

    $labels = array(
        'name'              => $pluralName,
        'singular_name'     => $singularName,
        'add_new'           => 'Novo ' . $singularName,
        'add_new_item'      => 'Adicionar ' . $singularName,
        'edit_item'         => 'Editar ' . $singularName,
        'featured_image'    => 'Adicionar imagem destacada'
    );

    $supports = array(
        'title',
        'excerpt',
        'thumbnail',
        'post-formats'
    );

    $register_type = array(
        'labels'   => $labels,
        'supports'  => $supports,
        'public'    => true,
        'menu_icon' => 'dashicons-editor-help'
    );
    
    register_post_type( 'product_faq', $register_type );
};

/**
 * Product warranties
 * @post-type: product_warranties
*/
add_action( 'init', 'product_warranties' );
function product_warranties() {
    $pluralName = 'Garantias';
    $singularName = 'Garantia';

    $labels = array(
        'name'              => $pluralName,
        'singular_name'     => $singularName,
        'add_new'           => 'Novo ' . $singularName,
        'add_new_item'      => 'Adicionar ' . $singularName,
        'edit_item'         => 'Editar ' . $singularName,
        'featured_image'    => 'Adicionar ícone'
    );

    $supports = array(
        'title',
        'excerpt',
        'thumbnail'
    );

    $args_warranties = array(
        'labels'    => $labels,
        'supports'   => $supports,
        'public'    => true,
        'menu_icon' => 'dashicons-awards'
    );

    register_post_type( 'product_warranties', $args_warranties );
}

/**
 * Meta campos de registro do produto
 * campos = [ Nome do produto, Descrição, Imagem, Valor, Link para compra, email de contato ]
 * @post-type: product
 * 
 * @func callback
 * @func save
 * @func reg
 * 
 * @prefixo hp_ = hotpage_;
*/

/**
 * -> Callback
*/
function callback_reg_product_infos( $post ) {
    $postID = get_post_meta( $post->ID );

    // Vars
    $product_name           = $postID['hp_product_name'][0];
    $product_description    = $postID['hp_product_description'][0];
    $product_valor          = $postID['hp_product_valor'][0];
    $product_valor_promo    = $postID['hp_product_valor_promo'][0];
    $product_email          = $postID['hp_product_email'][0];
    $product_link           = $postID['hp_product_link'][0];
    $product_video          = $postID['hp_product_video'][0];
    ?>
    <div class="wrap-input">
        <label for="hp_product_name">Nome do produto</label>
        <input class="" name="hp_product_name" type="text" value="<?php echo $product_name; ?>">
    </div>
    <div class="wrap-input">
        <label for="hp_product_description">Descrição do produto</label>
        <input class=""  name="hp_product_description" type="text" value="<?php echo $product_description; ?>">
    </div>
    <div class="wrap-input">
        <label for="hp_product_valor">Preço</label>
        <input class="" name="hp_product_valor" type="text" value="<?php echo $product_valor; ?>">
        <label for="hp_product_valor_promo">É promoção?</label>
        <input class="" name="hp_product_valor_promo" type="text" value="<?php echo $product_valor_promo ?>">
    </div>
    <div class="wrap-input">
        <label for="hp_product_email">E-mail</label>
        <input class="" name="hp_product_email" type="email" value="<?php echo $product_email; ?>">
    </div>
    <div class="wrap-input">
        <label for="hp_product_link">Link de venda</label>
        <input class="" name="hp_product_link" type="text" value="<?php echo $product_link; ?>">
    </div>
    <div class="wrap-input">
        <label for="hp_product_video">Link do vídeo</label>
        <textarea class="" name="hp_product_video" value="<?php echo $product_video; ?>" ></textarea>
    </div>
    <?php
}

/**
 * -> Save
*/
function save_reg_product_infos( $post_id ) {
    if( isset( $_POST['hp_product_name'] ) ) {
        update_post_meta( $post_id, 'hp_product_name', sanitize_text_field( $_POST['hp_product_name'] ) );
    }
    if( isset( $_POST['hp_product_description'] ) ) {
        update_post_meta( $post_id, 'hp_product_description', sanitize_text_field( $_POST['hp_product_description'] ) );
    }
    if( isset( $_POST['hp_product_valor'] ) ) {
        update_post_meta( $post_id, 'hp_product_valor', sanitize_text_field( $_POST['hp_product_valor'] ) );
    }
    if( isset( $_POST['hp_product_valor_promo'] ) ) {
        update_post_meta( $post_id, 'hp_product_valor_promo', sanitize_text_field( $_POST['hp_product_valor_promo'] ) );
    }
    if( isset( $_POST['hp_product_email'] ) ) {
        update_post_meta( $post_id, 'hp_product_email', sanitize_text_field( $_POST['hp_product_email'] ) );
    }
    if( isset( $_POST['hp_product_link'] ) ) {
        update_post_meta( $post_id, 'hp_product_link', sanitize_text_field( $_POST['hp_product_link'] ) );
    }
    if( isset( $_POST['hp_product_video'] ) ) {
        update_post_meta( $post_id, 'hp_product_video', $_POST['hp_product_video'] );
    }
}
add_action( 'save_post', 'save_reg_product_infos' );

/**
 * -> Register
*/
function reg_product_infos() {
    
    add_meta_box(
        'product_infos',
        'Adicione informações sobre o produto',
        'callback_reg_product_infos',
        'products',
        'advanced',
        'default'
    );
}
add_action( 'add_meta_boxes', 'reg_product_infos' );
?>
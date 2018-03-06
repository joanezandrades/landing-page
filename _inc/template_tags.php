<?php 
/**
 *  The template for construction of template tags and hooks
 * @package hotpage
 * @version 1.0
 *  
 */ 
?>
<?php 
/**
 * Funções globais
 * 
*/
function hp_custom_logo() {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id, 'full' );             
    ?>

    <img src="<?php echo $image[0] ?>" class="custom-logo" alt="Logotipo hotpage">

    <?php
}


/** 
 * Hook Homepage - Chamada do produto anunciado
 * 
 * @post-type: products
 * */ 
function hp_hook_homepage() {
    global $post;
    
    $args_post = array(
        'post_type'         => 'products',
        'post_status'       => 'publish',
        'posts_per_page'    => '1',
    );

    $post_homepage = get_posts( $args_post );
    
    if( $post_homepage ) :
        foreach( $post_homepage as $post ) :
    ?>
    <section id="home" class="" style="background-image: url(<?php the_post_thumbnail_url( 'hotpage-full-thumb' ) ?>)">
        <div class="wrapper-content container-fluid">
            <h1 class="big-title" ><?php the_title() ?></h1>
            <?php the_excerpt(); ?>

            <div id="open-video" class="btn-video">
                <i class="icon-big fa fa-play-circle"></i>
                <span class="text-video">Aperte o play e conheça nosso produto</span> <!-- Adicionar meta-campo para isso -->
            </div>

            <div id="wrapper-iframe">
                <i id="close-video" class="fa fa-times"></i>

                <!-- Chamada do vídeo -->
                <?php 
                if( dynamic_sidebar( 'widget_video' ) ) :                 
                endif;
                ?>

            </div>
        </div>
    </section> <!-- End Home -->
    <?php widget_price_product(); ?>

    <?php 
        endforeach;
    else :
    ?>
    <div>
        <h1>Não encontramos produtos cadastrados.</h1>
    </div>
    <?php
    endif;
}

/***
 * Hook Section 2 - Conteúdo e informações explicativas do produto
 * 
 * @post-type: product_about
 */
function hp_hook_sct2() {
    global $post;
    ?>
    <section id="product-infos" class="">
        <!-- Add Page About Product(Para que o nome seja configurável) -->
        <h1 class="title-section" alt="">Conheça o conteúdo do produto</h1>
        <ul class="wrapper-content container">
            <ul class="list-posts">
                <?php
                global $post;

                $args_post = array (
                    'post_type'     => 'product_about',
                    'post_status'   => 'publish'
                );

                $posts_products = get_posts( $args_post );

                if( $posts_products ) :
                    foreach( $posts_products as $post ) :
                        setup_postdata( post );
                ?>
                <li class="post-item">
                    <?php the_post_thumbnail( 'hotpage-icon-big' ) ?>
                    <h2 class="title"><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                </li>
                <?php
                    endforeach;
                else :
                ?>
                <div>
                    <h1>Não encontramos informações cadastradas.</h1>
                </div>
                <?php
                endif;
                ?>
            </ul>
        </ul>
    </section>
    <?php
}

/***
 * Hook section 3 - Dicas de uso ou de como funciona o produto.
 * 
 * @post-type: product_tips
 */ 
function hp_hook_sct3() {
    global $post;
    ?>
    <section id="product-differential" class="">
        <!-- Add Page Product Differential(Para que o nome seja configurável) -->
        <h1 class="title-section" alt="">Aqui vão alguns passos/dicas que vc precisa saber sobre o produto</h1>

        <ul class="wrapper-content container">
        <?php 
        $args_dicas = array(
            'post_type'         => 'product_tips',
            'post_status'       => 'publish',
        );

        $dicas = get_posts( $args_dicas );

        if( $dicas ) :
            foreach( $dicas as $post ) :

        ?>
            <li class="tip-item">
                <?php the_post_thumbnail( 'hotpage-icon-medium' ) ?>

                <div class="wrap-text">
                    <h3 class="title"><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                </div>
            </li>

        <?php 
            endforeach;
        else :
        ?>
        <div>
            <h1>Não encontramos dicas cadastradas para este produto.</h1>
        </div>
        <?php
        endif;
        ?>
        </ul>
    </section>
    <?php
}

/**
 * Hook Section 4 - Valores e informações de compra do produto cadastrado.
 * -> Chamada das meta-tags
 * 
 * @post-type: products
 */
function hp_hook_sct4() { 
    global $post;
    ?>
    <section id="product-price" class="">    
        <div class="container">
            <h1 class="title-section">Aproveite nosso valor promocional e compre agora o seu <?php echo get_post_meta( $post->ID, 'hp_product_name', true ); ?>!</h1>

            <?php

            // vars
            $precoProduto       = get_post_meta( $post->ID, 'hp_product_name', true );
            $descricaoProduto   = get_post_meta( $post->ID, 'hp_product_description', true );
            $nomeProduto        = get_post_meta( $post->ID, 'hp_product_valor', true );
            $emailProduto       = get_post_meta( $post->ID, 'hp_product_email', true );
            $linkProduto        = get_post_meta( $post->ID, 'hp_product_link', true );

            $args_produto = array(
                'post_type'     => 'products',
                'post_status'   => 'publish'
            );

            $postProduto = get_posts( $args_produto );

            if( $postProduto ) :
                foreach( $postProduto as $post ) : 
            ?>
            
            <div class="wrapper-price-product">
                <!-- Se for promoção -->
                <?php  if( get_post_meta( $post->ID, 'hp_product_valor_promo', true ) ) : ?>
                <div class="box-price col-md-12">
                    <div class="old-price">
                        <span class="tag">de</span>
                        <h3 class="medium-title">R$<?php echo get_post_meta( $post->ID, 'hp_product_valor', true ) ?></h3>
                    </div>

                    <div class="promotional-price">
                        <span class="tag">por apenas</span>
                        <h2 class="extra-title">R$<?php echo get_post_meta( $post->ID, 'hp_product_valor_promo', true ) ?></h2>
                    </div>
                </div>

                <!-- Se não for promoção -->
                <?php else : ?>
                <div class="box-price col-md-12">
                    <span class="tag">por</span>
                    <h2 class="extra-title">R$<?php echo get_post_meta( $post->ID, 'hp_product_valor', true ) ?></h2>
                </div>
                <?php endif; ?>
                
                <a class="big-button" href="<?php echo get_post_meta( $post->ID, 'hp_product_link', true ) ?>"><i class="fa fa-chart"></i> Comprar agora</a>
            </div>

            <?php
                endforeach;
            endif;

            ?>
            <span class="text-security"><i class="fa fa-shield"></i>Compra 100% segura, aceitamos várias formas de pagamento</span>
        </div>
    </section>
    <?php
}

/**
 * Hook section 5 - Garantias do produto 
 **/
function hp_hook_sct5() {
    global $post;
    ?>
    <section id="product-ensure" class="">
        <!-- Add Page Product Ensure(Para que o nome seja configurável) -->
        <h1 class="title-section">Garantias do produto</h1>
        <i class="icon-safe fa fa-unlock-alt"></i>
        <div class="wrapper-content container">
            <ul class="list-of-ensurance">
            <?php 
            $args_ensurance = array(
                'post_type'         => 'product_warranties',
                'post_status'       => 'publish',
            );

            $posts_ensurance = get_posts( $args_ensurance );

            if( $posts_ensurance ) :
                foreach( $posts_ensurance as $post ) :
                ?>

                <li class="item-ensurance">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                    <span class="line-block"></span>
                </li>

                <?php
                endforeach;
            endif;
            ?>
            </ul>

            <!-- Botões de navegação -->
            <ul class="nav-list-posts" style="display: none">
            <?php 
            foreach( $posts_ensurance as $post) : 
            ?>
            
                <li class="nav-item">
                    <?php the_post_thumbnail( 'icon-small' ); ?>
                    <?php the_title(); ?>
                </li>
            
            <?php 
            endforeach;
            ?>
            </ul>
        </div>
    </section>
    <?php
}

/***
 * Hook section 6 - FAQ
 */
function hp_hook_sct6() {
    global $post;
    ?>
    <section id="product-support" class="">
        <!-- Add Page Suporte/Faq(Para que o nome seja configurável) -->
        <h1 class="title-section">Suporte / FAQ do produto</h1>
        <div class="wrapper-content container">
            <ul class="list-of-faqs">
            <?php 
            $args_faq = array(
                'post_type'         => 'product_faq',
                'post_status'       => 'publish',
            );
            
            $posts_faq = get_posts( $args_faq );

            if( $posts_faq ) :
                foreach( $posts_faq as $post ) :
            ?>
                <li class="faq-item">
                    <i class="icon fa fa-caret-down"></i>
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="answer">
                        <?php the_excerpt(); ?>
                    </div>
                </li>
            <?php
                endforeach;
            endif;
            ?>
            </ul>
        </div>
    </section>
    <?php
}

/**
 * widget box price
 * 
*/
function widget_price_product() {
    global $post;

    // vars
    $precoProduto       = get_post_meta( $post->ID, 'hp_product_valor', true );
    $precoPromo         = get_post_meta( $post->ID, 'hp_product_valor_promo', true );
    $linkProduto        = get_post_meta( $post->ID, 'hp_product_link', true );
    ?>

    <i id="open-price-mobile" class="fa fa-dollar"></i>
    
    <?php
    if( $precoPromo ) :
    ?>
    
    <div class="container_widget">
        <header class="head_widget">
            <i id="close-widget" class="btn-widget fa fa-window-minimize"></i>
            <i id="open-widget" class="btn-widget fa fa-window-maximize"></i>
            <h1 class="title">Preço Promocional!</h1>
        </header>
        <div class="content_widget">
            <ul class="list">
                <li class="list-item">
                    <span class="text">de</span>
                    <del><span class="small-price">R$<?php echo $precoProduto; ?></span></del>
                </li>
                <li class="list-item">
                    <span class="text">por apenas</span>
                    <span class="medium-price">R$<?php echo $precoPromo; ?></span>
                </li>
            </ul>
            <a href="<?php echo $linkProduto; ?>" class="sell-button" target="_blank">
                <i class="icon fa fa-shopping-cart"></i>comprar
            </a>

            <span class="small-text">*Em até 12x no cartão</span>
            <span class="small-text">*Compra 100% segura!</span>
        </div>
    </div>

    <?php
    else :
    ?>
    <div class="container_widget">
        <header class="head_widget">
            <i id="close-widget" class="btn-widget fa fa-window-minimize"></i>
            <i id="open-widget" class="btn-widget fa fa-window-maximize"></i>
            <h1 class="title">Preço Exclusivo!</h1>
        </header>
        <div class="content_widget">
            <ul class="list">
                <li class="list-item">
                    <span class="text">por apenas</span>
                    <span class="extra-price">R$<?php echo $precoProduto; ?></span>
                </li>
            </ul>
            <a href="<?php echo $linkProduto; ?>" class="sell-button" target="_blank">
                <i class="icon fa fa-shopping-cart"></i>comprar
            </a>

            <span class="small-text">*Em até 12x no cartão</span>
            <span class="small-text">*Compra 100% segura!</span>
        </div>
    </div>
    <?php
    endif;
}

?>
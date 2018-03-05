<?php 
/**
 *  The template for displaying the index.
 * 
 */
get_header();
?>

<main class="content" role="content">

    <section id="home" class="">
        <?php hp_hook_homepage(); ?>
    </section> <!-- /End section home -->

    <section id="product-infos" class="">
        <!-- Add Page About Product(Para que o nome seja configurável) -->
        <h1 class="title-section" alt="">Conheça o conteúdo do produto</h1>

        <!-- Hook sct2 -->
        <?php hp_hook_sct2(); ?>        

        <!-- add wrapper do nav -->
        <ul class="nav-list-posts">
            <?php 
                if( $posts_products ) :
                    foreach( $posts_products as $post) :
                        setup_postdata( post );
            ?>
            <li class="list-item">
                <?php the_post_thumbnail( 'small', '' )?>
                <h4 class=""><?php the_title(); ?></h4>
            </li>
            <?php 
                    endforeach;
                endif;
            ?>
        </ul>
    </section>

    <section id="product-differential" class="">
        <!-- Add Page Product Differential(Para que o nome seja configurável) -->
        <h1 class="title-section" alt="">Aqui vão alguns passos/dicas que vc precisa saber sobre o produto</h1>

        <!-- Buscar posts relacionados com essa página -->
        <?php hp_hook_sct3(); ?>
    </section>

    <section id="product-price" class="">
    
        <div class="container">
            <!-- Add Page Product Price(Para que o nome seja configurável) -->
            <?php hp_hook_sct4(); ?>
        </div>

    </section>

    <section id="product-ensure" class="">
        <!-- Add Page Product Ensure(Para que o nome seja configurável) -->
        <h1 class="title-section">Garantias do produto</h1>

        <!-- Buscar os posts relacionados -->
        <?php hp_hook_sct5(); ?>
    </section>

    <section id="product-author" class="" style="display: none">
        <!-- Add Page About Author(Onde será adicionado a foto do autor, nome, resumo e link principal) - Próxima versão -->
    </section>

    <section id="product-support" class="">
        <!-- Add Page Suporte/Faq(Para que o nome seja configurável) -->
        <h1 class="title-section">Suporte / FAQ do produto</h1>

        <!-- Buscar posts relacionados -->
        <?php hp_hook_sct6(); ?>
    </section>

</main>

<?php get_footer(); ?>
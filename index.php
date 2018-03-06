<?php 
/**
 *  The template for displaying the index.
 * 
 */
get_header();
?>

<main class="content" role="content">

    <!-- Hook Homepage -->
    <?php hp_hook_homepage(); ?>

    <!-- Hook sct2 -->
    <?php hp_hook_sct2(); ?>        

    <!-- Buscar posts relacionados com essa página -->
    <?php hp_hook_sct3(); ?>

    <!-- Add Page Product Price(Para que o nome seja configurável) -->
    <?php hp_hook_sct4(); ?>

    <!-- Buscar os posts relacionados -->
    <?php hp_hook_sct5(); ?>

    <!-- Buscar posts relacionados -->
    <?php hp_hook_sct6(); ?>
</main>

<?php get_footer(); ?>
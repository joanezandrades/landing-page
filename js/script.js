// Slick slider
$('.list-posts, .list-of-ensurance').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    ease: true,
    dots: true,
});


/**
 * rollPageheader
 * 
 * @func rollPageHeader();
 * @desc Quando rolar a página o header recebe uma classe que ajusta os tamanhos.
*/
$(document).ready( function () {

    $(window).on('scroll', function() {

        let heightScreen = $(window).height();
    
        let screen = $(window);
    
        if( screen.scrollTop() > heightScreen / 2  ) {
    
            $('.main-header').addClass('roll-page-active');
        } else {
    
            $('.main-header').removeClass('roll-page-active');
        }
    
        console.log(heightScreen);
    })
});

/**
 * Mostrar resposta do FAQ
 * 
 * @func activeFaq()
 * @desc Mostrar resposta do faq-item clicado
 * 
*/
$('.faq-item').on('click', function() {

    $(this).toggleClass('faq-active');
})

/**
 * Display vídeo homepage
 * 
 * @func Abre o vídeo embedado na homepage
 * @desc Ações de abrir e fechar o vídeo da homepage
 * 
*/
$('.btn-video').on( 'click', function() {

    $('#wrapper-iframe').css({ 'display' : 'block' })
});

$('#close-video').on( 'click', function() {

    $('#wrapper-iframe').css({ 'display' : 'none' })
});

/**
 * Ações box widget homepage
 * 
 * @func Minimizar e maximizar a box de preço da homepage desktop
 * @func Abrir a box de preço na homepage mobile
*/
$('#close-widget, #open-widget').on( 'click', function() {

    $('.container_widget').toggleClass('widget_minimize');

});
$('#open-price-mobile').on( 'click', function() {

    $('.container_widget').toggleClass('widget_minimize');
});

/**
 * Ações de rolagem da página
 * 
 * @func Rolagem suave da página
*/
$('.main-nav a[href^="#"]').on( 'click', function (e){

    e.preventDefault();

    let idElement = $(this).attr('href');
    let targetOffSet = $(idElement).offset().top;

    $('html, body').animate({
        scrollTop: targetOffSet - 90
    }, 500);
});

/**
 * Evento Menu Mobile
 * 
 * @func openMenuMobile();
 * @desc Abrir e fechar o menu mobile
*/
$('#open-menu').on( 'click', function () {
    // Abrir Menu
    $('.container-menu').css({
        'display' : 'block'
    })
});

$('#close-menu').on( 'click', function () {
    // Fechar Menu
    $('.container-menu').css({
        'display' : 'none'
    })
});

if( $(window).width < 560){
    $('.main-nav a[href^="#"]').on( 'click', function () {
        // Fechar menu ao clicar no link
        $('.container-menu').css({
            'display' : 'none'
        })
    });
}
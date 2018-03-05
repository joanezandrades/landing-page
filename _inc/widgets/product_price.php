<?php 
/**
* Add Widget price product
* Widget que guardará os valores do produto
*/ 
class Register_product extends WP_Widget{

    /**
        * Sets up the widget name etc
    */
    function __construct() {
        
        $widget_args = array(
            'classname'     => 'register_product',
            'description'   => 'Cadastro de informações do produto'
        );

        parent::__construct( 'register_product', 'Registrar produto', $widget_args );
    }

    /**
    * Front-end display widget.
    * 
    * @param array $args
    * @param array $instance
    */
    public function widget( $args, $instance ) {

        // outputs the content of the widget
        echo $args['before_widget'];
        if( ! empty( $instance['title'] ) ) {

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        echo esc_html__( 'Hello, world!', 'text_domain' );
        echo $args['after_widget'];
    }

    /**
    * Back-end widget form.
    * 
    * @param array @instance the widget options
    */
    public function form( $instance ) {

        // outputs the options form on admin
        $title = ! empty( $instance['title']) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        ?>

        <div class="wrap-input">
            <label for="">Nome</label>
            <input type="text">
        </div>
        <div class="wrap-input">
            <label for="product_val">Preço</label>
            <input clas="" id="price_val" name="" type="text" value="">
        </div>

        <?php
    }

    /**
    * Proccessing widget options on save
    * 
    * @param array $new_instance the new options
    * @param array $old_instance the previous options
    * 
    * @return array
    */
    public function update( $new_instance, $old_instance ) {

        // Proccesses widget options to be saved
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

}

// Register Product_price widget
function register_product_widget() {
    
    register_widget( 'Register_product' );
}
add_action( 'widgets_init', 'register_product_widget' );
?>
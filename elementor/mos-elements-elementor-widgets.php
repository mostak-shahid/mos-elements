<?php

class Mos_Elements_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		// require_once('widget1.php');
		// require_once('iconbox-carousel-widget.php');
		require_once('posts-widget.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\My_Widget_1() );
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Mos_Iconbox_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Mos_Posts_Widget() );
	}

}

add_action( 'init', 'my_elementor_init' );
function my_elementor_init() {
	Mos_Elements_Elementor_Widgets::get_instance();
}
function mos_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'mos-elements',
		[
			'title' => __( 'Mos Elements', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);
	/*$elements_manager->add_category(
		'second-category',
		[
			'title' => __( 'Second Category', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);*/

}
add_action( 'elementor/elements/categories_registered', 'mos_add_elementor_widget_categories' );
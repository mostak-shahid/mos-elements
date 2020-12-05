<?php
namespace Elementor;
include "Helper.php";
use MOS_Elements\Classes\Helper;
class Mos_Posts_Widget extends Widget_Base {
	
	public function get_name() {
		return 'mos-posts-widget';
	}
	
	public function get_title() {
		return 'Mos Posts';
	}
	
	public function get_icon() {
		return 'eicon-post-list';
	}
	
	public function get_categories() {
		return [ 'mos-elements' ];
	}
	
	protected function _register_controls() {
        $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');
        $users = [];
        $all_user = get_users();
        foreach($all_user as $user){
            $users[$user->ID] = $user->display_name;
        } 
        $taxonomies = get_taxonomies([], 'objects');
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
        // Start Query Controls
		$this->start_controls_section(
			'_content_query_tab',
			[
				'label' => __( 'Query', 'elementor' ),
			]
		);        

            $this->add_control(
                'post_type',
                [
                    'label' => __('Source', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $post_types,
                    'default' => 'post',
                ]
            );

            $this->add_control(
                'authors',
                [
                    'label' => __('Author', 'elementor'),
                    'label_block' => true,
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => $users,
                    'default' => '1',
                ]
            );
        

            foreach ($taxonomies as $taxonomy => $object) {
                if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types))) {
                    continue;
                }

                $this->add_control(
                    $taxonomy . '_ids',
                    [
                        'label' => $object->label,
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'object_type' => $taxonomy,
                        'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                        'condition' => [
                            'post_type' => $object->object_type,
                        ],
                    ]
                );
            }

            $this->add_control(
                'post__not_in',
                [
                    'label' => __('Exclude', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SELECT2,
                    'options' => Helper::get_post_list(),
                    'label_block' => true,
                    'post_type' => '',
                    'multiple' => true,
                    'condition' => [
                        'post_type!' => ['by_id', 'source_dynamic'],
                    ],
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label' => __('Posts Per Page', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '4',
                ]
            );

            $this->add_control(
                'offset',
                [
                    'label' => __('Offset', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '0',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => __('Order By', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SELECT,
                    //'options' => ControlsHelper::get_post_orderby_options(),
                    'options' => $orderby,
                    'default' => 'date',

                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => __('Order', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'asc' => 'Ascending',
                        'desc' => 'Descending',
                    ],
                    'default' => 'desc',

                ]
            );
        
            $this->add_responsive_control(
                'eael_post_grid_columns',
                [
                    'label' => esc_html__('Column', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'eael-col-4',
                    'tablet_default' => 'eael-col-2',
                    'mobile_default' => 'eael-col-1',
                    'options' => [
                        'eael-col-1' => esc_html__('1', 'elementor'),
                        'eael-col-2' => esc_html__('2', 'elementor'),
                        'eael-col-3' => esc_html__('3', 'elementor'),
                        'eael-col-4' => esc_html__('4', 'elementor'),
                        'eael-col-5' => esc_html__('5', 'elementor'),
                        'eael-col-6' => esc_html__('6', 'elementor'),
                    ],
                    'prefix_class' => 'elementor-grid%s-',
                    'frontend_available' => true,
                ]
            );
        
		$this->end_controls_section();
        //End Query Controls
        // Start Layout Controls
		$this->start_controls_section(
			'_content_layout_tab',
			[
				'label' => __( 'Layout', 'elementor' ),
			]
		);
		
            $this->add_control(
                '_content_layout_tab_skin',
                [
                    'label' => __( 'Skin', 'elementor' ),
                    // 'label_block' => true,
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'clasic' => __( 'Classic', 'elementor' ),
                        '' => __( 'Teaser', 'elementor' ),
                        'card' => __( 'Card', 'elementor' ),
                    ],
                ]
            );		
            $this->add_control(
                '_content_layout_tab_per_page',
                [
                    'label' => __( 'Posts Per Page', 'elementor' ),
                    // 'label_block' => true,
                    'type' => Controls_Manager::NUMBER,
                    'default' => '3',                    
				    'min' => 1,
                ]
            );

            $this->add_control(
                'hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );
            $this->add_control(
                '_content_layout_tab_image',
                [
                    'label' => __( 'Image', 'elementor' ),
                    // 'label_block' => true,
                    'type' => Controls_Manager::SWITCHER,                    
                    'label_on' => 'Hide',
                    'label_off' => 'Show',
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                    'default' => 'large',
                    'separator' => 'none',
                ]
            );

		$this->end_controls_section();
        // End Layout Controls
        // Start Pagination Controls
		$this->start_controls_section(
			'_content_pagination_tab',
			[
				'label' => __( 'Pagination', 'elementor' ),
			]
		);
        
		$this->end_controls_section();
        //End Pagination Controls
        
        
        // Srart General Style Controls
        $this->start_controls_section(
			'_general_style_section',
			[
				'label' => __( 'General', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_general_bg_style_tab',
                [
                    'label' => __( 'Background Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_control(
                '_general_text_style_tab',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_control(
                '_general_shadow_style_tab',
                [
                    'label' => __( 'Box Shadow', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::BOX_SHADOW,				
                ]
            );
		$this->end_controls_section();
        //End General Style Controls
        
        //Start Tab Tile Controls
        $this->start_controls_section(
			'_tab_title_style_section',
			[
				'label' => __( 'Tab Title', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_tab_title_color',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_tab_title_typography',
                    'label' => __( 'Typography', 'plugin-domain' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .text',
                ]
            );            
            $this->add_control(
                '_tab_title_margin',
                [
                    'label' => __( 'Margin', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} > .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();         
        //End Tab Tile Controls
        
        //Start Icon Controls
        $this->start_controls_section(
			'_icon_style_section',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_icon_color',
                [
                    'label' => __( 'Icon Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );		
		$this->end_controls_section();         
        //End Icon Controls
        
        //Start Content Controls
        $this->start_controls_section(
			'_content_style_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_content_color',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_content_typography',
                    'label' => __( 'Typography', 'plugin-domain' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .text',
                ]
            );		
		$this->end_controls_section();         
        //End Content Controls
        
        
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        // $url = $settings['link']['url'];
        $element_id = gettimeofday()['sec'] . rand(1000,9999);
        
        echo '<div class="mos-post-grid">
            <div class="mos-post-grid-seven mos-post-grid-merge-two-rows" style="background-color: antiquewhite">This is Section One</div>
            <div class="mos-post-grid-five" style="background-color:azure">This is Section Two</div>
            <div class="mos-post-grid-five" style="background-color:aquamarine">This is Section Three</div>
        </div>';       
        
    }
	
    protected function _content_template() {
		?>
		<div class="mos-iconbox-carousel-container">
            <div class="text-container" style="background-color:{{settings._general_bg_style_tab}};color:{{settings._general_text_style_tab}}"><div class="wrap">{{{settings._mos_iconbox_content}}}</div></div>
        </div>
		<?php
	}
	
	
}
<?php
namespace Elementor;

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
		return [ 'basic' ];
	}
	
	protected function _register_controls() {
        $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');
        // var_dump($post_types);
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
                    'label' => __('Source', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $post_types,
                    'default' => 'post',
                ]
            );
        
		$this->end_controls_section();
        //End Query Controls
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
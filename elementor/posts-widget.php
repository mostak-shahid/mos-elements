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

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'list_icon',
                [
                    'label' => __( 'Icon', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::ICON,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $repeater->add_control(
                'list_title', [
                    'label' => __( 'Title', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'List Title' , 'plugin-domain' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'list_content', [
                    'label' => __( 'Content', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => __( 'List Content' , 'plugin-domain' ),
                    'show_label' => false,
                ]
            );

            $this->add_control(
                'list',
                [
                    'label' => __( 'Iconbox List', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    /*'default' => [
                        [
                            'list_title' => __( 'Title #1', 'plugin-domain' ),
                            'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        ],
                    ],*/
                    'title_field' => '{{{ list_title }}}',
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
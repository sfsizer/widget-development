<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Glass_Card_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Card widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name(): string {
		return 'glass_card_widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title(): string {
		return esc_html__( 'Glass Card Widget', 'custom-card' );
	}
    /**  
     * Get widget script dependencies.
     * 
    * @since 1.0.0
	 * @access public
	 * @return string Widget css.
    */
     public function get_style_depends() {
        return [ 'glass_card_css' ];
    }
	/**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-testimonial';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories(): array {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords(): array {
		return [ 'card', 'cards', 'glass' ];
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url(): string {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget promotion data.
	 *
	 * Retrieve the widget promotion data.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return array Widget promotion data.
	 */
	protected function get_upsale_data(): array {
		return [
			'condition' => true,
			'image' => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
			'image_alt' => esc_attr__( 'Upgrade', 'custom-card' ),
			'title' => esc_html__( 'Promotion heading', 'custom-card' ),
			'description' => esc_html__( 'Get the premium version of the widget with additional styling capabilities.', 'custom-card' ),
			'upgrade_url' => esc_url( 'https://example.com/upgrade-to-pro/' ),
			'upgrade_text' => esc_html__( 'Upgrade Now', 'custom-card' ),
		];
	}

	/**
	 * Whether the widget requires inner wrapper.
	 *
	 * Determine whether to optimize the DOM size.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return bool Whether to optimize the DOM size.
	 */
	public function has_widget_inner_wrapper(): bool {
		return false;
	}

	/**
	 * Whether the element returns dynamic content.
	 *
	 * Determine whether to cache the element output or not.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return bool Whether to cache the element output.
	 */
	protected function is_dynamic_content(): bool {
		return false;
	}

	/**
	 * Register Card widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'List Content', 'custom-card' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'glass_card_list',
			[
				'label' => esc_html__( 'Repeater List', 'custom-card' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'glass_card_img',
						'label' => esc_html__( 'Choose Image', 'custom-card' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' =>  [
                                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                                ]
					],
					[
						'name' => 'glass_card_title',
						'label' => esc_html__( 'Name', 'custom-card' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Md. Shahriar' , 'custom-card' ),
						'label_block' => true,
					],
					[
						'name' => 'glass_card_subtitle',
						'label' => esc_html__( 'Content', 'custom-card' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta repellat quod esse iure rerum
                                    consectetur, inventore cum nobis ullam nihil!' , 'custom-card' ),
						'show_label' => false,
					],
					[
						'name' => 'glass_icon',
						'label' => esc_html__( 'Title Color', 'custom-card' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-circle',
					        'library' => 'fa-solid',
						]
					],
				],
				'default' => [
					[
						'glass_card_title' => esc_html__( 'Md. Shahriar', 'custom-card' ),
						'glass_card_subtitle' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta repellat quod esse iure rerum
                                    consectetur, inventore cum nobis ullam nihil!', 'custom-card' ),
						'glass_icon' => [
							'value' => 'fas fa-circle',
					        'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ glass_card_title }}}',
			]
		);

		$this->end_controls_section();

	
		// Style Tab Controlls can be added here
		$this->start_controls_section(
				'style_section',
				[
					'label' => esc_html__( 'Style', 'custom-card' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Card Title Typography', 'custom-card' ),
					'name' => 'card_title_typography',
					'selector' => '{{WRAPPER}} .card-hedding',
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Card Product Name Typography', 'custom-card' ),
					'name' => 'card_product_name_typography',
					'selector' => '{{WRAPPER}} .card-product-name',
				]
			);
			$this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'custom-card' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 2,
					'right' => 0,
					'bottom' => 2,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .card-padding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			);
			$this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'custom-card' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-border-radius' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			);
			$this->add_control(
			'img-border-radius',
			[
				'label' => esc_html__( 'Image Border Radius', 'custom-card' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .img-border-radius' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			);
			$this->add_responsive_control(
				'gap',
				[
					'label' => esc_html__( 'Gap', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'selectors' => [
					'{{WRAPPER}} .card-gap' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

	}
	/**
	 * Render Card widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(): void {
		$settings = $this->get_settings_for_display();

                if ( $settings['glass_card_list'] ) { ?>
                    <div class="glass-wrapper">
                    <div class="glass-card">
                    <?php
                    foreach (  $settings['glass_card_list'] as $item ) {
							$bg_color = ! empty( $item['card_color'] )
							? $item['card_color']
							: '#ffffff';
							?>
                        <div class="box">
                            <div class="elements bg"></div>
                            <div class="elements imgbx">
								<?php
									if ( !empty( $item['glass_card_img']['url'] ) ) { ?>
										<img src="<?php echo $item['glass_card_img']['url'] ?>" alt="<?php echo esc_attr( $item['glass_card_title'] ); ?>">
									<?php }
								?>
								
								
                            </div>
                            <div class="elements name">
                                <h2><?php echo esc_html( $item['glass_card_title'] ); ?></h2>
                            </div>
                            <div class="elements content">
                                <p><?php echo esc_html( $item['glass_card_subtitle'] ); ?></p>
                            </div>
							<div class="card"></div>
                        </div>
                    <?php
                    } 
                    ?>
                    </div>
                    </div>
                    <?php
                }
                
		
	}

	
}

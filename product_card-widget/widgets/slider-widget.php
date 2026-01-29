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
class Elementor_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name(): string {
		return 'slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title(): string {
		return esc_html__( 'Custome Slider', 'elementor-slider-widget' );
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
		return 'eicon-post-slider';
	}
	/**
	 * Get widget CSS.
	 *
	 * Retrieve the css of slider the slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget CSS.
	 */
	public function get_style_depends(): array {
		return [ 'elementor_slider_css', 'elementor_slick_css', 'elementor_extra_css' ];
	}
	/**
	 * Get widget Js.
	 *
	 * Retrieve the Js of slider the slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget JS.
	 */
	public function get_script_depends(): array {
	return [ 'custome_main_js' ];
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
		return [ 'slide', 'slides'];
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
			'image_alt' => esc_attr__( 'Upgrade', 'elementor-list-widget' ),
			'title' => esc_html__( 'Promotion heading', 'elementor-list-widget' ),
			'description' => esc_html__( 'Get the premium version of the widget with additional styling capabilities.', 'elementor-list-widget' ),
			'upgrade_url' => esc_url( 'https://example.com/upgrade-to-pro/' ),
			'upgrade_text' => esc_html__( 'Upgrade Now', 'elementor-list-widget' ),
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
	 * Register list widget controls.
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
				'label' => esc_html__( 'Sliders Content', 'elementor-list-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		

		$repeater->add_control(
			'slide_color',
			[
				'label' => esc_html__( 'Card Color', 'custom-card' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$repeater->add_control(
			'reviewer_name',
			[
				'label' => esc_html__( 'Reviewer Name', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Reviewer Name' , 'textdomain' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'reviewer_name_check',
			[
				'label' => esc_html__( 'Reviewer Name Check Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check-circle',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'review_content',
			[
				'label' => esc_html__( 'Review Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Review Content' , 'textdomain' ),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' => __( 'Rating', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
				'max' => 5,
			]
		);

		$repeater->add_control(
			'star_icon',
			[
				'label' => __( 'Star Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
					'class' => 'star-icon',
				],
			]
		);


		$this->add_control(
			'slider_list',
			[
				'label' => esc_html__( 'Repeater List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'review_icon' => esc_html__( 'Review Icon', 'textdomain' ),
						'reviewer_name' => esc_html__( 'Reviewer Name #1', 'textdomain' ),
						'review_content' => esc_html__( 'Review content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'review_icon' => esc_html__( 'Review Icon', 'textdomain' ),
						'reviewer_name' => esc_html__( 'Reviewer Name #2', 'textdomain' ),
						'review_content' => esc_html__( 'Review content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'review_icon' => esc_html__( 'Review Icon', 'textdomain' ),
						'reviewer_name' => esc_html__( 'Reviewer Name #2', 'textdomain' ),
						'review_content' => esc_html__( 'Review content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ reviewer_name }}}',
			]
		);


		$this->end_controls_section();
		//Icon Section
		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Review Icon', 'elementor-list-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'star_color',
			[
				'label' => esc_html__( 'Review Icon Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stars svg' => 'fill: {{VALUE}};',
				],
			],
		);

		$this->add_control(
			'star_size',
			[
				'label' => __( 'Review Icon Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 10, 'max' => 50 ],
				],
				'selectors' => [
					'{{WRAPPER}} .stars' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stars svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		//Blue Tick Icon Section
		$this->start_controls_section(
			'blue_tick_icon_section',
			[
				'label' => esc_html__( 'Review Name Icon', 'elementor-list-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'blue_tick_color',
			[
				'label' => esc_html__( 'Reviewer Icon Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blue-tick svg' => 'fill: {{VALUE}};',
				],
			],
		);

		$this->add_control(
			'blue_tick_size',
			[
				'label' => __( 'Reviewer Icon Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 10, 'max' => 50 ],
				],
				'selectors' => [
					'{{WRAPPER}} .blue-tick' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .blue-tick svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//Reviewer Name Section
		$this->start_controls_section(
			'reviewer_name_section',
			[
				'label' => esc_html__( 'Reviewer Name', 'elementor-list-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'reviewer_content_color',
			[
				'label' => esc_html__( 'Reviewer Name Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reviewer-name' => 'color: {{VALUE}};',
				],
			],
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .reviewer-name',
			]
		);

		$this->end_controls_section();
		//Reviewer Content Section
		$this->start_controls_section(
			'reviewer_content_section',
			[
				'label' => esc_html__( 'Reviewer Content', 'elementor-list-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'reviewer_content_color',
			[
				'label' => esc_html__( 'Reviewer Content Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reviews-content' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .reviews-content',
			]
		);

		$this->end_controls_section();

		//Slider Navigation Section
		$this->start_controls_section(
			'slider_navigation',
			[
				'label' => __( 'Navigation', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label' => __( 'Show Arrows', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'textdomain' ),
				'label_off' => __( 'No', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'arrow_left_icon',
			[
				'label' => __( 'Left Arrow Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_arrows' => 'yes'
				]
			]
		);

		$this->add_control(
			'arrow_right_icon',
			[
				'label' => __( 'Right Arrow Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_arrows' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		//Slider Navigation Style Section
		$this->start_controls_section(
			'slider_navigation_style',
			[
				'label' => __( 'Slider Navigation Style', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Arrow Color
		$this->add_control(
			'arrow_color',
			[
				'label'     => __( 'Arrow Color', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-prev i, {{WRAPPER}} .slick-next i' => 'color: {{VALUE}};',
				],
			]
		);

		// Arrow Size
		$this->add_control(
			'arrow_size',
			[
				'label' => __( 'Arrow Size (px)', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev i, {{WRAPPER}} .slick-next i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$arrows = ( $settings['show_arrows'] === 'yes' ) ? 'true' : 'false';
		$arrow_left  = $settings['arrow_left_icon']['value'] ?? 'fas fa-chevron-left';
		$arrow_right = $settings['arrow_right_icon']['value'] ?? 'fas fa-chevron-right';
		if ( $settings['slider_list'] ) { ?>
				<div class=" py-20">
				<div class="slick-carousel relative"  data-arrow-left="<?php echo esc_attr($arrow_left); ?>"
     data-arrow-right="<?php echo esc_attr($arrow_right); ?>">
					
			<?php
			foreach (  $settings['slider_list'] as $item ) {
				$bg_color = ! empty( $item['slide_color'] )
							? $item['slide_color']
							: '#ffffff'; ?>
				<div class="slider-wrapper slider-col" >
					<div class="border-1 rounded-[20px] border-[#ddd] py-6.5 px-8 flex flex-col gap-3.75" style="background-color: <?php echo esc_attr($bg_color); ?>;">
						<div class="flex gap-1.75 stars">
							<?php 
								$rating = min( intval( $item['rating'] ), 5 ); // max 5 star
								for ( $i = 1; $i <= $rating; $i++ ) {
									\Elementor\Icons_Manager::render_icon(
										$item['star_icon'],
										[ 'aria-hidden' => 'true', 'class' => 'star-icon' ]
									);
								}
							?>
						</div>
						<article class="flex flex-col gap-3">
							<div class="flex gap-1">
								<h3 class="reviewer-name"><?php echo $item['reviewer_name']; ?></h3>
								<div class="blue-tick">
									<?php \Elementor\Icons_Manager::render_icon( $item['reviewer_name_check'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							</div>
							<p class="reviews-content">
								<?php echo $item['review_content']; ?>
							</p>
						</article>
					</div>
				</div>
			<?php
			} 
			?>
				</div>
				</div>
				<script>
					window.mySliderSettings = {
						arrows: <?php echo $arrows; ?>
					};
					</script>
			<?php
		}	  
		
	}

}
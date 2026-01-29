<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if (!function_exists('get_filtered_post_types')) {
    function get_filtered_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $exclude = ['attachment', 'page', 'elementor_library', 'elementor-hf', 'floating_element', 'nav_menu_item', 'wp_block', 'floating'];

        $options = [];

        foreach ($post_types as $post_type) {
            if (!in_array($post_type->name, $exclude)) {
                $options[$post_type->name] = $post_type->label;
            }
        }

        return $options;
    }
}
/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Skill_Widget extends \Elementor\Widget_Base {

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
		return 'skills-animated-card';
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
		return esc_html__( 'Animated Skill Card', 'custom-card' );
	}
    /**  
     * Get widget script dependencies.
     * 
    * @since 1.0.0
	 * @access public
	 * @return string Widget css.
    */
     public function get_style_depends() {
        return [ 'skill_card_css' ];
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
		return 'eicon-tools';
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
		return [ 'skill', 'skills', 'animated', 'card' ];
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
                'label' => esc_html__( 'Content', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => 'Select Post Type',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => get_filtered_post_types(),
                'default' => 'post',
            ]
        );
        $this->end_controls_section();
        //style section can be added here
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title Style', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .skills .card .content .details h2',
			]
		);

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'custom-card' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=> '#45f3ff',
                'selectors' => [
                    '{{WRAPPER}} .skills .card .content .details h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_description_style',
            [
                'label' => esc_html__( 'Description Style', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .skills .card .content .details p',
			]
		);

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Description Color', 'custom-card' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default'=> '#fff',
                'selectors' => [
                    '{{WRAPPER}} .skills .card .content .details p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button Style', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .skills .card .content .details a',
			]
		);

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Button Color', 'custom-card' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skills .card .content .details a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Button Background Color', 'custom-card' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skills .card .content .details a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Card Animation Color', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_before_gradient',
                'label' => __('Card ::before Gradient', 'textdomain'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .skills .card .lines::before', // 👈 pseudo element
                'fields_options' => [
                    'background' => [
                        'default' => 'linear-gradient(90deg, #ff512f, #dd2476)', // default gradient
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        //style section can be added here
        $this->start_controls_section(
            'style_img_section',
            [
                'label' => esc_html__( 'Image Animation Color', 'custom-card' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'imgbx_before_gradient',
                'label' => __('Image ::before Gradient', 'textdomain'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .skills .card .imgbx::before', // 👈 pseudo element
                'fields_options' => [
                    'background' => [
                        'default' => 'linear-gradient(90deg, #ff512f, #dd2476)', // default gradient
                    ],
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
        $post_type = $settings['post_type'];?>
        
        <div class="animated_skill_cards_body">
            <div class="skills">
                <?php
                    $query = new WP_Query([
                        'post_type' => $post_type,
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'ASC',
                    ]);

                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <div class="card">
                            <div class="lines"></div>
                            <div class="imgbx">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></p>
                                    <a href="<?php the_permalink(); ?>">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                ?>
                
            </div>
        </div>
               
                
		
	<?php }

	
}

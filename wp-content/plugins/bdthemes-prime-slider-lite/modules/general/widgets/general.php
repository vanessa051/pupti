<?php

namespace PrimeSlider\Modules\General\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;

use PrimeSlider\Prime_Slider_Loader;

use PrimeSlider\Modules\General\Skins;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class General extends Widget_Base {

	public function get_name() {
		return 'prime-slider-general';
	}

	public function get_title() {
		return BDTPS . esc_html__('General', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-general';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return [ 'prime slider', 'slider', 'general', 'prime' ];
	}

	public function get_style_depends() {
		return ['ps-general'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/VMBuGusjvtM';
	}

	protected function _register_controls() {
		$this->register_query_section_controls();
	}

	public function _register_skins() {

       $slide  = prime_slider_option('general_skin_slide', 'prime_slider_active_modules', 'on' );
       $crelly = prime_slider_option('general_skin_crelly', 'prime_slider_active_modules', 'on' );
       $meteor = prime_slider_option('general_skin_meteor', 'prime_slider_active_modules', 'on' );

       if ( 'on' == $slide or 'on' == $crelly or 'on' == $meteor ) {
           if ('on' == $slide) {
               $this->add_skin(new Skins\Skin_Slide($this));
           }
           if ('on' == $crelly) {
               $this->add_skin(new Skins\Skin_Crelly($this));
           }
           if ('on' == $meteor) {
               $this->add_skin(new Skins\Skin_Meteor($this));
           }
       } else {
           return [];
       }
       
	}

	private function register_query_section_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'slider_size_ratio',
			[
				'label'       => esc_html__('Size Ratio', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => 'Slider ratio to widht and height, such as 16:9',
				'separator'	  => 'before',
			]
		);

		$this->add_control(
			'slider_min_height',
			[
				'label' => esc_html__('Minimum Height', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1024,
					],
				],
			]
		);

		$this->add_control(
			'show_logo',
			[
				'label'   => esc_html__('Show Logo', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_menu',
			[
				'label'   => esc_html__('Show Menu', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_offcanvas',
			[
				'label'   => esc_html__('Show Offcanvas', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hide_offcanvas_desktop',
			[
				'label'   => esc_html__('Hide Offcanvas Desktop?', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'show_offcanvas' => 'yes',
					'_skin' => '',
				]
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__('Show Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_sub_title',
			[
				'label'   => esc_html__('Show Sub Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_button_text',
			[
				'label'   => esc_html__('Show Button', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__('Show Excerpt', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
		'show_social_icon',
			[
				'label'   => esc_html__('Show Social Icon', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition'	=> [
					'_skin!'    => ['slide'],
				],
			]
		);

		$this->add_control(
			'show_scroll_button',
			[
				'label'   => esc_html__('Show Scroll Button', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_navigation_arrows',
			[
				'label'   => esc_html__('Show Arrows', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_navigation_dots',
			[
				'label'   => esc_html__('Show Dots', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
            'content_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'bdthemes-prime-slider' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content *' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_header',
			[
				'label' => esc_html__('Header', 'bdthemes-prime-slider'),
			]
		);


		$this->start_controls_tabs('tabs_header_layout');

		$this->start_controls_tab(
			'tab_logo_layout',
			[
				'label' => __('Logo', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'logo_type',
			[
				'label'   => esc_html__('Select Logo Type', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'text'    => [
						'title' => esc_html__('Text', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-header',
					],

					'image' => [
						'title' => esc_html__('Image', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-picture-o',
					],

				],
				'default'   => 'text',
				'condition' => [
					'show_logo' => 'yes',
				],
			]
		);

		$this->add_control(
			'logo_text',
			[
				'label' 	  => __('Logo Text', 'bdthemes-prime-slider'),
				'type' 		  => Controls_Manager::TEXT,
				'dynamic' 	  => [
					'active' 	 => true,
				],
				'default' 	  => __('Brand', 'bdthemes-prime-slider'),
				'placeholder' => __('Your Brand Name', 'bdthemes-prime-slider'),
				'condition'   => [
					'show_logo!' => '',
					'logo_type'  => 'text',
				],
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label' 	=> __('Choose Image', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::MEDIA,
				'dynamic' 	=> [
					'active'     => true,
				],
				'default' 	=> [
					'url' 	     => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    	=> 'logo_image_size',
				'label'   	=> esc_html__('Image Size', 'bdthemes-prime-slider'),
				'exclude' 	=> ['custom'],
				'default' 	=> 'medium',
				'condition' => [
					'show_logo' => 'yes',
					'logo_type' => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'logo_image_width',
			[
				'label' => __('Logo Image Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'   => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' 	 => [
					'{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo .bdt-logo-inner img' => 'width: {{SIZE}}px;',
				],
				'condition' 	 => [
					'show_logo' 	=> 'yes',
					'logo_type' 	=> 'image',
				],
			]
		);

		$this->add_control(
			'show_custom_logo_link',
			[
				'label'   	=> esc_html__('Show Custom Link', 'bdthemes-prime-slider'),
				'type'    	=> Controls_Manager::SWITCHER,
				'default' 	=> '',
				'condition' => [
					'show_logo'	=> 'yes',
				]
			]
		);

		$this->add_control(
			'logo_link',
			[
				'label'       => __('URL', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => ['active' => true],
				'default' 	  => [
					'url' 		 => '',
				],
				'condition'   => [
					'show_logo!'         	=> '',
					'show_custom_logo_link' => 'yes',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_layout',
			[
				'label' => __('Menu', 'bdthemes-prime-slider'),
			]
		);

        $this->add_control(
            'dynamic_menu',
            [
                'label'   => esc_html__('Dynamic Menu', 'bdthemes-prime-slider'),
                'type'    => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'navbar',
            [
                'label'   => esc_html__( 'Select Menu', 'bdthemes-prime-slider' ),
                'type'    => Controls_Manager::SELECT,
                'options' => prime_slider_get_menu(),
                'default' => 0,
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );


        $this->add_responsive_control(
            'dropdown_align',
            [
                'label'     => esc_html__( 'Dropdown Alignment', 'bdthemes-prime-slider' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_responsive_control(
            'dropdown_link_align',
            [
                'label'   => esc_html__( 'Item Alignment', 'bdthemes-prime-slider' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-navbar-dropdown-nav > li > a' => 'text-align: {{VALUE}};',
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_control(
            'dropdown_padding',
            [
                'label'      => esc_html__( 'Dropdown Padding', 'bdthemes-prime-slider' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-navbar-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_responsive_control(
            'dropdown_width',
            [
                'label' => esc_html__( 'Dropdown Width', 'bdthemes-prime-slider' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 350,
                    ],
                ],
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-navbar-dropdown' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_control(
            'dropdown_delay_show',
            [
                'label' => esc_html__( 'Delay Show', 'bdthemes-prime-slider' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_control(
            'dropdown_delay_hide',
            [
                'label' => esc_html__( 'Delay Hide', 'bdthemes-prime-slider' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'default' => ['size' => 800],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_control(
            'dropdown_duration',
            [
                'label' => esc_html__( 'Dropdown Duration', 'bdthemes-prime-slider' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'default' => ['size' => 200],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
        );

        $this->add_control(
            'dropdown_offset',
            [
                'label' => esc_html__( 'Dropdown Offset', 'bdthemes-prime-slider' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => ['dynamic_menu' => 'yes'],
            ]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'menu_title',
			[
				'label'       => __('Title & Content', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'menu_link',
			[
				'label'       => __('Link', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => ['active' => true],
				'default' => [
					'url' => '#',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'menus',
			[
				'label'   => __('Menu Items', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'menu_title'   => __('About', 'bdthemes-prime-slider'),
						'menu_link'    => '#',
					],
					[
						'menu_title'   => __('Projects', 'bdthemes-prime-slider'),
						'menu_link'    => '#',
					],
					[
						'menu_title'   => __('Services', 'bdthemes-prime-slider'),
						'menu_link'    => '#',
					],
					[
						'menu_title'   => __('Contacts', 'bdthemes-prime-slider'),
						'menu_link'    => '#',
					],
				],
				'condition' => ['dynamic_menu' => ''],
				'title_field' => '{{{ menu_title }}}',
			]
		);


		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_offcanvas_layout',
			[
				'label' => __('Offcanvas', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'offcanvas_button_text',
			[
				'label'       => esc_html__('Button Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'placeholder' => esc_html__('Offcanvas', 'bdthemes-prime-slider'),
			]
		);

		$this->add_responsive_control(
			'offcanvas_button_align',
			[
				'label' => esc_html__('Button Alignment', 'bdthemes-prime-slider'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-prime-slider'),
						'icon' => 'fa fa-align-left',
					],

					'right' => [
						'title' => esc_html__('Right', 'bdthemes-prime-slider'),
						'icon' => 'fa fa-align-right',
					],

				],
				'condition' => [
					'_skin'	=> [''],
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_button_offset',
			[
				'label' => esc_html__('Offset', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_icon',
			[
				'label'       		=> esc_html__('Button Icon', 'bdthemes-prime-slider'),
				'type'        		=> Controls_Manager::ICONS,
				'default' 			=> [
					'value' 	=> 'fas fa-bars',
					'library' 	=> 'fa-solid',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_icon_align',
			[
				'label'   => esc_html__('Icon Position', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__('Before', 'bdthemes-prime-slider'),
					'right' => esc_html__('After', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_icon_indent',
			[
				'label'   => esc_html__('Icon Spacing', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button .bdt-offcanvas-button-icon.elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button .bdt-offcanvas-button-icon.elementor-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Offcanvas', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'bdthemes-prime-slider'),
					'custom'  => esc_html__('Custom Link', 'bdthemes-prime-slider'),
				],
			]
		);

		$this->add_control(
			'offcanvas_custom_id',
			[
				'label'       => esc_html__('Offcanvas Selector', 'bdthemes-prime-slider'),
				'description' => __('Set your offcanvas selector here. For example: <b>.custom-link</b> or <b>#customLink</b>. Set this selector where you want to link this offcanvas.', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('#bdt-custom-offcanvas', 'bdthemes-prime-slider'),
				'condition'   => [
					'layout'     => 'custom',
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label'   => esc_html__('Select Source', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sidebar',
				'options' => [
					'sidebar'   => esc_html__('Sidebar', 'bdthemes-prime-slider'),
					'elementor' => esc_html__('Elementor Template', 'bdthemes-prime-slider'),
				],
			]
		);

		$this->add_control(
			'template_id',
			[
				'label'       => __('Choose Template', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'label_block' => 'true',
				'condition'   => ['source' => 'elementor'],
				'options' => prime_slider_et_options(),
			]
		);

		$this->add_control(
			'sidebars',
			[
				'label'       => esc_html__('Choose Sidebar', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options' 	  => prime_slider_sidebar_options(),
				'label_block' => 'true',
				'condition'   => ['source' => 'sidebar'],
			]
		);

		$this->add_responsive_control(
			'offcanvas_width',
			[
				'label'      => esc_html__('Width', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'vw'],
				'range'      => [
					'px' => [
						'min' => 240,
						'max' => 1200,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'offcanvas_animations!' => ['push', 'reveal'],
				]
			]
		);

		$this->add_control(
			'custom_content_before_switcher',
			[
				'label' => esc_html__('Custom Content Before', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'custom_content_after_switcher',
			[
				'label' => esc_html__('Custom Content After', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_overlay',
			[
				'label'        => esc_html__('Overlay', 'bdthemes-prime-slider'),
				'type'         => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_animations',
			[
				'label'     => esc_html__('Animations', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slide',
				'options'   => [
					'slide'  => esc_html__('Slide', 'bdthemes-prime-slider'),
					'push'   => esc_html__('Push', 'bdthemes-prime-slider'),
					'reveal' => esc_html__('Reveal', 'bdthemes-prime-slider'),
					'none'   => esc_html__('None', 'bdthemes-prime-slider'),
				],
			]
		);

		$this->add_control(
			'offcanvas_flip',
			[
				'label'        => esc_html__('Flip', 'bdthemes-prime-slider'),
				'type'         => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_close_button',
			[
				'label'   => esc_html__('Close Button', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'header_sticky_on',
			[
				'label'        => esc_html__('Enable Sticky', 'bdthemes-prime-slider'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__('Set sticky options by enable this option.', 'bdthemes-prime-slider'),
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'header_sticky_controls',
			[
				'label' => __('Sticky', 'bdthemes-prime-slider'),
				'condition' => ['header_sticky_on' => 'yes'],
			]
		);

		$this->add_control(
			'header_sticky_offset',
			[
				'label'   => esc_html__('Offset', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_sticky_active_bg',
			[
				'label'     => esc_html__('Active Background Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-header-wrapper header.bdt-sticky:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_sticky_active_padding',
			[
				'label'      => esc_html__('Active Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-header-wrapper header.bdt-sticky.bdt-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'     => esc_html__('Active Box Shadow', 'bdthemes-prime-slider'),
				'name'     => 'header_sticky_active_shadow',
				'selector' => '{{WRAPPER}} .bdt-header-wrapper header.bdt-sticky.bdt-active',
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_sticky_animation',
			[
				'label'     => esc_html__('Animation', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'options'   => prime_slider_transition_options(),
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_sticky_bottom',
			[
				'label' => esc_html__('Scroll Until', 'bdthemes-prime-slider'),
				'description'  => esc_html__('If you don\'t want to scroll after specific section so set that section ID/CLASS here. for example: #section1 or .section1 it\'s support ID/CLASS', 'bdthemes-prime-slider'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_sticky_on_scroll_up',
			[
				'label'        => esc_html__('Sticky on Scroll Up', 'bdthemes-prime-slider'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__('Set sticky options when you scroll up your mouse.', 'bdthemes-prime-slider'),
				'condition' => [
					'header_sticky_on' => 'yes',
				],
			]
		);


		$this->add_control(
			'header_sticky_off_media',
			[
				'label'       => __('Turn Off', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::CHOOSE,
				'options' => [
					'960' => [
						'title' => __('On Tablet', 'bdthemes-prime-slider'),
						'icon'  => 'fas fa-tablet',
					],
					'768' => [
						'title' => __('On Mobile', 'bdthemes-prime-slider'),
						'icon'  => 'fas fa-mobile',
					],
				],
				'condition' => [
					'header_sticky_on' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_custom_before',
			[
				'label'     => esc_html__('Custom Content Before', 'bdthemes-prime-slider'),
				'condition' => [
					'custom_content_before_switcher' => 'yes',
				]
			]
		);

		$this->add_control(
			'custom_content_before',
			[
				'label'   => esc_html__('Custom Content Before', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => ['active' => true],
				'default' => esc_html__('This is your custom content for before of your offcanvas.', 'bdthemes-prime-slider'),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_custom_after',
			[
				'label'     => esc_html__('Custom Content After', 'bdthemes-prime-slider'),
				'condition' => [
					'custom_content_after_switcher' => 'yes',
				]
			]
		);


		$this->add_control(
			'custom_content_after',
			[
				'label'   => esc_html__('Custom Content After', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => ['active' => true],
				'default' => esc_html__('This is your custom content for after of your offcanvas.', 'bdthemes-prime-slider'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_sliders',
			[
				'label' => esc_html__('Sliders', 'bdthemes-prime-slider'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'sub_title',
			[
				'label'       => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Sub title goes here', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'title_link',
			[
				'label'         => esc_html__('Title Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => ''],
				'show_external' => false,
				'dynamic'       => ['active' => true],
				'condition'     => [
					'title!' => ''
				]
			]
		);

		$repeater->add_control(
			'slide_button_text',
			[
				'label'       => esc_html__('Button Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Details', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'         => esc_html__('Button Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'dynamic'       => ['active' => true],
				'condition'     => [
					'title!' => '',
				]
			]
		);

		$repeater->add_control(
			'excerpt',
			[
				'label'       => esc_html__('Excerpt', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore et quasi architecto beatae vitae dicta sunt explicabo.', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'background',
			[
				'label'   => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'color',
				'toggle'  => false,
				'options' => [
					'color' => [
						'title' => esc_html__('Color', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-picture-o',
					],
					'video' => [
						'title' => esc_html__('Video', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-play-circle',
					],
					'youtube' => [
						'title' => esc_html__('Youtube', 'bdthemes-prime-slider'),
						'icon'  => 'fa fa-youtube',
					],
				],
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#193d4c',
				'condition' => [
					'background' => 'color'
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'     => esc_html__('Image', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'background' => 'image'
				],
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'video_link',
			[
				'label'     => esc_html__('Video Link', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'background' => 'video'
				],
				'default' => '//clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'youtube_link',
			[
				'label'     => esc_html__('Youtube Link', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'background' => 'youtube'
				],
				'default' => 'https://youtu.be/YE7VzlLtp-4',
				'dynamic'     => ['active' => true],
			]
		);

		$this->add_control(
			'slides',
			[
				'label'   => esc_html__('Slider Items', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__('Slide Item 1', 'bdthemes-prime-slider'),
					],
					[
						'title' => esc_html__('Slide Item 2', 'bdthemes-prime-slider'),
					],
					[
						'title' => esc_html__('Slide Item 3', 'bdthemes-prime-slider'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_social_link',
			[
				'label' 	=> __('Social Icon', 'bdthemes-prime-slider'),
				'condition' => [
					'show_social_icon' => 'yes',
					'_skin!'	=> ['slide'],
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link_title',
			[
				'label'   => __('Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Facebook',
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label'   => __('Link', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider'),
			]
		);

		$repeater->add_control(
			'social_icon',
			[
				'label'   => __('Choose Icon', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
			]
		);

		$this->add_control(
			'social_link_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'social_link'       => __('http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider'),
						'social_icon' 		=> [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
						'social_link_title' => 'Facebook',
					],
					[
						'social_link'       => __('http://www.twitter.com/bdthemes/', 'bdthemes-prime-slider'),
						'social_icon'		=> [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
						'social_link_title' => 'Twitter',
					],
					[
						'social_link'       => __('http://www.instagram.com/bdthemes/', 'bdthemes-prime-slider'),
						'social_icon'		=> [
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
						'social_link_title' => 'Instagram',
					],
				],
				'title_field' => '{{{ social_link_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_scroll_button',
			[
				'label' 	=> esc_html__('Scroll Down', 'bdthemes-prime-slider'),
				'condition' => [
					'show_scroll_button' => ['yes'],
					'_skin!'	=> ['slide', 'crelly'],
				],
			]
		);

		$this->add_control(
			'duration',
			[
				'label'      => esc_html__('Duration', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => esc_html__('Offset', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => -200,
						'max'  => 200,
						'step' => 10,
					],
				],
			]
		);

		$this->add_control(
			'scroll_button_text',
			[
				'label'       => esc_html__('Button Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'default'     => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
				'placeholder' => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'section_id',
			[
				'label'       => esc_html__('Section ID', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'my-header',
				'description' => esc_html__("By clicking this scroll button, to which section in your page you want to go? Just write that's section ID here such 'my-header'. N.B: No need to add '#'.", 'bdthemes-prime-slider'),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_animation',
			[
				'label' => esc_html__('Animation', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'finite',
			[
				'label'   => esc_html__('Loop', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__('Autoplay', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_interval',
			[
				'label'     => esc_html__('Autoplay Interval', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 7000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => esc_html__('Pause on Hover', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'velocity',
			[
				'label'   => __( 'Animation Speed', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
			]
		);

		$this->add_control(
			'slider_animations',
			[
				'label'     => esc_html__('Slider Animations', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'fade',
				'options'   => [
					'slide' => esc_html__('Slide', 'bdthemes-prime-slider'),
					'fade'  => esc_html__('Fade', 'bdthemes-prime-slider'),
					'scale' => esc_html__('Scale', 'bdthemes-prime-slider'),
					'push'  => esc_html__('Push', 'bdthemes-prime-slider'),
					'pull'  => esc_html__('Pull', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'_skin!' => 'slide',
				]
			]
		);

		$this->add_control(
			'kenburns_animation',
			[
				'label'     => esc_html__('Kenburns Animation', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'kenburns_reverse',
			[
				'label'     => esc_html__('Kenburn Reverse', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'kenburns_animation' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_logo_animation',
			[
				'label'     => esc_html__('Show Logo Animation', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'default'	=> 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_menu_animation',
			[
				'label'     => esc_html__('Show Menu Animation', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'default'	=> 'yes',
			]
		);

		$this->add_control(
			'show_offcanvas_animation',
			[
				'label'     => esc_html__('Show Offcanvas Animation', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'default'	=> 'yes',
			]
		);

		$this->end_controls_section();

		//Style Start

		$this->start_controls_section(
			'section_header_style',
			[
				'label' 	=> __('Header', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_background_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'shape_background_color',
			[
				'label' 	=> __('Shape Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-shape' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'_skin'	=> 'slide',
				],
			]
		);

		$this->start_controls_tabs('tabs_header_style');

		$this->start_controls_tab(
			'tab_logo_style',
			[
				'label' 	=> __('Logo', 'bdthemes-prime-slider'),
				'condition'	=> [
					'show_logo'	=> 'yes'
				],
			]
		);

		$this->add_control(
			'logo_text_color',
			[
				'label' 	=> __('Logo Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo .bdt-logo-inner' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_logo!' => '',
					'logo_type' => 'text',
				],
			]
		);

		$this->add_control(
			'logo_hover_color',
			[
				'label' 	=> __('Logo Hover Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo .bdt-logo-inner:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'logo_typography',
				'selector' 	=> '{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo .bdt-logo-inner',
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'logo_image_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo img',
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'logo_image_border_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'logo_image_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-header-wrapper .bdt-prime-slider-logo img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_logo!' => '',
					'logo_type'  => 'image',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'section_menu_style',
			[
				'label' 	=> __('Menu', 'bdthemes-prime-slider'),
				'condition'	=> [
					'show_menu'	=> 'yes'
				],
			]
		);

		$this->add_control(
			'slider_menu_style_normal',
			[
				'label' 	=> esc_html__('Normal', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_text_color',
			[
				'label' 	=> __('Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_background_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_border_radius',
			[
				'label' 	 => __('Border Radius', 'bdthemes-prime-slider'),
				'type' 	     => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_text_padding',
			[
				'label' 	 => __('Padding', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'menu_typography',
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a',
			]
		);

		$this->add_control(
			'slider_menu_style_hover',
			[
				'label' 	=> esc_html__('Hover', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_hover_color',
			[
				'label' 	=> __('Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_background_hover_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_style_type',
			[
				'label'   => esc_html__('Select Menu Style', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  	=> esc_html__('Default', 'bdthemes-prime-slider'),
					'background' => esc_html__('Background', 'bdthemes-prime-slider'),
					'line' => esc_html__('Line', 'bdthemes-prime-slider'),
					'dotline' => esc_html__('DotLine', 'bdthemes-prime-slider'),
				],
			]
		);

		$this->add_control(
			'menu_before_style_color',
			[
				'label' 	=> __('Menu Style Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a:after, {{WRAPPER}} .bdt-prime-slider .bdt-navbar-nav > li > a:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slider_dropdown_menu_style_normal',
			[
				'label' 	=> esc_html__('Dropdown Menu', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dropdown_menu_text_color',
			[
				'label' 	=> __('Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-dropdown-nav > li > a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dropdown_menu_text__hover_color',
			[
				'label' 	=> __('Active Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-dropdown li>a:hover, .bdt-prime-slider .bdt-navbar-dropdown li>a.bdt-open' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_menu_background_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-navbar-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_menu_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-navbar-dropdown-nav > li > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'section_style_offcanvas_content',
			[
				'label' => esc_html__('Offcanvas', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'offcanvas_content_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_color',
			[
				'label'     => esc_html__('Link Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar a'   => 'color: {{VALUE}};',
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_content_shadow',
				'selector'  => '#bdt-offcanvas-{{ID}}.bdt-offcanvas > div',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'offcanvas_content_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'style_offcanvas_widget',
			[
				'label'     => esc_html__('WIDGET', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::HEADING,
				// 'condition' => [
				// 	'source' => 'sidebar',
				// ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_widget_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .widget',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'widget_border_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_widget_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_vertical_spacing',
			[
				'label'     => esc_html__('Vertical Spacing', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .widget:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);



		$this->add_control(
			'tab_style_offcanvas_button',
			[
				'label' 	 => esc_html__('OFFCANVAS BUTTON', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::HEADING,
				'condition'  => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'slider_style_offcanvas_button_normal',
			[
				'label' 	=> esc_html__('Normal', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'offcanvas_button_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_color',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_primary_background_color',
			[
				'label'     => esc_html__('Primary Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-header-skin-meteor .bdt-header-inner .bdt-offcanvas-button-wrapper' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'_skin' => 'meteor',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_button_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button',
			]
		);

		$this->add_control(
			'offcanvas_button_border_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_button_shadow',
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'offcanvas_button_typography',
				'label'     => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button',
			]
		);

		$this->add_control(
			'slider_style_offcanvas_button_hover',
			[
				'label' 	=> esc_html__('Hover', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'offcanvas_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_hover_color',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'offcanvas_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-offcanvas-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' 	=> esc_html__('Button Animation', 'bdthemes-prime-slider'),
				'type'  	=> Controls_Manager::HOVER_ANIMATION,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'tab_style_close_button',
			[
				'label'     => esc_html__('CLOSE BUTTON', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'offcanvas_close_button' => 'yes'
				],
			]
		);

		$this->add_control(
			'slider_style_close_button_normal',
			[
				'label' 	=> esc_html__('Normal', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'close_button_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .bdt-offcanvas-close *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_bg',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'close_button_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close',
			]
		);

		$this->add_control(
			'close_button_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'close_button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'close_button_shadow',
				'selector'  => '#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close',
			]
		);

		$this->add_control(
			'slider_style_close_button_hover',
			[
				'label' 	=> esc_html__('Hover', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'close_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-bar .bdt-offcanvas-close:hover *' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'close_button_hover_bg',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'close_button_border_border!' => ''
				],
				'selectors' => [
					'#bdt-offcanvas-{{ID}}.bdt-offcanvas .bdt-offcanvas-close:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_sliders',
			[
				'label'     => esc_html__('Sliders', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('slider_item_style');

		$this->start_controls_tab(
			'slider_title_style',
			[
				'label' 	=> __('Title', 'bdthemes-prime-slider'),
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'title_width',
			[
				'label' => esc_html__('Title Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 220,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'prime_slider_title_spacing',
			[
				'label' => esc_html__('Title Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'title_advanced_style',
			[
				'label' => esc_html__('Advanced Style', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'label' => __( 'Background', 'bdthemes-prime-slider'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __( 'Text Shadow', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 	   => 'title_border',
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label'		 => __('Border Radius', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 	   => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_text_padding',
			[
				'label' 	 => __('Padding', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_sub_title_style',
			[
				'label' 	=> __('Sub Title', 'bdthemes-prime-slider'),
				'condition' => [
					'show_sub_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc h4',
			]
		);

		$this->add_responsive_control(
			'prime_slider_sub_title_spacing',
			[
				'label' => esc_html__('Sub Title Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-sub-title h4' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_sub_title' => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_style_excerpt',
			[
				'label'     => esc_html__('Excerpt', 'bdthemes-prime-slider'),
				'condition' => [
					'show_excerpt' => ['yes'],
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'excerpt_title_color',
			[
				'label'     => esc_html__('Title Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt-content h3' => 'color: {{VALUE}};',
				],
				'condition' => [
					'_skin' => ['crelly'],
				],
			]
		);

		$this->add_control(
			'excerpt_background_color',
			[
				'label'     => esc_html__('Primary Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-prime-slider-footer-content .bdt-social-background, {{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-featured' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'_skin' => ['meteor', 'slide'],
				],
			]
		);

		$this->add_control(
			'excerpt_style_color',
			[
				'label'     => esc_html__('Style Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-slider-excerpt:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'_skin' => 'crelly',
				],
			]
		);

		$this->add_control(
			'excerpt_style_border_color',
			[
				'label'     => esc_html__('Line Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-featured .bdt-slider-excerpt' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'_skin' => 'slide',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt',
			]
		);

		$this->add_responsive_control(
			'excerpt_width',
			[
				'label' 	 	 => __('Width (px)', 'bdthemes-prime-slider'),
				'type' 			 => Controls_Manager::SLIDER,
				'default' 		 => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' 	 => ['px'],
				'range' 		 => [
					'px' => [
						'min' => 100,
						'max' => 1200,
					],
				],
				'selectors'  	 => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'prime_slider_excerpt_spacing',
			[
				'label' 	=> esc_html__('Excerpt Spacing', 'bdthemes-prime-slider'),
				'type'  	=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 		=> [
						'min' 		=> 0,
						'max' 		=> 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_excerpt'  => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_button_style',
			[
				'label' 	=> __('Button', 'bdthemes-prime-slider'),
				'condition' => [
					'show_button_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'slider_button_style_normal',
			[
				'label' 	=> esc_html__('Normal', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slide_button_text_color',
			[
				'label' 	=> __('Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn svg *' => 'stroke: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slide_button_background_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 	 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_icon_background_color',
			[
				'label' 	=> __('Icon Background', 'bdthemes-prime-slider'),
				'type' 	 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 	   => 'slide_button_border',		
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
			]
		);

		$this->add_control(
			'slide_button_border_radius',
			[
				'label'		 => __('Border Radius', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 	   => 'slide_button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
			]
		);

		$this->add_responsive_control(
			'slide_button_text_padding',
			[
				'label' 	 => __('Padding', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'slide_button_typography',
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
			]
		);

		$this->add_control(
			'slider_button_style_hover',
			[
				'label' 	=> esc_html__('Hover', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slide_button_hover_color',
			[
				'label' 	=> __('Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover svg *' => 'stroke: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'slide_button_background_hover_color',
			[
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_icon_background_hover_color',
			[
				'label' 	=> __('Icon Background', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover .bdt-slide-btn-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_hover_border_color',
			[
				'label' 	=> __('Border Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'condition' => [
					'slide_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'overlay',
			[
				'label'   => esc_html__('Overlay', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => esc_html__('None', 'bdthemes-prime-slider'),
					'background' => esc_html__('Background', 'bdthemes-prime-slider'),
					'blend'      => esc_html__('Blend', 'bdthemes-prime-slider'),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'     => esc_html__('Overlay Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'overlay' => ['background', 'blend']
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-slideshow .bdt-overlay-default' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'blend_type',
			[
				'label'     => esc_html__('Blend Type', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => prime_slider_blend_options(),
				'condition' => [
					'overlay' => 'blend',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social_icon',
			[
				'label'     => esc_html__('Social Icon', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_social_icon' => 'yes',
					'_skin!'	=> ['slide'],
				],
			]
		);

		$this->start_controls_tabs('tabs_social_icon_style');

		$this->start_controls_tab(
			'tab_social_icon_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'social_icon_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_icon_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon h3' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'_skin'	=> 'crelly',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'social_icon_background',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'social_icon_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
			]
		);

		$this->add_control(
			'social_icon_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_icon_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'social_icon_shadow',
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
			]
		);

		$this->add_responsive_control(
			'social_icon_size',
			[
				'label' => __('Icon Size', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'social_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a'    => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_skin!' => 'crelly',
				],
			]
		);

		$this->add_control(
			'social_background_color',
			[
				'label'     => esc_html__('Primary Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-prime-slider-footer-content .bdt-social-bg-color' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'_skin' => 'meteor',
				],
			]
		);

		$this->add_control(
			'social_icon_tooltip',
			[
				'label'   => esc_html__('Show Tooltip', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_social_icon_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'social_icon_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'social_icon_hover_background',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'social_icon_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_scroll_button',
			[
				'label' 	=> esc_html__('Scroll Down', 'bdthemes-prime-slider'),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_scroll_button' => ['yes'],
					'_skin!'	=> ['slide', 'crelly'],
				],
			]
		);

		$this->start_controls_tabs('tabs_scroll_button_style');

		$this->start_controls_tab(
			'tab_scroll_button_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'scroll_button_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'scroll_button_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_scroll_button_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'scroll_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down:hover span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down:hover span svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __('Navigation', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_navigation_style');

		$this->start_controls_tab(
			'tab_navigation_arrows_style',
			[
				'label' 	=> __('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Arrows Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:before, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
					'_skin!'	=> ['meteor'],
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'arrows_background',
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'types' 	=> ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
					'_skin!'	=> ['meteor'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'arrows_border',
				'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
				'separator' => 'before',
				'condition' => [
					'_skin!'	=> ['meteor'],
				],
			]
		);

		$this->add_control(
			'arrows_border_radius',
			[
				'label' 	 => __('Border Radius Test', 'bdthemes-prime-slider'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'_skin!'	=> ['meteor'],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __('Active Dot Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-slideshow-nav li a:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-dotnav li a' => 'background: {{VALUE}}',
					'{{WRAPPER}} .bdt-dotnav li.bdt-active a' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_dots' => ['yes'],
					'_skin!'	=> ['meteor', 'crelly'],
					
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meteor_active_dot_color',
			[
				'label'     => __('Active Dot Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-dotnav li.bdt-active a, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-dotnav li.bdt-active a:after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li.bdt-active a:before, {{WRAPPER}} .bdt-prime-slider .bdt-dotnav li a:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_dots' => ['yes'],
					'_skin'	=> ['meteor', 'crelly'],
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'active_dot_number_color',
			[
				'label'     => __('Active Number Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-dotnav li:after, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-ps-counternav span, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-ps-counternav li a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_dots' => ['yes'],
					'_skin!'	=> ['meteor', 'default'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_navigation_arrows_hover_style',
			[
				'label' 	=> __('Hover', 'bdthemes-prime-slider'),
				'condition' => [
					'_skin!'	=> [ 'meteor' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Arrows Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:before, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'arrows_hover_background',
				'label' 	=> __('Background', 'bdthemes-prime-slider'),
				'types' 	=> ['classic', 'gradient'],
				'selector' 	=> '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_border_color',
			[
				'label' 	=> __('Border Color', 'bdthemes-prime-slider'),
				'type' 		=> Controls_Manager::COLOR,
				'condition' => [
					'arrows_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render_header($skin_name = 'general') {
		$settings = $this->get_settings_for_display();

		$this->header_sticky_render();

		$this->add_render_attribute('header', 'class', 'bdt-prime-header-skin-' . $skin_name);
		$this->add_render_attribute('slider', 'class', 'bdt-prime-slider-skin-' . $skin_name);

		$ratio = ($settings['slider_size_ratio']['width'] && $settings['slider_size_ratio']['height']) ? $settings['slider_size_ratio']['width'] . ":" . $settings['slider_size_ratio']['height'] : '16:9';

		$this->add_render_attribute(
			[
				'slideshow' => [
					'bdt-slideshow' => [
						wp_json_encode([
							"animation"         => $settings["slider_animations"],
							"ratio"             => $ratio,
							"min-height"        => ($settings["slider_min_height"]["size"]) ? $settings["slider_min_height"]["size"] : 480,
							"autoplay"          => ($settings["autoplay"]) ? true : false,
							"autoplay-interval" => $settings["autoplay_interval"],
							"pause-on-hover"    => ("yes" === $settings["pause_on_hover"]) ? true : false,
							"velocity"          => ($settings["velocity"]["size"]) ? $settings["velocity"]["size"] : 1,
							"finite"            => ($settings["finite"]) ? false : true,
						])
					]
				]
			]
		);

		if ('yes' == $settings['hide_offcanvas_desktop']) {
			$this->add_render_attribute('hide_offcanvas', 'class', 'bdt-hidden@m bdt-visible@m');
		} else {
			$this->add_render_attribute('hide_offcanvas', 'class', 'bdt-visible@m');
		}

		?>
			<div class="bdt-prime-slider">
				<div class="bdt-header-wrapper bdt-position-top">
					<header <?php echo $this->get_render_attribute_string('header'); ?>>
						<div class="bdt-prime-slider-container">
							<div class="bdt-header-inner bdt-flex bdt-flex-middle" bdt-grid>
								<div class="bdt-width-auto">
									<div class="bdt-prime-slider-logo bdt-flex bdt-flex-middle">

										<?php if ('yes' == $settings['show_offcanvas']) : ?>
											<?php if ('left' == $settings['offcanvas_button_align'] and 'general' == $skin_name) : ?>
												<div <?php echo $this->get_render_attribute_string('hide_offcanvas'); ?>>
													<?php $this->render_offcanvas_button(); ?>
												</div>
											<?php endif; ?>
										<?php endif; ?>

										<?php $this->render_logo(); ?>

									</div>
								</div>
								<div class="bdt-width-expand">
									<?php $menu_align = ( 'crelly' == $skin_name or 'meteor' == $skin_name ) ? 'bdt-navbar-left' : 'bdt-navbar-right' ?>
                                    <?php $this->render_menu( $skin_name, $menu_align ); ?>
								</div>
							</div>
						</div>
					</header>
				</div>

				<div <?php echo $this->get_render_attribute_string('slider'); ?>>

				<div class="bdt-position-relative bdt-visible-toggle" <?php echo $this->get_render_attribute_string('slideshow'); ?>>

					<ul class="bdt-slideshow-items">
		<?php
	}

	public function render_logo() {
		$settings = $this->get_settings_for_display();

		$image_html        = Group_Control_Image_Size::get_attachment_image_html($settings, 'logo_image');
		$placeholder_image_src = BDTPS_ASSETS_URL . 'images/brand-logo.svg';

		if (!$image_html) {
			$image_html = '<img width="75" src="' . esc_url($placeholder_image_src) . '" alt="' . get_the_title() . '">';
		}

		$this->add_render_attribute('logo_link', 'class', 'bdt-logo-inner');

		if ('yes' == $settings['show_logo_animation']) {
			$this->add_render_attribute('logo_link', 'bdt-scrollspy', 'cls: bdt-animation-fade;');
			$this->add_render_attribute('logo_link', 'bdt-scrollspy', 'delay: 500;');
		}

		if ('yes' == $settings['show_custom_logo_link'] and !empty($settings['logo_link']['url'])) {

			$this->add_render_attribute('logo_link', 'href', $settings['logo_link']['url']);

			if ($settings['logo_link']['is_external']) {
				$this->add_render_attribute('logo_link', 'target', '_blank');
			}

			if ($settings['logo_link']['nofollow']) {
				$this->add_render_attribute('logo_link', 'rel', 'nofollow');
			}
		} else {
			$this->add_render_attribute('logo_link', 'href', get_bloginfo('url'));
		}

		?>

		<?php if ($settings['show_logo']) : ?>

			<a <?php echo $this->get_render_attribute_string('logo_link'); ?>>

				<?php if ('image' == $settings['logo_type']) : ?>

				<?php echo wp_kses_post($image_html); ?>

				<?php else : ?>

					<?php echo wp_kses( $settings['logo_text'], prime_slider_allow_tags('logo') ); ?>

				<?php endif; ?>

			</a>

		<?php endif; ?>
		<?php
	}

	public function render_menu($skin_name = 'general', $menu_align = 'bdt-navbar-left') {
		$settings = $this->get_settings_for_display();

		?>

		<div class="bdt-prime-slider-navbar bdt-grid-small" bdt-grid>
			<div class="bdt-width-expand">

                <?php if( 'yes' == $settings['dynamic_menu'] ) : ?>
                    <?php prime_slider_dynamic_menu($this, $menu_align); ?>
                <?php else : ?>
                    <?php prime_slider_static_menu($this, $menu_align); ?>
                <?php endif; ?>

			</div>

			<?php 
				$show_offcanvas_right = '';

				if ( 'left' == $settings['offcanvas_button_align'] and 'general' == $skin_name or 'slide' == $skin_name ) {
					$show_offcanvas_right = ' bdt-hidden@m';
				}
			 ?>
			 <?php if ('yes' == $settings['show_offcanvas']) : ?>
				<div class="bdt-width-auto<?php echo esc_attr($show_offcanvas_right); ?>">
					
					<?php $this->render_offcanvas_button(); ?>

				</div>
			<?php endif; ?>
			
		</div>

		<?php
	}

	public function render_offcanvas() {
		$settings = $this->get_settings_for_display();
		$id       = ('custom' == $settings['layout'] and !empty($settings['offcanvas_custom_id'])) ? $settings['offcanvas_custom_id'] : 'bdt-offcanvas-' . $this->get_id();

		$this->add_render_attribute('offcanvas', 'class', 'bdt-offcanvas');
		$this->add_render_attribute('offcanvas', 'id', $id);
		$this->add_render_attribute(
			[
				'offcanvas' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							'id'      =>  $id,
							'layout'  => $settings['layout'],
						]))
					]
				]
			]
		);

		$this->add_render_attribute('offcanvas', 'bdt-offcanvas', 'mode: ' . $settings['offcanvas_animations'] . ';');

		if ($settings['offcanvas_overlay']) {
			$this->add_render_attribute('offcanvas', 'bdt-offcanvas', 'overlay: true;');
		}

		if ($settings['offcanvas_flip']) {
			$this->add_render_attribute('offcanvas', 'bdt-offcanvas', 'flip: true;');
		}

		?>

		<div <?php echo $this->get_render_attribute_string('offcanvas'); ?>>
			<div class="bdt-offcanvas-bar">

				<?php if ($settings['offcanvas_close_button']) : ?>
					<button class="bdt-offcanvas-close" type="button" bdt-close></button>
				<?php endif; ?>

				<?php if ($settings['custom_content_before_switcher'] or $settings['custom_content_after_switcher'] or !empty($settings['source'])) : ?>
					<?php if ($settings['custom_content_before_switcher'] === 'yes' and !empty($settings['custom_content_before'])) : ?>
						<div class="bdt-offcanvas-custom-content-before widget">
							<?php echo wp_kses_post($settings['custom_content_before']); ?>
						</div>
					<?php endif; ?>

					<?php
						if ('sidebar' == $settings['source'] and !empty($settings['sidebars'])) {
							dynamic_sidebar($settings['sidebars']);
						} elseif ('elementor' == $settings['source'] and !empty($settings['template_id'])) {
							echo Prime_Slider_Loader::elementor()->frontend->get_builder_content_for_display($settings['template_id']);
						}
						?>

					<?php if ($settings['custom_content_after_switcher'] === 'yes' and !empty($settings['custom_content_after'])) : ?>
						<div class="bdt-offcanvas-custom-content-after widget">
							<?php echo wp_kses_post($settings['custom_content_after']); ?>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<div class="bdt-offcanvas-custom-content-after widget">
						<div class="bdt-alert-warning" bdt-alert><?php esc_html_e('Ops you don\'t select or enter any content! Add your offcanvas content from editor.', 'bdthemes-prime-slider'); ?></div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}

	public function render_offcanvas_button() {
		$settings = $this->get_settings_for_display();
		$id       = 'bdt-offcanvas-' . $this->get_id();

		if ('default' !== $settings['layout']) {
			return;
		}

		$this->add_render_attribute('button', 'class', ['bdt-offcanvas-button', 'elementor-button'], true);

		if ('yes' == $settings['show_offcanvas_animation']) {
			$this->add_render_attribute('button', 'bdt-scrollspy', 'cls: bdt-animation-fade;');
			$this->add_render_attribute('button', 'bdt-scrollspy', 'delay: 500;');
		}

		if ($settings['hover_animation']) {
			$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}

		$this->add_render_attribute('button', 'bdt-toggle', 'target: #' . esc_attr($id), true);
		$this->add_render_attribute('button', 'href', '#', true);

		$this->add_render_attribute('content-wrapper', 'class', 'elementor-button-content-wrapper', true);
		$this->add_render_attribute('icon-align', 'class', 'elementor-align-icon-' . $settings['offcanvas_button_icon_align'], true);
		$this->add_render_attribute('icon-align', 'class', 'bdt-offcanvas-button-icon elementor-button-icon');

		$this->add_render_attribute('text', 'class', 'elementor-button-text', true);

		?>

			<div class="bdt-offcanvas-button-wrapper">
				<a <?php echo $this->get_render_attribute_string('button'); ?>>

					<span <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
						<?php if (!empty($settings['offcanvas_button_icon']['value'])) : ?>
							<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>

								<?php Icons_Manager::render_icon($settings['offcanvas_button_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>

							</span>
						<?php endif; ?>
						<?php if (!empty($settings['offcanvas_button_text'])) : ?>
							<span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo wp_kses($settings['offcanvas_button_text'], prime_slider_allow_tags('title')); ?></span>
						<?php endif; ?>
					</span>

				</a>
			</div>
		<?php
	}

	public function header_sticky_render() {
		$settings = $this->get_settings_for_display();

		if (!empty($settings['header_sticky_on']) == 'yes') {
			$sticky_option = [];
			if (!empty($settings['header_sticky_on_scroll_up'])) {
				$sticky_option['show-on-up'] = 'show-on-up: true';
			}

			if (!empty($settings['header_sticky_offset']['size'])) {
				$sticky_option['offset'] = 'offset: ' . $settings['header_sticky_offset']['size'];
			}

			if (!empty($settings['header_sticky_animation'])) {
				$sticky_option['animation'] = 'animation: bdt-animation-' . $settings['header_sticky_animation'] . '; top: 100';
			}

			if (!empty($settings['header_sticky_bottom'])) {
				$sticky_option['bottom'] = 'bottom: ' . $settings['header_sticky_bottom'];
			}

			if (!empty($settings['header_sticky_off_media'])) {
				$sticky_option['media'] = 'media: ' . $settings['header_sticky_off_media'];
			}

			$this->add_render_attribute('header', 'bdt-sticky', implode(";", $sticky_option));
			$this->add_render_attribute('header', 'class', 'bdt-sticky');
		}
	}

	public function render_social_link($position = 'right', $label = false, $class = []) {
		$settings  = $this->get_active_settings();

		if ('' == $settings['show_social_icon']) {
			return;
		}

		$this->add_render_attribute('social-icon', 'class', 'bdt-prime-slider-social-icon');
		$this->add_render_attribute('social-icon', 'class', $class);

		?>

			<div <?php echo $this->get_render_attribute_string('social-icon'); ?>>

				<?php if ($label) : ?>
					<h3><?php esc_html_e('Share Us', 'bdthemes-prime-slider'); ?></h3>
				<?php endif; ?>

				<?php
				foreach ($settings['social_link_list'] as $link) :
					$tooltip = ('yes' == $settings['social_icon_tooltip']) ? ' title="' . esc_attr($link['social_link_title']) . '" bdt-tooltip="pos: ' . $position . '"' : ''; ?>

					<a class="bdt-social-animate" href="<?php echo esc_url($link['social_link']); ?>" target="_blank" <?php echo wp_kses_post($tooltip); ?>>
						<?php Icons_Manager::render_icon($link['social_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php
	}

	public function render_scroll_button_text($settings) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('content-wrapper', 'class', 'bdt-scroll-down-content-wrapper');
		$this->add_render_attribute('text', 'class', 'bdt-scroll-down-text');

		?>
			<span bdt-scrollspy="cls: bdt-animation-slide-right; repeat: true" <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
				<span class="bdt-scroll-icon">

					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
						<g><g><polygon points="31,0 31,60.586 23.707,53.293 22.293,54.854 31.293,64 32.707,64 41.707,54.854 40.293,53.366 33,60.586 33,0 " /></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
					</svg>

				</span>
				<span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo wp_kses($settings['scroll_button_text'], prime_slider_allow_tags('title')); ?></span>
			</span>
		<?php
	}

	public function render_scroll_button() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('bdt-scroll-down', 'class', ['bdt-scroll-down']);

		if ('' == $settings['show_scroll_button']) {
			return;
		}

		$this->add_render_attribute(
			[
				'bdt-scroll-down' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							'duration' => ('' != $settings['duration']['size']) ? $settings['duration']['size'] : '',
							'offset' => ('' != $settings['offset']['size']) ? $settings['offset']['size'] : '',
						]))
					]
				]
			]
		);

		$this->add_render_attribute('bdt-scroll-down', 'data-selector', '#' . esc_attr($settings['section_id']));

		$this->add_render_attribute('bdt-scroll-wrapper', 'class', 'bdt-scroll-down-wrapper');

		?>
			<div <?php echo $this->get_render_attribute_string('bdt-scroll-wrapper'); ?>>
				<button <?php echo $this->get_render_attribute_string('bdt-scroll-down'); ?>>
					<?php $this->render_scroll_button_text($settings); ?>
				</button>
			</div>

		<?php
	}

	public function render_navigation_arrows() {
		$settings = $this->get_settings_for_display();

		?>

			<?php if ($settings['show_navigation_arrows']) : ?>

				<div <?php echo $this->get_render_attribute_string('navi_arrow_animate'); ?>>
					<a class="bdt-position-bottom-right bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
					<a class="bdt-position-bottom-right bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
				</div>

			<?php endif; ?>

		<?php
	}

	public function render_navigation_dots() {
		$settings = $this->get_settings_for_display();

		?>

			<?php if ($settings['show_navigation_dots']) : ?>
			<div <?php echo $this->get_render_attribute_string('navi_dots_animate'); ?>>
				<ul class="bdt-slideshow-nav bdt-dotnav bdt-margin-large bdt-position-bottom-left bdt-text-center"></ul>
			</div>
			<?php endif; ?>

		<?php
	}

	public function render_footer() {

		?>

						</ul>

						<?php $this->render_navigation_arrows(); ?>
						<?php $this->render_navigation_dots(); ?>
					</div>

					<?php $this->render_social_link(); ?>
					<?php $this->render_scroll_button(); ?>
				</div>
			</div>

			<?php $this->render_offcanvas(); ?>
		<?php
	}

	public function rendar_item_image($image, $alt = '') {
		$image_src = wp_get_attachment_image_src($image['image']['id'], 'full');

		if ($image_src) :
			echo '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_html($alt) . '" bdt-cover>';
		endif;

		return 0;
	}

	public function rendar_item_video($link) {
		$video_src = $link['video_link'];

		?>
			<video autoplay loop muted playsinline bdt-cover>
				<source src="<?php echo  $video_src; ?>" type="video/mp4">
			</video>
		<?php

	}

	public function rendar_item_youtube($link) {
		$match = [];
		$id = (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link['youtube_link'], $match)) ? $match[1] : false;
		$url = '//www.youtube.com/embed/' . $id . '?autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;playsinline=1&playlist=' . $id;

		?>
			<iframe src="<?php echo  esc_url($url); ?>" allowfullscreen bdt-cover></iframe>
		<?php

	}

	public function render_button($content) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('slider-button', 'class', 'bdt-slide-btn', true);

		if ($content['button_link']['url']) {
			$this->add_render_attribute('slider-button', 'href', $content['button_link']['url'], true);

			if ($content['button_link']['is_external']) {
				$this->add_render_attribute('slider-button', 'target', '_blank', true);
			}

			if ($content['button_link']['nofollow']) {
				$this->add_render_attribute('slider-button', 'rel', 'nofollow', true);
			}
		} else {
			$this->add_render_attribute('slider-button', 'href', '#', true);
		}

		?>

		<?php if ($content['slide_button_text'] && ('yes' == $settings['show_button_text'])) : ?>

			<a <?php echo $this->get_render_attribute_string('slider-button'); ?>>

				<?php

					$this->add_render_attribute([
						'content-wrapper' => [
							'class' => 'bdt-prime-slider-button-wrapper',
						],
						'text' => [
							'class' => 'bdt-prime-slider-button-text bdt-flex bdt-flex-middle bdt-flex-inline',
						],
					], '', '', true);

				?>
				<span <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>

					<span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?><span class="bdt-slide-btn-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-right"><polyline fill="none" stroke="#000" points="10 5 15 9.5 10 14"></polyline><line fill="none" stroke="#000" x1="4" y1="9.5" x2="15" y2="9.5"></line></svg></span></span>

				</span>

			</a>
		<?php endif;
	}

	public function render_item_content($slide_content) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('slide_content_animate', 'class', 'bdt-prime-slider-content');

		$this->add_render_attribute(
			[
				'title-link' => [
					'class' => [
						'bdt-slider-title-link',
					],
					'href'   => $slide_content['title_link']['url'] ? esc_url($slide_content['title_link']['url']) : 'javascript:void(0);',
					'target' => $slide_content['title_link']['is_external'] ? '_blank' : '_self'
				]
			], '', '', true
		);

		?>
		<div class="bdt-position-z-index bdt-position-large">
			<div class="bdt-prime-slider-wrapper">
				<div <?php echo $this->get_render_attribute_string('slide_content_animate'); ?>>
					<div class="bdt-prime-slider-desc">

						<?php if ($slide_content['sub_title'] && ('yes' == $settings['show_sub_title'])) : ?>
							<div class="bdt-sub-title">
								<h4 bdt-slideshow-parallax="x: 50,0,-10; opacity: 1,1,0">
									<?php echo wp_kses_post($slide_content['sub_title']); ?>
								</h4>
							</div>
						<?php endif; ?>

						<?php if ($slide_content['title'] && ('yes' == $settings['show_title'])) : ?>
							<div class="bdt-main-title" bdt-slideshow-parallax="x: 100,0,-20; opacity: 1,1,0">
								<<?php echo esc_html($settings['title_html_tag']); ?> class="bdt-title-tag" >
									<?php if ('' !== $slide_content['title_link']['url']) : ?>
										<a <?php echo $this->get_render_attribute_string( 'title-link' ); ?>>
									<?php endif; ?>
										<?php echo wp_kses_post($slide_content['title']); ?>
								<?php if ('' !== $slide_content['title_link']['url']) : ?>
									</a>
								<?php endif; ?>
								</<?php echo esc_html($settings['title_html_tag']); ?>>
							</div>
						<?php endif; ?>

						<div bdt-slideshow-parallax="x: 150,0,-30; opacity: 1,1,0">
							<div class="bdt-btn-wrapper">
								<?php $this->render_button($slide_content); ?>
							</div>
						</div>
					</div>

					<?php if ($slide_content['excerpt'] && ('yes' == $settings['show_excerpt'])) : ?>
						<div class="bdt-slider-excerpt" bdt-slideshow-parallax="y: 50,0,-10; opacity: 1,1,0">
							<?php echo wp_kses_post($slide_content['excerpt']); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<?php
	}

	public function render_slides_loop() {
		$settings = $this->get_settings_for_display();

		$kenburns_reverse = $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '';

		foreach ($settings['slides'] as $slide) : ?>

		<li class="bdt-slideshow-item bdt-flex bdt-flex-middle bdt-flex-center elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>">
			<?php if ('yes' == $settings['kenburns_animation']) : ?>
				<div class="bdt-position-cover bdt-animation-kenburns<?php echo esc_attr($kenburns_reverse); ?> bdt-transform-origin-center-left">
				<?php endif; ?>

				<?php if (($slide['background'] == 'image') && $slide['image']) : ?>
					<?php $this->rendar_item_image($slide, $slide['title']); ?>
				<?php elseif (($slide['background'] == 'video') && $slide['video_link']) : ?>
					<?php $this->rendar_item_video($slide); ?>
				<?php elseif (($slide['background'] == 'youtube') && $slide['youtube_link']) : ?>
					<?php $this->rendar_item_youtube($slide); ?>
				<?php endif; ?>

				<?php if ('yes' == $settings['kenburns_animation']) : ?>
				</div>
			<?php endif; ?>

			<?php if ('none' !== $settings['overlay']) :
							$blend_type = ('blend' == $settings['overlay']) ? ' bdt-blend-' . $settings['blend_type'] : ''; ?>
				<div class="bdt-overlay-default bdt-position-cover<?php echo esc_attr($blend_type); ?>"></div>
			<?php endif; ?>

			<?php

			$this->render_item_content($slide);

			?>
		</li>

		<?php endforeach;
	}

	public function render() {

		$this->render_header();
		$this->render_slides_loop();
		$this->render_footer();

	}
}
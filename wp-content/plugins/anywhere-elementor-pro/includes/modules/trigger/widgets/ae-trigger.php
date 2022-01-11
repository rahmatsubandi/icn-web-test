<?php

namespace Aepro\Modules\Trigger\Widgets;

use Aepro\Aepro;
use Aepro\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Aepro\Modules\Trigger\Skins;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AeTrigger extends Widget_Base {

	protected $_access_level = 1;

	public function get_name() {

		return 'ae-trigger';
	}

	public function get_title() {

		return __( 'AE - Trigger', 'ae-pro' );
	}

	public function get_icon() {
		return 'ae-pro-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'ae-template-elements' ];
	}

	public function get_keywords()
    {
        return [
            'trigger',
			'carousel',
			'slider',
			'accordion',
			'tabs'
        ];
    }

	protected function _register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
	}

	//phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'General', 'ae-pro' ),
			]
		);

		$this->add_control(
			'trigger_target',
			[
				'label' => __( 'Target', 'ae-pro' ),
				'type' 	=> Controls_Manager::TEXT,
				'placeholder' => 'Widget Id',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'ae-trigger-widget-doc',
			[
				'type' => Controls_Manager::RAW_HTML,
				'classes' => 'ae-widget-id',
				'raw' => __( Aepro::$_helper->get_widget_admin_note_html( 'Know more about Trigger', 'https://wpvibes.link/go/widget-ae-trigger' ), 'ae-pro' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_triggers',
			[
				'label' => esc_html__( 'Triggers', 'ae-pro' ),
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'trigger_type',
			[
				'label' => __( 'Type', 'ae-pro' ),
				'type' 	=> Controls_Manager::SELECT,
				'options' => [
					'carousel' 	=> __( 'Carousel / Slider', 'ae-pro' ),
					'accordion'	=> __( 'Accordion', 'ae-pro' ),
				],
				'default' => 'carousel',
				'frontend_available' => true,
			]
		);

		$repeater->add_control(
			'trigger_action_carousel',
			[
				'label' => __( 'Action', 'ae-pro' ),
				'type'  => Controls_Manager::SELECT,
				'options'	=> [
					'next_slide' => __( 'Next Slide', 'ae-pro' ),
					'prev_slide' => __( 'Prev Slide', 'ae-pro' ),
					'first_slide' => __( 'First Slide', 'ae-pro' ),
					'last_slide' => __( 'Last Slide', 'ae-pro' ),
					'play_slide' => __( 'Play', 'ae-pro' ),
					'pause_slide' => __( 'Pause', 'ae-pro' ),
					'play_pause' => __( 'Play / Pause', 'ae-pro' ),
				],
				'default' => 'next_slide',
				'frontend_available' => true,
				'condition' => [
					'trigger_type' => 'carousel',
				],
			]
		);

		$repeater->add_control(
			'trigger_action_accordion',
			[
				'label' => __( 'Action', 'ae-pro' ),
				'type'  => Controls_Manager::SELECT,
				'options'	=> [
					'expand' => __( 'Expand', 'ae-pro' ),
					'collapse' => __( 'Collapse', 'ae-pro' ),
					'next' => __( 'Next', 'ae-pro' ),
					'prev' => __( 'Prev', 'ae-pro' ),
					'expand_collapse' => __( 'Expand / Collapse', 'ae-pro' ),
				],
				'default' => 'expand',
				'frontend_available' => true,
				'condition' => [
					'trigger_type' => 'accordion',
				],
			]
		);

		$repeater->add_control(
			'target_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'ae-pro' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'ae-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				//'exclude_inline_options' => [ 'svg' ],
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
				'frontend_available' => true,
			]
		);

		$repeater->add_control(
			'secondary_text',
			[
				'label' => esc_html__( 'Secondary Text', 'ae-pro' ),
				'type' => Controls_Manager::TEXT,
				/* 'condition' => [
					'trigger_action_carousel' => 'play_pause',
					'trigger_type' => 'carousel',
				], */
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[ 
							'terms' => [
									[
										'name' => 'trigger_action_carousel',
										'operator' => '==',
										'value' => 'play_pause',
									],
									[
										'name' => 'trigger_type',
										'operator' => '==',
										'value' => 'carousel'
									],
								],
						],
						[
							'terms' => [
									[
										'name' => 'trigger_action_accordion',
										'operator' => '==',
										'value' => 'expand_collapse',
									],
									[
										'name' => 'trigger_type',
										'operator' => '==',
										'value' => 'accordion'
									],
								],
						],
					]	
				]
			]
		);

		$repeater->add_control(
			'selected_icon_secondary',
			[
				'label' => esc_html__( 'Secondary Icon', 'ae-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				//'frontend_available' => true,
				/* 'condition' => [
					'trigger_action_carousel' => 'play_pause',
					'trigger_type' => 'carousel',
				] */
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[ 
							'terms' => [
									[
										'name' => 'trigger_action_carousel',
										'operator' => '==',
										'value' => 'play_pause',
									],
									[
										'name' => 'trigger_type',
										'operator' => '==',
										'value' => 'carousel'
									],
								],
						],
						[
							'terms' => [
									[
										'name' => 'trigger_action_accordion',
										'operator' => '==',
										'value' => 'expand_collapse',
									],
									[
										'name' => 'trigger_type',
										'operator' => '==',
										'value' => 'accordion'
									],
								],
						],
					]	
				]
			]
		);

		$repeater->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'ae-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'ae-pro' ),
					'right' => esc_html__( 'After', 'ae-pro' ),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
				'condition' => [
					'text!' => ''
				]
			]
		);

		$repeater->add_responsive_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'ae-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ae-trigger-inner .ae-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .ae-trigger-inner .ae-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'text!' => ''
				]
			]
		);

		$repeater->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'ae-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ae-trigger-inner .ae-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'triggers',
			[
				'label'       => __( 'Triggers', 'ae-pro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
				'default'    => [
					[
						'text'       				=> __( '', 'ae-pro' ),
						'trigger_action_carousel' 	=> 'prev_slide',
						'selected_icon'				=> [
							'value' => 'fas fa-angle-left',
							'library' => 'fa-solid',
						],
					],
					[
						'text'       				=> __( '', 'ae-pro' ),
						'trigger_action_carousel' 	=> 'play_pause',
						'selected_icon'				=> [
							'value' => 'fas fa-play',
							'library' => 'fa-solid',
						],
						'selected_icon_secondary'	=> [
							'value' => 'fas fa-pause',
							'library' => 'fa-solid',
						],
					],
					[
						'text'       				=> __( '', 'ae-pro' ),
						'trigger_action_carousel' 	=> 'next_slide',
						'selected_icon'				=> [
							'value' => 'fas fa-angle-right',
							'library' => 'fa-solid',
						],
					],

				],
			]
		);

		$this->add_responsive_control(
			'trigger_layout',
			[
				'label'          => __( 'Layout', 'ae-pro' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'inline',
				'options'        => [
					'traditional' => [
						'title' => __( 'Default', 'ae-pro' ),
						'icon'  => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => __( 'Inline', 'ae-pro' ),
						'icon'  => 'eicon-ellipsis-h',
					],
				],
				'label_block'    => false,
				'style_transfer' => true,
				'prefix_class'   => 'ae-trigger-layout-',
			]
		);

		$this->add_responsive_control(
			'trigger_align',
			[
				'label' => esc_html__( 'Alignment', 'ae-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start'    => [
						'title' => esc_html__( 'Left', 'ae-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ae-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'ae-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}.ae-trigger-layout-inline .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}};',
					'{{WRAPPER}}.ae-trigger-layout-inline .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}};',
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();
    }

	protected $_has_template_content = false;

/* 	protected function render() {
		$this->render_trigger();
	} */

	/* public function render_trigger(){
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

		$this->add_render_attribute( 'button', 'class', 'elementor-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );
		?>
		<div class="ae-trigger-container">
			<?php
			foreach( $settings['triggers'] as $trigger ) {

			if ( ! empty( $trigger['size'] ) ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $trigger['size'] );
			}

			if ( $settings['trigger_hover_animation'] ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['trigger_hover_animation'] );
			}

			$this->set_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper elementor-repeater-item-' . $trigger['_id']);


			$trigger_data = [
				'trigger_type' => $trigger['trigger_type'],
				'trigger_action' => $trigger['trigger_action_' . $trigger['trigger_type']],
				'selected_icon' => $trigger['selected_icon'],
			];
			if( $trigger_data['trigger_action'] == 'play_pause'){
				$trigger_data['selected_icon_secondary'] = $trigger['selected_icon_secondary'];
			}

			$this->set_render_attribute( 'button', 'title', ucwords( str_replace("_", " ", $trigger_data['trigger_action'] ) ) );

			$this->set_render_attribute( 'wrapper', 'data-trigger_settings', wp_json_encode( $trigger_data ) );
			?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<a href='#' <?php echo $this->get_render_attribute_string( 'button' ); ?>>
					<?php $this->render_text($trigger); ?>
				</a>
			</div>
		<?php
		}
		?>
		</div>
		<?php
	}

    protected function render_text($settings) {

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		] );

		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings[ 'text' ]; ?></span>
		</span>
		<?php
	} */

	/* protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );
			if ( settings.triggers.length ) {
		#>
		<# _.each( settings.triggers, function( item ) { #>
			<# var iconHTML = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
		<div class="elementor-button-wrapper elementor-repeater-item-{{ item._id }}">
			<a class="elementor-button elementor-size-{{ item.size }} elementor-animation-{{ settings.hover_animation }}" href="#" role="button">
				<span class="elementor-button-content-wrapper">
					<span class="elementor-button-icon elementor-align-icon-{{ item.icon_align }}">
							{{{ iconHTML.value }}}
					</span>
					<span>{{{ item.text }}}</span>
				</span>
			</a>
		</div>
		<# }); #>
		<# } #>
		<?php
	} */

}

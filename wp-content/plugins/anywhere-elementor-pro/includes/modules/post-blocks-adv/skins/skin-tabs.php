<?php
namespace Aepro\Modules\PostBlocksAdv\Skins;

use Aepro\Aepro;
use Aepro\Frontend;
use Aepro\Modules\PostBlocksAdv\Classes\Query;
use Elementor\Core\Files\CSS\Post as Post_CSS;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Aepro\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Skin_Tabs extends Skin_Base {
    //phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function _register_controls_actions() {
		parent::_register_controls_actions(); // TODO: Change the autogenerated stub
		add_action( 'elementor/element/ae-post-blocks-adv/section_layout/before_section_end', [ $this, 'tabs_controls' ] );
		add_action( 'elementor/element/ae-post-blocks-adv/section_query/after_section_end', [ $this, 'register_style_controls' ] );
	}

	public function get_id() {
		return 'tabs';
	}

	public function get_title() {
		return __( 'Tabs', 'ae-pro' );
	}

	public function render() {
		// TODO: Implement render() method.

		$this->if_layout_is_blank();

		$settings = $this->parent->get_settings_for_display();
		// get posts
		$query = new Query( $settings );
		$posts = $query->get_posts();

		// Checked for No Post Message.
		if ( ! $posts->have_posts() ) {
			echo $this->ae_no_post_message( $settings );
			return;
		}

		$layout = $settings['layout'];

		$this->parent->add_render_attribute( 'outer-wrapper', 'class', 'ae-outer-wrapper' );

		$this->parent->add_render_attribute( 'outer-wrapper', 'class', 'ae-height-100' );
		// Collection Attributes

		$this->parent->add_render_attribute( 'collection', 'class', 'ae-post-collection' );

		// Post Item Attributes
		$this->parent->add_render_attribute( 'item', 'class', 'ae-post-item' );

		// Item Inner Attribute
		$this->parent->add_render_attribute( 'item-inner', 'class', 'ae-post-item-inner' );

		//WooCommerce Sales Badge
		if ( isset( $settings['sale_badge_switcher'] ) && $settings['sale_badge_switcher'] === 'yes' ) {
			$this->parent->add_render_attribute( 'outer-wrapper', 'class', 'sale-badge-' . $settings['sale_badge_switcher'] );
			$this->parent->add_render_attribute( 'item-inner', 'class', 'badge-type-' . $settings['sale_badge_type'] );
		}

		$this->parent->add_render_attribute(
			'collection',
			[
				'class' => 'ae-post-blocks-adv-tabs',
				'role'  => 'tablist',
			]
		);

		$tabs_content_space = $this->get_instance_value( 'tabs_content_space' );
		if ( $tabs_content_space['size'] != 0 ) {
			$this->parent->add_render_attribute(
				'collection',
				[
					'class' => 'space-between-tab-content',
				]
			);
		};

		if ( $this->get_instance_value( 'advance_style' ) === 'yes' ) {
			$this->parent->add_render_attribute(
				'collection',
				[
					'class' => 'advance-style',
				]
			);
		}

		$this->parent->add_render_attribute(
			'ae-post-blocks-adv-tabs-wrapper',
			[
				'class' => 'ae-post-blocks-adv-tabs-wrapper',
				'role'  => 'tab',
			]
		);

		$this->parent->add_render_attribute(
			'ae-post-blocks-adv-tabs-content-wrapper',
			[
				'class' => 'ae-post-blocks-adv-tabs-content-wrapper',
				'role'  => 'tabpanel',
			]
		);
		?>

		<div <?php echo $this->parent->get_render_attribute_string( 'outer-wrapper' ); ?> >
		<?php

			$seq = 0;

			$css_file = Post_CSS::create( $layout );

			$css_file->enqueue();
		?>

			<div <?php echo $this->parent->get_render_attribute_string( 'collection' ); ?> >
			<?php
			Frontend::$_in_repeater_block = true;
			?>

				<?php
				$counter = 1;
				?>
				<div <?php echo $this->parent->get_render_attribute_string( 'ae-post-blocks-adv-tabs-wrapper' ); ?>>
				<?php
				while ( $posts->have_posts() ) {
					$posts->the_post();
					Frontend::$_ae_post_block = get_the_ID();
					$this->parent->set_render_attribute(
						'ae-post-blocks-adv-tab-desktop-title',
						[
							'class'        => 'ae-post-blocks-adv-tab-title ae-post-blocks-adv-tab-desktop-title',
							'data-tab'     => $counter,
							'data-hashtag' => 'tab_' . $counter,
						]
					);

					if ( $settings['tab_title'] === 'post_title' ) {
						$tab_title = get_the_title();
					} else {
						$tab_title = get_field( $settings['tab_title_custom_field'], get_the_ID() );
					}

					?>
					<<?php echo $settings['title_html_tag']; ?> <?php echo $this->parent->get_render_attribute_string( 'ae-post-blocks-adv-tab-desktop-title' ); ?>>
					<?php echo $tab_title; ?>
					</<?php echo $settings['title_html_tag']; ?>>
					<?php
							$counter++;
				}
					wp_reset_postdata();
					Frontend::$_in_repeater_block = false;
				?>
			</div>
			<?php
			$counter = 1;
			?>
			<div <?php echo $this->parent->get_render_attribute_string( 'ae-post-blocks-adv-tabs-content-wrapper' ); ?>>
					<?php
					while ( $posts->have_posts() ) {
						$posts->the_post();
						$this->parent->set_render_attribute(
							'ae-post-blocks-adv-tab-mobile-title',
							[
								'class'        => 'ae-post-blocks-adv-tab-title ae-post-blocks-adv-tab-mobile-title',
								'data-tab'     => $counter,
								'data-hashtag' => 'tab_' . $counter,
							]
						);
						$this->parent->set_render_attribute(
							'ae-post-blocks-adv-tab-content',
							[
								'class'        => 'ae-post-blocks-adv-tab-content elementor-clearfix',
								'data-tab'     => $counter,
								'data-hashtag' => 'tab_' . $counter,
							]
						);
						if ( $settings['tab_title'] === 'post_title' ) {
							$tab_title = get_the_title();
						} else {
							$tab_title = get_field( $settings['tab_title_custom_field'], get_the_ID() );
						}
						?>
						<div <?php echo $this->parent->get_render_attribute_string( 'ae-post-blocks-adv-tab-mobile-title' ); ?>>
						<?php echo $tab_title; ?>
						</div>
						<div <?php echo $this->parent->get_render_attribute_string( 'ae-post-blocks-adv-tab-content' ); ?>>
						<?php

							$layout = $this->get_layout( $seq, $settings );

							$this->render_item( $layout );

						?>
						</div>
						<?php
						$counter++;
					}
					wp_reset_postdata();
					?>
				</div>
			<?php
			Frontend::$_in_repeater_block = false;
			?>
		</div>
		<?php
	}

	public function tabs_controls( Widget_Base $widget_Base ) {

		$this->parent = $widget_Base;

		$this->add_control(
			'tab_layout',
			[
				'label'        => __( 'Tab Layout', 'ae-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'horizontal' => [
						'title' => __( 'Horizontal', 'ae-pro' ),
						'icon'  => 'fa fa-arrows-alt-h',
					],
					'vertical' => [
						'title' => __( 'Vertical', 'ae-pro' ),
						'icon'  => 'fa fa-arrows-alt-v',
					],
				],
				'seperator'    => 'before',
				'prefix_class' => 'ae-post-blocks-adv-tabs-view-',
				'default'      => 'horizontal',

			]
		);

		$this->add_responsive_control(
			'tab_align',
			[
				'label'     => __( 'Tab Align', 'ae-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'ae-pro' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ae-pro' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ae-pro' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}}.ae-post-blocks-adv-tabs-view-horizontal .ae-post-blocks-adv-tabs-wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id( 'tab_layout' ) => 'horizontal',
				],
			]
		);
	}

	public function register_style_controls() {

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => __( 'General', 'ae-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'     => __( 'Border Width', 'ae-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title, 
                    {{WRAPPER}} .ae-post-blocks-adv-tab-title:before, 
                    {{WRAPPER}} .ae-post-blocks-adv-tab-title:after, 
                    {{WRAPPER}} .ae-post-blocks-adv-tab-content, 
                    {{WRAPPER}} .ae-post-blocks-adv-tabs-content-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .advance-style .ae-post-blocks-adv-tab-title:before, {{WRAPPER}} .advance-style .ae-post-blocks-adv-tab-title:after' => 'bottom: -{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tabs_content_space',
			[
				'label'       => __( 'Space Between Tab/Cotent', 'ae-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}}.ae-post-blocks-adv-tabs-view-horizontal .ae-post-blocks-adv-tabs-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.ae-post-blocks-adv-tabs-view-vertical .ae-post-blocks-adv-tabs-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'advance_style',
			[
				'label'        => __( 'Advance', 'ae-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'default'      => '',
				'label_on'     => __( 'Yes', 'ae-pro' ),
				'label_off'    => __( 'No', 'ae-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_navigation_style',
			[
				'label'     => __( 'Tab Navigation', 'ae-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id( 'advance_style' ) => 'yes',
				],
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label'     => __( 'Navigation Width', 'ae-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => '%',
				],
				'range'     => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs-wrapper' => 'flex-basis: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					$this->get_control_id( 'tab_layout' ) => 'vertical',
				],
			]
		);

		$this->add_control(
			'tab_nav_background_color',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'navigation_border',
				'label'          => __( 'Tabs Border', 'ae-pro' ),
				'default'        => '1px',
				'fields_options' => [
					'width' => [
						'responsive' => false,
					],
				],
				'selector'       => '{{WRAPPER}} .ae-post-blocks-adv-tabs-wrapper',
			]
		);

		$this->add_control(
			'space_around_tabs',
			[
				'label'      => __( 'Space Between Tab/Content', 'ae-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_item_style',
			[
				'label'     => __( 'Tab', 'ae-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id( 'advance_style' ) => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label'      => __( 'Padding', 'ae-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tab_style' );

		$this->start_controls_tab(
			'normal_tab_style',
			[
				'label' => __( 'Normal', 'ae-pro' ),
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label'     => __( 'Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_control(
			'tab_background_color',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .ae-post-blocks-adv-tab-title',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'tab_border',
				'label'          => __( 'Border', 'ae-pro' ),
				'default'        => '1px',
				'selector'       => '{{WRAPPER}} .ae-post-blocks-adv-tabs .ae-post-blocks-adv-tab-title',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'default' => [
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'tab_border_radius',
			[
				'label'     => __( 'Border Radius', 'ae-pro' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs .ae-post-blocks-adv-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'active_tab_style',
			[
				'label' => __( 'Active / Hover', 'ae-pro' ),
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label'     => __( 'Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title.active, {{WRAPPER}} .ae-post-blocks-adv-tab-title:hover' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'tab_background_color_active',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-title.active, {{WRAPPER}} .ae-post-blocks-adv-tab-title:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'tab_border_active',
				'label'    => __( 'Border', 'ae-pro' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .ae-post-blocks-adv-tabs .ae-post-blocks-adv-tab-title.active, {{WRAPPER}} .ae-post-blocks-adv-tabs-wrapper .ae-post-blocks-adv-tab-title:hover',
			]
		);

		$this->add_responsive_control(
			'tab_border_radius_active',
			[
				'label'     => __( 'Border Radius', 'ae-pro' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs .ae-post-blocks-adv-tab-title.active, ae-post-blocks-adv-tabs-wrapper .ae-post-blocks-adv-tab-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'tab_title_shadow',
				'label'    => __( 'Shadow', 'ae-pro' ),
				'selector' => '{{WRAPPER}} .ae-post-blocks-adv-tab-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'     => __( 'Content', 'ae-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					$this->get_control_id( 'advance_style' ) => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'content_border',
				'label'          => __( 'Border', 'ae-pro' ),
				'selector'       => '{{WRAPPER}} .ae-post-blocks-adv-tabs-content-wrapper .ae-post-blocks-adv-tab-content',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'default' => [
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						],
					],
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-mobile-title, {{WRAPPER}} .ae-post-blocks-adv-tab-desktop-title.active,
                    {{WRAPPER}} .ae-post-blocks-adv-tab-title:before, {{WRAPPER}} .ae-post-blocks-adv-tab-title:after,
                    {{WRAPPER}} .ae-post-blocks-adv-tab-content, {{WRAPPER}} .ae-post-blocks-adv-tabs-content-wrapper' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'ae-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ae-post-blocks-adv-tabs-desktop-title.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ae-post-blocks-adv-tabs-content-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label'      => __( 'Padding', 'ae-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ae-post-blocks-adv-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

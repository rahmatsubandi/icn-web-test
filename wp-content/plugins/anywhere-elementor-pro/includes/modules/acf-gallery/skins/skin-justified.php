<?php
namespace Aepro\Modules\AcfGallery\Skins;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Skin_Justified extends Skin_Base {

	public function get_id() {
		return 'justified';
	}

	public function get_title() {
		return __( 'Justified', 'ae-pro' );
	}
     protected function _register_controls_actions() {
	 	parent::_register_controls_actions();

	 	//add_action( 'elementor/element/ae-acf-gallery/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
	 }

	public function register_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		parent::field_control();
        $this->remove_control('enable_image_ratio');
        parent::justified_control();
	}

    public function register_layout_controls(){
        $this->remove_control('enable_image_ratio');
    }

    public function register_style_controls() {
		parent::grid_style_control();
	}

    public function register_overlay_controls() {
		parent::grid_overlay_controls();
	}
	public function register_overlay_style_controls() {
		parent::grid_overlay_style_control();
	}

    public function render() {
		// TODO: Implement render() method.
        parent::justified_html();
        //$settings = $this->parent->get_settings_for_display();	
        //echo "<pre>"; print_r($settings); echo "</pre>";
		//parent::grid_html();
	}
}    
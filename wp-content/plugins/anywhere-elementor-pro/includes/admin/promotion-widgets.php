<?php

namespace Aepro\Admin;

class Promotion_Widgets
{

    private static $_instance = null;

    public $_promotion_widgets = [];
    public $_plan1_widget_flag = false;
    public $_plan2_widget_flag = false;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        add_action('plugins_loaded', [ $this, 'load_promotion_widgets' ] );
        add_filter('elementor/editor/localize_settings', [$this, 'get_promotion_widgets']);
    }

    public function load_promotion_widgets()
    {
        $this->_plan1_widget_flag = apply_filters( 'aepro/plan1_widgets/flag', true );
        if($this->_plan1_widget_flag){
            
            $this->_promotion_widgets = $this->load_plan1_widgets();
        }

        $this->_plan2_widget_flag = apply_filters( 'aepro/plan2_widgets/flag', true );
        if($this->_plan2_widget_flag){
            $this->_promotion_widgets = $this->load_plan2_widgets();
        }
    }

    public function load_plan1_widgets()
    {
        $plan1_widgets = array(
            array(
                'name'       => 'ae-author',
                'title'      => __('AE - Author', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('author','user','profile','biography','avatar'),
                'icon'       => 'ae-pro-icon eicon-person',
            ),
            array(
                'name'       => 'ae-breadcrumb',
                'title'      => __('AE - Breadcrumb', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('yoast', 'rankmath', 'seo', 'breadcrumbs', 'internal links'),
                'icon'       => 'ae-pro-icon eicon fa fa-angle-double-right',
            ),
            array(
                'name'       => 'ae-custom-field',
                'title'      => __('AE - Custom Field', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('acf', 'fields', 'custom fields', 'meta'),
                'icon'       => 'ae-pro-icon eicon-gallery-grid',
            ),
            array(
                'name'       => 'ae-post-blocks',
                'title'      => __('AE - Post Blocks', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('posts','cpt','item','blocks','loop','query','grid','carousel', 'custom post type'),
                'icon'       => 'ae-pro-icon eicon-post-list',
            ),
            array(
                'name'       => 'ae-portfolio',
                'title'      => __('AE - Portfolio', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('posts','cpt','item','blocks','loop','query', 'portfolio', 'custom post type'),
                'icon'       => 'ae-pro-icon eicon-gallery-grid',
            ),
            array(
                'name'       => 'ae-post-blocks-adv',
                'title'      => __('AE - Post Blocks Adv', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('posts','cpt','item','blocks','loop','query','grid','carousel', 'portfolio','custom post type'),
                'icon'       => 'ae-pro-icon eicon-post-list',
            ),
            array(
                'name'       => 'ae-post-comments',
                'title'      => __('AE - Post Comments', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('comments','response','form'),
                'icon'       => 'ae-pro-icon eicon-testimonial',
            ),
            array(
                'name'       => 'ae-post-content',
                'title'      => __('AE - Post Content', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('content','excerpt','post'),
                'icon'       => 'ae-pro-icon eicon-text-align-left',
            ),
            array(
                'name'       => 'ae-post-image',
                'title'      => __('AE - Post Image', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'image','thumbnail','featured'),
                'icon'       => 'ae-pro-icon eicon-image-box',
            ),
            array(
                'name'       => 'ae-post-meta',
                'title'      => __('AE - Post Meta', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'info', 'date', 'time', 'author', 'taxonomy', 'comments', 'terms', 'avatar', 'post'),
                'icon'       => 'ae-pro-icon eicon-post',
            ),
            array(
                'name'       => 'ae-post-navigation',
                'title'      => __('AE - Post Navigation', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'navigation', 'menu', 'links', 'post'),
                'icon'       => 'ae-pro-icon eicon-navigation-horizontal',
            ),
            array(
                'name'       => 'ae-post-readmore',
                'title'      => __('AE - Post Read More', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'read', 'more', 'excerpt', 'post'),
                'icon'       => 'ae-pro-icon eicon-button',
            ),
            array(
                'name'       => 'ae-post-title',
                'title'      => __('AE - Title', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'title', 'heading', 'post', 'archive'),
                'icon'       => 'ae-pro-icon eicon-post-title',
            ),
            array(
                'name'       => 'ae-searchform',
                'title'      => __('AE - Search Form', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'search', 'form'),
                'icon'       => 'ae-pro-icon eicon-search',
            ),
            array(
                'name'       => 'ae-taxonomy',
                'title'      => __('AE - Search Form', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'taxonomy', 'category', 'term'),
                'icon'       => 'ae-pro-icon eicon-text-align-left',
            ),
            array(
                'name'       => 'ae-taxonomy-blocks',
                'title'      => __('AE - Taxonomy Blocks', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array( 'taxonomy','term', 'category','blocks','loop', 'query', 'grid', 'carousel', 'custom taxonomy'),
                'icon'       => 'ae-pro-icon eicon-post-list',
            ),
            array(
                'name'       => 'ae-tax-custom-field',
                'title'      => __('AE - Taxonomy Custom Field', 'ae-pro'),
                'categories' => '["ae-template-elements"]',
                'keywords'   => array('acf', 'fields', 'custom fields', 'meta', 'taxonomy'),
                'icon'       => 'ae-pro-icon eicon-gallery-grid',
            ),   
        );
        return array_merge($this->_promotion_widgets, $plan1_widgets);
    }

    public function load_plan2_widgets()
    {
        $ae_acf_widgets = array();
        $ae_pods_widgets = array();
        $ae_woo_widgets = array();

        if(AE_ACF || AE_ACF_PRO){
            $ae_acf_widgets = array(
                array(
                    'name'       => 'ae-acf',
                    'title'      => __('AE - ACF Fields', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('acf','fields','custom fields','meta','group','repeater','flexible content'),
                    'icon'       => 'ae-pro-icon eicon-gallery-grid',
                ),
                array(
                    'name'       => 'ae-acf-flexible-content',
                    'title'      => __('AE - ACF Flexible Content', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('acf','fields','custom fields','meta','carousel','grid','list','flexible content'),
                    'icon'       => 'ae-pro-icon eicon-post-list',
                ),
                array(
                    'name'       => 'ae-acf-gallery',
                    'title'      => __('AE - ACF Gallery', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('acf','fields','custom fields','meta','gallery','image'),
                    'icon'       => 'ae-pro-icon eicon-gallery-grid',
                ),
                array(
                    'name'       => 'ae-acf-repeater',
                    'title'      => __('AE - ACF Repeater', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('acf','fields','custom fields','meta','repeater','carousel','grid','accordion'),
                    'icon'       => 'ae-pro-icon eicon-post-list',
                ),
                array(
                    'name'       => 'ae-cf-google-map',
                    'title'      => __('AE - Custom Field Map', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('google','map','embed','location','marker'),
                    'icon'       => 'ae-pro-icon eicon-google-maps',
                ), 
            );
        }
        
        if(AE_PODS){
            $ae_pods_widgets = array(
                array(
                    'name'       => 'ae-pods',
                    'title'      => __('AE - Pods', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('pods','fields','custom fields','meta'),
                    'icon'       => 'ae-pro-icon eicon-gallery-grid',
                ),
            );
        }

        if(AE_WOO){
            $ae_woo_widgets = array(
                array(
                    'name'       => 'ae-woo-add-to-cart',
                    'title'      => __('AE - Woo Add To Cart', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce','shop', 'store', 'cart', 'product', 'button', 'add to cart'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-category',
                    'title'      => __('AE - Woo Category', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce','shop','store','category','product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-description',
                    'title'      => __('AE - Woo Description', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop', 'store', 'content', 'text', 'description', 'short description', 'product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-notices',
                    'title'      => __('AE - Woo Notices', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store','notices','messages'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-price',
                    'title'      => __('AE - Woo Price', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop', 'store', 'price', 'product', 'sale'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-galley',
                    'title'      => __('AE - Woo Galley', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'gallery', 'image', 'product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-products',
                    'title'      => __('AE - Woo Products', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'upsell', 'cross-sell', 'related', 'product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-rating',
                    'title'      => __('AE - Woo Rating', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'rating', 'review', 'comments', 'stars', 'product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-readmore',
                    'title'      => __('AE - Woo Read More', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'product' , 'button', 'add to cart', 'read more'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-sku',
                    'title'      => __('AE - Woo SKU', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'stock', 'unit', 'stock unit', 'sku'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-stock-status',
                    'title'      => __('AE - Woo Stock Status', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'stock', 'unit', 'quantity','product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-tabs',
                    'title'      => __('AE - Woo Tabs', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'description', 'data', 'attributes','product', 'tabs'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-tags',
                    'title'      => __('AE - Woo Tags', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store', 'meta','info','product', 'tags'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
                array(
                    'name'       => 'ae-woo-title',
                    'title'      => __('AE - Woo Title', 'ae-pro'),
                    'categories' => '["ae-template-elements"]',
                    'keywords'   => array('woocommerce', 'shop','store','title', 'heading','product'),
                    'icon'       => 'ae-pro-icon eicon-woocommerce',
                ),
            );
        }

        

        $plan2_widgets = array_merge( $ae_acf_widgets, $ae_pods_widgets, $ae_woo_widgets );

        return array_merge( $this->_promotion_widgets, $plan2_widgets );
    }

    public function get_promotion_widgets($config)
    {
        $promotion_widgets = [];

        if (isset($config['promotionWidgets'])) {
            $promotion_widgets = $config['promotionWidgets'];
        }

        $pro_widgets = $this->_promotion_widgets;

        $combine_array = array_merge($promotion_widgets, $pro_widgets);

        $config['promotionWidgets'] = $combine_array;

        return $config;
    }
}

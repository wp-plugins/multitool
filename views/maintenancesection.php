<?php
/**
 * Maintenance Section main view.   
 *
 * @package Multitool
 * @subpackage Views
 * @author Ryan Bayne   
 * @since 0.0.1
 */

// Prohibit direct script loading
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class MULTITOOL_MaintenanceSection_View extends MULTITOOL_View {

    protected $screen_columns = 2;
    
    protected $view_name = 'maintenancesection';
    
    public $purpose = 'normal';// normal, dashboard

    /**
    * Array of meta boxes, looped through to register them on views and as dashboard widgets
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function meta_box_array() {
        // array of meta boxes + used to register dashboard widgets (id, title, callback, context, priority, callback arguments (array), dashboard widget (boolean) )   
        return $this->meta_boxes_array = array(
            // array( id, title, callback (usually parent, approach created by Ryan Bayne), context (position), priority, call back arguments array, add to dashboard (boolean), required capability
            //array( $this->view_name . '-importbranding', __( 'Import Branding', 'multitool' ), array( $this, 'parent' ), 'normal','default',array( 'formid' => 'importbranding' ), true, 'activate_plugins' ),
        );    
    }
            
    /**
     * Set up the view with data and do things that are specific for this view
     *
     * @since 0.0.1
     *
     * @param string $action Action for this view
     * @param array $data Data for this view
     */
    public function setup( $action, array $data ) {
        global $multitool_settings;
            
        // create constant for view name
        if(!defined( "MULTITOOL_VIEWNAME") ){define( "MULTITOOL_VIEWNAME", $this->view_name );}
        
        // create class objects
        $this->MULTITOOL = MULTITOOL::load_class( 'MULTITOOL', 'class-multitool.php', 'classes' );
        $this->UI = MULTITOOL::load_class( 'MULTITOOL_UI', 'class-ui.php', 'classes' ); 
        $this->DB = MULTITOOL::load_class( 'MULTITOOL_DB', 'class-wpdb.php', 'classes' );
        $this->PHP = MULTITOOL::load_class( 'MULTITOOL_PHP', 'class-phplibrary.php', 'classes' );
        $this->Forms = MULTITOOL::load_class( 'MULTITOOL_Formbuilder', 'class-forms.php', 'classes' );
        
        parent::setup( $action, $data );
        
        // view header box - introduction, status, progress or vital information box
        // this function places content below the tab menu and above post-boxes
        $this->add_text_box( 'buildmenu-texttest', array( $this, 'postbox_buildmenu_viewintroduction' ), 'normal', true );
                
        // using array register many meta boxes
        foreach( self::meta_box_array() as $key => $metabox ) {
            // the $metabox array includes required capability to view the meta box
            if( isset( $metabox[7] ) && current_user_can( $metabox[7] ) ) {
                $this->add_meta_box( $metabox[0], $metabox[1], $metabox[2], $metabox[3], $metabox[4], $metabox[5] );   
            }               
        }        
              
    }

    /**
    * Outputs the meta boxes
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.3
    * @version 1.0
    */
    public function metaboxes() {
        parent::register_metaboxes( self::meta_box_array() );     
    }

    /**
    * This function is called when on WP core dashboard and it adds widgets to the dashboard using
    * the meta box functions in this class. 
    * 
    * @uses dashboard_widgets() in parent class MULTITOOL_View which loops through meta boxes and registeres widgets
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.2
    * @version 1.0
    */
    public function dashboard() { 
        parent::dashboard_widgets( self::meta_box_array() );  
    }
     
    /**
    * All add_meta_box() callback to this function to keep the add_meta_box() call simple.
    * 
    * This function also offers a place to apply more security or arguments.
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    function parent( $data, $box ) {
        eval( 'self::postbox_' . $this->view_name . '_' . $box['args']['formid'] . '( $data, $box );' );
    }

    /**
    * This function places content below the tab menu and above post-boxes.
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */    
    public function postbox_buildmenu_viewintroduction( $data, $box ) {
        $info_area_content = '
        <ol>
            <li>Tasks system.</li>
            <li>Trash limit with auto delete.</li>
            <li>Remind subscribers to complete their profiles.</li>
        </ol>';
        $this->UI->intro_box( 'About Maintenance Section', 'Introduction to the Maintenance Section to help you understand what tools should be added to this section (by the community) and what sort of tools you can request for this section.', true, __( 'Maintenance Tools Ideas', 'multitool' ), $info_area_content, __( 'Please submit new tool ideas/requests in the WebTechGlobal forum.', 'multitool' ) );
    }
         
    /**
    * post box function for testing
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function postbox_postssection_importbranding( $data, $box ) {    
        $this->UI->postbox_content_header( $box['title'], $box['args']['formid'], __( 'Import both project and in the verse branding to the media gallery i.e. corporation logos.', 'multitool' ), false );        
        $this->Forms->form_start( $box['args']['formid'], $box['args']['formid'], $box['title'] );   
        $this->UI->postbox_content_footer( __( 'Import Now', 'multitool' ) );
    } 
}?>
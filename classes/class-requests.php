<?php
/** 
* Class for handling $_POST and $_GET requests
* 
* The class is called in the process_admin_POST_GET() method found in the MULTITOOL class. 
* The process_admin_POST_GET() method is hooked at admin_init. It means requests are handled in the admin
* head, globals can be updated and pages will show the most recent data. Nonce security is performed
* within process_admin_POST_GET() then the require method for processing the request is used.
* 
* Methods in this class MUST be named within the form or link itself, basically a unique identifier for the form.
* i.e. the Section Switches settings have a form name of "sectionswitches" and so the method in this class used to
* save submission of the "sectionswitches" form is named "sectionswitches".
* 
* process_admin_POST_GET() uses eval() to call class + method 
* 
* @package Multitool
* @author Ryan Bayne   
* @since 0.0.1
* @version 1.2
*/

// load in WordPress only
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class MULTITOOL_Requests {  
    public function __construct() {
        global $multitool_settings;
    
        // create class objects
        $this->MULTITOOL = MULTITOOL::load_class( 'MULTITOOL', 'class-multitool.php', 'classes' ); # plugin specific functions
        $this->UI = $this->MULTITOOL->load_class( 'MULTITOOL_UI', 'class-ui.php', 'classes' ); # interface, mainly notices
        $this->DB = $this->MULTITOOL->load_class( 'MULTITOOL_DB', 'class-wpdb.php', 'classes' ); # database interaction
        $this->PHP = $this->MULTITOOL->load_class( 'MULTITOOL_PHP', 'class-phplibrary.php', 'classes' ); # php library by Ryan R. Bayne
        $this->Files = $this->MULTITOOL->load_class( 'MULTITOOL_Files', 'class-files.php', 'classes' );
        $this->Forms = $this->MULTITOOL->load_class( 'MULTITOOL_Formbuilder', 'class-forms.php', 'classes' );
        $this->WPCore = $this->MULTITOOL->load_class( 'MULTITOOL_WPCore', 'class-wpcore.php', 'classes' );
        $this->TabMenu = $this->MULTITOOL->load_class( "MULTITOOL_TabMenu", "class-pluginmenu.php", 'classes','pluginmenu' );    
    }
    
    /**
    * Applies WebTechGlobals own security for $_POST and $_GET requests. It involves
    * a range of validation, including ensuring HTML source edit was not performed before
    * users submission.
    * 
    * This function is called by process_admin_POST_GET() which is hooked by admin_init.
    * None security is done in that function before this class-request.php file is loaded.
    * 
    * @parameter $method is post or get or ajax
    * @parameter $function the method for completing the request, to be found in this class
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.1
    */
    public function process_admin_request( $method, $function ) { 
        
        // arriving here means check_admin_referer() security is positive       
        global $multitool_debug_mode, $cont;

        $this->PHP->var_dump( $_POST, '<h1>$_POST</h1>' );           
        $this->PHP->var_dump( $_GET, '<h1>$_GET</h1>' );    
                              
        // $_POST security
        if( $method == 'post' || $method == 'POST' || $method == '$_POST' ) {                      
            // check_admin_referer() wp_die()'s if security fails so if we arrive here WordPress security has been passed
            // now we validate individual values against their pre-registered validation method
            // some generic notices are displayed - this system makes development faster
            $post_result = true;
            $post_result = $this->Forms->apply_form_security();// ensures $_POST['multitool_form_formid'] is set, so we can use it after this line
            
            // apply my own level of security per individual input
            if( $post_result ){ $post_result = $this->Forms->apply_input_security(); }// detect hacking of individual inputs i.e. disabled inputs being enabled 
            
            // validate users values
            if( $post_result ){ $post_result = $this->Forms->apply_input_validation( $_POST['multitool_form_formid'] ); }// values (string,numeric,mixed) validation

            // cleanup to reduce registered data
            $this->Forms->deregister_form( $_POST['multitool_form_formid'] );
                    
            // if $overall_result includes a single failure then there is no need to call the final function
            if( $post_result === false ) {        
                return false;
            }
        }
        
        // handle a situation where the submitted form requests a function that does not exist
        if( !method_exists( $this, $function ) ){
            wp_die( sprintf( __( "The method for processing your request was not found. This can usually be resolved quickly. Please report method %s does not exist. <a href='https://www.youtube.com/watch?v=vAImGQJdO_k' target='_blank'>Watch a video</a> explaining this problem.", 'multitool' ), 
            $function) ); 
            return false;// should not be required with wp_die() but it helps to add clarity when browsing code and is a precaution.   
        }
        
        // all security passed - call the processing function
        if( isset( $function) && is_string( $function ) ) {
            eval( 'self::' . $function .'();' );
        }
    }  

    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */    
    public function request_success( $form_title, $more_info = '' ){  
        $this->UI->create_notice( "Your submission for $form_title was successful. " . $more_info, 'success', 'Small', "$form_title Updated");          
    } 

    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */    
    public function request_failed( $form_title, $reason = '' ){
        $this->UI->n_depreciated( $form_title . ' Unchanged', "Your settings for $form_title were not changed. " . $reason, 'error', 'Small' );    
    }

    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */    
    public function logsettings() {
        global $multitool_settings;
        $multitool_settings['globalsettings']['uselog'] = $_POST['multitool_radiogroup_logstatus'];
        $multitool_settings['globalsettings']['loglimit'] = $_POST['multitool_loglimit'];
                                                   
        ##################################################
        #           LOG SEARCH CRITERIA                  #
        ##################################################
        
        // first unset all criteria
        if( isset( $multitool_settings['logsettings']['logscreen'] ) ){
            unset( $multitool_settings['logsettings']['logscreen'] );
        }
                                                           
        // if a column is set in the array, it indicates that it is to be displayed, we unset those not to be set, we dont set them to false
        if( isset( $_POST['multitool_logfields'] ) ){
            foreach( $_POST['multitool_logfields'] as $column){
                $multitool_settings['logsettings']['logscreen']['displayedcolumns'][$column] = true;                   
            }
        }
                                                                                 
        // outcome criteria
        if( isset( $_POST['multitool_log_outcome'] ) ){    
            foreach( $_POST['multitool_log_outcome'] as $outcomecriteria){
                $multitool_settings['logsettings']['logscreen']['outcomecriteria'][$outcomecriteria] = true;                   
            }            
        } 
        
        // type criteria
        if( isset( $_POST['multitool_log_type'] ) ){
            foreach( $_POST['multitool_log_type'] as $typecriteria){
                $multitool_settings['logsettings']['logscreen']['typecriteria'][$typecriteria] = true;                   
            }            
        }         

        // category criteria
        if( isset( $_POST['multitool_log_category'] ) ){
            foreach( $_POST['multitool_log_category'] as $categorycriteria){
                $multitool_settings['logsettings']['logscreen']['categorycriteria'][$categorycriteria] = true;                   
            }            
        }         

        // priority criteria
        if( isset( $_POST['multitool_log_priority'] ) ){
            foreach( $_POST['multitool_log_priority'] as $prioritycriteria){
                $multitool_settings['logsettings']['logscreen']['prioritycriteria'][$prioritycriteria] = true;                   
            }            
        }         

        ############################################################
        #         SAVE CUSTOM SEARCH CRITERIA SINGLE VALUES        #
        ############################################################
        // page
        if( isset( $_POST['multitool_pluginpages_logsearch'] ) && $_POST['multitool_pluginpages_logsearch'] != 'notselected' ){
            $multitool_settings['logsettings']['logscreen']['page'] = $_POST['multitool_pluginpages_logsearch'];
        }   
        // action
        if( isset( $_POST['csv2pos_logactions_logsearch'] ) && $_POST['csv2pos_logactions_logsearch'] != 'notselected' ){
            $multitool_settings['logsettings']['logscreen']['action'] = $_POST['csv2pos_logactions_logsearch'];
        }   
        // screen
        if( isset( $_POST['multitool_pluginscreens_logsearch'] ) && $_POST['multitool_pluginscreens_logsearch'] != 'notselected' ){
            $multitool_settings['logsettings']['logscreen']['screen'] = $_POST['multitool_pluginscreens_logsearch'];
        }  
        // line
        if( isset( $_POST['multitool_logcriteria_phpline'] ) ){
            $multitool_settings['logsettings']['logscreen']['line'] = $_POST['multitool_logcriteria_phpline'];
        }  
        // file
        if( isset( $_POST['multitool_logcriteria_phpfile'] ) ){
            $multitool_settings['logsettings']['logscreen']['file'] = $_POST['multitool_logcriteria_phpfile'];
        }          
        // function
        if( isset( $_POST['multitool_logcriteria_phpfunction'] ) ){
            $multitool_settings['logsettings']['logscreen']['function'] = $_POST['multitool_logcriteria_phpfunction'];
        }
        // panel name
        if( isset( $_POST['multitool_logcriteria_panelname'] ) ){
            $multitool_settings['logsettings']['logscreen']['panelname'] = $_POST['multitool_logcriteria_panelname'];
        }
        // IP address
        if( isset( $_POST['multitool_logcriteria_ipaddress'] ) ){
            $multitool_settings['logsettings']['logscreen']['ipaddress'] = $_POST['multitool_logcriteria_ipaddress'];
        }
        // user id
        if( isset( $_POST['multitool_logcriteria_userid'] ) ){
            $multitool_settings['logsettings']['logscreen']['userid'] = $_POST['multitool_logcriteria_userid'];
        }
        
        $this->MULTITOOL->update_settings( $multitool_settings );
        $this->UI->n_postresult_depreciated( 'success', __( 'Log Settings Saved', 'multitool' ), __( 'It may take sometime for new log entries to be created depending on your websites activity.', 'multitool' ) );  
    }  
    
    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */       
    public function beginpluginupdate() {
        $this->Updates = $this->MULTITOOL->load_class( 'MULTITOOL_Formbuilder', 'class-forms.php', 'classes' );
        
        // check if an update method exists, else the plugin needs to do very little
        eval( '$method_exists = method_exists ( $this->Updates , "patch_' . $_POST['multitool_plugin_update_now'] .'" );' );

        if( $method_exists){
            // perform update by calling the request version update procedure
            eval( '$update_result_array = $this->Updates->patch_' . $_POST['multitool_plugin_update_now'] .'( "update");' );       
        }else{
            // default result to true
            $update_result_array['failed'] = false;
        } 
      
        if( $update_result_array['failed'] == true){           
            $this->UI->create_notice( __( 'The update procedure failed, the reason should be displayed below. Please try again unless the notice below indicates not to. If a second attempt fails, please seek support.', 'multitool' ), 'error', 'Small', __( 'Update Failed', 'multitool' ) );    
            $this->UI->create_notice( $update_result_array['failedreason'], 'info', 'Small', 'Update Failed Reason' );
        }else{  
            // storing the current file version will prevent user coming back to the update screen
            global $multitool_currentversion;        
            update_option( 'multitool_installedversion', $multitool_currentversion);

            $this->UI->create_notice( __( 'Good news, the update procedure was complete. If you do not see any errors or any notices indicating a problem was detected it means the procedure worked. Please ensure any new changes suit your needs.', 'multitool' ), 'success', 'Small', __( 'Update Complete', 'multitool' ) );
            
            // do a redirect so that the plugins menu is reloaded
            wp_redirect( get_bloginfo( 'url' ) . '/wp-admin/admin.php?page=multitool' );
            exit;                
        }
    }
    
    /**
    * Save drip feed limits  
    */
    public function schedulerestrictions() {
        $multitool_schedule_array = $this->MULTITOOL->get_option_schedule_array();
        
        // if any required values are not in $_POST set them to zero
        if(!isset( $_POST['day'] ) ){
            $multitool_schedule_array['limits']['day'] = 0;        
        }else{
            $multitool_schedule_array['limits']['day'] = $_POST['day'];            
        }
        
        if(!isset( $_POST['hour'] ) ){
            $multitool_schedule_array['limits']['hour'] = 0;
        }else{
            $multitool_schedule_array['limits']['hour'] = $_POST['hour'];            
        }
        
        if(!isset( $_POST['session'] ) ){
            $multitool_schedule_array['limits']['session'] = 0;
        }else{
            $multitool_schedule_array['limits']['session'] = $_POST['session'];            
        }
                                 
        // ensure $multitool_schedule_array is an array, it may be boolean false if schedule has never been set
        if( isset( $multitool_schedule_array ) && is_array( $multitool_schedule_array ) ){
            
            // if times array exists, unset the [times] array
            if( isset( $multitool_schedule_array['days'] ) ){
                unset( $multitool_schedule_array['days'] );    
            }
            
            // if hours array exists, unset the [hours] array
            if( isset( $multitool_schedule_array['hours'] ) ){
                unset( $multitool_schedule_array['hours'] );    
            }
            
        }else{
            // $schedule_array value is not array, this is first time it is being set
            $multitool_schedule_array = array();
        }
        
        // loop through all days and set each one to true or false
        if( isset( $_POST['multitool_scheduleday_list'] ) ){
            foreach( $_POST['multitool_scheduleday_list'] as $key => $submitted_day ){
                $multitool_schedule_array['days'][$submitted_day] = true;        
            }  
        } 
        
        // loop through all hours and add each one to the array, any not in array will not be permitted                              
        if( isset( $_POST['multitool_schedulehour_list'] ) ){
            foreach( $_POST['multitool_schedulehour_list'] as $key => $submitted_hour){
                $multitool_schedule_array['hours'][$submitted_hour] = true;        
            }           
        }    

        if( isset( $_POST['deleteuserswaiting'] ) )
        {
            $multitool_schedule_array['eventtypes']['deleteuserswaiting']['switch'] = 'enabled';                
        }
        
        if( isset( $_POST['eventsendemails'] ) )
        {
            $multitool_schedule_array['eventtypes']['sendemails']['switch'] = 'enabled';    
        }        
  
        $this->MULTITOOL->update_option_schedule_array( $multitool_schedule_array );
        $this->UI->notice_depreciated( __( 'Schedule settings have been saved.', 'multitool' ), 'success', 'Large', __( 'Schedule Times Saved', 'multitool' ) );   
    } 
    
    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */       
    public function logsearchoptions() {
        $this->UI->n_postresult_depreciated( 'success', __( 'Log Search Settings Saved', 'multitool' ), __( 'Your selections have an instant effect. Please browse the Log screen for the results of your new search.', 'multitool' ) );                   
    }
 
    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */        
    public function defaultcontenttemplate () {        
        $this->UI->create_notice( __( 'Your default content template has been saved. This is a basic template, other advanced options may be available by activating the Multitool Templates custom post type (pro edition only) for managing multiple template designs.' ), 'success', 'Small', __( 'Default Content Template Updated' ) );         
    }
        
    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */       
    public function reinstalldatabasetables() {
        $installation = new MULTITOOL_Install();
        $installation->reinstalldatabasetables();
        $this->UI->create_notice( 'All tables were re-installed. Please double check the database status list to
        ensure this is correct before using the plugin.', 'success', 'Small', 'Tables Re-Installed' );
    }
     
    /**
    * form processing function
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */          
    public function globalswitches() {
        global $multitool_settings;
        $multitool_settings['noticesettings']['wpcorestyle'] = $_POST['uinoticestyle'];                      
        $multitool_settings['posttypes']['wtgflags']['status'] = $_POST['flagsystemstatus'];
        $multitool_settings['widgetsettings']['dashboardwidgetsswitch'] = $_POST['dashboardwidgetsswitch'];
        $this->MULTITOOL->update_settings( $multitool_settings ); 
        $this->UI->create_notice( __( 'Global switches have been updated. These switches can initiate the use of 
        advanced systems. Please monitor your blog and ensure the plugin operates as you expected it to. If
        anything does not appear to work in the way you require please let WebTechGlobal know.' ),
        'success', 'Small', __( 'Global Switches Updated' ) );       
    } 
       
    /**
    * save capability settings for plugins pages
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function pagecapabilitysettings() {
        
        // get the capabilities array from WP core
        $capabilities_array = $this->WPCore->capabilities();

        // get stored capability settings 
        $saved_capability_array = get_option( 'multitool_capabilities' );
        
        // get the tab menu 
        $pluginmenu = $this->TabMenu->menu_array();
                
        // to ensure no extra values are stored (more menus added to source) loop through page array
        foreach( $pluginmenu as $key => $page_array ) {
            
            // ensure $_POST value is also in the capabilities array to ensure user has not hacked form, adding their own capabilities
            if( isset( $_POST['pagecap' . $page_array['name'] ] ) && in_array( $_POST['pagecap' . $page_array['name'] ], $capabilities_array ) ) {
                $saved_capability_array['pagecaps'][ $page_array['name'] ] = $_POST['pagecap' . $page_array['name'] ];
            }
                
        }
          
        update_option( 'multitool_capabilities', $saved_capability_array );
         
        $this->UI->create_notice( __( 'Capabilities for this plugins pages have been stored. Due to this being security related I recommend testing before you logout. Ensure that each role only has access to the plugin pages you intend.' ), 'success', 'Small', __( 'Page Capabilities Updated' ) );        
    }
    
    /**
    * Saves the plugins global dashboard widget settings i.e. which to display, what to display, which roles to allow access
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function dashboardwidgetsettings() {
        global $multitool_settings;
        
        // loop through pages
        $MULTITOOL_TabMenu = MULTITOOL::load_class( 'MULTITOOL_TabMenu', 'class-pluginmenu.php', 'classes' );
        $menu_array = $MULTITOOL_TabMenu->menu_array();       
        foreach( $menu_array as $key => $section_array ) {

            if( isset( $_POST[ $section_array['name'] . 'dashboardwidgetsswitch' ] ) ) {
                $multitool_settings['widgetsettings'][ $section_array['name'] . 'dashboardwidgetsswitch'] = $_POST[ $section_array['name'] . 'dashboardwidgetsswitch' ];    
            }
            
            if( isset( $_POST[ $section_array['name'] . 'widgetscapability' ] ) ) {
                $multitool_settings['widgetsettings'][ $section_array['name'] . 'widgetscapability'] = $_POST[ $section_array['name'] . 'widgetscapability' ];    
            }

        }

        $this->MULTITOOL->update_settings( $multitool_settings );    
        $this->UI->create_notice( __( 'Your dashboard widget settings have been saved. Please check your dashboard to ensure it is configured as required per role.', 'multitool' ), 'success', 'Small', __( 'Settings Saved', 'multitool' ) );         
    }
    
    /**
    * Import Star Citizen images related to branding to the WordPress media gallery.
    * 
    * @author Ryan R. Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function importbranding() {
        $media_created = 0;
        $media_failed = 0;
        $corporations = true;
        $project = true;
        $backgrounds = true;
        $orgs = true;
        
        require_once( MULTITOOL_ABSPATH . 'arrays/brandingmedia_array.php' );
        
        if( $corporations ) {
            foreach( $brandingmedia_array['corporations'] as $url ) {                                       
                $the_result = $this->MULTITOOL->create_localmedia_fromhttp( $url );    
                if( is_numeric( $the_result ) ) {
                    ++$media_created;    
                } else {
                    ++$media_failed;
                }
            }
        }
    
        if( $project ) {
            foreach( $brandingmedia_array['project'] as $url ) {                                       
                $the_result = $this->MULTITOOL->create_localmedia_fromhttp( $url );    
                if( is_numeric( $the_result ) ) {
                    ++$media_created;    
                } else {
                    ++$media_failed;
                }
            }
            }
        
        if( $backgrounds ) {
            foreach( $brandingmedia_array['backgrounds'] as $url ) {                                       
                $the_result = $this->MULTITOOL->create_localmedia_fromhttp( $url );    
                if( is_numeric( $the_result ) ) {
                    ++$media_created;    
                } else {
                    ++$media_failed;
                }
            }
        }
        
        if( $orgs ) {
            foreach( $brandingmedia_array['orgs'] as $url ) {                                       
                $the_result = $this->MULTITOOL->create_localmedia_fromhttp( $url );    
                if( is_numeric( $the_result ) ) {
                    ++$media_created;    
                } else {
                    ++$media_failed;
                }
            }
        }
 
        $this->UI->create_notice( __( "A total of $media_created images were imported to the WP media gallery and $media_failed failed to import.", 'multitool' ), 'success', 'Small', __( 'Media Import Request Complete', 'multitool' ) );         
    }
  
}// MULTITOOL_Requests       
?>

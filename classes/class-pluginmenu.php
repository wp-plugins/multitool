<?php
/**
* Beta testing only (check if in use yet) - phasing array files into classes of their own then calling into the main class
* 
* @package Multitool
* @author Ryan Bayne   
* @since 0.0.1
* @version 1.2 
*/
class MULTITOOL_TabMenu {
    public function menu_array() {
        $menu_array = array();
        
        ######################################################
        #                                                    #
        #                        MAIN                        #
        #                                                    #
        ######################################################
        // can only have one view in main right now until WP allows pages to be hidden from showing in
        // plugin menus. This may provide benefit of bringing user to the latest news and social activity
        // main page
        $menu_array['main']['groupname'] = 'main';        
        $menu_array['main']['slug'] = 'multitool';// home page slug set in main file
        $menu_array['main']['menu'] = __( 'Plugins Dashboard', 'multitool' );// plugin admin menu
        $menu_array['main']['pluginmenu'] = __( 'Plugins Dashboard' ,'multitool' );// for tabbed menu
        $menu_array['main']['name'] = "main";// name of page (slug) and unique
        $menu_array['main']['title'] = 'Multitool Dashboard';// title at the top of the admin page
        $menu_array['main']['parent'] = 'parent';// either "parent" or the name of the parent - used for building tab menu         
        $menu_array['main']['tabmenu'] = false;// boolean - true indicates multiple pages in section, false will hide tab menu and show one page 

        ######################################################
        #                                                    #
        #                   POSTS SECTION                    #
        #                                                    #
        ###################################################### 
  
        // posts section 
        $menu_array['postssection']['groupname'] = 'poststools';
        $menu_array['postssection']['slug'] = 'multitool_postssection'; 
        $menu_array['postssection']['menu'] = __( 'Posts', 'multitool' );
        $menu_array['postssection']['pluginmenu'] = __( 'Posts', 'multitool' );
        $menu_array['postssection']['name'] = "postssection";
        $menu_array['postssection']['title'] = __( 'Posts', 'multitool' ); 
        $menu_array['postssection']['parent'] = 'parent'; 
        $menu_array['postssection']['tabmenu'] = true;     
                
        ######################################################
        #                                                    #
        #                   MEDIA SECTION                    #
        #                                                    #
        ###################################################### 
  
        // media section 
        $menu_array['mediasection']['groupname'] = 'mediatools';
        $menu_array['mediasection']['slug'] = 'multitool_mediasection'; 
        $menu_array['mediasection']['menu'] = __( 'Media', 'multitool' );
        $menu_array['mediasection']['pluginmenu'] = __( 'Media', 'multitool' );
        $menu_array['mediasection']['name'] = "mediasection";
        $menu_array['mediasection']['title'] = __( 'Media', 'multitool' ); 
        $menu_array['mediasection']['parent'] = 'parent'; 
        $menu_array['mediasection']['tabmenu'] = true;
       
        // graphs
        /*
        $menu_array['graphs']['groupname'] = 'samples';
        $menu_array['graphs']['slug'] = 'multitool_graphs'; 
        $menu_array['graphs']['menu'] = __( 'Graphs', 'multitool' );
        $menu_array['graphs']['pluginmenu'] = __( 'Graphs', 'multitool' );
        $menu_array['graphs']['name'] = "graphs";
        $menu_array['graphs']['title'] = __( 'Graphs', 'multitool' ); 
        $menu_array['graphs']['parent'] = 'importstuff'; 
        $menu_array['graphs']['tabmenu'] = true;
          
        // WP Table 2
        $menu_array['tablelist']['groupname'] = 'samples';
        $menu_array['tablelist']['slug'] = 'multitool_tablelist'; 
        $menu_array['tablelist']['menu'] = __( 'WP Table 2', 'multitool' );
        $menu_array['tablelist']['pluginmenu'] = __( 'WP Table 2', 'multitool' );
        $menu_array['tablelist']['name'] = "table";
        $menu_array['tablelist']['title'] = __( 'WP Table 2', 'multitool' ); 
        $menu_array['tablelist']['parent'] = 'commonforms'; 
        $menu_array['tablelist']['tabmenu'] = true;
          */
                
        ######################################################
        #                                                    #
        #                   PAGES SECTION                    #
        #                                                    #
        ###################################################### 
  
        // pages section 
        $menu_array['pagessection']['groupname'] = 'pagestools';
        $menu_array['pagessection']['slug'] = 'multitool_pagessection'; 
        $menu_array['pagessection']['menu'] = __( 'Pages', 'multitool' );
        $menu_array['pagessection']['pluginmenu'] = __( 'Pages', 'multitool' );
        $menu_array['pagessection']['name'] = "pagessection";
        $menu_array['pagessection']['title'] = __( 'Pages', 'multitool' ); 
        $menu_array['pagessection']['parent'] = 'parent'; 
        $menu_array['pagessection']['tabmenu'] = true;  
                      
        ######################################################
        #                                                    #
        #                  COMMENTS SECTION                  #
        #                                                    #
        ###################################################### 
  
        // comments section 
        $menu_array['commentssection']['groupname'] = 'commentstools';
        $menu_array['commentssection']['slug'] = 'multitool_commentssection'; 
        $menu_array['commentssection']['menu'] = __( 'Comments', 'multitool' );
        $menu_array['commentssection']['pluginmenu'] = __( 'Comments', 'multitool' );
        $menu_array['commentssection']['name'] = "commentssection";
        $menu_array['commentssection']['title'] = __( 'Comments', 'multitool' ); 
        $menu_array['commentssection']['parent'] = 'parent'; 
        $menu_array['commentssection']['tabmenu'] = true;  
        
        ######################################################
        #                                                    #
        #                 APPEARANCE SECTION                 #
        #                                                    #
        ###################################################### 
  
        // appearance section 
        $menu_array['appearancesection']['groupname'] = 'appearancetools';
        $menu_array['appearancesection']['slug'] = 'multitool_appearancesection'; 
        $menu_array['appearancesection']['menu'] = __( 'Appearance', 'multitool' );
        $menu_array['appearancesection']['pluginmenu'] = __( 'Appearance', 'multitool' );
        $menu_array['appearancesection']['name'] = "appearancesection";
        $menu_array['appearancesection']['title'] = __( 'Appearance', 'multitool' ); 
        $menu_array['appearancesection']['parent'] = 'parent'; 
        $menu_array['appearancesection']['tabmenu'] = true;     
          
        ######################################################
        #                                                    #
        #                   PLUGINS SECTION                  #
        #                                                    #
        ###################################################### 
  
        // plugins section 
        $menu_array['pluginssection']['groupname'] = 'pluginstools';
        $menu_array['pluginssection']['slug'] = 'multitool_pluginssection'; 
        $menu_array['pluginssection']['menu'] = __( 'Plugins', 'multitool' );
        $menu_array['pluginssection']['pluginmenu'] = __( 'Plugins', 'multitool' );
        $menu_array['pluginssection']['name'] = "pluginssection";
        $menu_array['pluginssection']['title'] = __( 'Plugins', 'multitool' ); 
        $menu_array['pluginssection']['parent'] = 'parent'; 
        $menu_array['pluginssection']['tabmenu'] = true;               
                   
        ######################################################
        #                                                    #
        #                   USERS SECTION                    #
        #                                                    #
        ###################################################### 
  
        // users section 
        $menu_array['userssection']['groupname'] = 'userstools';
        $menu_array['userssection']['slug'] = 'multitool_userssection'; 
        $menu_array['userssection']['menu'] = __( 'Users', 'multitool' );
        $menu_array['userssection']['pluginmenu'] = __( 'Users', 'multitool' );
        $menu_array['userssection']['name'] = "userssection";
        $menu_array['userssection']['title'] = __( 'Users', 'multitool' ); 
        $menu_array['userssection']['parent'] = 'parent'; 
        $menu_array['userssection']['tabmenu'] = true;     
                 
        ######################################################
        #                                                    #
        #                MONITORING SECTION                  #
        #                                                    #
        ###################################################### 
  
        // monitoring section 
        $menu_array['monitoringsection']['groupname'] = 'monitoringtools';
        $menu_array['monitoringsection']['slug'] = 'multitool_monitoringsection'; 
        $menu_array['monitoringsection']['menu'] = __( 'Monitoring', 'multitool' );
        $menu_array['monitoringsection']['pluginmenu'] = __( 'Monitoring', 'multitool' );
        $menu_array['monitoringsection']['name'] = "monitoringsection";
        $menu_array['monitoringsection']['title'] = __( 'Monitoring', 'multitool' ); 
        $menu_array['monitoringsection']['parent'] = 'parent'; 
        $menu_array['monitoringsection']['tabmenu'] = true;     
             
        ######################################################
        #                                                    #
        #                 SECURITY SECTION                   #
        #                                                    #
        ###################################################### 
  
        // security section 
        $menu_array['securitysection']['groupname'] = 'securitytools';
        $menu_array['securitysection']['slug'] = 'multitool_securitysection'; 
        $menu_array['securitysection']['menu'] = __( 'Security', 'multitool' );
        $menu_array['securitysection']['pluginmenu'] = __( 'Security', 'multitool' );
        $menu_array['securitysection']['name'] = "securitysection";
        $menu_array['securitysection']['title'] = __( 'Security', 'multitool' ); 
        $menu_array['securitysection']['parent'] = 'parent'; 
        $menu_array['securitysection']['tabmenu'] = true;

        ######################################################
        #                                                    #
        #               MAINTENANCE SECTION                  #
        #                                                    #
        ###################################################### 
  
        // maintenance section 
        $menu_array['maintenancesection']['groupname'] = 'maintenancetools';
        $menu_array['maintenancesection']['slug'] = 'multitool_maintenancesection'; 
        $menu_array['maintenancesection']['menu'] = __( 'Maintenance', 'multitool' );
        $menu_array['maintenancesection']['pluginmenu'] = __( 'Maintenance', 'multitool' );
        $menu_array['maintenancesection']['name'] = "maintenancesection";
        $menu_array['maintenancesection']['title'] = __( 'Maintenance', 'multitool' ); 
        $menu_array['maintenancesection']['parent'] = 'parent'; 
        $menu_array['maintenancesection']['tabmenu'] = true;
        
        ######################################################
        #                                                    #
        #                  SOCIAL SECTION                    #
        #                                                    #
        ###################################################### 
  
        // social section 
        $menu_array['socialsection']['groupname'] = 'socialtools';
        $menu_array['socialsection']['slug'] = 'multitool_socialsection'; 
        $menu_array['socialsection']['menu'] = __( 'Social', 'multitool' );
        $menu_array['socialsection']['pluginmenu'] = __( 'Social', 'multitool' );
        $menu_array['socialsection']['name'] = "socialsection";
        $menu_array['socialsection']['title'] = __( 'Social', 'multitool' ); 
        $menu_array['socialsection']['parent'] = 'parent'; 
        $menu_array['socialsection']['tabmenu'] = true;
                                                                            
        
        ######################################################
        #                                                    #
        #                  SCHEDULE SECTION                  #
        #                                                    #
        ###################################################### 
  
        // schedule (cron) section 
        $menu_array['schedulingsection']['groupname'] = 'schedulingtools';
        $menu_array['schedulingsection']['slug'] = 'multitool_schedulingsection'; 
        $menu_array['schedulingsection']['menu'] = __( 'Scheduling', 'multitool' );
        $menu_array['schedulingsection']['pluginmenu'] = __( 'Scheduling', 'multitool' );
        $menu_array['schedulingsection']['name'] = "schedulingsection";
        $menu_array['schedulingsection']['title'] = __( 'Scheduling', 'multitool' ); 
        $menu_array['schedulingsection']['parent'] = 'parent'; 
        $menu_array['schedulingsection']['tabmenu'] = true;
                                                                            
        return $menu_array;
    }
} 
?>

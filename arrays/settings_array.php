<?php
/** 
 * Default administration settings for Multitool plugin. These settings are installed to the 
 * wp_options table and are used from there by default. 
 * 
 * @package Multitool
 * @author Ryan Bayne   
 * @since 0.0.1
 * @version 1.0.7
 */

// load in WordPress only
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// install main admin settings option record
$multitool_settings = array();
// encoding
$multitool_settings['standardsettings']['encoding']['type'] = 'utf8';
// admin user interface settings start
$multitool_settings['standardsettings']['ui_advancedinfo'] = false;// hide advanced user interface information by default
// other
$multitool_settings['standardsettings']['ecq'] = array();
$multitool_settings['standardsettings']['chmod'] = '0750';
$multitool_settings['standardsettings']['systematicpostupdating'] = 'enabled';
// testing and development
$multitool_settings['standardsettings']['developementinsight'] = 'disabled';
// global switches
$multitool_settings['standardsettings']['textspinrespinning'] = 'enabled';// disabled stops all text spin re-spinning and sticks to the last spin

##########################################################################################
#                                                                                        #
#                           SETTINGS WITH NO UI OPTION                                   #
#              array key should be the method/function the setting is used in            #
##########################################################################################
$multitool_settings['create_localmedia_fromlocalimages']['destinationdirectory'] = 'wp-content/uploads/importedmedia/';
 
##########################################################################################
#                                                                                        #
#                            DATA IMPORT AND MANAGEMENT SETTINGS                         #
#                                                                                        #
##########################################################################################
$multitool_settings['datasettings']['insertlimit'] = 100;

##########################################################################################
#                                                                                        #
#                                    WIDGET SETTINGS                                     #
#                                                                                        #
##########################################################################################
$multitool_settings['widgetsettings']['dashboardwidgetsswitch'] = 'disabled';

##########################################################################################
#                                                                                        #
#                               CUSTOM POST TYPE SETTINGS                                #
#                                                                                        #
##########################################################################################
$multitool_settings['posttypes']['wtgflags']['status'] = 'disabled'; 
$multitool_settings['posttypes']['posts']['status'] = 'disabled';

##########################################################################################
#                                                                                        #
#                                    NOTICE SETTINGS                                     #
#                                                                                        #
##########################################################################################
$multitool_settings['noticesettings']['wpcorestyle'] = 'enabled';

##########################################################################################
#                                                                                        #
#                           YOUTUBE RELATED SETTINGS                                     #
#                                                                                        #
##########################################################################################
$multitool_settings['youtubesettings']['defaultcolor'] = '&color1=0x2b405b&color2=0x6b8ab6';
$multitool_settings['youtubesettings']['defaultborder'] = 'enable';
$multitool_settings['youtubesettings']['defaultautoplay'] = 'enable';
$multitool_settings['youtubesettings']['defaultfullscreen'] = 'enable';
$multitool_settings['youtubesettings']['defaultscriptaccess'] = 'always';

##########################################################################################
#                                                                                        #
#                                  LOG SETTINGS                                          #
#                                                                                        #
##########################################################################################
$multitool_settings['logsettings']['uselog'] = 1;
$multitool_settings['logsettings']['loglimit'] = 1000;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['outcome'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['timestamp'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['line'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['function'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['page'] = true; 
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['panelname'] = true;   
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['userid'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['type'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['category'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['action'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['priority'] = true;
$multitool_settings['logsettings']['logscreen']['displayedcolumns']['comment'] = true;
?>
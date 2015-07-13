<?php
/** 
 * Default schedule array for Multitool plugin 
 * 
 * @package Multitool
 * @author Ryan Bayne   
 * @since 0.0.1
 */

// load in WordPress only
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

$multitool_schedule_array = array();
// history
$multitool_schedule_array['history']['lastreturnreason'] = __( 'None', 'multitool' );
$multitool_schedule_array['history']['lasteventtime'] = time();
$multitool_schedule_array['history']['lasteventtype'] = __( 'None', 'multitool' );
$multitool_schedule_array['history']['day_lastreset'] = time();
$multitool_schedule_array['history']['hour_lastreset'] = time();
$multitool_schedule_array['history']['hourcounter'] = 1;
$multitool_schedule_array['history']['daycounter'] = 1;
$multitool_schedule_array['history']['lasteventaction'] = __( 'None', 'multitool' );
// times/days
$multitool_schedule_array['days']['monday'] = true;
$multitool_schedule_array['days']['tuesday'] = true;
$multitool_schedule_array['days']['wednesday'] = true;
$multitool_schedule_array['days']['thursday'] = true;
$multitool_schedule_array['days']['friday'] = true;
$multitool_schedule_array['days']['saturday'] = true;
$multitool_schedule_array['days']['sunday'] = true;
// times/hours
$multitool_schedule_array['hours'][0] = true;
$multitool_schedule_array['hours'][1] = true;
$multitool_schedule_array['hours'][2] = true;
$multitool_schedule_array['hours'][3] = true;
$multitool_schedule_array['hours'][4] = true;
$multitool_schedule_array['hours'][5] = true;
$multitool_schedule_array['hours'][6] = true;
$multitool_schedule_array['hours'][7] = true;
$multitool_schedule_array['hours'][8] = true;
$multitool_schedule_array['hours'][9] = true;
$multitool_schedule_array['hours'][10] = true;
$multitool_schedule_array['hours'][11] = true;
$multitool_schedule_array['hours'][12] = true;
$multitool_schedule_array['hours'][13] = true;
$multitool_schedule_array['hours'][14] = true;
$multitool_schedule_array['hours'][15] = true;
$multitool_schedule_array['hours'][16] = true;
$multitool_schedule_array['hours'][17] = true;
$multitool_schedule_array['hours'][18] = true;
$multitool_schedule_array['hours'][19] = true;
$multitool_schedule_array['hours'][20] = true;
$multitool_schedule_array['hours'][21] = true;
$multitool_schedule_array['hours'][22] = true;
$multitool_schedule_array['hours'][23] = true;
// limits
$multitool_schedule_array['limits']['hour'] = '1000';
$multitool_schedule_array['limits']['day'] = '5000';
$multitool_schedule_array['limits']['session'] = '300';
// event types (update event_action() if adding more eventtypes)
// deleteuserswaiting - this is the auto deletion of new users who have not yet activated their account 
$multitool_schedule_array['eventtypes']['deleteuserswaiting']['name'] = __( 'Delete Users Waiting', 'multitool' ); 
$multitool_schedule_array['eventtypes']['deleteuserswaiting']['switch'] = 'disabled';
// send emails - rows are stored in wp_c2pmailing table for mass email campaigns 
$multitool_schedule_array['eventtypes']['sendemails']['name'] = __( 'Send Emails', 'multitool' ); 
$multitool_schedule_array['eventtypes']['sendemails']['switch'] = 'disabled';    
?>
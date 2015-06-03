<?php
/** 
 * Database tables information for past and new versions.
 * 
 * This file is not fully in use yet. The intention is to migrate it to the
 * installation class and rather than an array I will simply store every version
 * of each tables query. Each query can be broken down to compare against existing 
 * tables. I find this array approach too hard to maintain over many plugins.
 * 
 * @todo move this to installation class but also reduce the array to actual queries per version
 * 
 * @package Multitool
 * @author Ryan Bayne   
 * @since 0.0.1
 * @version 8.1.2
 */

// load in WordPress only
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );
 
 
/*   Column Array Example Returned From "mysql_query( "SHOW COLUMNS FROM..."
        
          array(6) {
            [0]=>
            string(5) "row_id"
            [1]=>
            string(7) "int(11)"
            [2]=>
            string(2) "NO"
            [3]=>
            string(3) "PRI"
            [4]=>
            NULL
            [5]=>
            string(14) "auto_increment"
          }
                  
    +------------+----------+------+-----+---------+----------------+
    | Field      | Type     | Null | Key | Default | Extra          |
    +------------+----------+------+-----+---------+----------------+
    | Id         | int(11)  | NO   | PRI | NULL    | auto_increment |
    | Name       | char(35) | NO   |     |         |                |
    | Country    | char(3)  | NO   | UNI |         |                |
    | District   | char(20) | YES  | MUL |         |                |
    | Population | int(11)  | NO   |     | 0       |                |
    +------------+----------+------+-----+---------+----------------+            
*/
   
global $wpdb;   
$multitool_tables_array =  array();
##################################################################################
#                                 webtechglobal_log                                         #
##################################################################################        
$multitool_tables_array['tables']['webtechglobal_log']['name'] = $wpdb->prefix . 'webtechglobal_log';
$multitool_tables_array['tables']['webtechglobal_log']['required'] = false;// required for all installations or not (boolean)
$multitool_tables_array['tables']['webtechglobal_log']['pluginversion'] = '0.0.1';
$multitool_tables_array['tables']['webtechglobal_log']['usercreated'] = false;// if the table is created as a result of user actions rather than core installation put true
$multitool_tables_array['tables']['webtechglobal_log']['version'] = '0.0.1';// used to force updates based on version alone rather than individual differences
$multitool_tables_array['tables']['webtechglobal_log']['primarykey'] = 'row_id';
$multitool_tables_array['tables']['webtechglobal_log']['uniquekey'] = 'row_id';
// webtechglobal_log - row_id
$multitool_tables_array['tables']['webtechglobal_log']['columns']['row_id']['type'] = 'bigint(20)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['row_id']['null'] = 'NOT NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['row_id']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['row_id']['default'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['row_id']['extra'] = 'AUTO_INCREMENT';
// webtechglobal_log - outcome
$multitool_tables_array['tables']['webtechglobal_log']['columns']['outcome']['type'] = 'tinyint(1)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['outcome']['null'] = 'NOT NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['outcome']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['outcome']['default'] = '1';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['outcome']['extra'] = '';
// webtechglobal_log - timestamp
$multitool_tables_array['tables']['webtechglobal_log']['columns']['timestamp']['type'] = 'timestamp';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['timestamp']['null'] = 'NOT NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['timestamp']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['timestamp']['default'] = 'CURRENT_TIMESTAMP';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['timestamp']['extra'] = '';
// webtechglobal_log - line
$multitool_tables_array['tables']['webtechglobal_log']['columns']['line']['type'] = 'int(11)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['line']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['line']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['line']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['line']['extra'] = '';
// webtechglobal_log - file
$multitool_tables_array['tables']['webtechglobal_log']['columns']['file']['type'] = 'varchar(250)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['file']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['file']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['file']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['file']['extra'] = '';
// webtechglobal_log - function
$multitool_tables_array['tables']['webtechglobal_log']['columns']['function']['type'] = 'varchar(250)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['function']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['function']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['function']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['function']['extra'] = '';
// webtechglobal_log - sqlresult
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlresult']['type'] = 'blob';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlresult']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlresult']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlresult']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlresult']['extra'] = '';
// webtechglobal_log - sqlquery
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlquery']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlquery']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlquery']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlquery']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlquery']['extra'] = '';
// webtechglobal_log - sqlerror
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlerror']['type'] = 'mediumtext';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlerror']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlerror']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlerror']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['sqlerror']['extra'] = '';
// webtechglobal_log - wordpresserror
$multitool_tables_array['tables']['webtechglobal_log']['columns']['wordpresserror']['type'] = 'mediumtext';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['wordpresserror']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['wordpresserror']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['wordpresserror']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['wordpresserror']['extra'] = '';
// webtechglobal_log - screenshoturl
$multitool_tables_array['tables']['webtechglobal_log']['columns']['screenshoturl']['type'] = 'varchar(500)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['screenshoturl']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['screenshoturl']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['screenshoturl']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['screenshoturl']['extra'] = '';
// webtechglobal_log - userscomment
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userscomment']['type'] = 'mediumtext';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userscomment']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userscomment']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userscomment']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userscomment']['extra'] = '';
// webtechglobal_log - page
$multitool_tables_array['tables']['webtechglobal_log']['columns']['page']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['page']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['page']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['page']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['page']['extra'] = '';
// webtechglobal_log - version
$multitool_tables_array['tables']['webtechglobal_log']['columns']['version']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['version']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['version']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['version']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['version']['extra'] = '';
// webtechglobal_log - panelid
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelid']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelid']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelid']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelid']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelid']['extra'] = '';
// webtechglobal_log - panelname
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelname']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelname']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelname']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelname']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['panelname']['extra'] = '';
// webtechglobal_log - tabscreenid
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenid']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenid']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenid']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenid']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenid']['extra'] = '';
// webtechglobal_log - tabscreenname
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenname']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenname']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenname']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenname']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['tabscreenname']['extra'] = '';
// webtechglobal_log - dump
$multitool_tables_array['tables']['webtechglobal_log']['columns']['dump']['type'] = 'longblob';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['dump']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['dump']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['dump']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['dump']['extra'] = '';
// webtechglobal_log - ipaddress
$multitool_tables_array['tables']['webtechglobal_log']['columns']['ipaddress']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['ipaddress']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['ipaddress']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['ipaddress']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['ipaddress']['extra'] = '';
// webtechglobal_log - userid
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userid']['type'] = 'int(11)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userid']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userid']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userid']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['userid']['extra'] = '';
// webtechglobal_log - comment
$multitool_tables_array['tables']['webtechglobal_log']['columns']['comment']['type'] = 'mediumtext';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['comment']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['comment']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['comment']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['comment']['extra'] = '';
// webtechglobal_log - type
$multitool_tables_array['tables']['webtechglobal_log']['columns']['type']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['type']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['type']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['type']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['type']['extra'] = '';
// webtechglobal_log - category
$multitool_tables_array['tables']['webtechglobal_log']['columns']['category']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['category']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['category']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['category']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['category']['extra'] = '';
// webtechglobal_log - action
$multitool_tables_array['tables']['webtechglobal_log']['columns']['action']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['action']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['action']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['action']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['action']['extra'] = '';
// webtechglobal_log - priority
$multitool_tables_array['tables']['webtechglobal_log']['columns']['priority']['type'] = 'varchar(45)';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['priority']['null'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['priority']['key'] = '';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['priority']['default'] = 'NULL';
$multitool_tables_array['tables']['webtechglobal_log']['columns']['priority']['extra'] = '';              
?>
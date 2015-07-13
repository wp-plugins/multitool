<?php
/** 
 * Help contains class related to information flow specific to providing
 * support i.e. importing help content directly from WebTechGlobal.
 * 
 * @package Multitool
 * @author Ryan Bayne   
 * @since 0.0.1
 * @version 1.0
 */  
class MULTITOOL_Help {

    /**
    * aids manual entry of a view, use this first then use enterform() and then enteroption()
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function enterpage( $view_title, $view_about, $view_readmoreurl = false, $view_videourl = false, $view_discussurl = false ){
        return array( 'pagetitle'       => $view_title,
                      'pageabout'       => $view_about,
                      'pagereadmoreurl' => $view_readmoreurl,
                      'pagevideourl'    => $view_videourl, 
                      'pagediscussurl'  => $view_discussurl);
    }
          
    /**
    * use for manual entry of a form/box 
    * 
    * Copy: self::entry('FormTitle','OptionTitle','HelpText
    * 
    * @param string $form_title    i.e. Create New Project
    * @param string $aboutform     i.e. Use the form in this box to create a new project.
    * @param string $readmoreurl   i.e. http://webtechglobal.co.uk/blog/wordpress/multitool/how-to-create-new-projects
    * @param string $videourl      i.e. https://www.youtube.com/watch?v=602gnhYMq8Q
    * @param string $discussurl    i.e. http://forum.webtechglobal.co.uk/viewforum.php?f=8
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function enterform(  $form_title = false, $aboutform = 'No form introduction sorry.', $readmoreurl = false, $videourl = false, $discussurl = false ){
        return array(          
                      'formtitle'   => $form_title,  
                      'formabout'   => $aboutform,
                      'formreadmoreurl' => $readmoreurl, 
                      'formvideourl'    => $videourl,
                      'formdiscussurl'  => $discussurl,
                      'options'     => array() );
    }

    /**
    * add help for a specific option, these will be listed with the title being a label
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.1
    * @version 1.0
    */
    public function enteroption( $optiontitle, $optiontext, $optionurl = false, $optionvideourl = false ) {
        return array( 'optiontitle' => $optiontitle, 
                      'optiontext' => $optiontext, 
                      'optionurl' => $optionurl, 
                      'optionvideourl' => $optionvideourl );              
    }
    
    /**
    * Array of help content. First entry is an example using functions that help with manual entry.
    * The rest of the array is generated using data stored on the WebTechGlobal website and using
    * a WordPress plugin created by WTG for the mangement of documentation.
    * 
    * @author Ryan Bayne
    * @package Multitool
    * @since 0.0.2
    * @version 1.0
    */
    public function get_help_array() {   
        $h = array();
      
        // PAGE: main
        $h[ 'main' ][ 'pageinfo' ] = self::enterpage( __( 'Welcome', 'multitool' ), __( 'My name Ryan Bayne and I created this plugin. I can also help you at anytime. This help tab is not complete and will eventually offer help content for every feature.', 'multitool' ), MULTITOOL_PORTAL, MULTITOOL_YOUTUBEPLAYLIST );

        // PAGE TEST 1: postssection (manually typed)    
        $h[ 'postssection' ][ 'pageinfo' ][ 'pagetitle' ]       = __( 'Test Page', 'multitool' ); 
        $h[ 'postssection' ][ 'pageinfo' ][ 'pageabout' ]       = __( 'Beta Testing: These settings reflect what WordPress already has to offer. You will find these settings on the Edit Post screen and in most other .csv import plugins.', 'multitool' );    
        $h[ 'postssection' ][ 'pageinfo' ][ 'pagereadmoreurl' ] = 'https://codex.wordpress.org/Post_Status';
        $h[ 'postssection' ][ 'pageinfo' ][ 'pagevideourl' ]    = 'http://www.youtube.com/2UQfk1PLj2s?t=2m';
        $h[ 'postssection' ][ 'pageinfo' ][ 'pagediscussurl' ]  = 'http://forum.webtechglobal.co.uk';
        //                                 FORM: basicpostoptions
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formtitle' ]       = __( 'Basic Post Options' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formabout' ]       = __( 'Beta Testing: These are the first and most commonly used options when creating posts in WordPress. The selections you make here will only apply to posts created by this plugin. If you want to read more about each setting you should use the WordPress.org codex.' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formreadmoreurl' ] = 'https://codex.wordpress.org/Post_Status';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formvideourl' ]    = 'http://www.youtube.com/2UQfk1PLj2s?t=2m';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formvideoid' ]    = 'http://www.youtube.com/2UQfk1PLj2s?t=2m';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'formdiscussurl' ]  = 'http://forum.webtechglobal.co.uk';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'helpurl' ]  = 'http://forum.webtechglobal.co.uk';
        //                                                        OPTION: poststatus
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'poststatus' ][ 'optiontitle' ]    = __( 'Post Status' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'poststatus' ][ 'optiontext' ]     = __( 'Beta Testing:A key ability within post status control is being able to hide content from the public until your ready to show it by changing a post to "publish" status. Each of the other status hide posts from visitors in different ways. I highly recommending reading the codex page.' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'poststatus' ][ 'optionurl' ]      = 'https://codex.wordpress.org/Post_Status';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'poststatus' ][ 'optionvideourl' ] = 'http://www.youtube.com/2UQfk1PLj2s?t=2m';
        //                                                        OPTION: pingstatus
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'pingstatus' ][ 'optiontitle' ]    = __( 'Ping Status' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'pingstatus' ][ 'optiontext' ]     = __( 'Beta Testing: A key ability within post status control is being able to hide content from the public until your ready to show it by changing a post to "publish" status. Each of the other status hide posts from visitors in different ways. I highly recommending reading the codex page.' );
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'pingstatus' ][ 'optionurl' ]      = 'https://codex.wordpress.org/Post_Status';
        $h[ 'postssection' ][ 'forms' ][ 'iconstest' ][ 'options' ][ 'pingstatus' ][ 'optionvideourl' ] = 'http://www.youtube.com/2UQfk1PLj2s?t=2m';
        
        // PAGE TEST 2: used functions to add more arrays
        $h[ 'betatest1' ][ 'pageinfo' ] = self::enterpage( 'Testers', 'Beta Testing: About testers area about text intro text help text etc', 'www.webtechglobal.co.uk', 'www.youtube.com', 'discussurl' );
        // FORM: postbox_betatest1_t1
        $h[ 'betatest1' ][ 'forms' ][ 'postbox_betatest1_t1' ] = self::enterform( __( 'New Project & New CSV Files', 'multitool' ), __( 'Beta Testing: After uploading your .csv file/s using WordPress, FTP or another plugin. Enter the path/s into the form then submit. The plugin will do various checks to ensure your file/s can be used and end with creating one or more database tables.', 'multitool' ), false, false, false);
        // OPTIONS for FORM postbox_betatest1_t1
        $h[ 'betatest1' ][ 'forms' ][ 'postbox_betatest1_t1' ][ 'options' ][ 'csvfile1' ] = self::enteroption( 'CSV File 1', 'Beta Testing: Enter the local path to your .csv file. If multiple fields are available for your version of the plugin. You may enter paths to multiple .csv file. Multitool will merge the data and can do so using various methods. Premium purchase is recommended for professional projects especially if data updated will be required.', false, false );
              
        return $h;
    }
   
}
?>
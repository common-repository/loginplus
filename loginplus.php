<?php
/*
Plugin Name: Login Plus
Plugin URI: https://plugins.svn.wordpress.org/loginplus
Description: Change Wordpress Login Logo and Logo Url with out altering any core file. See Login Logs like Hacking attempt,Failed login, successfull login with tons of info.
Version: 1.2
Author: Sanjaysolutions
Author URI: https://www.codentricks.com/about
Text Domain: Change Wordpress Login with altering any core file.
*/

require 'core/system.php';


add_action('admin_menu', 'loginplus_pages');
function loginplus_pages() {
    add_menu_page( 'Login Plus', 'Login  Plus',1,'login_plus_sphome', 'login_plus_sphome', 'dashicons-lock', 90);
    add_submenu_page( 'login_plus_sphome', 'Hacking Attempts', 'Hacking Attempts',1,'login_plus_sphacking', 'login_plus_sphacking');
    add_submenu_page( 'login_plus_sphome', 'Change Logo', 'Change Logo',1,'login_plus_splogo', 'login_plus_splogo');
    add_submenu_page( 'login_plus_sphome', 'Settings', 'Settings',1,'login_plus_spsettings', 'login_plus_spsettings');
}



add_action( 'admin_enqueue_scripts', 'loginplus_load_files' );
function loginplus_load_files() {
	wp_register_style('loginplus', plugin_dir_url(__FILE__) . 'assets/loginplus.css');
	wp_enqueue_style('loginplus');
    wp_register_script('loginplus', plugin_dir_url(__FILE__) . 'assets/loginplus.js');
    wp_enqueue_script('jquery');
	wp_enqueue_media();
    wp_register_script( 'media-lib-uploader-js', plugins_url( 'media-lib-uploader.js' , __FILE__ ), array('jquery') );
    wp_enqueue_script( 'media-lib-uploader-js' );
    wp_enqueue_script('loginplus');
   
}




function login_plus_sphome(){
   require 'apps/home.php';
}
function login_plus_splogo(){
   require 'apps/logo.php';
}
function login_plus_sphacking(){
   require 'apps/hacking.php';
}
function login_plus_spsettings(){
   require 'apps/settings.php';
}

function login_plus_sp_activation(){
    global $wpdb;
    $tableCreation = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "sp_login_details (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username varchar(255),
            uagent text,
            ipaddr varchar(40),
            browser varchar(100),
            visitoros varchar(100),
            visitType varchar(60),
            refUrl text,
            queryType varchar(60),
            visitdate DATE,
            visittimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            
            ); ";
    $wpdb->query($tableCreation);
    


    //Create the plugin options
    $login_plus_sp = array(
        'imgUrl' => 'Inactive',
        'logoUrl' => 'Default',
        'status' => 'Inactive',
    );
    update_option( 'login_plus_sp', $login_plus_sp );
}
register_activation_hook(__FILE__, 'login_plus_sp_activation');

function login_plus_sp__deactivation(){
    global $wpdb;
    $sql="drop table if exists " . $wpdb->prefix . "sp_login_details";
    $wpdb->query($sql);

}
register_deactivation_hook(__FILE__, 'login_plus_sp_deactivation');

//failed login attemp
add_action( 'wp_login_failed', 'login_plus_splogin_failed' );
function login_plus_splogin_failed($username) {
    global $wpdb;
    
    if(wp_get_referer())
      $refUrl=wp_get_referer();
    else
      $refUrl='NA';

    $allUser=get_users();
    $allu=array();
        foreach($allUser  as $auser){
            $allu[]=$auser->user_login;

        }
    if(in_array($username, $allu)){
        $visitType= 'Failed Login';            
    }else{
        $visitType= 'Hacking Attempt';
    }

    $sys=new LoginPlusSystem();
    $uagent=$_SERVER ['HTTP_USER_AGENT'];
    $ipaddr= $_SERVER['REMOTE_ADDR'];

    $browser=$sys->getBrowser($uagent)." ".$sys->broV($uagent);
    $visitoros=$sys->getOS($uagent);
    $today=date("Y-m-d");
    $failedlog = "insert into " . $wpdb->prefix . "sp_login_details 
    (username,uagent,ipaddr,browser,visitoros,visitdate,queryType,refUrl,visitType) 
    values('$username','$uagent','$ipaddr','$browser','$visitoros','$today','failedLogin','$refUrl','$visitType')";
    $wpdb->query($failedlog);

    //error_log("user $username: authentication failure for \"".admin_url()."\": Password Mismatch");
}
//failed login attemp

//Login success
add_action('wp_login', 'login_plus_splogin_success', 10, 2);
//add_action( 'wp_authenticate', 'login_success' );
function login_plus_splogin_success($username) {
    global $wpdb;
    if(wp_get_referer())
      $refUrl=wp_get_referer();
    else
      $refUrl='NA';

    if($username){
        $visitType= 'Valid Login';  
        $sys=new LoginPlusSystem();
        $uagent=$_SERVER ['HTTP_USER_AGENT'];
        $ipaddr= $_SERVER['REMOTE_ADDR'];

        $browser=$sys->getBrowser($uagent)." ".$sys->broV($uagent);
        $visitoros=$sys->getOS($uagent);
        $today=date("Y-m-d");
        $failedlog = "insert into " . $wpdb->prefix . "sp_login_details 
        (username,uagent,ipaddr,browser,visitoros,visitdate,queryType,refUrl,visitType) 
        values('$username','$uagent','$ipaddr','$browser','$visitoros','$today','successLogin','$refUrl','$visitType')";
    $wpdb->query($failedlog);
   }

    //error_log("user $username: authentication failure for \"".admin_url()."\": Password Mismatch");
}
//Login success


function login_Plus_Saved(){
  global $wpdb; 
    //var_dump($_POST);
   //echo $_POST['logoUrl'];

    $saveData = array(

        'imageUrl' => sanitize_text_field($_POST['imageUrl']),
        'logoUrl' => sanitize_text_field($_POST['logoUrl']),
        'status' => sanitize_text_field($_POST['status'])

    ); 
       
              
        update_option('login_plus_sp', $saveData);      
        echo 1;
        die();   

}
add_action('wp_ajax_login_Plus_Saved', 'login_Plus_Saved');
add_action('wp_ajax_nopriv_login_Plus_Saved', 'login_Plus_Saved');

//deleting logs
function login_plus_deleteLogs(){
    global $wpdb; 
    $deleteOption= sanitize_text_field($_POST['deleteOption']);
    $sql="delete from  " . $wpdb->prefix . "sp_login_details where queryType='".$deleteOption."'";
    //var_dump($sql);
    $wpdb->query($sql);
    echo 1;
    die();

}
add_action('wp_ajax_login_plus_deleteLogs', 'login_plus_deleteLogs');
add_action('wp_ajax_nopriv_login_plus_deleteLogs', 'login_plus_deleteLogs');
//deleting logs



add_action( 'login_enqueue_scripts', 'login_plus_change_logo' );
function login_plus_change_logo() { 
global $wpdb;
$lpdata = get_option( "login_plus_sp" );
if($lpdata['status']=='Active'):
    //wp_dequeue_style( 'login' );
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('<?php echo $lpdata['imageUrl']; ?>') !important;
            height: 75px;
            width: 280px;
            background-size: 280px 75px;
            background-repeat: no-repeat;
            padding-bottom: 0px;
        }
    </style>
<?php 
endif;

}


add_filter( 'login_headerurl', 'login_plus_logo_url' );
function login_plus_logo_url($url) {
    $lpdata = get_option( "login_plus_sp" );
    return $lpdata['logoUrl'];
}



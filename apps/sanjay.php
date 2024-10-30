<?php
class LoginPlusSanjay{

  private $wpdb;

  public function __construct(){
	    global $wpdb;
	    $this->wpdb = $wpdb;
  }

  public function countLoginRows($days,$queryType){
  	
  	$sql="SELECT count(*) FROM ".$this->wpdb->prefix."sp_login_details WHERE 
  	visitType='".$queryType."' and visitdate BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
  	//var_dump($sql);
    $count = $this->wpdb->get_var($sql);
  	return $count;
  }
}
?>
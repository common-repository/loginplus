<?php
global $pagenow; 
global $current_user;
if ( ! defined( 'ABSPATH' ) ) exit;
require 'sanjay.php';
$sanjay=new LoginPlusSanjay();
$lpdata = get_option( "login_plus_sp" );
//var_dump($lpdata);
if($lpdata['status']=='Inactive')
 $statusClass='sperror';
else
 $statusClass='spsuccess';	
?>
<div id="welcome-panel" class="welcome-panel">
<input id="welcomepanelnonce" name="welcomepanelnonce" value="0c243a2585" type="hidden">
<a class="welcome-panel-close" href="<?php echo site_url();?>/wp-admin/?welcome=0" aria-label="Dismiss the welcome panel">Dismiss</a>

<div class="welcome-panel-content">
	<h1 class="wp-heading-inline"> Login<span class="title-count theme-count">+</span></h1>
	<div class="welcome-panel-column-container" style="display: inline !important;">
       <?php 
       //var_dump($sanjay->countLoginRows(7,'Valid Login'));
       $valid=$sanjay->countLoginRows(7,'Valid Login');
       $failed=$sanjay->countLoginRows(7,'Failed Login');
       $hacked=$sanjay->countLoginRows(7,'Hacking Attempt');
       $total=$valid+$failed+$hacked;
       ?>
     <div class="grid4">
     	<div class="box">
     	  <div class="green">
     	   <div class="white-box">
     	  	<h2>Valid Login</h2>
     	  	<span>In Last 7 Days</span>
     	  	<h3><?php echo $valid;?></h3>
     	   </div>
     	  </div>
     	</div>
     </div>
     <div class="grid4">
     	<div class="box">
     	  <div class="voilet">
     	  	<div class="white-box">
     	  	<h2>Failed Attempts</h2>
     	  	<span>In Last 7 Days</span>
     	  	<h3><?php echo $failed;?></h3>
     	   </div>
     	  </div>
     	</div>
     </div>
     <div class="grid4">
     	<div class="box">
     	  <div class="red">
     	  	<div class="white-box">
     	  	<h2>Hacking Attempts</h2>
     	  	<span>In Last 7 Days</span>
     	  	<h3><?php echo $hacked;?></h3>
     	   </div>
     	  </div>
     	</div>
     </div>
     <div class="grid4">
     	<div class="box">
     	  <div class="blue">
     	  	<div class="white-box">
     	  	<h2>Total Attempts</h2>
     	  	<span>In Last 7 Days</span>
     	  	<h3><?php echo $total;?></h3>
     	   </div>
     	  </div>
     	</div>
     </div>
    
     <div class="clearfix"></div>
	 <div class="table-responsive">
	    <br/>
	  	<table class="sptable">
	  		<thead>
	  			<tr>	
	  				<th>Login as</th>
	  				<th>IP Address</th>
	  				<th>Browser</th>
	  				<th>OS</th>
	  				<th>Timestamp</th>
	  			</tr>
	  		</thead>
	  		<tbody>
              </tbody>
               <?php
               global $wpdb;
               $hrows = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sp_login_details where queryType='successLogin' order by id desc limit 50");
			   foreach ($hrows as $hrow) { 
				         
               ?>
	  			<tr>
	  				<td><?php echo $hrow->username;?></td>
	  				<td><?php echo $hrow->ipaddr.' <a href="https://whatismyipaddress.com/ip/'.$hrow->ipaddr.'"  target="_blank">Details</a>';?></td>
	  				<td><?php echo $hrow->browser;?></td>
	  				<td><?php echo $hrow->visitoros;?></td>
	  				<td><?php echo $hrow->visittimestamp;?></td>
	  			</tr>
	  			<tr>
	  				<td colspan="6" style="text-align:center">
	  				User Agent : <?php echo $hrow->uagent;?><br/>
	  				<!-- Referral Url : <?php echo $hrow->refUrl;?>	 -->
	  				</td>
	  			</tr>
				<?php } ?>
	  		</tbody>
	  	</table>
	  </div>
	
	</div>
</div>
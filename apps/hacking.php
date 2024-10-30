<?php
global $pagenow; 
global $current_user;
if ( ! defined( 'ABSPATH' ) ) exit;
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
	<h1 class="wp-heading-inline"> HACKING<span class="title-count theme-count">Attempts</span></h1>
	<div class="welcome-panel-column-container" style="display: inline !important;">

	  <div class="table-responsive">
	  	<table class="sptable">
	  		<thead>
	  			<tr>	
	  				<th>Attempt Type</th>
	  				<th>Tried Login  AS</th>
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
               $hrows = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sp_login_details where queryType='failedLogin' order by id desc limit 50");
			   foreach ($hrows as $hrow) { 
				         
               ?>
	  			<tr>
	  				
	  				<td>
	  					<?php
	  						//if($user==$hrow->username){
	  					    //echo $hrow->visitType;
	  					    if($hrow->visitType=='Hacking Attempt'){
	  							echo '<span class="sperror" style="font-size:16px;">Hacking Attempt</span>';
	  			
	  						}else{
	  							echo '<span class="spdefult" style="font-size:16px;">Suspicious / Failed Attempt</span>';
	  						}
	  					?>
	  				</td>
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
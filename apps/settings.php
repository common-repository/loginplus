<?php
global $pagenow; 
global $current_user;
if ( ! defined( 'ABSPATH' ) ) exit;
$lpdata = get_option( "sp_login_plus" );
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
	<h1 class="wp-heading-inline"> LOGIN<span class="title-count theme-count">+</span></h1>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h3>Delete Logs</h3>
		<div id="settingsProcess"></div>
		<form method="post"  id="loginPlussettings">        
		    <div class="fullWidth">
			  <select name="deleteOption" id="deleteOption" class="selectWidth">
			    <option value="">Select Option</option>
			  	<option value="successLogin">Delete Login Details</option>
			  	<option value="failedLogin">Delete Hacking Attempts</option>
			  </select>
		    </div>
			<button type="submit" class="button button-primary button-hero load-customize hide-if-no-customize" >Submit</button>
			<br/><br/>		  
		</form>	
	</div>
	<div class="welcome-panel-column">
		<h3>Upgrade to Login Plus Pro & Get</h3>
		<ul>
			<li><a class="welcome-icon dashicons-align-right">Logs with Pagination Support (Now only 50)</a></li>
			<li><a class="welcome-icon dashicons-align-right">Website Analytics (Analyse Visitor Data)</a></li>
			<li><a class="welcome-icon dashicons-align-right">Hacking Attempts Email Alert</a></li>
			<li><a class="welcome-icon dashicons-align-right">Block IP Address to stay protected</a></li>
			<li><a class="welcome-icon dashicons-align-right">Limit Suspicious login attempts</a></li>
			<li><a class="welcome-icon dashicons-align-right">Get information about vulnerable plugins</a></li>
		</ul>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h3>About Developer</h3>
		<ul>
			<li><div class="welcome-icon welcome-widgets-menus">Devloped by <a href="http://www.codentricks.com/about">Sanjay Prasad</a></div></li>
			<li><a href="#" class="welcome-icon dashicons-email-alt">info@codentricks.com</a></li>
			<li><a href="http://www.codentricks.com" class="welcome-icon dashicons-admin-site">http://www.codentricks.com</a></li>
			<li><a href="https://www.youtube.com/channel/UC8wnKuRaKVcprlKv3KE4pYw?sub_confirmation=1" class="welcome-icon dashicons-video-alt">Subscribe to Our YouTube Channel</a></li>
		</ul>
	</div>
	</div>
</div>
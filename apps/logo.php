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
	<h1 class="wp-heading-inline"> LOGIN<span class="title-count theme-count">+</span></h1>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h3>Upload Logo</h3>
		<form method="post"  id="loginPlusForm"><br/>
		    <label for="image"><b>Upload Image (Recommended 280X75)*</b></label>
                <br />
                <input type="text" name="imageUrl" id="imageUrl"  class="input-text" />
                <input type="button" name="image" id="imageU" class="button button-primary" value="Upload"/>
                <br />
            <label for="">Logo Url</label> <br/>
             <input type="text" name="logoUrl"" id="logoUrl""  class="input-text" placholder="Logo Url"/>    
		    <div class="fullWidth"><br/>
			  <label for=""><b>Select Status</b></label>
		    </div>
		    <div class="radio">
			  <label><input type="radio" name="status"  value="Active">Active</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="status" value="Inactive" checked>Inactive</label>
			</div>
			<button type="submit" class="button button-primary button-hero load-customize hide-if-no-customize" >Submit</button>
			<br/><br/>		  
		</form>	
	</div>
	<div class="welcome-panel-column">
		<h3>LoginPLUS Status</h3>
		<ul>
			<li>
				<div id="statusPreview" class="<?php echo $statusClass;?>">
					<?php
						echo $lpdata['status'];
						//var_dump($lpdata);
					?>
				</div>
			</li>
			<li>
			  <div id="imgPreview">
			  	<?php
                 if($lpdata['imageUrl']){
                 	echo '<img src="'.$lpdata['imageUrl'].'" class="imgResponsive"/><br/>';
                 }
                 if($lpdata['logoUrl']){
                 	echo '<strong>Logo URl Set to :</strong><br/>';
                 	echo $lpdata['logoUrl'];
                 }
			  	?>
			  </div>
			</li>
			<li><div id="result"></div></li>
		</ul>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h3>About Developer</h3>
		<ul>
			<li><div class="welcome-icon welcome-widgets-menus">Devloped by <a href="http://www.codentricks.com/about">Sanjay Prasad</a></div></li>
			<li><a href="#" class="welcome-icon dashicons-email-alt">info@codentricks.com</a></li>
			<li><a href="http://www.codentricks.com" class="welcome-icon dashicons-admin-site">http://www.codentricks.com</a></li>
		</ul>
	</div>
	</div>
</div>
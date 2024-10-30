<?php
class LoginPlusSystem{
  

  public  function getBrowser($useragent) {
	 // Create list of browsers with browser name as array key and user agent as value. 
		$browsers = array(
		    'Opera Mini'=>'Opera Mini',
		    'Opera Webkit' => 'Opera Mobi',
			'Opera' => 'Opera',
			'Dolfin'=>'Dolfin',
			'Fennec'=>'Fennec',
			'UCBrowser'=>'UCBrowser',
			'UCWEB'=>'UCWEB',
			'QupZilla'=>'QupZilla',
			'Opera'=>'OPR', //opera based on chrome
			'MAUI Browser'=>'MAUI',
			'Namoroka'=>'Namoroka',
			'Iceape'=>'Iceape',
			'SeaMonkey'=>'SeaMonkey',
			'Firebird'=>'Firebird',
			'Firefox'=> 'Firefox', 
			'Galeon' => 'Galeon',
			'Epiphany'=>'Epiphany',
			'rekonq'=>'rekonq',
			'Arora'=>'Arora',
			'Midori'=>'Midori',
			'Chromium'=>'Chromium',
			'Chrome'=>'CrMo',
			'Chrome'=>'Chrome',
			'Maxthon'=>'Maxthon',
			'Skyfire'=>'Skyfire',
			'Minimo'=>'Minimo',
			'Obigo'=>'Obigo',
			'Mobile Safari'=> 'Mobile Safari',
			'Safari'=> 'Safari',
			'Iceweasel'=>'Iceweasel',
			'MyIE'=>'MyIE',
			'Lynx' => 'Lynx',
			'NetFront'=>'NetFront',
			'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
			'Konqueror'=>'Konqueror',
			'Googlebot-Mobile'=>'Googlebot-Mobile',
			'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)',
	        'Dillo'=>'Dillo',
	        'Avant'=>'Avant Browser',
	        'IE12' => 'MSIE 12',
	        'IE11' => 'MSIE 11',
			'IE10' => 'MSIE 10',
			'IE9' => 'MSIE 9',
			'IE8' => 'MSIE 8',
			'IE7' => 'MSIE 7',
			'IE6' => 'MSIE 6',
			'IE5' => 'MSIE 5',
			'IE4' => 'MSIE 4',
		);
		
		foreach($browsers as $browser=>$pattern) { // Loop through $browsers array
		// Use regular expressions to check browser type
			if(@preg_match("/$pattern/i", $useragent)) { // Check if a value in $browsers array matches current user agent.
				return $browser; // Browser was matched so return $browsers key
			}
		}
		return 'Unknown'; // Cannot find browser so return Unknown
	}

  public function broV($useragent){
	if(
		preg_match('/Gecko(.*) SeaMonkey\/(.*)/i',$useragent,$mat)or
		preg_match('/Gecko(.*)Firefox\/(.*)/i',$useragent,$mat)or
		preg_match('/opera(.*) Opera Mini\/(.*)/i',$useragent,$mat)or
		preg_match('/Presto(.*)Version\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) UCBrowser\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) QupZilla\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) OPR\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) CrMo\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) CriOS\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) Konqueror\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) Arora\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) Epiphany\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) rekonq\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla (.*)  Midori\/(.*)/i',$useragent,$mat)or
		preg_match('/Mozilla(.*) Chrome\/(.*)/i',$useragent,$mat)

	){	
	return @number_format($mat['2'],2);	
		
	}
 }

 public function getOS($useragent) {

	  // Create list of operating systems with operating system name as array key 
		$oses = array (
			'iPad'=>'iPad',
			'iPod'=>'iPod',
			'Bada OS'=>'Bada',
			'iPhone' => '(iPhone)',
			'Android'=>'Android',
			'Zune'=>'Zune',
			'Windows 3.11' => 'Win16',
			'Windows CE '=>'Windows CE 5.1',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
			'Windows 2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
			'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
			'Windows 8' => '(Windows NT 6.2)',
			'Windows 8.1' => '(Windows NT 6.3)',
			'Windows 10' => '(Windows NT 10.0)',
			'Windows Mobile 6.1'=>'Windows Mobile 6.1',
			'Windows Phone 7.5'=>'Windows Phone OS 7.5',
			'Windows Phone 7.8'=>'Windows Phone OS 7.8',
			'Windows  Mobile 7'=>'Windows Phone OS 7',
			'Windows Phone 8'=>'Windows Phone 8.0',
			'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Windows ME' => 'Windows ME',
			'Windows OS'=>'Windows',
			'Open BSD'=>'OpenBSD',
			'Sun OS Unix'=>'SunOS',
			'BlackBerry'=>'BlackBerry',
			'MeeGo'=>'MeeGo',
			'Nokia'=>'Nokia',
			'LG'=>'LG',
			'Lava'=>'Lava',
			'Motorola'=>'MOT',
		   
		    'Micromax'=>'MicroMax',
		    'Samsung'=>'SEC',
			'SAMSUNG'=>'SAMSUNG',
			'SonyEricsson'=>'SonyEricsson',
			'Symbian'=>'SymbianOS',
			'Linux Maemo'=>'Maemo',
			'Linux OpenSUSE'=>'openSUSE',
			'Linux Gentoo'=>'Gentoo',
			'Linux Slackware'=>'Slackware',
			'Linux Mint'=>'Linux Mint',
			'Linux CentOS'=>'CentOS',
			'Linux Fedora'=>'Fedora',
			'Linux Mageia'=>'Mageia',
			'Linux Kubuntu'=>'Kubuntu',
			'Linux Ubuntu'=>'Ubuntu',
			'Linux Debian'=>'Debian',
			'Unix DragonFly'=>'DragonFly',
			'Unix BSD'=>'BSD',
			'Unix NetBSD'=>'NetBSD',
			'FreeBSD Unix'=>'FreeBSD',
			'Linux'=>'(Linux)|(X11)',
			
			'Mac OS'=>'(Mac_PowerPC)|(Macintosh)',
			'QNX'=>'QNX',
			'BeOS'=>'BeOS',
			'OS/2'=>'OS/2',
			'PalmOS'=>'PalmOS',
			'webOS'=>'webOS',
			'Java'=>'MIDP',
			'Google Wireless Transcoder'=>'Google Wireless Transcoder',
			'Googlebot'=>'Googlebot',
			'Msnbot'=>'msnbot',
			'Yahoo Bot'=>'Slurp',
			'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
		);

		foreach($oses as $os=>$pattern){ // Loop through $oses array
		// Use regular expressions to check operating system type
			if(preg_match("/$pattern/i", $useragent)) { // Check if a value in $oses array matches current user agent.
				
				if($os=='Android'){
					
					if(
						preg_match('/Android(.*) AppleWebKit\/(.*)/i',$useragent,$mat)
						
						){	
						$info=@explode(';',$mat['1']);	
							$mod=@explode(')',$info['2']);
							$opr=@explode(')',$info['1']);

							//return print_r($opr);
								
							return "Android ".$info['0']." ".$mod['0']. " ".$opr['0'] ;
						}
						
					if(
						preg_match('/Android(.*) Gecko\/(.*)/i',$useragent,$mat)
						
						){	
						$info=@explode(';',$mat['1']);	
							$mod=@explode(')',$info['2']);
							$opr=@explode(')',$info['1']);

							//return print_r($opr);
								
							return "Android ".$info['0']." ".$opr['0'] ;
						}	
						
					
				}else{
				
				return $os; // Operating system was matched so return $oses key
			    }
			}
		}
		return 'Unknown'; // Cannot find operating system so return Unknown
	}


}
?>
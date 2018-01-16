<?php
if(!isset($_SESSION['cmsuno'])) exit();
?>
<?php
if(file_exists('data/cookiebar.json'))
	{
	include('plugins/cookiebar/lang/lang.php');
	$q1 = file_get_contents('data/cookiebar.json');
	$a1 = json_decode($q1,true);
	if(!empty($a1['typ']) && $a1['typ']=='cc')
		{
		$tex = (!empty($a1['tex'])?'"message":"'.$a1['tex'].'",':'');
		$nolink = ((!empty($a1['mor']) && $a1['mor']=='N')?'"showLink":false,':'');
		$mor = ''; $url = '';
		if(!$nolink)
			{
			$mor = (!empty($a1['mor'])?'"link":"'.$a1['mor'].'",':'');
			$url = (!empty($a1['url'])?'"href":"'.$a1['url'].'",':'');
			}
		$btn = (!empty($a1['btn'])?'"dismiss":"'.$a1['btn'].'",':'');
		$c = '{"content":{'.$tex.$mor.$url.$btn;
		if(!empty($tex.$mor.$url.$btn)) $c = substr($c,0,-1); // ,
		$c .= '},'.$nolink;
		$cco = $c . (!empty($a1['cco'])?substr($a1['cco'],1):'"palette":{"popup":{"background":"#000"},"button":{"background":"#f1d600"}}}');
		$Uhead .= '<link rel="stylesheet" href="uno/plugins/cookiebar/cookieconsent.min.css" type="text/css" />'."\r\n";
		$Ufoot .= '<script type="text/javascript" src="uno/plugins/cookiebar/cookieconsent.min.js"></script>'."\r\n";
		$Ufoot .= '<script type="text/javascript">window.addEventListener("load",function(){window.cookieconsent.initialise('.$cco.')});</script>'."\r\n";
		}
	else if(!empty($a1['typ']) && $a1['typ']=='w3')
		{
		$tex = (!empty($a1['tex'])?$a1['tex']:T_("This website uses cookies to ensure you get the best experience on our website."));
		$mor = (!empty($a1['mor'])?$a1['mor']:T_("Learn more"));
		$url = (!empty($a1['url'])?$a1['url']:'http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm');
		$btn = (!empty($a1['btn'])?$a1['btn']:T_("Got it!"));
		$co1 = (!empty($a1['co1'])?$a1['co1']:'w3-black');
		$co2 = (!empty($a1['co2'])?$a1['co2']:'w3-amber');
		$o = '<div id="cookiebar" class="w3-bar w3-bottom '.$co1.' w3-animate-opacity">';
		$o .= '<div class="w3-bar-item w3-padding-16">'.$tex.'</div>';
		if($mor!='N') $o .= '<div class="w3-bar-item w3-padding-16"><a href="'.$url.'" target="_blank">'.$mor.'</a></div>';
		$o .= '<div class="w3-bar-item w3-right"><button id="cookiebarok" class="w3-button '.$co2.'">'.$btn.'</button></div>';
		$o .= '</div>';
		$s = '(function(){';
		$s .= 'function createCo(n,v,d,p){if(d){var date=new Date();date.setTime(date.getTime()+(d*24*60*60*1000));var e="; expires="+date.toGMTString();}else var e="";document.cookie = n+"="+v+e+"; path="+p;};';
		$s .= 'function readCo(n){var ne=n+"=",ca=document.cookie.split(";"),i,c;for(i=0;i<ca.length;i++){c=ca[i];while(c.charAt(0)==" ")c=c.substring(1,c.length);if(c.indexOf(ne)==0)return c.substring(ne.length,c.length);};return null;};';
		$s .= 'var cm=document.getElementById("cookiebar"),c,ce,cp;if(cm==null)return;';
		$s .= 'c=readCo("seen-cookie-message");if(c!=null&&c=="yes"&&cm.className.indexOf("w3-hide")==-1)cm.className+=" w3-hide";else if(c!="yes")cm.className.replace(" w3-hide","");';
		$s .= 'ce=cm.getAttribute("data-cookie-expiry");if(ce==null)ce=30;cp=cm.getAttribute("data-cookie-path");if(cp==null)cp="/";';
		$s .= 'document.getElementById("cookiebarok").onclick=function(){createCo("seen-cookie-message","yes",ce,cp);cm.className+=" w3-hide";};';
		$s .= '})();';
		$Ufoot .= $o ."\r\n".'<script type="text/javascript">'.$s.'</script>'."\r\n";
		}
	}
?>

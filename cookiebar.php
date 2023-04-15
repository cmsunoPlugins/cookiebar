<?php
session_start(); 
if(!isset($_POST['unox']) || $_POST['unox']!=$_SESSION['unox']) {sleep(2);exit;} // appel depuis uno.php
?>
<?php
include('../../config.php');
include('lang/lang.php');
// ********************* actions *************************************************************************
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		// ********************************************************************************************
		case 'plugin': 
		if(file_exists('../../data/cookiebar.json')) {
			$q = file_get_contents('../../data/cookiebar.json');
			$a = json_decode($q,true);
		}
		?>
		<div class="blocForm">
			<h2><?php echo T_("Cookie Bar");?></h2>
			<p><?php echo T_("This plugin is a solution to comply with the ridiculous European Cookie Law.");?></p>
			<h3><?php echo T_("Default Settings");?></h3>
			<table class="hForm">
				<tr>
					<td><label><?php echo T_("Type of bar");?></label></td>
					<td>
						<select name="cookTyp" id="cookTyp" onChange="f_cookiebar_type();">
							<option value="w3" <?php if(isset($a['typ']) && $a['typ']=='w3') echo 'selected'; ?>><?php echo T_("w3.css Bar");?></option>
							<option value="cc" <?php if(isset($a['typ']) && $a['typ']=='cc') echo 'selected'; ?>><?php echo T_("Cookie-Consent Bar");?></option>
						</select>
					</td>
					<td><em><?php echo T_("W3.css is ultra light. Cookie-Consent is heavier but more powerful.");?></em></td>
				</tr><tr>
					<td><label><?php echo T_("Text");?></label></td>
					<td><input type="text" class="input" name="cookTex" id="cookTex" <?php if(!empty($a['tex'])) echo 'value="'.$a['tex'].'"'; ?> placeholder="<?php echo T_("This website uses cookies to ensure you get the best experience on our website."); ?>" /></td>
					<td><em><?php echo T_("Text to display in the bar.");?></em></td>
				</tr><tr>
					<td><label><?php echo T_("'More' Text");?></label></td>
					<td><input type="text" class="input" name="cookMor" id="cookMor" <?php if(!empty($a['mor'])) echo 'value="'.$a['mor'].'"'; ?> placeholder="<?php echo T_("Learn more"); ?>" /></td>
					<td><em><?php echo T_("Text to link to get more detail. Write N to disable.");?></em></td>
				</tr><tr>
					<td><label><?php echo T_("'More' URL");?></label></td>
					<td><input type="text" class="input" name="cookUrl" id="cookUrl" <?php if(!empty($a['url'])) echo 'value="'.$a['url'].'"'; ?> /></td>
					<td><em><?php echo T_("URL to get more detail.");?></em></td>
				</tr><tr>
					<td><label><?php echo T_("Button");?></label></td>
					<td><input type="text" class="input" name="cookBtn" id="cookBtn" <?php if(!empty($a['btn'])) echo 'value="'.$a['btn'].'"'; ?> placeholder="<?php echo T_("Got it!"); ?>" /></td>
					<td><em><?php echo T_("Link to get more detail.");?></em></td>
				</tr><tr class="cookTrcc" <?php if(isset($a['typ']) && $a['typ']!='cc') echo 'style="display:none"'; ?>>
					<td><label><?php echo T_("Options");?></label></td>
					<td><input type="text" class="input" name="cookCco" id="cookCco" <?php if(!empty($a['cco'])) echo "value='".$a['cco']."'"; ?> placeholder='{"palette":{"popup":{"background":"#000"},"button":{"background":"#f1d600"}}}'/></td>
					<td><em><?php echo T_("Cookie-Content Option. Leave empty to see the right format : {...}");?></em></td>
				</tr><tr class="cookTrw3" <?php if(isset($a['typ']) && $a['typ']!='w3') echo 'style="display:none"'; ?>>
					<td><label><?php echo T_("Bar Color");?></label></td>
					<td>
						<select name="cookCo1" id="cookCo1">
						<?php $co = array("w3-amber","w3-aqua","w3-black","w3-blue","w3-blue-grey","w3-brown","w3-cyan","w3-deep-orange","w3-deep-purple","w3-green","w3-indigo","w3-khaki","w3-light-blue","w3-light-green","w3-lime","w3-orange","w3-pink","w3-purple","w3-red","w3-sand","w3-teal","w3-white","w3-yellow");
						foreach($co as $v) echo '<option value="'.$v.'"'.((isset($a['co1']) && $a['co1']==$v)?' selected':'').'>'.ucwords(substr($v,3),"-").'</option>'; ?>
						</select>
					</td>
					<td><em><?php echo T_("Background color for the bottom bar.");?>&nbsp;<a href="https://www.w3schools.com/w3css/w3css_colors.asp" target="_blank">W3.CSS Colors</a></em></td>
				</tr><tr class="cookTrw3" <?php if(isset($a['typ']) && $a['typ']!='w3') echo 'style="display:none"'; ?>>
					<td><label><?php echo T_("Button Color");?></label></td>
					<td>
						<select name="cookCo2" id="cookCo2">
						<?php foreach($co as $v) echo '<option value="'.$v.'"'.((isset($a['co2']) && $a['co2']==$v)?' selected':'').'>'.ucwords(substr($v,3),"-").'</option>'; ?>
						</select>
					</td>
					<td><em><?php echo T_("Background color for the button of the bottom bar.");?>&nbsp;<a href="https://www.w3schools.com/w3css/w3css_colors.asp" target="_blank">W3.CSS Colors</a></em></td>
				</tr>
			</table>
			<div class="bouton fr" onClick="f_save_cookiebar();" title="<?php echo T_("Save settings");?>"><?php echo T_("Save");?></div>
			<div class="clear"></div>
		</div>
		<?php break;
		// ********************************************************************************************
		case 'save':
		$a = array();
		if(!empty($_POST['typ'])) $a['typ'] = strip_tags($_POST['typ']);
		if(!empty($_POST['tex'])) $a['tex'] = strip_tags($_POST['tex']);
		if(!empty($_POST['mor'])) $a['mor'] = strip_tags($_POST['mor']);
		if(!empty($_POST['url'])) $a['url'] = (strpos($_POST['url'],'//')===false?'//':'').strip_tags($_POST['url']);
		if(!empty($_POST['btn'])) $a['btn'] = strip_tags($_POST['btn']);
		if(!empty($_POST['cco'])) $a['cco'] = str_replace("'","&apos;",strip_tags($_POST['cco']));
		if(!empty($_POST['co1'])) $a['co1'] = strip_tags($_POST['co1']);
		if(!empty($_POST['co2'])) $a['co2'] = strip_tags($_POST['co2']);
		$out = json_encode($a);
		if(file_put_contents('../../data/cookiebar.json', $out)) echo T_('Backup performed');
		else echo '!'.T_('Impossible backup');
		break;
		// ********************************************************************************************
	}
	clearstatcache();
	exit;
}
?>

<?php
	include('config.php');
	
	/*if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com/login", true, 302);
		exit;
	}*/
	
	$files = array(
		'http://gamemaker.mooo.com/locale/af_ZA.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/ar_SA.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/da_DK.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/de_DE.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/el_GR.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/en_US.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/es_ES.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/fr_FR.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/fy_NL.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/he_IL.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/id_ID.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/it_IT.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/nl_NL.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/nn_NO.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/pl_PL.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/pt_PT.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/ru_RU.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/sv_SE.utf8/LC_MESSAGES/messages.po',
		'http://gamemaker.mooo.com/locale/zh_CN.utf8/LC_MESSAGES/messages.po'
	);
	
	$content_source = "locale/$language/LC_MESSAGES/messages_new.po";
	$content_main = str_replace("\r",'',file_get_contents($content_source));
	if (!strlen($content_main)||filemtime("locale/$language/LC_MESSAGES/messages.po")>filemtime("locale/$language/LC_MESSAGES/messages_new.po")) {
		$content_source = "locale/$language/LC_MESSAGES/messages.po";
		$content_main = str_replace("\r",'',file_get_contents($content_source));
	}
	$matches = array();
	preg_match('/^(#.*?(?:\n#.*?)*?)\n[^#]/',$content_main,$matches);
	if (sizeof($matches)>=2) {
		$content_header = $matches[1];
		$content_main = substr($content_main,strlen($content_header)+1);
	} else {
		$content_header = '';
	}
	
	require_once('vendor/autoload.php');
	$translations  = Gettext\Translations::fromPoFile($content_source);
	$translations_str = $translations->toJsonString();
	$translations_str = str_replace('"":{','',$translations_str);
	$translations_str = substr($translations_str,0,strlen($translations_str)-1);
	
	if (!empty($_POST)) {
		$_POST['language']['url'] = "http://gamemaker.mooo.com/locale/$language/LC_MESSAGES/messages.po";
		$errors = array();
		
		if (empty($_POST['language']['url'])) {
			$errors['name'] = 'Please choose a language URL.';
		}
		
		if (empty($_POST['language']['content'])&&empty($_POST['language']['alt_content'])) {
			$errors['description'] = 'Please enter content.';
		}
		
		if (empty($errors)) {
			if (!empty($_POST['language']['alt_content'])) {
				foreach($_POST['language']['alt_content'] as $key=>$val) {
					$translation = $translations->find(null,$_POST['language']['alt_content'][$key][0]);
					if ($translation) {
						$translation->setTranslation($_POST['language']['alt_content'][$key][1]);
						array_shift($_POST['language']['alt_content'][$key]);
						array_shift($_POST['language']['alt_content'][$key]);
						$translation->setPluralTranslations($_POST['language']['alt_content'][$key]);
					}
				}
				$_POST['language']['content'] = $translations->toPoString();
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			$author = !isset($_SESSION['username']) ? $ip : $_SESSION['username'];
			$url = $con->real_escape_string($_POST['language']['url']);
			$content = "# Last change at ".date('Y-m-d H:i:s')." by $author (changes automatically, log in to show your name)\r\n\r\n{$_POST['language']['content']}";
			
			$curl = curl_init($url);

			curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

			//curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS,$content);

			$curl_response = curl_exec($curl);
			$_SESSION['message'] = '<pre>'.$curl_response.'</pre>';
		}
	}
	
	$page_title = 'Language updater';
	include('default-top.php');
?>
				<h2>Language updater</h2>
				<p>
					Modify language files to correct words and to add words.<br>
					Tip: use a utility like Poedit or Open Source Translation Database.
				<div class="container-lt" style="min-height: 200px; overflow: auto; float: none;">
					<div class="container-title-lt">Language details</div>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
					<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
					<form action="<?php echo $language_url; ?>/language-updater" enctype="multipart/form-data" method="post">
						<table class="upload-form">
							<col width="120px" />
							<tr>
								<td>
									<label for="language_url"><strong>URL:</strong></label>
								</td>
								<td>
									<select id="language_url" name="language[url]" disabled="disabled">
										<option value="">== Select a flag icon from the top right of the page ==</option>
<?php
	foreach($files as $file) {
?>
										<option <?php if ((!empty($_POST['language']['url'])&&$_POST['language']['url']==$file)||strstr($file,$language)) echo 'selected="selected" '; ?>value="<?php echo $file; ?>"><?php echo $file; ?></option>
<?php
	}
?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="language_header"><strong>Extra info:</strong></label>
								</td>
								<td>
									<textarea id="language_header" name="language[header]" cols="40" rows="<?php echo substr_count($content_header,"\n")+1; ?>" disabled="disabled" wrap="off"><?php if (!empty($content_header)) echo $content_header; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="language_content"><strong>Content:</strong></label>
								</td>
								<td>
									<textarea id="language_content" name="language[content]" cols="40" rows="<?php echo substr_count($content_main,"\n")+2; ?>" wrap="off" <?php if (isset($errors['description'])) echo 'class="redfield" '; ?>><?php /*if (!empty($_POST['language']['description'])) echo $_POST['language']['description']; else*/if (!empty($content_main)) echo $content_main; ?></textarea>
									<p>
										NOTE: You need to choose a flag icon first at the top of this page.
									<p>
										Try out the new language updater if you see it below.<br>
										It's done now, but if you encounter any problems contact me (<a href="/users/Yambam">Yambam</a>). ;)
									<p>
										Use TAB on your keyboard to go to and select the text in the next cell and SHIFT + TAB to go to the previous cell.
									<table id="language-updater"><col width="25%" /></table>
									<script>
										document.getElementById('language_content').style.display = 'none';
										
										var translations = <?php echo $translations_str; ?>;
										var num = Object.keys(translations.messages).length;
										if (translations['plural-forms']!=undefined) {
											var nplurals = parseInt(translations['plural-forms'].substring(9,10));
										} else {
											var nplurals = 2;
										}
										if (nplurals==2) {
											var singularplural = ['Singular','Plural'];
										} else {
											var singularplural = ['<abbr title="When no plurals are needed, just fill in the singular.">Singular / Zero</abbr>','<br>One','<br>Two','<br>3-10','<br>11-99','100+<br><abbr title="Last digit 0, 1 or 2.">^[0-2]</abbr>'];
										}
										for (var i=0; i<num+1; i++) {
											var row = document.getElementById('language-updater').insertRow(-1);
											for (var j=0; j<nplurals+1; j++) {
												var letter = String.fromCharCode("A".charCodeAt(0)+j-1);
												var cell = row.insertCell(-1);
												if (i==0) {
													if (j==0) {
														cell.innerHTML = '';
													} else {
														cell.innerHTML = singularplural[j-1];
													}
												} else if (j==0) {
													cell.innerHTML = Object.keys(translations.messages)[i-1];
													
													input = document.createElement('input');
													input.id = letter+i;
													input.type = 'hidden';
													input.name = 'language[alt_content]['+(i-1).toString()+'][0]';
													input.value = Object.keys(translations.messages)[i-1];
													cell.appendChild(input);
												} else {
													input = document.createElement('textarea');
													input.id = letter+i;
													input.name = 'language[alt_content]['+(i-1).toString()+']['+j.toString()+']'; //encodeURIComponent(Object.keys(translations.messages)[i-1])+']
													input.cols = '40';
													input.rows = '1';
													var extra = 0;
													if (j-1<Object.values(translations.messages)[i-1].length) {
														input.innerHTML = Object.values(translations.messages)[i-1][j-1];
													} else {
														input.disabled = 'disabled';
														input.style.resize = 'none';
														extra = 4;
													}
													cell.appendChild(input);
													input.style.height = '12px';
													input.style.height = Math.max(input.scrollHeight+extra,cell.offsetHeight-4+extra).toString()+'px';
												}
											}
										}

										/*var DATA={}, INPUTS=[].slice.call(document.getElementById('language-updater').querySelectorAll("textarea"));
										INPUTS.forEach(function(elm) {
											elm.onfocus = function(e) {
												e.target.innerHTML = localStorage[e.target.id] || "";
											};
											elm.onblur = function(e) {
												localStorage[e.target.id] = e.target.innerHTML;
												Object.values(translations.messages)[parseInt(e.target.id.substring(1))-1] = e.target.innerHTML;
												document.getElementById('language_alt_content').value = JSON.stringify(translations);
												//computeAll();
											};
											var getter = function() {
												var value = localStorage[elm.id] || "";
												if (value.charAt(0) == "=") {
													with (DATA) return eval(value.substring(1));
												} else { return isNaN(parseFloat(value)) ? value : parseFloat(value); }
											};
											Object.defineProperty(DATA, elm.id, {get:getter});
											Object.defineProperty(DATA, elm.id.toLowerCase(), {get:getter});
										});
										/*(window.computeAll = function() {
											INPUTS.forEach(function(elm) { try { elm.innerHTML = DATA[elm.id]; } catch(e) {} });
										})();*/
										
										textareas = document.getElementsByTagName('textarea');
										for (var i=0; i<textareas.length; i++){
											textareas[i].addEventListener('focus', function (e) {
												var element = this;
												var ev = function (e) {
													var code = (e.keyCode ? e.keyCode : e.which);
													if (code == 9 && document.activeElement == element ) {
														element.select();
													}
													
													e.target.removeEventListener(e.type, arguments.callee);
												};
												window.addEventListener('keyup', ev);
												//window.setTimeout(ev, 200);
											});
										};
									</script>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input name="commit" type="submit" value="Submit" style="display: block; margin: 0 auto; width: 80px;" />
								</td>
							</tr>
						</table>
					</form>
				</div>
<?php
	include('default-bottom.php');
?>

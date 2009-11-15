<html>
<head>
<title>Phoebe &amp; Nathan's Advent 2008</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
	
	$action = isset($_POST['action']) ? $_POST['action'] : isset($_GET['action']) ? $_GET['action'] : 'defaultAction';

?>
<?php

	switch ($action) {
	
		case 'editCaption':
			break;
			
		case 'submitCaption':
		
			$to = "phoebe@mooremail.co.uk";
			$day = min(max(1, intval(isset($_POST['day']) ? $_POST['day'] : 1)), 25);
			$caption = isset($_POST['caption']) ? stripslashes(substr($_POST['caption'], 0, 255)) : '';
			$subject = "Caption Competition 2008 - Day {$day}";
			$name = isset($_POST['name']) ? stripslashes(substr($_POST['name'], 0, 60)) : '';
			$email = isset($_POST['email']) ? stripslashes(substr($_POST['email'], 0, 100)) : '';
			$from = "From: {$name} <{$email}>";
			
			mail($to, $subject, $caption, $from);
			break;
	
		case 'defaultAction':
		default:
			break;
	
	}

?>
<?php

	function caption($day) {

		$path = $_SERVER['DOCUMENT_ROOT'] . '/images/2008/captions/' . sprintf('%02d', $day) . '.html';
		
		if (is_file($path)) {
		
			$caption = '';
			$fp = @fopen($path, 'rb');
			
			if ($fp) {
			
				while (!feof($fp)) {
					$caption .= fread($fp, 1024);
				}
				
				fclose($fp);
			
			}
			
			return $caption;
		
		} else {
			return '&nbsp;';
		}
	
	}

	echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n";
	echo "<!--\n\n";
	echo "var photoCaptions = new Array();\n";
	
	if (time() < mktime(0, 0, 0, 12, 26, 2008)) {
		$n = intval(date('j'));
	} else {
		$n = 25;
	}
	
	for ($i = 1; $i <= $n; $i++) {
		echo "photoCaptions[{$i}] = \"" . rawurlencode(caption($i)) . "\";\n";
	}
	
	echo "\n";
	
	$preload = array();
	
	for ($i = 1; $i <= $n; $i++) {
		$preload[] = "'/images/2008/days/" . sprintf('%02d', $i) . "_d.gif'";
	}
	
	echo "function PX_preloadImages() {\n";
	echo "\tMM_preloadImages(" . implode(',', $preload) . ");\n";	
	echo "}\n\n";
	echo "-->\n";
	echo "</script>\n";

?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function MM_setTextOfLayer(objName,x,newText) { //v4.01
  if ((obj=MM_findObj(objName))!=null) with (obj)
    if (document.layers) {document.write(unescape(newText)); document.close();}
    else innerHTML = unescape(newText);
}

function MM_nbGroup(event, grpName) { //v6.0
  var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])? args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) {
      img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr)
      for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<style type="text/css">
<!--
body {
	font: 10px Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	background: #000000;
	margin: 0px;
	padding: 0px;
}
td {
	font-size: 10px;
}
#Caption {
	background: #336633;
	padding: 2px 4px;
}
select {
	margin: 0px;
	font: 10px Verdana, Arial, Helvetica, sans-serif;
}
form {
	margin: 0px;
}
textarea, input {
	margin: 0px;
	font: 10px Verdana, Arial, Helvetica, sans-serif;
}
#CaptionBackground {
	background: #336633;
	width: 498px;
	height: 388px;
}
#CaptionForm {
	padding: 20px;
}
#CaptionResponse {
	padding: 20px;
}
h4 {
	font-size: 10px;
	font-weight: bold;
	margin: 0px;
	padding: 0px;
}
.label {
	margin: 10px 0px 5px;
	padding: 0px;
}
.button {
	margin: 20px 0px 0px;
	padding: 0px;
}
#Balloon {
	text-align: center;
	padding: 75px;
}
#PhotoBkgnd {
  background-color: #99CC33;
}
-->
</style>
</head>

<body onLoad="PX_preloadImages();MM_preloadImages('/images/2008/buttons/caption_o.gif','/images/2008/buttons/email_o.gif')">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>

<table width="498" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td valign="top"><img src="/images/titles/2008.gif" alt="Phoebe &amp; Nathan's Advent 2008" width="330" height="21"></td>
<td align="right" valign="top"><a href="mailto:phoebe@mooremail.co.uk" onMouseOver="MM_swapImage('EmailButton','','/images/2008/buttons/email_o.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/images/2008/buttons/email.gif" alt="Email" name="EmailButton" width="34" height="17" border="0" id="EmailButton"></a></td>
</tr>
<tr>
<td colspan="2"><img src="/images/shim/s.gif" width="498" height="5"></td>
</tr>
<?php 

	if (time() < mktime(0, 0, 0, 12, 26, 2008)) {
		$day = intval(date('j'));
	} else {
		$day = 25;
	}

?>
<?php if ($action == 'defaultAction'):?>
<tr>
<td colspan="2">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<?php for ($i = 1; $i <= 25; $i++) :?>
<?php $name = sprintf('%02d', $i);?>
<?php if (($i <= $day) && (is_file("{$_SERVER['DOCUMENT_ROOT']}/images/2008/photos/{$name}.jpg"))) :?>
<td><a href="#" onClick="MM_nbGroup('down','group1','Day<?=$name;?>','/images/2008/days/<?=$name;?>_d.gif',1);MM_swapImage('Photo','', '/images/2008/photos/<?=$name;?>.jpg',1);MM_setTextOfLayer('Caption','', photoCaptions[<?=$i;?>]);return false;"><img src="/images/2008/days/<?=$name;?>_o.gif" name="Day<?=$name;?>" width="18" height="18" border="0" id="Day<?=$name;?>" alt="<?=$name;?>"></a></td>
<?php else :?>
<td><img src="/images/2008/days/<?=$name;?>.gif" width="18" height="18" border="0" alt="<?=$name;?>"></td>
<?php endif;?>
<?php if ($i < 25) :?>
<td><img src="/images/shim/s.gif" width="2" height="18"></td>
<?php endif;?>
<?php endfor;?>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="/images/shim/s.gif" width="498" height="2"></td>
</tr>
<tr>
<td colspan="2" id="PhotoBkgnd"><img src="/images/shim/s.gif" alt="Photo" name="Photo" width="498" height="350" id="Photo"></td>
</tr>
<tr>
<td colspan="2"><img src="/images/shim/s.gif" width="498" height="2"></td>
</tr>
<tr>
<td colspan="2"><div id="Caption">&nbsp;</div></td>
</tr>
<?php elseif ($action == 'editCaption'):?>
<tr>
<td colspan="2">
<div id="CaptionBackground">
<div id="CaptionForm">
<form action="/advent2008.php?action=submitCaption" method="post" name="CaptionForm" onSubmit="MM_validateForm('name','','R','email','','RisEmail','caption','','R');return document.MM_returnValue">
<div><img src="/images/2008/titles/caption_comp.gif" width="208" height="22"></div>
<div class="label"><strong>Day</strong>
<select name="day" id="day">
<?php for ($i = 1; $i <= $day; $i++):?>
<option value="<?=sprintf('%02d', $i);?>"><?=sprintf('%02d', $i);?></option>
<?php endfor;?>
</select>
</div>
<h4 class="label">Your Caption</h4>
<div>
<textarea cols="40" rows="8" name="caption" style="width: 350px"></textarea>
</div>
<h4 class="label">Your Name</h4>
<div>
<input type="text" name="name" value="" size="40" style="width: 350px">
</div>
<h4 class="label">Your Email Address</h4>
<div>
<input type="text" name="email" value="" size="40" style="width: 350px">
</div>
<div class="button">
<input type="submit" name="submit" value="Send your caption"></div>
</form>
</div>
</div>
</td>
</tr>
<?php elseif ($action == 'submitCaption'):?>
<tr>
<td colspan="2">
<div id="CaptionBackground">
<div id="CaptionResponse">
<div><img src="/images/2008/titles/caption_comp.gif" width="208" height="22"></div>
<div id="Balloon"><a href="/advent2008.php"><img src="/images/2008/titles/caption_sent.gif" width="209" height="155" border="0"></a></div>
</div>
</div>
</td>
</tr>
<?php endif;?>
<tr>
<td colspan="2"><img src="/images/shim/s.gif" width="498" height="5"></td>
</tr>
<tr>
<td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<?php if ($action == 'defaultAction'):?>
<a href="/advent2008.php?action=editCaption"><img src="/images/2008/buttons/caption.gif" alt="Caption Competition" name="CaptionButton" width="140" height="14" border="0" id="CaptionButton" onMouseOver="MM_swapImage('CaptionButton','','/images/2008/buttons/caption_o.gif',1)" onMouseOut="MM_swapImgRestore()"></a>
<?php else:?>
&nbsp;
<?php endif;?>
</td>
<td align="right">
<form name="MenuForm" method="get" action="">
<select name="select" onChange="MM_jumpMenu('parent',this,0)">
<option selected>Select...
<option>--------------------
<option value="advent2008.php">Phoebe &amp; Nathan's Advent 2008
<option value="advent2007.php">Phoebe &amp; Nathan's Advent 2007
<option value="advent2006.php">Phoebe &amp; Nathan's Advent 2006
<option value="advent2005.php">Phoebe &amp; Nathan's Advent 2005
<option value="advent2004.php">Phoebe &amp; Nathan's Advent 2004
<option value="advent2003.php">Phoebe &amp; Nathan's Advent 2003
<option value="advent2002.htm">Phoebe's Advent 2002
<option value="phoebeistwo.htm">Phoebe is Two
<option value="first99.htm">Going Going Gone
<option value="outtakes.htm">Christmas Card 2001 Outtakes
<option value="advent2001.htm">Phoebe's Advent 2001
<option value="advent2000.htm">Phoebe's Advent 2000
</select>
</form></td>
</tr>
</table>
</td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>

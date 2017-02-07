<?php 
$fontname = 'futura/futura medium bt.ttf';
$fontfonction = 'futura/futura light bt.ttf';
// controls the spacing between text
$i=30;
//PNG image Compression level 0-9
$quality = 9;

function create_image($user) {
	global $fontname;	
	global $fontfonction;	
	global $quality;
	
	$file = "signatures/".md5($user[0]['name'].$user[1]['name']).".png";
	
	// if the file already exists dont create it again just serve up the original	
	if (!file_exists($file)) {	
		// Creation de notre rectangle
		$im = imagecreatetruecolor(400, 45);
			
		// Creation de quelques couleurs
		$white = imagecolorallocate($im, 255, 255, 255); // blanc
		$black = imagecolorallocate($im, 0, 0, 0); // noir
		
		imagefilledrectangle($im, 0, 0, 399, 49, $white); // Remplissage du rectangle en blanc
		
		
		imagettftext($im, $user[0]['font-size'], 0, 0, 20, $black, $fontname, $user[0]['name']);
		imagettftext($im, $user[1]['font-size'], 0, 0, 40, $black, $fontfonction, $user[1]['name']);
			
		// create the image
		imagepng($im, $file, $quality);
		imagedestroy($im);
			
	}
	return $file;
}

$user = array(
	array(
		'name'=> '[COLLABORATEUR]', 
		'font-size'=>'18'),
			
	array(
		'name'=> '[FONCTION]',
		'font-size'=>'16')
			
);

if(isset($_GET['submit'])){
	
	$error = array();
	
	if(strlen($_GET['name'])==0){
		$error[] = 'Svp entrez votre nom';
	}
	
	if(strlen($_GET['job'])==0){
		$error[] = 'Svp entrez votre fonction';
	}		
		
	if(count($error)==0){
		$user = array(
			array(
				'name'=> $_GET['name'], 
				'font-size'=>'18'
				),
			array(
				'name'=> $_GET['job'],
				'font-size'=>'16',
			)
		);
	}
		
}

$filename = create_image($user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>McCANN Signatures</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<style>
input{
	border:1px solid #ccc;
	padding:8px;
	font-size:14px;
	width:300px;
	}
	
.submit{
	width:110px;
	background-color:#FF6;
	padding:3px;
	border:1px solid #FC0;
	margin-top:20px;}	

</style>

</head>

<body>

<p>Vous pouvez modifier la signature ci dessous en rentrant vos données. <br />
Ceci génère un code HTML que vous pourrez copier et sauvegarder.</p>

<div class="dynamic-form">
<form action="" method="get">
<label>Nom</label>
<input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" name="name" maxlength="40" placeholder="Name"><br/><br/>
<label>Fonction</label>
<input type="text" value="<?php if(isset($_POST['job'])){echo $_POST['job'];}?>" name="job" placeholder="Job Title"><br/><br/>
<input name="submit" type="submit" class="btn btn-primary" value="Générer la signature HTML" />
</form>
</div>

<table border="0" cellpadding="0" cellspacing="0" width="65%" >
	<tr>
		<th width="180" border="0" cellpadding="0" cellspacing="0" style="text-align:center" rowspan="4">
			<img src="http://digex.tech/mccann/new-logo-douala.png" width="175" height="148.75" />
		</th>
		<th style="padding:10px 5px;">&nbsp;&nbsp;&nbsp;</th>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td style="padding-bottom: 0px; padding-left: 0px;" class="fancy-font">
				<img src="<?php echo $filename;?>?id=<?php  echo rand(0,1292938);?>"  />
				<!--<strong style="font-family: 'futura bold'; font-size: 18px"><?php if(isset($_GET['name'])){echo $_GET['name'];}else echo "[COLLABORATEUR]"; ?></strong>
				<br>
				<span style="font-size: 16px"><?php if(isset($_GET['job'])){echo $_GET['job'];}else echo "[FONTION]"; ?></span>-->
			
			</div>
		</td>
	</tr>
	<tr>
		<td width="770" style="word-break:normal; padding:5px; padding-left : 0;  vertical-align: middle;" height="40" valign="middle">
			<table>
			<tbody>
			<tr>
			<td><a style="color:black;text-decoration: none; font-family: 'Calibri'; font-size: 11px;" href="https://www.facebook.com/McCann-Douala-183130485072196/">
			<img src="http://digex.tech/mccann/face.png" />
			</a></td>
			<td><a href="https://www.youtube.com/channel/UChIXkBEoj_7-QSq_ZI9Umcg"><img src="http://digex.tech/mccann/you.png" /></a></td>
			<td><a style="color:black;text-decoration: none; font-family: 'Calibri'; font-size: 11px; cursor : none;" href=""><img src="http://digex.tech/mccann/phone2.png" /></a></td>
			<td><a style="color:black;text-decoration: none; font-family: 'Calibri'; font-size: 11px;" href="https://www.google.fr/maps/place/McCANN+Douala/@4.0444425,9.683916,17z/data=!3m1!4b1!4m5!3m4!1s0x106112fb09dcca83:0xbb93590cfd57ca73!8m2!3d4.0444425!4d9.6861047!5m1!1e1">
			<img src="http://digex.tech/mccann/location.png" />
			</a></td>
			</tr>
			</tbody>
			</table>
			
		</td>
	</tr>
	<tr>
		<td style="font-family:Arial, sans-serif;font-size:14px;overflow:hidden;word-break:normal;text-align:center"><img src="http://digex.tech/mccann/douala.png" width="80" height="25.3" style="width:80px" /></td>
		<td style="word-break:normal"></td>
	</tr>
</table>

</body>
</html>
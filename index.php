<?php 
$fontname = 'futura/futura medium bt.ttf';
$fontfonction = 'futura/futura light bt.ttf';
$fonttel = 'futura/Futura Medium Italic font.ttf';
$urlimages = 'http://digex.tech/mccann/signature_generator/';

// controls the spacing between text
$i=25;
//PNG image Compression level 0-9
$quality = 9;

function create_image($user) {
	global $fontname;	
	global $fontfonction;	
	global $fonttel;	
	global $quality;
	
	$file = "signatures/".md5($user[0]['name'].$user[1]['name'].$user[2]['name']).".png";
	
	// if the file already exists dont create it again just serve up the original	
	//if (!file_exists($file)) {	
		// Creation de notre rectangle
		$im = imagecreatetruecolor(300, 70);
			
		// Creation de quelques couleurs
		$white = imagecolorallocate($im, 255, 255, 255); // blanc
		$black = imagecolorallocate($im, 0, 0, 0); // noir
		$grey = imagecolorallocate($im, 136, 129, 163); // noir
		
		imagefilledrectangle($im, 0, 0, 299, 69, $white); // Remplissage du rectangle en blanc
		
		
		imagettftext($im, $user[0]['font-size'], 0, 0, 16, $black, $fontname, $user[0]['name']);
		imagettftext($im, $user[1]['font-size'], 0, 0, 41, $black, $fontfonction, $user[1]['name']);
		imagettftext($im, $user[2]['font-size'], 0, 0, 65, $black, $fontfonction, $user[2]['name']);
			
		// create the image
		imagepng($im, $file, $quality);
		imagedestroy($im);
			
	//}
	return $file;
}

$user = array(
	array(
		'name'=> '[COLLABORATEUR]', 
		'font-size'=>'14'),
			
	array(
		'name'=> '[FONCTION]',
		'font-size'=>'12'),
			
	array(
		'name'=> '[CONTACT]',
		'font-size'=>'10')
			
);

if(isset($_GET['submit'])){
	
	$error = array();
	
	if(strlen($_GET['name'])==0){
		$error[] = 'Svp entrez votre nom';
	}
	
	if(strlen($_GET['job'])==0){
		$error[] = 'Svp entrez votre fonction';
	}
	if(strlen($_GET['tel'])==0){
		$error[] = 'Svp entrez votre fonction';
	}	
		
	if(count($error)==0){
		$user = array(
			array(
				'name'=> $_GET['name'], 
				'font-size'=>'14'
				),
			array(
				'name'=> $_GET['job'],
				'font-size'=>'12',
			)
			,
			array(
				'name'=> $_GET['tel'],
				'font-size'=>'10',
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
	<div id="container" style="opacity: 1; display: block;">
		<header class="clearfix">
		  <div id="headerimg">
		   <a title="Truth Well Told" target="_blank" href="http://truthcentral.mccann.com/" id="slogan">
			<img alt="Truth Well Told" src="http://www.mccann.com.co/wp-content/themes/mccann-au/images/logos/slogan.png" style="position: absolute; top: 0px; z-index: 7; opacity: 1; width: 78px; height: 79px; left: 0px; display: block;">
			</a>
		<!--
		   <a href="http://www.mccann.com.co">
			<img src="http://www.mccann.com.co/wp-content/themes/mccann-au/images/logo.png" class="mccann-logo" />
		   </a>
		-->
		   <h1>
			<a rel="nofollow" href="http://www.mccanndouala.com" class="title ir">McCANN Afrique</a>
		   </h1>
		  </div>
		  <!--<div role="navigation" id="access">-->
		  <div role="navigation" id="nav-container" class="clearfix">    
			<div id="nav-wrapper" class="clearfix">
				<ul id="nav" class="menu equalize sf-menu clearfix sf-js-enabled sf-shadow">
					<li id="menu-item-274" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a href="?pays=abidjan">Abidjan</a></li>
					<li id="menu-item-275" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="?pays=douala">Douala</a></li>
					<li id="menu-item-275" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="?pays=worldwide">Worldwide</a></li>
				</ul>
			</div>
		</div>
	</header>
<p>Vous pouvez modifier la signature ci dessous en rentrant vos données. <br />
Ceci génère un code HTML que vous pourrez copier et sauvegarder.</p>

<div class="dynamic-form">
	<form action="" method="get">
		<table>
			  <tr>
				<td><label>Nom</label></td>
				<td><input type="text" value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>" name="name" maxlength="40" placeholder="Name"></td>
			  </tr>
			  <tr>
				<td><label>Fonction</label></td>
				<td><input type="text" value="<?php if(isset($_GET['job'])){echo $_GET['job'];}?>" name="job" placeholder="Job Title"></td>
			  </tr>
			  <tr>
				<td><label>Contact</label></td>
				<td><input type="text" value="<?php if(isset($_GET['tel'])){echo $_GET['tel'];}?>" name="tel" placeholder="Contact"></td>
			  </tr><tr>
				<td></td>
				<td><input name="submit" type="submit" class="btn btn-primary" value="Générer la signature HTML" /></td>
			  </tr>
		</table>
		<input type="hidden" name="pays" value="<?php if(isset($_GET['pays'])){echo $_GET['pays'];}?>" />
	</form>
</div>
<b>Aperçu :</b>
<hr size="100%">
<table border="0" cellpadding="0" cellspacing="0" width="65%" >
	<tr>
		<th width="180" border="0" cellpadding="0" cellspacing="0" style="text-align:center" rowspan="4">
		<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<img src="<?php echo $urlimages; ?>new-logo-douala.png" width="120" height="104" />
			<?php } else { ?>
				<img src="<?php echo $urlimages; ?>new-logo-abidjan.png" width="120" height="104" />
			<?php }
		} else { 
		?>
			<img src="<?php echo $urlimages; ?>new-logo-douala.png" width="120" height="104" />
		<?php } ?>
		</th>
		<th style=""></th>
	</tr>
	<tr>
		<td style="padding-left : 10px">
			<img style="margin-left: 4px; margin-top: <?php if(@$_GET['pays'] == 'douala') echo "-6"; else echo "2"; ?>px;" src="<?php echo $filename;?>?id=<?php  echo rand(0,1292938);?>"  />
			
		</td>
	</tr>
	<tr>
		<td style="padding-bottom: 0px; padding-left: 0px;" class="fancy-font"></td>
	</tr>
	<tr>
		<td width="770" style="padding:0px; padding-left : 0;  vertical-align: middle;" height="12" valign="middle">
						
		</td>
	</tr>
	<tr>
		<td style="font-family:Arial, sans-serif;font-size:14px;overflow:hidden;word-break:normal;text-align:center">
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<img src="<?php echo $urlimages; ?>douala.png" width="80" height="25.3" style="width:80px" />
			<?php } else { ?>
				<img src="<?php echo $urlimages; ?>abidjan.png" width="80" height="25.3" style="width:80px" />
			<?php }
			} else { 
			?>
				<img src="<?php echo $urlimages; ?>douala.png" width="80" height="25.3" style="width:80px" />
			<?php } ?>
		</td>
		<td style="word-break:normal">
			<table style="margin-bottom : 0px;padding-left : 10px">
			<tbody>
			<tr>
			<td>
				
				<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/McCann-Douala-183130485072196/"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face.png" />
			</a><?php } else { ?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/Entreprise.comm?fref=ts"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face-abidjan.png" /></a>
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/McCann-Douala-183130485072196/"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face.png" />
			</a><?php } ?>
			</td>
			<td><a href="https://www.youtube.com/channel/UChIXkBEoj_7-QSq_ZI9Umcg"><img src="<?php echo $urlimages; ?>you.png" /></a></td>
			<td>
				<?php if(isset($_GET['pays'])){
				
				if($_GET['pays'] == 'douala') { ?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone2.png" /></a>
				<?php } else { ?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone-abidjan.png" /></a>
				<?php }
				} else { 
				?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone2.png" /></a>
				<?php } ?>
			</td>
			<td>
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Douala/@4.0444425,9.683916,17z/data=!3m1!4b1!4m5!3m4!1s0x106112fb09dcca83:0xbb93590cfd57ca73!8m2!3d4.0444425!4d9.6861047!5m1!1e1"><img src="<?php echo $urlimages; ?>location.png" /></a>
			<?php } else { ?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Abidjan/@5.3366183,-3.9962643,17z/data=!3m1!4b1!4m5!3m4!1s0xfc1eb823526c619:0x9669cb5fd7bcd491!8m2!3d5.336613!4d-3.9940756!5m1!1e1"><img src="<?php echo $urlimages; ?>location-abidjan.png" />
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Douala/@4.0444425,9.683916,17z/data=!3m1!4b1!4m5!3m4!1s0x106112fb09dcca83:0xbb93590cfd57ca73!8m2!3d4.0444425!4d9.6861047!5m1!1e1"><img src="<?php echo $urlimages; ?>location.png" /></a>
			<?php } ?>
			</td>
			<td>
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none;" href="http://mccann-afrique.com/"><img src="<?php echo $urlimages; ?>site.png" /></a>
			<?php } else { ?>
				<a style="color:black;text-decoration: none;" href="http://mccannlabs.com/abidjan/"><img src="<?php echo $urlimages; ?>site.png" />
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none;" href="http://mccann-afrique.com/"><img src="<?php echo $urlimages; ?>site.png" /></a>
			<?php } ?>
			</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
</table>
<br />
<b>HTML à copier : </b> <button class="btn" data-clipboard-action="copy" data-clipboard-target="#div-target">Copier l'HTML</button>
<hr size="100%">
<script src="js/clipboard.min.js"></script>
	<script>
	var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
	</script>
<div  id="div-target" style="background-color: whitesmoke; border: 1px solid #ccc; overflow: hidden; padding : 5px">
<xmp>
<table border="0" cellpadding="0" cellspacing="0" width="65%" >
	<tr>
		<th width="180" border="0" cellpadding="0" cellspacing="0" style="text-align:center" rowspan="4">
		<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<img src="<?php echo $urlimages; ?>new-logo-douala.png" width="120" height="104" />
			<?php } else { ?>
				<img src="<?php echo $urlimages; ?>new-logo-abidjan.png" width="120" height="104" />
			<?php }
		} else { 
		?>
			<img src="<?php echo $urlimages; ?>new-logo-douala.png" width="120" height="104" />
		<?php } ?>
		</th>
		<th style=""></th>
	</tr>
	<tr>
		<td style="padding-left : 10px;margin-top : 6px">
			<img style="margin-left: 4px; margin-top: <?php if($_GET['pays'] == 'douala') echo "0"; else echo "8"; ?>px;" src="<?php echo $urlimages . $filename;?>?id=<?php  echo rand(0,1292938);?>"  />
			
		</td>
	</tr>
	<tr>
		<td style="padding-bottom: 0px; padding-left: 0px;" class="fancy-font"></td>
	</tr>
	<tr>
		<td width="770" style="padding:0px; padding-left : 0;  vertical-align: middle;" height="12" valign="middle">
						
		</td>
	</tr>
	<tr>
		<td style="font-family:Arial, sans-serif;font-size:14px;overflow:hidden;word-break:normal;text-align:center">
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<img src="<?php echo $urlimages; ?>douala.png" width="80" height="25.3" style="width:80px" />
			<?php } else { ?>
				<img src="<?php echo $urlimages; ?>abidjan.png" width="80" height="25.3" style="width:80px" />
			<?php }
			} else { 
			?>
				<img src="<?php echo $urlimages; ?>douala.png" width="80" height="25.3" style="width:80px" />
			<?php } ?>
		</td>
		<td style="word-break:normal">
			<table style="margin-bottom : 0px;padding-left : 10px">
			<tbody>
			<tr>
			<td>
				
				<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/McCann-Douala-183130485072196/"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face.png" />
			</a><?php } else { ?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/Entreprise.comm?fref=ts"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face-abidjan.png" /></a>
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none; " href="https://www.facebook.com/McCann-Douala-183130485072196/"><img style="padding-top: 5px;" src="http://gen-signature.mccannlabs.com/face.png" />
			</a><?php } ?>
			</td>
			<td><a href="https://www.youtube.com/channel/UChIXkBEoj_7-QSq_ZI9Umcg"><img src="<?php echo $urlimages; ?>you.png" /></a></td>
			<td>
				<?php if(isset($_GET['pays'])){
				
				if($_GET['pays'] == 'douala') { ?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone2.png" /></a>
				<?php } else { ?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone-abidjan.png" /></a>
				<?php }
				} else { 
				?>
					<a style="color:black;text-decoration: none; cursor : none;" href=""><img src="<?php echo $urlimages; ?>phone2.png" /></a>
				<?php } ?>
			</td>
			<td>
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Douala/@4.0444425,9.683916,17z/data=!3m1!4b1!4m5!3m4!1s0x106112fb09dcca83:0xbb93590cfd57ca73!8m2!3d4.0444425!4d9.6861047!5m1!1e1"><img src="<?php echo $urlimages; ?>location.png" /></a>
			<?php } else { ?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Abidjan/@5.3366183,-3.9962643,17z/data=!3m1!4b1!4m5!3m4!1s0xfc1eb823526c619:0x9669cb5fd7bcd491!8m2!3d5.336613!4d-3.9940756!5m1!1e1"><img src="<?php echo $urlimages; ?>location-abidjan.png" />
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none;" href="https://www.google.fr/maps/place/McCANN+Douala/@4.0444425,9.683916,17z/data=!3m1!4b1!4m5!3m4!1s0x106112fb09dcca83:0xbb93590cfd57ca73!8m2!3d4.0444425!4d9.6861047!5m1!1e1"><img src="<?php echo $urlimages; ?>location.png" /></a>
			<?php } ?>
			</td>
			<td>
			<?php if(isset($_GET['pays'])){
			
			if($_GET['pays'] == 'douala') { ?>
				<a style="color:black;text-decoration: none;" href="http://mccann-afrique.com/"><img src="<?php echo $urlimages; ?>site.png" /></a>
			<?php } else { ?>
				<a style="color:black;text-decoration: none;" href="http://mccannlabs.com/abidjan/"><img src="<?php echo $urlimages; ?>site.png" />
			<?php }
			} else { 
			?>
				<a style="color:black;text-decoration: none;" href="http://mccann-afrique.com/"><img src="<?php echo $urlimages; ?>site.png" /></a>
			<?php } ?>
			</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
</table>
</xmp>
</div>
</div>
</body>
</html>
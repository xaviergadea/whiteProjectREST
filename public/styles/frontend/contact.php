<?php
	$submit=$_POST['Submit'];
	if($submit == Submit){
	$status = "OK";
	$email=$_POST['email'];
	$message=$_POST['message'];
	$subject=$_POST['subject'];
	$name=$_POST['name'];
	$phone=$_POST['phone'];

	$msg="";
	$msgerror="";
	//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);


if ( strlen($name) < 1 ){
	$msgerror=$msgerror."* your name field is missing<BR />";
	$status= "NOTOK";}	

if ( strlen($message) < 5 ){
	$msgerror=$msgerror."* your Comments field is blank must be more than 5 words<BR/>";
	$status= "NOTOK";}	


if (!stristr($email,"@") OR !stristr($email,".")) {
	$msgerror=$msgerror."* your email address is not correct<BR />";
	$status= "NOTOK";}   


if($status=="OK"){// echo $query;
	$headers="";
	$headers4="king4u_7@yahoo.com"; // Change this address within quotes to your address //
	$headers.="Reply-to:$email\n";
	$headers .= "From: $email\n";
	$headers .= "Errors-to: $headers4\n";
	$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
mail($headers4,$subject,"Contact Us <BR>
Name :$name
<BR>Email:$email
<br>Phoneno:$phone
<br>Comments: $message","$headers");
$msg="Thank you! your message has been sent we will contact you soon.";
}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Levos Clean and Minimal Website Template</title>
<style type="text/css">
<!--

html, 
body, 
.pageright, 
.pageleft 						{  min-height: 100%; width: 100%; height: 100%; overflow: hidden; }
.pageright 						{ position: fixed; top: 0; left: 0; }

-->

</style>
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel='stylesheet' media='screen' href='css/blue.css' />

<!-- Jquery -->
<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>

<!-- start : Accordion Menu Script -->


<!-- ToolTip-->
<script type="text/javascript" src="js/jquery.tipsy.js"></script>

<!-- Jscroolpane jscripts and css -->
<link rel="stylesheet" type="text/css" media="all" href="css/jScrollPane.css" />
<script type="text/javascript" src="js/mouse_wheel.js"></script>
<script type="text/javascript" src="js/jScrollPane.js"></script>

<!--Cufon -->
<script type="text/javascript" src="js/cufon/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon/Titillium.js"></script>

<script type="text/javascript" src="js/custom.js"></script>
<!--[if IE 6]>
<script src="DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* EXAMPLE */
  DD_belatedPNG.fix('*');
  
  /* string argument can be any CSS selector */
  /* .png_bg example is unnecessary */
  /* change it to what suits you! */
</script>
<![endif]--> 

</head>
<body>
<!-- .pageleft -->
<div class="pageleft">

	<!-- .content -->
	<div class="content">	
    	<!-- .logo -->
        <div class="logo">
			<a href="#"><img src="images/logo.png" alt="logo" /></a>
		</div>
        <!-- .logo -->
		
		<div class="clear"></div>
		
	    <!-- .main_menu -->
        <div class="main_menu">
	    <!-- Menu Lists -->
			<ul id="side-nav">		
				<li><a href="index.html" class="parent no-child current">Home</a></li>
				<li><a href="aboutus.html" class="parent no-child">About Us</a></li>
				<li><a href="portfolio.html" class="parent no-child">Portfolio</a></li>												
				<li><a href="gallery.html" class="parent no-child">Gallery</a></li>						
<li><a href="typography.html" class="parent no-child">Typography</a></li>
				<li><a href="#" class="parent">Dropdown Menu</a>
									<ul>
						<li><a href="#">Sub Menu</a></li>						
						<li><a href="#">Sub Menu</a></li>
						<li><a href="#">Sub Menu</a></li>										
						<li><a href="#">Sub Menu</a></li>
						<li><a href="#">Sub Menu</a></li>
					</ul>
				</li>
				<li><a href="blog.html" class="parent no-child">Blog</a></li>
				<li><a href="contact.php" class="parent no-child">Contact Us</a></li>						
			</ul>
		</div>
        <!-- .main_menu -->
		<div class="clear"></div>
		
			
		<!-- .footer -->		
		<div class="footer">
			
			<!-- .socialbar -->
			<div class="socialbar">
			<span>Follow us on the social network</span>
			<ul class="social">					
				<li><a href="#" title="Twitter" class="twitter"></a></li>				
				<li><a href="#" title="Facebook" class="facebook"></a></li>			
				<li><a href="#" title="Digg" class="digg"></a></li>
				<li><a href="#" title="Delicious" class="delicious"></a></li>	
				<li><a href="#" title="Flickr" class="flickr"></a></li>									
				<li><a href="#" title="RSS" class="rss"></a></li>
			</ul>
			</div>
			<!-- .socialbar -->
					
			<div class="clear"></div>
			
			<!-- .copyright -->
			<p>&copy; Copyright 2010. All Rights Reserved - <a href="#">www.domainname.com</a> - Privacy Policy</p>

		</div>
		<!-- .footer -->
	</div>
	<!-- .content -->

</div>
<!-- .pageleft -->	

<!-- .pageright -->
<div class="pageright">

	<!-- #contentwrap -->
	<div id="contentwrap">

		<!-- .scrollpanel -->
		<div class="scroll-pane">		

			<!-- START : .SUBHEADER -->
			<div class="subheader">	
			<h1>Contact Us</h1>	
			<h5 class="simple">Lorem ipsum dolor sit amet consectetur adipiscing elit.</h5>
			</div>	
			<!-- END : .SUBHEADER -->
			
<div class="half_width">
<h3>Postal Address</h3>
<p>Envato<br />
PO Box 21177<br />
Little Lonsdale St, Melbourne<br />
Victoria 8011 Australia
</p>
</div>

<div class="half_width last">
<h3>Street Address</h3>
<p>Envato<br />
Level 5, 140 Bourke St, Melbourne<br />
Victoria 3000 Australia</p>
</div>

<div class="divider"></div>

			
<h5>Lorem ipsum dolor sit amet consectetur adipiscing elit.</h5>
			<!-- Start: Contact form -->
               <div id="form">
				<?php if($msg) { ?><p><span class="info"><?php echo $msg; ?></span></p><?php } ?>
				<?php if($msgerror) { ?><p><span class="error"><?php echo $msgerror; ?></span></p><?php } ?>
				
						<form action="contact.php" method="post" id="contactform">
							<p><label>Name :</label>
							<input type="text" name="name" class="input" />	</p>
				
							<p>	<label>Email :</label>
							<input type="text" name="email" class="input" />	</p>
				
							<p><label>Phone :</label>
							<input type="text" name="phone" class="input" />	</p>
					
							<p>	<label>Subject :</label>
							<select name="subject">
								<option>Select one...</option>
								<option value="Crescento i want to buy">I want to buy this template</option>
								<option value="Crescento i need help">I need help</option>
							</select>	</p>
							<p><label>Comments :</label>
							<textarea name="message" rows="" cols=""></textarea>	</p>
			
						<div class="indent"> 
							<input type="hidden" name="Submit" value="Submit" />
							<input name="submit" class="submitbutton" type="image" src="images/submit_button.gif" value="Send Message"/>
						</div>
					</form>
	
				</div>	
				<!-- End: Contact form -->	
	

		
		</div>
		<!-- .scrollpanel -->
		<div class="clear"></div>

	</div>
	<!-- .contentwrap -->
</div>
<!-- .pageright -->

</body>
</html>
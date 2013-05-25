<html>
<head>
	<title>JumpLoader applet</title>
	<script language="javascript">
		/**
		* resize applet to fit client area
		* @param applet an applet to resize
		* @param dx a horizontal space to substract from client area width
		* @param dy a vertical space to substract from client area width
		*/
		function resizeApplet() {
			var applet = document.jumpLoaderApplet;
			var dx = 0;
			var dy = 7;
			var w_newWidth, w_newHeight;
			var w_maxWidth = 2600, w_maxHeight = 2200;
			var dx = 0;
			var dy = 2;
			if( navigator.appName.indexOf( "Microsoft" ) != -1 ) {
				w_newWidth = document.body.clientWidth;
				w_newHeight = document.body.clientHeight;
			} else {
				var netscapeScrollWidth = 15;
				w_newWidth = window.innerWidth - netscapeScrollWidth;
				w_newHeight = window.innerHeight - netscapeScrollWidth;
			}
			if( w_newWidth > w_maxWidth ) {
				w_newWidth = w_maxWidth;
			}
			if( w_newHeight > w_maxHeight ) {
				w_newHeight = w_maxHeight;
			}
			applet.width = w_newWidth - dx;
			applet.height = w_newHeight - dy;
			applet.setSize( w_newWidth - dx, w_newHeight - dy );
			//window.scroll( 0,0 );
		}
	</script>
</head>
<body
	leftmargin="0"
	topmargin="0"
	marginwidth="0"
	marginheight="0"
	onResize="resizeApplet()"
	onLoad="resizeApplet()"
>
	<applet id="jumpLoaderApplet" name="jumpLoaderApplet"
			code="jmaster.jumploader.app.JumpLoaderApplet.class"
			archive="jumploader_z_2.17.1.jar"
			width="800"
			height="600" mayscript>

                      <param name="uc_uploadUrl" value="/projects/ajax/addjarphoto/id/2"/>
	</applet>

</body>
</html>
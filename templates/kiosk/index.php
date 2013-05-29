<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
?>

<!DOCTYPE html>
<html>
<head>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> 
  <style type="text/css">
	body, html,ul { margin:0px; padding:0px; height:100%; }
	ul { list-style:none; }
	video { height:100%; width:100%; padding:0px; margin:0px; background:#000;}
	#container{
		width:100%;
		height:100%;
		position:relative;
	}

	#container ul{
		width:100%;
		height:100%;
		list-style:none outside none;
		position:relative;
		overflow:hidden;
	}
	  
	#container li:first-child{
		height:100%;
		opacity:1;
		position:absolute;
	}

	#container li{
		width:100%;
		height:100%;
		opacity:0;
		position:absolute;
		-webkit-transition: all 3s ease-in-out;
	}
	.show {
		z-index:999!important;
		opacity:1!important;

	}
  </style>
	<jdoc:include type="head" />
	

</head>
<body class="">
	
		
		<jdoc:include type="component" />
	

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39359298-5', '2win.co');
  ga('send', 'pageview');

</script>
</body>
</html>

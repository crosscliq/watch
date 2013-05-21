$(document).ready(function ()
{
	$('#findNowBtn').click(function( e )
	{
		$('#map').submit();
	});
	
	$('#findStoreInput').bind('keypress', function(e) 
  	{
	  	var code = (e.keyCode ? e.keyCode : e.which);
	  	if(code == 13) 
	  	{ 
		
		$('#map').submit();}
  	});
});



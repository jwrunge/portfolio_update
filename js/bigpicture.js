//Set up site alert
var alertDiv = "<div id='alertBlock'>" +
	"<div id='blackout'>" +
		"<div id='blowup_menu'>" +
			"<img id='btow' src='media/bwsquare.png'/>" +
			"<img id='zoomin' src='media/zoomin.png'/>" +
			"<img id='zoomout' src='media/zoomout.png'/>" +
			"<img id='cancel_blowup' src='media/redex.png'/>" +
		"</div>" +
		"<img id='blownup'/>" +
	"</div>";
	
//Attach to page
$('body').append(alertDiv);

//Bind event listeners
$('#cancel_blowup').on('click', function()
{
	$('#alertBlock').stop(true).fadeOut(300);
	$('html, body').css('overflow', '');
});

$('#zoomin').on('click', function()
{
	$(this).css('display', 'none');
	$('#zoomout').css('display', 'inline');
	
	$('#blownup').css('maxHeight', $('#blownup')[0].naturalHeight + 'px');
	$('#blownup').css('maxWidth', $('#blownup')[0].naturalWidth + 'px');
});

$('#zoomout').on('click', function()
{
	$(this).css('display', 'none');
	$('#zoomin').css('display', 'inline');
	
	$('#blownup').css({'maxWidth': '100%', 'maxHeight': '100vh'});
});

$('#btow').on('click', function()
{
	if($('#blackout').hasClass('whitebg'))
		$('#blackout').removeClass('whitebg');
	else
		$('#blackout').addClass('whitebg');
});

function enlarge_img(image_src)
{
	$('#zoomout').css('display', 'none');
	$('#zoomin').css('display', 'inline');
	$('#blackout').removeClass('whitebg');
	
	$('#blownup').css({'maxWidth': '100%', 'maxHeight': '100vh'}).attr('src', image_src);
	$('#alertBlock').stop(true).fadeIn(300);
	
	$('html, body').css('overflow', 'hidden');
}

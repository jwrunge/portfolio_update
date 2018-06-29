//Set up site alert
var alertDiv = "<div id='alertBlock'>" +
	"<div id='blackout'>" +
		"<div id='alertbox'>" +
			"<p id='message'>Placeholder Text</p>" +
			"<div id='alertConfirmBox'>" +
				"<input type='button' id='ok_button' value='OK'/>" +
				"<input type='button' id='cancel_button' value='Cancel'/>" +
			"</div>" +
		"</div>" +
	"</div>";
	
//Attach to page
$('body').append(alertDiv);

//Bind event listeners
$('#ok_button').on('click', function()
{
	if(current_command) current_command();
	$('#alertBlock').stop(true).fadeOut(300);
	current_command = null;
	cancel_command = null;
});

$('#cancel_button').on('click', function()
{
	if(cancel_command) cancel_command();
	$('#alertBlock').stop(true).fadeOut(300);
	current_command = null;
	cancel_command = null;
});

function siteAlert(message)
{
	$('#message').html(message);
	
	if(!current_command) $('#cancel_button').css('display', 'none');
	else $('#cancel_button').css('display', 'inline');
	
	$('#alertBlock').stop(true).fadeIn(300);
}

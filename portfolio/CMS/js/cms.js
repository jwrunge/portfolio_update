var current_command = null; //store a command to be called by confirmation box
var cancel_command = null; //store a command to be called by confirmation box
var page_url = $('#page_reference').val();
var newBlock = 0; //Tracks how many new items are added (for data-id)
var img_to_change = null;

history.pushState(null, null, null);

//Init tinymce
function init_tinymce()
{
	tinymce.init({
		  selector: 'textarea',
		  height: 300,
		  menubar: false,
		  branding: false,
		  plugins: [
			'advlist autolink lists link charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime table contextmenu paste code'
		  ],
		  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code',
		  content_css: [ 'style/coreStyle.css' ]
	});
}

$(document).ready(function()
{
	init_tinymce();
});

//Bind in a function because we'll be "copying and pasting," which rids event binding--so we'll need to call this again
//Note--convoluted content reordering thanks to the otherwise fantastic tinymce, which (maybe because it uses iframe?) will not allow its content to be cloned
function bind_buttons()
{
	$('.delete').off('click').on('click', function()
	{
		var content_block = $(this).closest('.editing_block');
		var mask = content_block.find('.delete_marker');
		
		current_command = function() {
			mask.stop(true).fadeIn(300);
			content_block.attr('data-remove', 'remove');
		};
		
		siteAlert('Are you sure you want to delete this content?');
	});

	$('a.undo_delete').off('click').on('click', function()
	{
		var content_block = $(this).closest('.editing_block');
		content_block.find('.delete_marker').stop(true).fadeOut(300);
		content_block.attr('data-remove', 'nevermind');
	});

	$('.up').off('click').on('click', function()
	{
		var content_block = $(this).closest('.editing_block');
		var prev_block = content_block.prev('.editing_block');
		
		var content_distance = content_block.outerHeight(true);
		var prev_distance = prev_block.outerHeight(true);
				
		if(typeof prev_block.attr('data-id') != 'undefined')
		{					
			var content_clone = content_block.clone();
			var prev_clone = prev_block.clone();
			
			content_block.css('z-index', '500').animate(
				{'top': '-' + prev_distance + 'px'},
				{duration: 500, queue: false, easing: 'swing'}
			);			
			
			prev_block.css('z-index', '499').animate(
				{'top': content_distance + 'px'},
				{duration: 500, queue: false, easing: 'swing',
				complete: function() {
				
					if(page_url != 'team.php')
						tinymce.remove();
						
					var content_clone = content_block.clone();
					var prev_clone = prev_block.clone();
					
					content_clone.css('top', '0');
					prev_clone.css('top', '0');
					
					content_block.replaceWith(prev_clone);
					prev_block.replaceWith(content_clone);
					
					if(page_url != 'team.php')
						init_tinymce();
					
					bind_buttons(); //call binding function to rebind button actions
				}}
			);
		}
	});

	$('.down').off('click').on('click', function()
	{
		var content_block = $(this).closest('.editing_block');
		var next_block = content_block.next('.editing_block');
		
		var content_distance = content_block.outerHeight(true);
		var next_distance = next_block.outerHeight(true);
	
		if(typeof next_block.attr('data-id') != 'undefined')
		{										
			content_block.css('z-index', '500').animate(
				{'top': next_distance + 'px'},
				{duration: 500, queue: false, easing: 'swing'}
			);			
			
			next_block.css('z-index', '499').animate(
				{'top': '-' + content_distance + 'px'},
				{duration: 500, queue: false, easing: 'swing',
				complete: function() {
				
					if(page_url != 'team.php')
						tinymce.remove();
				
					var content_clone = content_block.clone();
					var next_clone = next_block.clone();
					
					content_clone.css('top', '0');
					next_clone.css('top', '0');
			
					content_block.replaceWith(next_clone);
					next_block.replaceWith(content_clone);
					
					if(page_url != 'team.php')	
						init_tinymce();
					
					bind_buttons(); //call binding function to rebind button actions
				}}
			);
		}
	});

	$(document).off('click', '.add_image').on('click', '.add_image', function(e) {
		
		//Prevent default link behavior ("jumping" to the anchor)
		e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		if($(this).prop('id') != 'header_img')
			source_element = $(this);
		else
			source_element = 'header';
		window.open("image_select.php", "_blank");
	});
}

$('.submitter').on('click', function() {

	current_command = function(){
	
		var data = {};
		data['header_value'] = $('#title').val();
		data['header_image'] = $('#content_screen').css('background-image');
		data['header_orientation'] = $('#content_screen').css('background-position');
		data['content'] = {
			'user': [],
			'html_content': [],
			'image_path': [],
			'page': []
		};
			
		//Remove anything marked for deletion, and load image array
		$('.editing_block').each(function()
		{	
			tinymce.remove();
			
			if($(this).attr('data-remove') == 'remove')
			{
				$(this).remove();
			}
			else
			{
				if($(this).find('.add_image').attr('src') == 'media/core/addImage.png')
					data['content']['image_path'].push('');
				else
					data['content']['image_path'].push($(this).find('.add_image').attr('src'));
			}
			
			init_tinymce();
		});
			
		//Load arrays with values
		$.each(tinyMCE.editors, function()
		{
			data['content']['html_content'].push(this.getContent());
			data['content']['page'].push(page_url);
			data['content']['user'].push($('#username').val());
		});
						
		$.ajax({
			url: 'modules/db_action.php',
			type: 'POST',
			dataType: 'text',
			data: {page: page_url, user: $('#username').val(), data: data },
			success: function(response) 
			{ 
				siteAlert(response); 
			},
			error: function(xhr, ajaxOptions, thrownError)
			{
				siteAlert("Error: " + thrownError);
			},
			cache: 'false'
		});
	};
	
	siteAlert('Are you sure you want to commit these changes? This action cannot be undone.');
});

$('.adder').on('click', function() {

	if(page_url == 'staff.php')
	{
		tinymce.remove();

		$('.entry').append(
			"<div class='editing_block' data-id='" + newBlock + "'style='clear: both; margin-bottom: 1em;'>" +
				"<div class='panel_control'>" + 
					"<label>Name: </lable><input type='text' class='editable staff_name'></input>" +
					"<br/><label>Title: </label><input type='text' class='editable staff_title'></input>" +
					"<br/><label>Email: </label><input type='text' class='editable staff_email'></input>" +
				"</div>" + 
				"<div class='image_control'>" +
					"<div class='block_controls'>" + 
						"<input type='button' class='up' value='&uarr;'/>" + 
						"<input type='button' class='down' value='&darr;'/>" +
						"<input type='button' class='delete' value='x'/>" +
					"</div>" +
					"<img class='add_image' src='media/core/addImage.png'/>" +
				"</div>" + 
				"<div class='delete_marker'>Queued for deletion<br/>-<a class='undo_delete'>undo</a></div>" +
			"</div>"
		);
			
		newBlock++;
	}
	else
	{
		tinymce.remove();

		$('.entry').append(
			"<div class='editing_block' data-id='" + newBlock + "'style='clear: both; margin-bottom: 1em;'>" +
				"<div class='panel_control'>" + 
					"<textarea class='editable' value='New content'/>" +
				"</div>" + 
				"<div class='image_control'>" +
					"<div class='block_controls'>" + 
						"<input type='button' class='up' value='&uarr;'/>" + 
						"<input type='button' class='down' value='&darr;'/>" +
						"<input type='button' class='delete' value='x'/>" +
					"</div>" +
					"<img class='add_image' src='media/core/addImage.png'/>" +
				"</div>" + 
				"<div class='delete_marker'>Queued for deletion<br/>-<a class='undo_delete'>undo</a></div>" +
			"</div>"
		);
			
		newBlock++;		
		init_tinymce();
	}

	bind_buttons();	//Rebind buttons
	$('#main_content').delay(300).animate({scrollTop: $(".editing_block").last()[0].offsetTop - 25}, 600, 'swing');
});

//Navigate away from page
$('.viewer, #nav a, #menu_links a').on('click', function(e) {
	
	if($(this).prop('id') != 'menu_button')
	{
		e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior	
		
		var link = $(this).attr('href');
		
		current_command = function() {
			window.location.href = link;
		};
		
		siteAlert('Are you sure you want to leave the editor? Unsaved work will be lost.');
	}
});

$(window).on('popstate', function() {
	
	current_command = function() {
		$(window).unbind('popstate');
		window.history.back();
	};
	
	cancel_command = function() {
		history.pushState(null, null, null);
	};
	
	siteAlert('Are you sure you want to leave the editor? Unsaved work will be lost.');
	
});

bind_buttons(); //Call initially

/*
	CHANGE HEADER IMAGE ALIGNMENT
*/
$(document).on('click', '.a_top', function(e) {

	//Prevent default link behavior ("jumping" to the anchor)
	e.preventDefault();		//prevents default link behavior
	e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
	
	$('#content_screen').css('background-position', 'center top');		
	$('#alignment_input').attr('data-val', 'center top');		
});

$(document).on('click', '.a_mid', function(e) {

	//Prevent default link behavior ("jumping" to the anchor)
	e.preventDefault();		//prevents default link behavior
	e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
	
	$('#content_screen').css('background-position', 'center center');	
	$('#alignment_input').attr('data-val', 'center center');
});

$(document).on('click', '.a_bot', function(e) {

	//Prevent default link behavior ("jumping" to the anchor)
	e.preventDefault();		//prevents default link behavior
	e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
	
	$('#content_screen').css('background-position', 'center bottom');	
	$('#alignment_input').attr('data-val', 'center bottom');
});
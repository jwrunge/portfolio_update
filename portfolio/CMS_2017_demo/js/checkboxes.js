$(document).ready(function(){

	$('#worship_link_check').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.worship').prop('checked', true);
	});
	
	$('#learn_link_check').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.learn').prop('checked', true);
	});
	
	$('#community_link_check').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.community').prop('checked', true);
	});
	
	$('#worship_link_clear').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.worship').prop('checked', false);
	});
	
	$('#learn_link_clear').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.learn').prop('checked', false);
	});
	
	$('#community_link_clear').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		$('input.community').prop('checked', false);
	});
		
	
});
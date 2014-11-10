
var siteUrl = $('#hdnSiteUrl').val();

// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}


// Movies List
if(exist($('.pgaeMovies'))){
	
	var orderBy = minusLoc.get('?', 'orderBy'), orderRule = minusLoc.get('?', 'orderRule');
	
	if(orderRule == 'DESC')
		$('.table-movies th a[rel="'+orderBy+'"]').addClass("desc").removeClass("asc");
	else
		$('.table-movies th a[rel="'+orderBy+'"]').removeClass("desc").addClass("asc");
	
	$('.table-movies th a').click(function(){
		
		orderBy = $(this).attr("rel");
		
		if($(this).hasClass('asc'))
			orderRule = 'DESC';
		else
			orderRule = 'ASC';
		
		minusLoc.put('?',orderBy+'|'+orderRule , 'orderBy|orderRule');

	});
	
}

//Movies Detail
if(exist($('.pageMovie'))){
	
	// Multiselect actions
	var sel;
	
	function getSelections(sel){
		$('.groupMulti[rel="'+sel+'"] .selections').html('');
		$('.groupMulti[rel="'+sel+'"] select option:selected').each(function(){
			$('.groupMulti[rel="'+sel+'"] .selections').append('<small rel="'+$(this).text()+'">'+$(this).text()+'</small>');
		});
	}
	
	$('.groupMulti').each(function(){
		sel = $(this).attr('rel');
		getSelections(sel);
	});
	
	
	$('.groupMulti select').change(function(){
		sel = $(this).parent('.groupMulti').attr('rel');
		getSelections(sel);
	});
	
	// Poster Action
	$('.posterHolder img').click(function(){
		$(this).toggleClass('big');
	});
	
}

//Settings (Slug Generate)
if(exist($('.pgaeSlugs'))){
	
	var rel;
	
	$('span.badge').click(function(){
		if(!exist($('.generating'))){
			rel = $(this).attr("rel");
			$(this).parent(".list-group-item").addClass("generating");
			
			$.post(rel, function(result){
				
				if(parseFloat(result) > 0)
					$(this).text(result);
				else
					$(this).remove();
				
				$(this).parent(".list-group-item").removeClass("generating");
				
			});
		}
	});
	

}
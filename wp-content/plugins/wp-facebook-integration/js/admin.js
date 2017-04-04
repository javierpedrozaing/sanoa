(function( $ ) {
			$("#wpfbint_form").submit(function(e) {
				e.preventDefault();
				var pageid = $('#wpfbint_page_id').val();
				var picnr = $('#wpfbint_pic_nr').val();
				
				if($.isNumeric($('#wpfbint_page_id').val())){					
						$.ajax({
							url: window.location.href,
							data:  $(this).serialize(),
							type: 'POST',
							beforeSend: function() {	
								$(window).scrollTop(0);
								$('#wpfbint_form').append("<img src='"+url.plugin_url+"/images/loader.gif' />");
								
							},						
							success: function(data){
								$('body').html(data);
								$('#wpfbint_page_id').val(pageid);				
							}
						});		
				}else if( $.isNumeric($('#wpfbint_pic_nr').val()) ){
						$.ajax({
							url: window.location.href,
							data:  $(this).serialize(),
							type: 'POST',
							beforeSend: function() {	
								$(window).scrollTop(0);
								$('#wpfbint_form').append("<img src='"+url.plugin_url+"/images/loader.gif' />");							
							},						
							success: function(data){
								$('body').html(data);
								$('#wpfbint_pic_nr').val(picnr);				
							}
						});					
				}else {
					alert('Enter Numbers only please..');	
				}
	
			});
		
})( jQuery );
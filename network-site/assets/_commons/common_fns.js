	
		/*
		 *  SOME USEFUL COMMON USED FUNCTIONS
		 *	
		 *  @owner: ToucanTech 
		 *  @author: Lajos Deli <lajos@toucantech.com>
		*/
		
		
		(function($) {	
		
		
			$.object_common_functions = {
				
				//covering any kind of element (by selector)
				showOverlay : function(selector_container, selector_cover_layer, display_msg) 
				{	
					var display_msg = (display_msg == undefined) ? '' : display_msg;
					var el_layer = $(selector_container);
					var position = el_layer.offset();
					var h = el_layer.height(); 
					var w = el_layer.width();
					var bl = (1 * el_layer.css("border-left-width").replace('px', ''));
					var br = (1 * el_layer.css("border-right-width").replace('px', ''));
					var bt = (1 * el_layer.css("border-top-width").replace('px', ''));
					var bb = (1 * el_layer.css("border-bottom-width").replace('px', ''));
					var lx = position.left;
					var ly = position.top;
					var new_class_name = selector_cover_layer.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
					var cover_content = '<div class="' + new_class_name + '" ' + 
											'style="display: block; width: ' + (w - (bt + bb)) + 'px; height: ' + (h - (bl + br)) + 'px; ' + 
											'position: absolute; z-index: 1100; top: ' + (ly + bt) + 'px; ' + 'left: ' + (lx + bl) + 'px; ' +  
											'background-color: rgba(0, 0, 0, 0.4); padding: 0px; margin-left: 0px;">' + 
										'	<table style="display: table;width: 100%;min-height: 100%;margin: 0;padding: 0;">' +
										'		<tr style="display: table-row;width: 100%;min-height: 100%;margin: 0;">' +
										'			<td style="display: table-cell;width: 100%;min-height: 100%;margin: 0;vertical-align: middle;">' + 
										((display_msg != '') 
											?	'				<div style="width: 80%;height: 40px;margin: 0px; margin-left: 10%; padding-top: 10px;padding-bottom: 10px;text-align: center;background-color: rgba(255, 255, 255, 0.8);">' +
												'					<span style="position: relative;margin: 0px;padding: 0px;font-size: 14px;font-weight: normal;font-family: arial;color: #000;">' + display_msg + '</span>' + 
												'				</div>'
											: display_msg ) +
										'			</td>' +
										'		</tr>' +
										'	</table>' + 
										'</div>';
					
					$('html, body').append(cover_content);
					$(selector_cover_layer)
								.css('width', (w + bl) + "px")
								.css('height', (h + bt) + "px")
								.css("top", position.top + "px")
								.css("left", position.left + "px")
								.fadeIn("fast");
				}, //END function showOverlay
				
				
				//removing overlay (by selector)
				removeOverlay : function(selector_cover_layer) 
				{ 
					$(selector_cover_layer).remove();		
				}, //END function removeOverlay
				
				
				//disabling bootstrap buttons (by selector)
				disableButton : function(btnSelector) 
				{
					$(btnSelector).prop("disabled", true)
								.removeClass('btn-default')
								.removeClass('btn-primary')
								.removeClass('btn-success')
								.removeClass('btn-info')
								.removeClass('btn-warning')
								.removeClass('btn-danger')
								.removeClass('btn-default')
								.removeClass('btn-link');
										
				}, //END function disableButton
				
				
				//enabling bootstrap buttons (by selector)
				enableButton : function(btnSelector, addClass) 
				{
					$(btnSelector).prop("disabled", false);
					if (addClass != undefined) {
						$(btnSelector).addClass(addClass);
					}
				}, //END function enableButton
				
				
			} //END $.object_common_functions 

					
			//Global variables
			COMMON = $.object_common_functions;		
				
		})(jQuery);
		
	
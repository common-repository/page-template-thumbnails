jQuery(document).ready(function($) {

	$(document).ready(function() {
		function getSelected() {
			var onm = '';
			$("#page_template option").each(function (i) {
				var sel = $(this).attr('selected');
				if (sel == true) { onm = $(this).text(); onm = onm.toLowerCase(); }
			});
			
			$('.pthm_img img').each(function (i) {
				var nm = $(this).attr('alt'); 
				nm = nm.toLowerCase();
				var mtc = onm.split(nm); 
				if (mtc.length > 1) { $(this).css({border: '5px solid #CCC'}); }
			}); 
		}
		
		getSelected();

		$('.pthm_img').click(function () { 
			//alert($('.pthm_img img').attr('alt'));
			var nm = $(this).children('img').attr('alt');
			nm = nm.toLowerCase();			
			
			$('.pthm_img img').each(function (i) {
				$(this).css({border: '5px solid #FFF'});
			});
			
			$(this).children('img').css({border: '5px solid #CCC'}); 
			
			$("#page_template option").each(function (i) {
				var onm = $(this).text();
				onm = onm.toLowerCase();
				
				var mtc = onm.split(nm); 
				
				if (mtc.length > 1) {
					$(this).attr('selected', true);
				}
			});
			
		});


	})

});
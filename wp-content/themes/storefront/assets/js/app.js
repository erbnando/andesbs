(function($){
	$(document).ready(function() {
		equalheight = function(container){
			var currentTallest = 0;
			var currentRowStart = 0;
			var rowDivs = [];
			var $el;
			var topPosition = 0;
			var currentDiv;
			$(container).each(function() {
				$el = $(this);
				$($el).height('auto');
				topPosition = $el.position().top;
				if (currentRowStart != topPosition) {
					for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
						rowDivs[currentDiv].height(currentTallest);
					}
					rowDivs.length = 0; // empty the array
					currentRowStart = topPosition;
					currentTallest = $el.height();
					rowDivs.push($el);
				} else {
					rowDivs.push($el);
					currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
				}
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
			});
		};
		// equalheight('ul.products li.product.product-category a');
	});

	$( window ).resize(function() {
		// equalheight('ul.products li.product.product-category a');
	});

})(jQuery);

(function( $ ) {
 
	$.fn.jChart = function(options) {
		var selector = $(this);
		var default_color = "#6b9bd6";
		var bar_height = 19;
		
		var settings = $.extend({
			width: 750,
    		name: null,
    		type: "bar",
    		headers: null,
    		values: null,
    		footers: Array(),
    		sort: false,
    		sort_colors: false,
    		colors: Array(),
    		x_label: null
    	}, options);
		
		//Initialize some settings that can be set via HTML
		if(settings.name==null) {
			settings.name = $(this).attr("name");
		}
		if($(this).data("sort")==true) {
			settings.sort = true;
		}
		if($(this).data("width")!=null) {
			settings.width = parseInt($(this).data("width"));
		}
		if($(this).data("x_label")!=null) {
			settings.x_label = $(this).data("x_label");
		}
		
		var chart_width=settings.width;
		if($(this).hasClass("chart-sm")) {
			bar_height = 17;
		}
		else if($(this).hasClass("chart-lg")) {
			bar_height = 25;
		}
		else if(settings.width!=null) {
			chart_width=parseInt(settings.width);
		}
		
		checkForHTMLSettings();
		
		//Clear the data in the jChart div
		$(this).html("");
		
		//Create the html containers for the chart
		var chart_title =
			$("<div>", {
				class: "chart-title",
				html: settings.name
			});
		var legend_left = 
			$("<div>", {
				class: "legend legend-left"
			});
		var x_label = 
			$("<span>", {
				class: "chart-x-label",
				html: settings.x_label,
        width: settings.width
			});
		
		//Calculate what the chart width should be
		var max_data = Math.max.apply(Math,settings.values);
		var max_footer = Math.max.apply(Math,settings.footers);
		var maxes = [max_data,max_footer];
		var chart_max = Math.max.apply(Math,maxes);
		var container_width = chart_width + 250;
		
		var chart_container = 
			$("<div>", {
	    		class: "chart-container",
	    		width: container_width + "px"
			});
		var chart = 
			$("<div>", {
				class: "chart",
				width: chart_width + "px"
			});
		var legend_bottom = 
			$("<div>", {
				class: "legend-bottom"
			});
		
		//Place the containers into the target element
		$(this).append(chart_container);
		chart_container.append(chart_title);
		chart_container.append(legend_left);
		chart_container.append(chart);
		
		//Sort the data if the setting is enabled (Insertion sort)
		if(settings.sort) {
			for(var i=1;i<settings.values.length;i++) {
				var j = i;
				while(j>0 && settings.values[j-1] < settings.values[j]) {
					var temp = settings.values[j];
					var head_temp = settings.headers[j];
					settings.values[j] = settings.values[j-1];
					settings.values[j-1] = temp;
					
					//Sort headings
					settings.headers[j] = settings.headers[j-1];
					settings.headers[j-1] = head_temp;
					
					//Sort colors
					if(settings.sort_colors) {
						var color_temp = settings.colors[j];
						settings.colors[j] = settings.colors[j-1];
						settings.colors[j-1] = color_temp;
					}
					j--;
				}
			}
		}
		
		//Loop through headings and create/place them and their corresponding value bars
		for(var i=0;i<settings.headers.length;i++) {
			var heading = 
				$("<div>", {
					class: "heading heading-left",
					style: "height: "+bar_height+"px;font-size: 10pt;",
					html: settings.headers[i]
				});
			var bar_width = (settings.values[i]/chart_max) * chart_width;
			var bar = 
				$("<div>", {
					class: "bar",
					"data-placement": "right",
					"data-toggle": "tooltip",
					title: commaSeparateNumber(settings.values[i]),
					style: "height:"+bar_height+"px;background-color:"+settings.colors[i%settings.colors.length],
					width: bar_width
				});
			legend_left.append(heading);
			chart.append(bar);	
		}
		chart.append(legend_bottom);
		for(var i=0;i<settings.footers.length;i++) {
			var margin = "margin-left:"+((settings.footers[i]/chart_max)*chart_width-9).toString() + "px;";
			var chart_label_bottom =
				$("<div>", {
					class: "chart-label chart-label-bottom",
					style: margin,
					html: commaSeparateNumber(settings.footers[i])
				});
			var margin = "margin-left:"+((settings.footers[i]/chart_max)*chart_width-2).toString() + "px;";
			var chart_label_hr = 
				$("<div>", {
					class: "chart-label-hr",
					style: margin
					
				});
			legend_bottom.append(chart_label_bottom);
			chart.append(chart_label_hr);
			legend_bottom.append(x_label);
		}
		
		//Enable hover details
		$(".bar").tooltip();
		
    	return this;
    	
    	/**
    	 * Checks for settings defined in the HTML
    	 * like chart-define-row and chart-define-footer classes
    	 */
    	function checkForHTMLSettings(){
    		//Check for HTML defined bar chart data
    		if(selector.find(".define-chart-row").length>0) {
    			settings.headers = Array();
    			settings.values = Array();
    			selector.find(".define-chart-row").each(function() {
    				settings.headers.push($(this).attr("title"));
    				var value = $(this).html();
    				if(value==null || value=="") {
    					settings.values.push(0);
    				}
    				else {
    					settings.values.push(parseInt(value));
    				}
    				var color = $(this).data("color");
    				if(color!=null) {
    					settings.sort_colors = true;
    					settings.colors.push(color);
    				}
    				else {
    					settings.colors.push(default_color);
    				}
    			});
    		}
    		else {
    			settings.colors.push(default_color);
    		}
    		//Check for HTML defined footers
    		if(selector.find(".define-chart-footer").length>0) {
    			settings.footers = Array();
    			selector.find(".define-chart-footer").each(function() {
    				var footer = $(this).html();
    				if(footer!=null && footer!="") {
    					settings.footers.push(parseInt(footer));
    				}
    			});
    		}
    	}
    	
    	/**
    	 * Converts a number into a comma separated string
    	 */
    	function commaSeparateNumber(val){
    		while (/(\d+)(\d{3})/.test(val.toString())){
    			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    	    }
    		return val;
    	}
	};
})( jQuery );
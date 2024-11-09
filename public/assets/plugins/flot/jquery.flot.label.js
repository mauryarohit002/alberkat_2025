/* Flot plugin that adds some extra labelss for plotting points.

Copyright (c) 2007-2016 IOLA and Ole Laursen.
Licensed under the MIT license.

The labelss are accessed as strings through the standard labels options:

	series: {
		points: {
			labels: "regular"
		}
	}

*/

(function ($) {
    function processRawData(plot, series, datapoints) {
        // we normalize the area of each labels so it is approximately the
        // same as a circle of the given radius

        var handlers = {
            regular: function (ctx, x, y, radius, shadow, data) {
                // pi * r^2 = (2s)^2  =>  s = r * sqrt(pi)/2
                var size = 10;
                ctx.lineWidth = size;
                ctx.fillStyle = 'black';
                ctx.fillText("Hello World",x - size,y - size);
            }
        };

        var s = series.points.labels;
        if (handlers[s])
            series.points.labels = handlers[s];
    }
    
    function init(plot) {
        plot.hooks.processDatapoints.push(processRawData);
    }
    
    $.plot.plugins.push({
        init: init,
        name: 'labels',
        version: '1.0'
    });
})(jQuery);

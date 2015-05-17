(function ($) {

    $.fn.circliful = function (options, callback) {

        var settings = $.extend({
            // These are the defaults.
            fgcolor: "#fff",
            bgcolor: "#fff",
            fill: false,
            width: 15,
            dimension: 200,
            fontsize: 15,
            percent: 50,
            animationstep: 1.0,
            iconsize: '20px',
            iconcolor: '#fff',
            border: 'default',
            complete: null
        }, options);

        return this.each(function () {
            var customSettings = ["fgcolor", "bgcolor", "fill", "width", "dimension", "fontsize", "animationstep", "endPercent", "icon", "iconcolor", "iconsize", "border", "padding"];
            var customSettingsObj = {};
            var icon = '<i class="fa fa-heart-o"></i>';
            var endPercent = 0;
            var obj = $(this);
            var fill = false;
            var text, info,bgimage;

            obj.addClass('circliful');

            checkDataAttributes(obj);

            if (obj.data('text') != undefined) {
                text = obj.data('text');

                if (obj.data('icon') != undefined) {
                    icon = $('<i></i>')
                        .addClass('fa ' + $(this).data('icon'))
                        .css({
                            'color': customSettingsObj.iconcolor,
                            'font-size': customSettingsObj.iconsize
                        });
                }

                if (obj.data('type') != undefined) {
                    type = $(this).data('type');

                    if (type == 'half') {
                        addCircleText(obj, 'circle-text-half', (customSettingsObj.dimension / 1.45),customSettingsObj.iconcolor);
                     } else {
                        addCircleText(obj, 'circle-text', customSettingsObj.dimension,customSettingsObj.iconcolor);
                     }
                } else {
                    addCircleText(obj, 'circle-text', customSettingsObj.dimension,customSettingsObj.iconcolor);
                 }
            }

            if ($(this).data("total") != undefined && $(this).data("part") != undefined) {
                var total = $(this).data("total") / 100;

                percent = (($(this).data("part") / total) / 100).toFixed(3);
                endPercent = ($(this).data("part") / total).toFixed(3)
            } else {
                if ($(this).data("percent") != undefined) {
                    percent = $(this).data("percent") / 100;
                    endPercent = $(this).data("percent")
                } else {
                    percent = settings.percent / 100
                }
            }

            if ($(this).data('info') != undefined) {
                info = $(this).data('info');

                if ($(this).data('type') != undefined) {
                    type = $(this).data('type');

                    if (type == 'half') {
                        addInfoText(obj, 0.9,customSettingsObj.iconcolor);
                    } else {
                        addInfoText(obj, 1.25,customSettingsObj.iconcolor);
                    }
                } else {
                    addInfoText(obj, 1.25,customSettingsObj.iconcolor);
                }
            }

            $(this).width(customSettingsObj.dimension + 'px');

            var canvas = $('<canvas></canvas>').attr({
			                width: customSettingsObj.dimension,
			                height: customSettingsObj.dimension
			            }).appendTo($(this)).get(0);

            var context = canvas.getContext('2d');
            var x = canvas.width / 2;
            var y = canvas.height / 2;
            var degrees = customSettingsObj.percent * 360.0;
            var radians = degrees * (Math.PI / 180);
            var radius = canvas.width / 2.5;
            var startAngle = 2.3 * Math.PI;
            var endAngle = 0;
            var counterClockwise = false;
            var curPerc = customSettingsObj.animationstep === 0.0 ? endPercent : 0.0;
            var curStep = Math.max(customSettingsObj.animationstep, 0.0);
            var circ = Math.PI * 2;
            var quart = Math.PI / 2;
            var type = '';
            var fireCallback = true;

            if ($(this).data('type') != undefined) {
                type = $(this).data('type');

                if (type == 'half') {
                    startAngle = 2.0 * Math.PI;
                    endAngle = 3.13;
                    circ = Math.PI * 1.0;
                    quart = Math.PI / 0.996;
                }
            }

            /**
             * adds text to circle
             * 
             * @param obj
             * @param cssClass
             * @param lineHeight
             */
            function addCircleText(obj, cssClass, lineHeight,textColor) {
                $("<span></span>")
                    .appendTo(obj)
                    .addClass(cssClass)
                    .text(text)
                    .prepend(icon)
                    .css({
                        'line-height': lineHeight + 'px',
                        'font-size': customSettingsObj.fontsize + 'px',
						'color': textColor
                    });
            }

            /**
             * adds info text to circle
             * 
             * @param obj
             * @param factor
             */
            function addInfoText(obj, factor,textColor) {
                $('<span></span>')
                    .appendTo(obj)
					.text(info)
                    .addClass('circle-info-half')
					.css({
						'line-height': (customSettingsObj.dimension * factor) + 'px',
						'color': textColor
                    });
            }

            /**
             * checks which data attributes are defined
             * @param obj
             */
            function checkDataAttributes(obj) {
                $.each(customSettings, function (index, attribute) {
                    if (obj.data(attribute) != undefined) {
                        customSettingsObj[attribute] = obj.data(attribute);
                    } else {
                        customSettingsObj[attribute] = $(settings).attr(attribute);
                    }

                    if (attribute == 'fill' && obj.data('fill') != undefined) {
                        fill = true;
                    } 
                });
            }

            /**
             * animate foreground circle
             * @param current
             */
            function animate(current) {
                context.clearRect(0, 0, canvas.width, canvas.height);

                context.beginPath();
                context.arc(x, y, radius, endAngle, startAngle, false);

                context.lineWidth = customSettingsObj.width + 1;
                if (obj.data('bgimage') != undefined) {
                    var fimg = obj.find('img');
                        fimg.remove()
                        bgimage = obj.data('bgimage');
                        var _ind = obj.index();
                        obj.append("<img src="+bgimage+" id='image"+_ind+"' class='hide' />");
                        var image = document.getElementById("image"+_ind)
                        var pattern = context.createPattern(image, "repeat");
                        context.strokeStyle = pattern;
                        context.stroke();
                }
                else{
                context.strokeStyle = customSettingsObj.bgcolor;
                context.stroke();
                }

                if (fill) {
                    context.fillStyle = customSettingsObj.fill;
                    context.fill();
                }

                context.beginPath();
                context.arc(x, y, radius, -(quart), ((circ) * current) - quart, false);

                if (customSettingsObj.border == 'outline') {
                	context.lineWidth = customSettingsObj.width + 13;
                } else if(customSettingsObj.border == 'inline') {
                	context.lineWidth = customSettingsObj.width - 13;
                } 

                context.strokeStyle = customSettingsObj.fgcolor;
                context.stroke();

                if (curPerc < endPercent) {
                    curPerc += curStep;
                    requestAnimationFrame(function () {
                        animate(Math.min(curPerc, endPercent) / 100);
                    }, obj);
                }

                if(curPerc == endPercent && fireCallback && typeof(options) != "undefined") {
                	if($.isFunction( options.complete )) {
		            	options.complete();

		            	fireCallback = false;
		            }
                }
            }

            animate(curPerc / 100);

        });
    };
}(jQuery));
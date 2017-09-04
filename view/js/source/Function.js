function delete_seleccione(id, data)
{
    data = data.replace('<option value="-1">SELECCIONE</option>', '');
    $(id).html(data);
}

function format_currency(id)
{
    $(id).formatCurrency({region: 'de-DE'});
}
function number(id)
{
    return $(id).asNumber();
}
function Formato_moneda(number)
{
    var decimals = 2;
    var dec_point = ',';
    var thousands_sep = '.';
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return '$ ' + s.join(dec);
}
function toast_options(title, msn)
{
    toastr.options = {
        closeButton: false,
        debug: false,
        //"positionClass": "toast-top-full-width",toast-top-left
        positionClass: "toast-top-left",
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        opacity: "0.9"
    };
    toastr.success(msn, title);
}
function toast_error_options(title, msn)
{
    toastr.options = {
        closeButton: false,
        debug: false,
        //"positionClass": "toast-top-full-width",toast-top-left
        positionClass: "toast-top-left",
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        opacity: "0.9"
    };
    toastr.error(msn, title);
}

$(function ()
{
    try {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var FeIni = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        var FeFin = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $('.fecha').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: "-150:+0"});
        $('.fechaadelante').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: "+0:+100"});
        $('.fechamin').datepicker({dateFormat: 'yy-mm-dd', minDate: '+0d', changeMonth: true, changeYear: true, yearRange: "-150:+0"});
        $('.fechamin').val(FeIni);
        $('.fechamin_bloq').datepicker("option", "minDate", "+0m +0d");
    }
    catch (Exception)
    {
    }
    try {
        $('.time').clockpicker({
            donetext: 'Guardar',
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            twelvehour: true,
            vibrate: true
        });
    }
    catch (Exception)
    {
    }
});
$(function () {
    var $ = window.jQuery,
            $win = $(window),
            $doc = $(document),
            $body;
    // Can I use inline svg ?
    var svgNS = 'http://www.w3.org/2000/svg',
            svgSupported = 'SVGAngle' in window && (function () {
                var supported,
                        el = document.createElement('div');
                el.innerHTML = '<svg/>';
                supported = (el.firstChild && el.firstChild.namespaceURI) == svgNS;
                el.innerHTML = '';
                return supported;
            })();
    // Can I use transition ?
    var transitionSupported = (function () {
        var style = document.createElement('div').style;
        return 'transition' in style ||
                'WebkitTransition' in style ||
                'MozTransition' in style ||
                'msTransition' in style ||
                'OTransition' in style;
    })();
    // Listen touch events in touch screen device, instead of mouse events in desktop.
    var touchSupported = 'ontouchstart' in window,
            mousedownEvent = 'mousedown' + (touchSupported ? ' touchstart' : ''),
            mousemoveEvent = 'mousemove.clockpicker' + (touchSupported ? ' touchmove.clockpicker' : ''),
            mouseupEvent = 'mouseup.clockpicker' + (touchSupported ? ' touchend.clockpicker' : '');
    // Vibrate the device if supported
    var vibrate = navigator.vibrate ? 'vibrate' : navigator.webkitVibrate ? 'webkitVibrate' : null;
    function createSvgElement(name) {
        return document.createElementNS(svgNS, name);
    }

    function leadingZero(num) {
        return (num < 10 ? '0' : '') + num;
    }

    // Get a unique id
    var idCounter = 0;
    function uniqueId(prefix) {
        var id = ++idCounter + '';
        return prefix ? prefix + id : id;
    }

    // Clock size
    var dialRadius = 100,
            outerRadius = 80,
            // innerRadius = 80 on 12 hour clock
            innerRadius = 54,
            tickRadius = 13,
            diameter = dialRadius * 2,
            duration = transitionSupported ? 350 : 1;
    // Popover template
    var tpl = [
        '<div class="popover clockpicker-popover">',
        '<div class="arrow"></div>',
        '<div class="popover-title">',
        '<span class="clockpicker-span-hours text-primary"></span>',
        ' : ',
        '<span class="clockpicker-span-minutes"></span>',
        '<span class="clockpicker-span-am-pm"></span>',
        '</div>',
        '<div class="popover-content">',
        '<div class="clockpicker-plate">',
        '<div class="clockpicker-canvas"></div>',
        '<div class="clockpicker-dial clockpicker-hours"></div>',
        '<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>',
        '</div>',
        '<span class="clockpicker-am-pm-block">',
        '</span>',
        '</div>',
        '</div>'
    ].join('');
    function AmOrPm(v) {
        if (!v)
            return "PM";
        if (v.toUpperCase().indexOf("AM") != -1)
            return "AM";
        if (v.toUpperCase().indexOf("PM") != -1)
            return "PM";
        return "PM";
    }

    // ClockPicker
    function ClockPicker(element, options)
    {
        var popover = $(tpl),
                plate = popover.find('.clockpicker-plate'),
                hoursView = popover.find('.clockpicker-hours'),
                minutesView = popover.find('.clockpicker-minutes'),
                amPmBlock = popover.find('.clockpicker-am-pm-block'),
                isInput = element.prop('tagName') === 'INPUT',
                input = isInput ? element : element.find('input'),
                addon = element.find('.input-group-addon'),
                self = this,
                timer;
        this.id = uniqueId('cp');
        this.element = element;
        this.options = options;
        this.isAppended = false;
        this.isShown = false;
        this.currentView = 'hours';
        this.isInput = isInput;
        this.input = input;
        this.addon = addon;
        this.popover = popover;
        this.plate = plate;
        this.hoursView = hoursView;
        this.minutesView = minutesView;
        this.amPmBlock = amPmBlock;
        this.spanHours = popover.find('.clockpicker-span-hours');
        this.spanMinutes = popover.find('.clockpicker-span-minutes');
        this.spanAmPm = popover.find('.clockpicker-span-am-pm');
        this.amOrPm = "PM";
        // Setup for for 12 hour clock if option is selected
        if (options.twelvehour) {

            var amPmButtonsTemplate = ['<div class="clockpicker-am-pm-block">',
                '<button type="button" class="btn btn-sm btn-default clockpicker-button clockpicker-am-button">',
                'AM</button>',
                '<button type="button" class="btn btn-sm btn-default clockpicker-button clockpicker-pm-button">',
                'PM</button>',
                '</div>'].join('');
            var amPmButtons = $(amPmButtonsTemplate);
            //amPmButtons.appendTo(plate);

            ////Not working b/c they are not shown when this runs
            //$('clockpicker-am-button')
            //    .on("click", function() {
            //        self.amOrPm = "AM";
            //        $('.clockpicker-span-am-pm').empty().append('AM');
            //    });
            //    
            //$('clockpicker-pm-button')
            //    .on("click", function() {
            //         self.amOrPm = "PM";
            //        $('.clockpicker-span-am-pm').empty().append('PM');
            //    });

            $('<button type="button" class="btn btn-sm btn-default clockpicker-button am-button">' + "AM" + '</button>')
                    .on("click", function () {
                        self.amOrPm = "AM";
                        $('.clockpicker-span-am-pm').empty().append('AM');
                    }).appendTo(this.amPmBlock);
            $('<button type="button" class="btn btn-sm btn-default clockpicker-button pm-button">' + "PM" + '</button>')
                    .on("click", function () {
                        self.amOrPm = 'PM';
                        $('.clockpicker-span-am-pm').empty().append('PM');
                    }).appendTo(this.amPmBlock);
        }

        if (!options.autoclose) {
            // If autoclose is not setted, append a button
            $('<button type="button" class="btn btn-sm btn-default btn-block clockpicker-button">' + options.donetext + '</button>')
                    .click($.proxy(this.done, this))
                    .appendTo(popover);
        }

        // Placement and arrow align - make sure they make sense.
        if ((options.placement === 'top' || options.placement === 'bottom') && (options.align === 'top' || options.align === 'bottom'))
            options.align = 'left';
        if ((options.placement === 'left' || options.placement === 'right') && (options.align === 'left' || options.align === 'right'))
            options.align = 'top';
        popover.addClass(options.placement);
        popover.addClass('clockpicker-align-' + options.align);
        this.spanHours.click($.proxy(this.toggleView, this, 'hours'));
        this.spanMinutes.click($.proxy(this.toggleView, this, 'minutes'));
        // Show or toggle
        input.on('focus.clockpicker click.clockpicker', $.proxy(this.show, this));
        addon.on('click.clockpicker', $.proxy(this.toggle, this));
        // Build ticks
        var tickTpl = $('<div class="clockpicker-tick"></div>'),
                i, tick, radian, radius;
        // Hours view
        if (options.twelvehour) {
            for (i = 1; i < 13; i += 1) {
                tick = tickTpl.clone();
                radian = i / 6 * Math.PI;
                radius = outerRadius;
                tick.css('font-size', '120%');
                tick.css({
                    left: dialRadius + Math.sin(radian) * radius - tickRadius,
                    top: dialRadius - Math.cos(radian) * radius - tickRadius
                });
                tick.html(i === 0 ? '00' : i);
                hoursView.append(tick);
                tick.on(mousedownEvent, mousedown);
            }
        } else {
            for (i = 0; i < 24; i += 1) {
                tick = tickTpl.clone();
                radian = i / 6 * Math.PI;
                var inner = i > 0 && i < 13;
                radius = inner ? innerRadius : outerRadius;
                tick.css({
                    left: dialRadius + Math.sin(radian) * radius - tickRadius,
                    top: dialRadius - Math.cos(radian) * radius - tickRadius
                });
                if (inner) {
                    tick.css('font-size', '120%');
                }
                tick.html(i === 0 ? '00' : i);
                hoursView.append(tick);
                tick.on(mousedownEvent, mousedown);
            }
        }

        // Minutes view
        for (i = 0; i < 60; i += 5) {
            tick = tickTpl.clone();
            radian = i / 30 * Math.PI;
            tick.css({
                left: dialRadius + Math.sin(radian) * outerRadius - tickRadius,
                top: dialRadius - Math.cos(radian) * outerRadius - tickRadius
            });
            tick.css('font-size', '120%');
            tick.html(leadingZero(i));
            minutesView.append(tick);
            tick.on(mousedownEvent, mousedown);
        }

        // Clicking on minutes view space
        plate.on(mousedownEvent, function (e) {
            if ($(e.target).closest('.clockpicker-tick').length === 0) {
                mousedown(e, true);
            }
        });
        // Mousedown or touchstart
        function mousedown(e, space) {
            var offset = plate.offset(),
                    isTouch = /^touch/.test(e.type),
                    x0 = offset.left + dialRadius,
                    y0 = offset.top + dialRadius,
                    dx = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                    dy = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0,
                    z = Math.sqrt(dx * dx + dy * dy),
                    moved = false;
            // When clicking on minutes view space, check the mouse position
            if (space && (z < outerRadius - tickRadius || z > outerRadius + tickRadius)) {
                return;
            }
            e.preventDefault();
            // Set cursor style of body after 200ms
            var movingTimer = setTimeout(function () {
                $body.addClass('clockpicker-moving');
            }, 200);
            // Place the canvas to top
            if (svgSupported) {
                plate.append(self.canvas);
            }

            // Clock
            self.setHand(dx, dy, !space, true);
            // Mousemove on document
            $doc.off(mousemoveEvent).on(mousemoveEvent, function (e) {
                e.preventDefault();
                var isTouch = /^touch/.test(e.type),
                        x = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                        y = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0;
                if (!moved && x === dx && y === dy) {
                    // Clicking in chrome on windows will trigger a mousemove event
                    return;
                }
                moved = true;
                self.setHand(x, y, false, true);
            });
            // Mouseup on document
            $doc.off(mouseupEvent).on(mouseupEvent, function (e) {
                $doc.off(mouseupEvent);
                e.preventDefault();
                var isTouch = /^touch/.test(e.type),
                        x = (isTouch ? e.originalEvent.changedTouches[0] : e).pageX - x0,
                        y = (isTouch ? e.originalEvent.changedTouches[0] : e).pageY - y0;
                if ((space || moved) && x === dx && y === dy) {
                    self.setHand(x, y);
                }
                if (self.currentView === 'hours') {
                    self.toggleView('minutes', duration / 2);
                } else {
                    if (options.autoclose) {
                        self.minutesView.addClass('clockpicker-dial-out');
                        setTimeout(function () {
                            self.done();
                        }, duration / 2);
                    }
                }
                plate.prepend(canvas);
                // Reset cursor style of body
                clearTimeout(movingTimer);
                $body.removeClass('clockpicker-moving');
                // Unbind mousemove event
                $doc.off(mousemoveEvent);
            });
        }

        if (svgSupported) {
            // Draw clock hands and others
            var canvas = popover.find('.clockpicker-canvas'),
                    svg = createSvgElement('svg');
            svg.setAttribute('class', 'clockpicker-svg');
            svg.setAttribute('width', diameter);
            svg.setAttribute('height', diameter);
            var g = createSvgElement('g');
            g.setAttribute('transform', 'translate(' + dialRadius + ',' + dialRadius + ')');
            var bearing = createSvgElement('circle');
            bearing.setAttribute('class', 'clockpicker-canvas-bearing');
            bearing.setAttribute('cx', 0);
            bearing.setAttribute('cy', 0);
            bearing.setAttribute('r', 2);
            var hand = createSvgElement('line');
            hand.setAttribute('x1', 0);
            hand.setAttribute('y1', 0);
            var bg = createSvgElement('circle');
            bg.setAttribute('class', 'clockpicker-canvas-bg');
            bg.setAttribute('r', tickRadius);
            var fg = createSvgElement('circle');
            fg.setAttribute('class', 'clockpicker-canvas-fg');
            fg.setAttribute('r', 3.5);
            g.appendChild(hand);
            g.appendChild(bg);
            g.appendChild(fg);
            g.appendChild(bearing);
            svg.appendChild(g);
            canvas.append(svg);
            this.hand = hand;
            this.bg = bg;
            this.fg = fg;
            this.bearing = bearing;
            this.g = g;
            this.canvas = canvas;
        }

        raiseCallback(this.options.init);
    }

    function raiseCallback(callbackFunction) {
        if (callbackFunction && typeof callbackFunction === "function") {
            callbackFunction();
        }
    }

    // Default options
    ClockPicker.DEFAULTS = {
        'default': 'now', // default time, 'now' or '13:14' e.g.
        fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
        placement: 'bottom', // clock popover placement
        align: 'left', // popover arrow align
        donetext: '完成', // done button text
        autoclose: false, // auto close when minute is selected
        twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
        vibrate: true        // vibrate the device when dragging clock hand
    };
    // Show or hide popover
    ClockPicker.prototype.toggle = function () {
        this[this.isShown ? 'hide' : 'show']();
    };
    // Set popover position
    ClockPicker.prototype.locate = function () {
        var element = this.element,
                popover = this.popover,
                offset = element.offset(),
                width = element.outerWidth(),
                height = element.outerHeight(),
                placement = this.options.placement,
                align = this.options.align,
                styles = {},
                self = this;
        popover.show();
        // Place the popover
        switch (placement) {
            case 'bottom':
                styles.top = offset.top + height;
                break;
            case 'right':
                styles.left = offset.left + width;
                break;
            case 'top':
                styles.top = offset.top - popover.outerHeight();
                break;
            case 'left':
                styles.left = offset.left - popover.outerWidth();
                break;
        }

        // Align the popover arrow
        switch (align) {
            case 'left':
                styles.left = offset.left;
                break;
            case 'right':
                styles.left = offset.left + width - popover.outerWidth();
                break;
            case 'top':
                styles.top = offset.top;
                break;
            case 'bottom':
                styles.top = offset.top + height - popover.outerHeight();
                break;
        }

        popover.css(styles);
    };
    // Show popover
    ClockPicker.prototype.show = function (e) {
        // Not show again
        if (this.isShown) {
            return;
        }

        raiseCallback(this.options.beforeShow);
        var self = this;
        // Initialize
        if (!this.isAppended) {
            // Append popover to body
            $body = $(document.body).append(this.popover);
            // Reset position when resize
            $win.on('resize.clockpicker' + this.id, function () {
                if (self.isShown) {
                    self.locate();
                }
            });
            this.isAppended = true;
        }

        // Get the time
        var value = ((this.input.prop('value') || this.options['default'] || '') + '');
        this.amOrPm = AmOrPm(value);
        value = value.split(':');
        if (value[0] === 'now') {
            var now = new Date(+new Date() + this.options.fromnow);
            value = [
                now.getHours(),
                now.getMinutes()
            ];
        }
        this.hours = +value[0] || 0;
        this.minutes = +value[1] || 0;
        this.spanHours.html(leadingZero(this.hours));
        this.spanMinutes.html(leadingZero(this.minutes));
        if (this.options.twelvehour)
            this.spanAmPm.html(this.amOrPm);
        // Toggle to hours view
        this.toggleView('hours');
        // Set position
        this.locate();
        this.isShown = true;
        // Hide when clicking or tabbing on any element except the clock, input and addon
        $doc.on('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id, function (e) {
            console.log(self.isShown);
            console.log(self.popover);
            console.log(self.addon);
            console.log(self.input);
            var target = $(e.target);
            if (target.closest(self.popover).length === 0 &&
                    target.closest(self.addon).length === 0 &&
                    target.closest(self.input).length === 0) {
                self.hide();
            }
        });
        // Hide when ESC is pressed
        $doc.on('keyup.clockpicker.' + this.id, function (e) {
            if (e.keyCode === 27) {
                self.hide();
            }
        });
        raiseCallback(this.options.afterShow);
    };
    // Hide popover
    ClockPicker.prototype.hide = function () {
        raiseCallback(this.options.beforeHide);
        this.isShown = false;
        // Unbinding events on document
        $doc.off('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id);
        $doc.off('keyup.clockpicker.' + this.id);
        this.popover.hide();
        raiseCallback(this.options.afterHide);
    };
    // Toggle to hours or minutes view
    ClockPicker.prototype.toggleView = function (view, delay) {

        var _this = this;
        var raiseAfterHourSelect = false;
        if (view === 'minutes' && $(this.hoursView).css("visibility") === "visible") {
            raiseCallback(this.options.beforeHourSelect);
            raiseAfterHourSelect = true;
        }
        var isHours = view === 'hours',
                nextView = isHours ? this.hoursView : this.minutesView,
                hideView = isHours ? this.minutesView : this.hoursView;
        this.currentView = view;
        this.spanHours.toggleClass('text-primary', isHours);
        this.spanMinutes.toggleClass('text-primary', !isHours);
        // Let's make transitions
        hideView.addClass('clockpicker-dial-out');
        nextView.css('visibility', 'visible').removeClass('clockpicker-dial-out');
        // Reset clock hand
        this.resetClock(delay);
        // After transitions ended
        clearTimeout(this.toggleViewTimer);
        this.toggleViewTimer = setTimeout(function () {

            if (_this.options.twelvehour)
                nextView.parents(".popover-content").find("." + _this.amOrPm.toLowerCase() + "-button").focus();
            hideView.css('visibility', 'hidden');
        }, duration);
        if (raiseAfterHourSelect) {
            raiseCallback(this.options.afterHourSelect);
        }
    };
    // Reset clock hand
    ClockPicker.prototype.resetClock = function (delay) {
        var view = this.currentView,
                value = this[view],
                isHours = view === 'hours',
                unit = Math.PI / (isHours ? 6 : 30),
                radian = value * unit,
                radius = isHours && value > 0 && value < 13 ? innerRadius : outerRadius,
                x = Math.sin(radian) * radius,
                y = -Math.cos(radian) * radius,
                self = this;
        if (svgSupported && delay) {
            self.canvas.addClass('clockpicker-canvas-out');
            setTimeout(function () {
                self.canvas.removeClass('clockpicker-canvas-out');
                self.setHand(x, y);
            }, delay);
        } else {
            this.setHand(x, y);
        }
    };
    // Set clock hand to (x, y)
    ClockPicker.prototype.setHand = function (x, y, roundBy5, dragging) {
        var radian = Math.atan2(x, -y),
                isHours = this.currentView === 'hours',
                unit = Math.PI / (isHours || roundBy5 ? 6 : 30),
                z = Math.sqrt(x * x + y * y),
                options = this.options,
                inner = isHours && z < (outerRadius + innerRadius) / 2,
                radius = inner ? innerRadius : outerRadius,
                value;
        if (options.twelvehour) {
            radius = outerRadius;
        }

        // Radian should in range [0, 2PI]
        if (radian < 0) {
            radian = Math.PI * 2 + radian;
        }

        // Get the round value
        value = Math.round(radian / unit);
        // Get the round radian
        radian = value * unit;
        // Correct the hours or minutes
        if (options.twelvehour) {
            if (isHours) {
                if (value === 0) {
                    value = 12;
                }
            } else {
                if (roundBy5) {
                    value *= 5;
                }
                if (value === 60) {
                    value = 0;
                }
            }
        } else {
            if (isHours) {
                if (value === 12) {
                    value = 0;
                }
                value = inner ? (value === 0 ? 12 : value) : value === 0 ? 0 : value + 12;
            } else {
                if (roundBy5) {
                    value *= 5;
                }
                if (value === 60) {
                    value = 0;
                }
            }
        }

        // Once hours or minutes changed, vibrate the device
        if (this[this.currentView] !== value) {
            if (vibrate && this.options.vibrate) {
                // Do not vibrate too frequently
                if (!this.vibrateTimer) {
                    navigator[vibrate](10);
                    this.vibrateTimer = setTimeout($.proxy(function () {
                        this.vibrateTimer = null;
                    }, this), 100);
                }
            }
        }

        this[this.currentView] = value;
        this[isHours ? 'spanHours' : 'spanMinutes'].html(leadingZero(value));
        // If svg is not supported, just add an active class to the tick
        if (!svgSupported) {
            this[isHours ? 'hoursView' : 'minutesView'].find('.clockpicker-tick').each(function () {
                var tick = $(this);
                tick.toggleClass('active', value === +tick.html());
            });
            return;
        }

        // Place clock hand at the top when dragging
        if (dragging || (!isHours && value % 5)) {
            this.g.insertBefore(this.hand, this.bearing);
            this.g.insertBefore(this.bg, this.fg);
            this.bg.setAttribute('class', 'clockpicker-canvas-bg clockpicker-canvas-bg-trans');
        } else {
            // Or place it at the bottom
            this.g.insertBefore(this.hand, this.bg);
            this.g.insertBefore(this.fg, this.bg);
            this.bg.setAttribute('class', 'clockpicker-canvas-bg');
        }

        // Set clock hand and others' position
        var cx = Math.sin(radian) * radius,
                cy = -Math.cos(radian) * radius;
        this.hand.setAttribute('x2', cx);
        this.hand.setAttribute('y2', cy);
        this.bg.setAttribute('cx', cx);
        this.bg.setAttribute('cy', cy);
        this.fg.setAttribute('cx', cx);
        this.fg.setAttribute('cy', cy);
    };
    // Hours and minutes are selected
    ClockPicker.prototype.done = function () {
        raiseCallback(this.options.beforeDone);
        this.hide();
        var last = this.input.prop('value'),
                value = leadingZero(this.hours) + ':' + leadingZero(this.minutes);
        if (this.options.twelvehour) {
            value = value + this.amOrPm;
        }

        this.input.prop('value', value);
        if (value !== last) {
            this.input.triggerHandler('change');
            if (!this.isInput) {
                this.element.trigger('change');
            }
        }

        if (this.options.autoclose) {
            this.input.trigger('blur');
        }

        raiseCallback(this.options.afterDone);
    };
    // Remove clockpicker from input
    ClockPicker.prototype.remove = function () {
        this.element.removeData('clockpicker');
        this.input.off('focus.clockpicker click.clockpicker');
        this.addon.off('click.clockpicker');
        if (this.isShown) {
            this.hide();
        }
        if (this.isAppended) {
            $win.off('resize.clockpicker' + this.id);
            this.popover.remove();
        }
    };
    // Extends $.fn.clockpicker
    $.fn.clockpicker = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.each(function () {
            var $this = $(this),
                    data = $this.data('clockpicker');
            if (!data) {
                var options = $.extend({}, ClockPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);
                $this.data('clockpicker', new ClockPicker($this, options));
            } else {
                // Manual operations. show, hide, remove, e.g.
                if (typeof data[option] === 'function') {
                    data[option].apply(data, args);
                }
            }
        });
    };
}()); //Funcion necesaria para el clickpicker
function SiValida()
{
    $('.requerido').css({'border': 'none'});
    var Correcto = true;
    $('.requerido').each(function (i, elem)
    {

        if ($(elem).val() == '')
        {
            $(elem).css({'border': '2px solid red'});
            $(elem).parent().parent().children('.tooltip_input').fadeIn();
            $(elem).parent().parent().children('.tooltip_input').html('No puede ir vac&iacute;o');
            $(elem).parent().parent().children('.tooltip_input').width('260');
            Correcto = false;
        }
    });
    return Correcto;
}
function tin(input)
{

    tinymce.init({
        selector: "textarea" + input,
        theme: "modern",
        height: 500,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor importcss"
        ],
        file_browser_callback: function elFinderBrowser(field_name, url, type, win)
        {
            tinymce.activeEditor.windowManager.open({
                file: './subir_archivos.html', // use an absolute path!
                title: "Insertar fichero",
                width: 900,
                height: 519,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
        },
        content_css: "css/development.css",
        add_unload_trigger: false,
        toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage ",
        image_advtab: true,
        language: 'es',
        style_formats: [
            {title: 'Bold text', format: 'h1'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        template_replace_values: {
            username: "Jack Black"
        },
        template_preview_replace_values: {
            username: "Preview user name"
        },
        templates: [
            {title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
            {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
        ],
        setup: function (ed) {
            ed.addButton('custompanelbutton', {
                type: 'panelbutton',
                text: 'Panel',
                panel: {
                    type: 'form',
                    items: [
                        {type: 'button', text: 'Ok'},
                        {type: 'button', text: 'Cancel'}
                    ]
                }
            });
            ed.addButton('textbutton', {
                type: 'button',
                text: 'Text'
            });
        },
        spellchecker_callback: function (method, words, callback) {
            if (method == "spellcheck") {
                var suggestions = {};
                for (var i = 0; i < words.length; i++) {
                    suggestions[words[i]] = ["First", "second"];
                }

                callback(suggestions);
            }
        }
    });
}
function autofitIframe(id)
{
    if (!window.opera && document.all && document.getElementById) {
        id.style.height = id.contentWindow.document.body.scrollHeight;
    } else if (document.getElementById) {
        id.style.height = id.contentDocument.body.scrollHeight + "px";
    }
}
function getUrlVars(id)  //Funcion para llamar datos capturar valores url get ejemplo var second = getUrlVars()["name2"];
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    if (typeof vars[id] === "undefined")
    {
        vars = null;
    }
    return vars;
}
function ValuesId(Name)//Funcion para llamar a todos los id que se encuentran en un array html input text
{
    var i = 1;
    var value = [], temp;
    var Funtion = 'input[name^="' + Name + '"]';
    $(Funtion).each(function ()
    {
        temp = document.getElementsByName(Name + '[]')[i];
        value.push(temp);
        i = i + 1;
    });
    return value;
}
function ValueName(Name)
{
    var Values = [];
    $('input[name^="' + Name + '"]').each(function ()
    {
        Values.push(this.value);
    });
    return Values;
}
$.fn.clearForm = function () {
    return this.each(function () {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
            return $(':input', this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea')
            this.value = '';
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        else if (tag == 'select')
            this.selectedIndex = -1;
    });
};
function ValidarFormulario(Form)
{
    var form = true; //$(Form).validate().form();
    var select = true;
    $(Form + ' select').each(function (index)
    {
        if ($(this).attr('required') === 'required')
        {
            if ($(this).val() === '-1' || $(this).val() === null)
            {
                select = false;
                $(this).attr('style', 'background-color: antiquewhite;');
            } else
            {
                $(this).attr('style', 'background-color: #FFF;');
                $(this).remove('.error');
            }

        }
    });
    if (form === true && select === true)
    {
        return true;
    } else
    {
        return false;
    }
}
function Notification_msg(title, msg, type)
{
    $.notify({
        title: title + '. ',
        message: msg
    },
    {
        type: type
    },
    {
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate:
                {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
    });
}

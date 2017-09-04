(function ($) {
    $.fn.printPage = function (options) {

        // EXTEND options for this button
        var pluginOptions = {
            attr: "href",
            url: false,
            message: "Imprimiendo. Por favor espere."
        };
        $.extend(pluginOptions, options);

        this.on("click", function () {
            loadPrintDocument(this, pluginOptions);
            return false;
        });

        function loadingstop()
        {
            $("#pre-load-web").fadeOut(3000, function ()
            {
                $(this).remove();
                $("body").css({"overflow-y": "auto"});
            });
        }
        function loadingstart()
        {
            $("body").css({"overflow-y": "hidden"});
            var alto = $(window).height();
            $("body").append("<div id='pre-load-web'><div id='imagen-load'><img id='id_img_loading_start' src='../img/loading.gif'  /></div>");
            $("#pre-load-web").css({height: 10000 + "px"});
            $("#imagen-load").css({"margin-top": (alto / 2) - 30 + "px"});
        }
        function loadPrintDocument(el, pluginOptions)
        {
            loadingstart();
            $("body").append(components.messageBox(pluginOptions.message));
            //$("#printMessageBox").css("opacity", 0);
            addIframeToPage(el, pluginOptions);
            /*$("#printMessageBox").animate({opacity: 1}, 300, function () {
             
             });*/
        }
        function addIframeToPage(el, pluginOptions) {

            var url = (pluginOptions.url) ? pluginOptions.url : $(el).attr(pluginOptions.attr);

            if (!$('#printPage')[0]) {
                $("body").append(components.iframe(url));
                $('#printPage').on("load", function () {
                    printit();
                });
            } else {
                $('#printPage').attr("src", url);
            }
        }
        function printit() {
            frames["printPage"].focus();
            frames["printPage"].print();
            unloadMessage();
        }
        function unloadMessage() {
            loadingstop();
        }
        var components = {
            iframe: function (url) {
                return '<iframe id="printPage" name="printPage" src=' + url + ' style="position:absolute;top:0px; left:0px;width:0px; height:0px;border:0px;overfow:none; z-index:-1"></iframe>';
            },
            messageBox: function (message)
            {
                return "<div id='printMessageBox' style='\
          position:fixed;\
          top:50%; left:50%;\
          text-align:center;\
          margin: -60px 0 0 -155px;\
          width:310px; height:120px; font-size:16px; padding:10px; color:#222; font-family:helvetica, arial;\
          opacity:0;\
          background:#fff;\
          border: 6px solid #555;\
          border-radius:8px; -webkit-border-radius:8px; -moz-border-radius:8px;\
          box-shadow:0px 0px 10px #888; -webkit-box-shadow:0px 0px 10px #888; -moz-box-shadow:0px 0px 10px #888'>\
          " + message + "</div>";
            }
        };
    };
})(jQuery);

function loadingstop()
{
    $("#pre-load-web").fadeOut(1000, function ()
    {
        $(this).remove();
        $("body").css({"overflow-y": "auto"});
    });
}
function loadingstart()
{
    $("body").css({"overflow-y": "hidden"});
    var alto = $(window).height();
    $("body").append("<div id='pre-load-web'><div id='imagen-load'><img src='../img/loading.gif'  /></div>");
    $("#pre-load-web").css({height: alto + "px"});
    $("#imagen-load").css({"margin-top": (alto / 2) - 30 + "px"});
}
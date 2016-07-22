// ==UserScript==
// @name        aviootryad
// @namespace   erepublik
// @description users, users
// @include     *www.erepublik.com/en
// @version     0.01
// @grant       none
// ==/UserScript==
function style(t) {
    $("head").append("<style>" + t + "</style>")
}

function parseOrgs() {
    var ids = [],
        ct = 0;
    src = $("#source").val().split('\n');
    ctl = src.length;
    $.each(src, function(i, el) {
        if (el.match(/profile\//)) {
            id = el.split(/profile\//)[1];
        } else {
            id = undefined;
        }
        if (id != undefined) {
            if ($.inArray(id, ids) === -1) {
                ids.push(id);
                $.ajax({
                        url: "/en/citizen/profile/" + id,
                    })
                    .done(function(t) {
                        var nameh = $(t).find('.citizen_profile_header h2').html();
                        if (nameh.length > 0) {
                            var name = $.trim(nameh.split('\<\/strong\>')[2]);
                            var exp = $.trim(nameh.split('\<\/strong\>')[1].split("\/")[1].replace(/[^0-9]/g, ""));
                            var strength = $(t).find(".mb_bottom:first").text().replace(/[^0-9\.]/g, "").replace(/\./g, decimalseparator);
                            var mrank = $(t).find(".rank_numbers:eq(0)").text().split('/')[0].replace(/[^0-9]/g, "");
                            var arank = $(t).find(".rank_numbers:eq(1)").text().split('/')[0].replace(/[^0-9]/g, "");
                            $.ajax({
                                url: "https://docs.google.com/forms/d/e/1FAIpQLSdj_l2xZmFjGOxzXU6EruZgDfRJMdfp4Y8D6m4WSfNkyW0QwQ/formResponse",
                                data: {
                                    "entry.1033147201": name,
                                    "entry.1630992086": exp,
                                    "entry.1163862787": mrank,
                                    "entry.1888692871": arank,
                                },
                                type: "POST",
                            });
                            ct++;
                            ww = Math.round(ct / ctl * 100);
                            $('#ctProgress div').css("width", ww + "%").text(ww + "%");
                        }
                    })
            }
        }
    })
}

function shownag() {
    style("#orgsnag{margin:5px 0 -5px;width:100%;display:inline-block;cursor:pointer;background:#83B70B;color:white;font:bold 11px Arial;text-align:center;padding:3px 0px;border-radius:1px}#orgsnag:hover,#orgsopts a:hover{background:#FB7E3D}#orgsopts a{cursor:pointer;color:white;font-weight:bold;background:#83B70B;padding:5px;margin:20px;border-radius:1px}")
    style(".belichko{color: white;}#decsep{font-size:14px;}");
    style("#ctProgress { width: 150px; margin: 0 0 10px 0; height: 16px; border: 1px solid #fff !important; background-color: #292929 !important; }");
    style("#ctProgress div { height: 100%; color: #fff; text-align: right; line-height: 16px; width: 0; background-color: #0099ff !important; }");
    $("body").append('<div id="orgsblock" style="display:none;z-index:999998;position:fixed;top:0;width:100%;height:100%;background:rgba(0,0,0,0.6)"></div><div id="orgsopts" style="display:none;width:900px;top:100px;margin:auto;cursor:default;position:fixed;left:' + ($(window).width() - 900) / 2 + 'px;z-index:999999"></div>')
    $("#orgsopts").append('<div id="ctProgress"><div>')
    $("#orgsopts").append('<span class="belichko">Списък с играчи</span><br><textarea id="source" rows="10" cols="120"></textarea><br>')
    $("#orgsopts").append('<button id="parse">Играчи</button> <button id="close">Затвори</button><br>')
    $("#close").click(function() {
        $("#orgsopts, #orgsblock").hide();
        $("#orgsopts, #orgsblock").remove();
    })
    $("#parse").click(function() {
        parseOrgs();
    })
    $("#orgsopts, #orgsblock").show()
}
var $ = jQuery
var m = {};
id = 0;
var decimalseparator = ",";

$("#notify_clone").before("<div style='position: fixed; top: 0; left: 50px; width: 16px; color: #fff; background-color: navy; border : 1px solid navy; cursor: pointer; margin: 7px 0 0 1px; -moz-border-radius: 3px; -webkit-border-radius: 3px; -khtml-border-radius: 3px; border-radius: 3px;'><a id='pitanka' href='javascript:void(0);'> !!!! </a></div>");
$("#pitanka").click(function() {
    shownag();
})
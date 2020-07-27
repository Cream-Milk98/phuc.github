define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'mage/mage'
], function ($) {
    'use strict';
    return function change(config, element){

        $(".btn-ajax").click(function () {
            var thisButton = this;
            var seeUrl = config.Url;
            var time = '10';
            $.ajax({
                url: seeUrl,
                type: 'POST',
           success: function () {
               setTimeout(function(){
                    time--;
                   $('#demo-ajax').html(time);
               },1000);
                $(thisButton).html(config.message);
            },
                error: function (e) {
                    console.log(e.message);
                }
            })
        })
    }
});

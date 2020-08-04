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
            // var color = new Array("black","red","orange","blue");
            $.ajax({
                url: seeUrl,
                type: 'POST',
           success: function () {
               setInterval(function() {
                   $('#demo-ajax').html(time);
                   time--;
                   $('#demo-ajax').css('color','red');
                   if ( time < 0){
                       $(thisButton).html(config.message);
                       $(thisButton).css('color','white');
                       $(thisButton).css('background-color','black');
                       $('#demo-ajax').css('color','black');
                       $('#demo-ajax').html('End');

                   }
                   
               }, 1000);
            },
                error: function (e) {
                    console.log(e.message);
                }
            })
        })
    }
});


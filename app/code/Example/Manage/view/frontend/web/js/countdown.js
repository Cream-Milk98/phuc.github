// define([
//     'jquery',
//     'mage/translate',
//     'jquery/ui',
//     'mage/mage'
// ], function ($,config) {
//     'use strict';
//     return function Countdown()
//     {
//         var p = document.querySelector('p');
//         // var redirect = "http://magento2.local.com";
//         var end = new Date("<?= $end ?>").getTime();
//         var start = new Date("<?= $start ?>").getTime();
//         var prod = "<?= $currentProduct ?>";
//         var name = "<?= $sku ?>";
//         var status = "<?= $status ?>";
//         if (status === '0') {
//             document.getElementById("sale").style.display = "none";
//         }
//
//         if (name === prod) {
//             var countDown = setInterval(run, 1000);
//
//             function run() {
//                 var now = new Date().getTime();
//                 //Số s đến thời gian hiện tại
//                 var timeRest = end - now;
//                 //Số s còn lại để Kết thúc sale;
//                 var timeStart = start - now;
//                 var day = Math.floor(timeStart / (1000 * 60 * 60 * 24));
//                 //Số ngày còn lại
//                 var hours = Math.floor(timeStart % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
//                 // Số giờ còn lại
//                 var minute = Math.floor(timeStart % (1000 * 60 * 60) / (1000 * 60));
//                 // Số phút còn lại
//                 var sec = Math.floor(timeStart % (1000 * 60) / (1000));
//                 // Số giây còn lại
//                 p.innerHTML = "Sale Start In: " + day + ' DAY ' + hours + ' : ' + minute + ' : ' + sec + "  ";
//                 document.getElementById("one").style.color = "orangered";
//                 if (timeStart <= 0) {
//                     var day = Math.floor(timeRest / (1000 * 60 * 60 * 24));
//                     //Số ngày còn lại
//                     var hours = Math.floor(timeRest % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
//                     // Số giờ còn lại
//                     var minute = Math.floor(timeRest % (1000 * 60 * 60) / (1000 * 60));
//                     // Số phút còn lại
//                     var sec = Math.floor(timeRest % (1000 * 60) / (1000));
//                     // Số giây còn lại
//                     p.innerHTML = "Sale Ends In: " + day + ' DAY ' + hours + ' : ' + minute + ' : ' + sec + "  ";
//                     document.getElementById("one").style.color = "#b61a70";
//                     if (timeRest <= 0) {
//                         clearInterval(countDown);
//                         document.getElementById("one").innerHTML = "End Sale";
//                         document.getElementById("one").style.color = "blue";
//                     }
//                 }
//             }
//         }
//     }
// });

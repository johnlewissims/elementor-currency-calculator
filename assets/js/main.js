( function( $ ) {
var ie = (isIE = /*@cc_on!@*/ false || !!document.documentMode);
var isChrome = !!window.chrome && !!window.chrome.webstore;

/* Currency */

var targetCurrency = $('.targetCurrency').text();
var apiKey = $('.apiKey').text();
var url = "https://apilayer.net/api/live?access_key=" + apiKey + "&currencies=" + targetCurrency + "&source=USD&format=1";
console.log(url);
$.getJSON(url, function(result){
      $('.result').empty();
      $('.fee').empty();
      $('.rateFinal').empty();
      var symbol = $('.symbol').text();
      var targetCurrency = $('.targetCurrency').text();
      var fxFeeText = $('.fxFee').text();
      var currencyText = 'USD' + targetCurrency;
      var fxFee = parseFloat(fxFeeText);
      var rate = result['quotes'][currencyText];
      var rateFee = rate * fxFee;
      var rateFinal = rate - rateFee;
      var usd = 500;
      var est = usd * rate;
      var wbFee = est * 0.01;
      var wbFeeUsd = usd * 0.01;
      var estFinal = est - wbFee;
      var toFixedEstFinal = estFinal.toFixed(2);
      var toFixedRateFinal = rateFinal.toFixed(4);
      $('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>");
      $('.rateFinal').append("<span> " + Number(toFixedRateFinal).toLocaleString('en-US') +"</span>");
  });

$('.usd').keypress(function(){
  $.getJSON(url, function(result){
    $('.result').empty();
    $('.fee').empty();
    $('.rateFinal').empty();
    var symbol = $('.symbol').text();
    var targetCurrency = $('.targetCurrency').text();
    var fxFeeText = $('.fxFee').text();
    var currencyText = 'USD' + targetCurrency;
    var fxFee = parseFloat(fxFeeText);
    var rate = result['quotes'][currencyText];
    var rateFee = rate * fxFee;
    var rateFinal = rate - rateFee;
    var usd = $('.usd').val();
    var est = usd * rate;
    var wbFee = est * 0.01;
    var wbFeeUsd = usd * 0.01;
    var estFinal = est - wbFee;
    var toFixedEstFinal = estFinal.toFixed(2);
    var toFixedRateFinal = rateFinal.toFixed(4);
    $('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>");
    $('.rateFinal').append("<span> " + Number(toFixedRateFinal).toLocaleString('en-US') +"</span>");
  });
})


} )( jQuery );

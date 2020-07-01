( function( $ ) {
var ie = (isIE = /*@cc_on!@*/ false || !!document.documentMode);
var isChrome = !!window.chrome && !!window.chrome.webstore;

/* Currency */
/* Currency */

$('.elementor-widget-jl-widget').each(function(index, widget){
  var targetCurrency = $(this).find('.targetCurrency').text();
  var sourceCurrency = 'USD';
  var apiKey = $(this).find('.apiKey').text();
  var url = "https://apilayer.net/api/live?access_key=" + apiKey + "&currencies=" + targetCurrency + "&source=" + sourceCurrency + "&format=1";
  console.log(url)
  // $.getJSON(url, function(result){
  //       $(widget).find('.result').empty();
  //       $(widget).find('.fee').empty();
  //       $(widget).find('.rateFinal').empty();
  //       var symbol = $(widget).find('.symbol').text();
  //       var targetCurrency = $(widget).find('.targetCurrency').text();
  //       var sourceCurrency = 'USD';
  //       var fxFeeText = $(widget).find('.fxFee').text();
  //       var currencyText = sourceCurrency + targetCurrency;
  //       var fxFee = parseFloat(fxFeeText);
  //       var rate = result['quotes'][currencyText];
  //       var rateFee = rate * fxFee;
  //       var rateFinal = rate;
  //       var usd = 1000;
  //       var est = usd * rate;
  //       var wbFee = est * fxFee;
  //       var wbFeeUsd = usd * fxFee;
  //       var estFinal = est - wbFee;
  //       var toFixedEstFinal = estFinal.toFixed(2);
  //       var toFixedRateFinal = rateFinal.toFixed(4);
  //       $(widget).find('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>");
  //       $(widget).find('.rateFinal').append("<span> " + Number(toFixedRateFinal).toLocaleString('en-US') +"</span>");
  //   });

  $.getJSON(url, function(result){
        $(widget).find('.result').empty();
        $(widget).find('.fee').empty();
        $(widget).find('.rateFinal').empty();
        var symbol = $(widget).find('.symbol').text();
        var targetCurrency = $(widget).find('.targetCurrency').text();
        var sourceCurrency = 'USD';
        var fxFeeText = $(widget).find('.fxFee').text();
        var currencyText = sourceCurrency + targetCurrency;
        var fxFee = parseFloat(fxFeeText);
        var rate = result['quotes'][currencyText];
        var rateFee = rate * fxFee;
        var rateFinal = rate;
        var usd = 1000;
        var est = usd * rate;
        var wbFee = est * fxFee;
        var wbFeeUsd = usd * fxFee;
        var estFinal = est - wbFee;
        var toFixedEstFinal = estFinal.toFixed(2);
        var toFixedRateFinal = rate.toFixed(4);
        $(widget).find('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>");
        $(widget).find('.rateFinal').append("<span> " + Number(toFixedRateFinal).toLocaleString('en-US') +"</span>");
    });

})

//console.log('hello')
	
$('.usd').keypress(function(){
  var context = $(this).closest('.elementor-widget-jl-widget');
  var targetCurrency = $(context).find('.targetCurrency').text();
  //var targetCurrency = $('.targetCurrency').text();
  var apiKey = $(context).find('.apiKey').text();
	var url = "https://apilayer.net/api/live?access_key=" + apiKey + "&currencies=" + targetCurrency + "&source=USD&format=1";
  ///console.log(url)
  $.getJSON(url, function(result){ 
    $(context).find('.result').empty();
    $(context).find('.fee').empty();
    $(context).find('.rateFinal').empty();
    var symbol = $(context).find('.symbol').text();
    var targetCurrency = $(context).find('.targetCurrency').text();
    var fxFeeText = $(context).find('.fxFee').text();
	  var sourceCurrency = 'USD';
    var currencyText = sourceCurrency + targetCurrency;
    var fxFee = parseFloat(fxFeeText);
    var rate = result['quotes'][currencyText];
    var rateFee = rate * fxFee;
    var rateFinal = rate - rateFee;
    var usd = $(context).find('.usd').val();
    var est = usd * rate;
    var wbFee = est * fxFee;
    var wbFeeUsd = usd * fxFee;
    var estFinal = est - wbFee;
    var toFixedEstFinal = estFinal.toFixed(2);
    var toFixedRateFinal = rate.toFixed(4);
    $(context).find('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>").fadeIn();
	  $(context).find('.result').hide();
	  $(context).find('.result').fadeIn(); 
    $(context).find('.rateFinal').append("<span> " + Number(rate).toLocaleString('en-US') +"</span>");
  });
})
	
function currencyUpdate(destinationCurrency, element) {
  var context = $(element).closest('.elementor-widget-jl-widget');
  var apiKey = $(context).find('.apiKey').text();
  var targetCurrency = $(context).find('.targetCurrency').text();
  var url = "https://apilayer.net/api/live?access_key=" + apiKey + "&currencies=" + targetCurrency + "&source=USD&format=1"; 	  
  var targetCurrency = destinationCurrency;  
	
  $.getJSON(url, function(result){ 
    $(context).find('.result').empty();
    $(context).find('.fee').empty();
    $(context).find('.rateFinal').empty();
    var symbol = $(context).find('.symbol').text();
    var fxFeeText = $(context).find('.fxFee').text();
	  var sourceCurrency = 'USD';  
    var currencyText = sourceCurrency + targetCurrency;
    var fxFee = parseFloat(fxFeeText);
    var rate = result['quotes'][currencyText];
    var rateFee = rate * fxFee;
    var rateFinal = rate - rateFee;
    var usd = $(context).find('.usd').val();
    var est = usd * rate;
    var wbFee = est * fxFee;
    var wbFeeUsd = usd * fxFee;
    var estFinal = est - wbFee;
    var toFixedEstFinal = estFinal.toFixed(2);
    var toFixedRateFinal = rate.toFixed(4);
	 
    $(context).find('.result').append(Number(toFixedEstFinal).toLocaleString('en-US', { style: 'currency', currency: targetCurrency }) +" <span style='font-size:12px;'>" + targetCurrency + "</span>");
    $(context).find('.rateFinal').append("<span> " + Number(toFixedRateFinal).toLocaleString('en-US') +"</span>");
  });
}	
	
$('.destinationSelected').click(function(){
  var context = $(this).closest('.elementor-widget-jl-widget');
	$(context).find('.destinationSelector').toggleClass('active');
})	
	
$('.destinationOptions').find('div').hover(function(){
	$(this).toggleClass('active')
})	

$('.destinationOptions').find('div').click(function(){
  var context = $(this).closest('.elementor-widget-jl-widget');
	$(context).find('.destinationSelector').toggleClass('active');
	var destinationCurrency = $(this).data("destinationcurrency");
	var destinationImage = $(this).data("image");
	$(context).find(".destinationSelected").find('img').attr("src",destinationImage);
	$(context).find('.targetCurrency').text(destinationCurrency);
	$(context).find('.currencyAbreviation').text(destinationCurrency);
	
	currencyUpdate(destinationCurrency, $(this))
})	
	
$('.destinationSelected').hover(function(){
	$(this).toggleClass('hover');
})	


} )( jQuery );

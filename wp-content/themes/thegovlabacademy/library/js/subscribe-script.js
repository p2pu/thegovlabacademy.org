$(document).ready(function() {

	$('#subscribe a').click(function(){
		$('#subscribe').addClass('active');
		$('#overlay').show();
	});

	$('#subscribe-submit').click(function(){
		$('#subscribe').removeClass('active');
		$('#modal-subscribe-successful').addClass('active');
	});

	$('.modal .button').click(function (){
		$('.modal').removeClass('active');
		$('#overlay').hide();
	});

	//  Function for the Overlay functionalities
	$('#overlay').click(function(){
		$('#subscribe').removeClass('active');
		$('.modal').removeClass('active');
		$('#overlay').hide();
	});


	// Function for interface color changing 
	$('.theme-menu a').click(function() {
		var theme = $(this).attr('class');
		$('body.theme-page').removeClass('data crowd behave history');
		$('body.theme-page').addClass(theme);
	});

	$('.theme-menu a').click(function() {
		var theme = $(this).attr('class');
		$('body.topic-page').removeClass('data crowd behave history');
		$('body.topic-page').addClass(theme);
	});






























});
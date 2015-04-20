


////////////////
// Navigation //
////////////////

// Use this variable to set the breakpoint at which the menu changes.
var breakPoint = 700;


// This function uses CSS classes to change the appearance of the menu.
function adjustNav() {

	if ($(document).width() < breakPoint) {

		$("nav.main-menu").removeClass("full").addClass("compact");
		$("nav.main-menu ul").hide();
	}

	else {

		$("nav.main-menu").removeClass("compact").addClass("full");
		$("nav.main-menu ul").show();
	}
}

// When the document loads, adjust the nav and add click handlers for the
// mobile view of the menu.

$(document).ready(function () {



	$("#assist-form-startdate").datepicker({ dateFormat: "yy-mm-dd" });
	$("#assist-form-enddate").datepicker({ dateFormat: "yy-mm-dd" });

	adjustNav();

	$(".menu-toggle").on('click', function (evt) {

		$("nav.main-menu ul").slideToggle();
		evt.preventDefault();
	});


	$("#inquiries-form").submit(function (evt) {

		evt.preventDefault();
		$(this).find("p.alert, p.success").fadeOut().remove();

		form = $(this);
		formData = $("#inquiries-form").serialize();

		$.ajax("http://osi.ucf.edu/osi/wp-content/themes/osi/functions/inquiry-handler.php",
		{
			method: 'POST',
			data: formData,
			success: function (data) {
				form.prepend("<p class='success'>" + data + "</p>");
				$("p.success").fadeIn(200);
				form[0].reset();
			},

			error: function (jqXHR, textStatus, errorThrown) {
				form.prepend("<p class='alert'>" + jqXHR.responseText + "</p>");
				$("p.alert").fadeIn(200);
			}
		});
	});


	$("#assist-form").submit(function (evt) {

		evt.preventDefault();
		$(this).find("p.alert, p.success").fadeOut().remove();

		form = $(this);
		formData = $("#assist-form").serialize();

		$.ajax("http://osi.ucf.edu/osi/wp-content/themes/osi/functions/assist-handler.php",
		{
			method: 'POST',
			data: formData,
			success: function (data) {
				form.prepend("<p class='success'>" + data + "</p>");
				$("p.success").fadeIn(200);
				form[0].reset();
			},

			error: function (jqXHR, textStatus, errorThrown) {
				form.prepend("<p class='alert'>" + jqXHR.responseText + "</p>");
				$("p.alert").fadeIn(200);
			}
		});
	});


	var count = 0;
	setInterval ( function() {

		rotateHeaders(count);
		count = (count+1) % headers.length;

	},5000);

});


// On window resize, reevaluate the view of the navigation.
$(window).resize(function () {

	adjustNav();
});



var dateCheck = new RegExp('^20[0-9]{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$');
var timeCheck = new RegExp('^((1[012]|[1-9])(:[0-5][0-9])?)$');
var colonCheck = new RegExp(':');
var getHour = new RegExp('^[0-9]{1,2}');
var getMinutes = new RegExp('[0-9]{1,2}$');

function startDateCheck() {

	var startDate = document.getElementById('assist-form-startdate');
	var endDate = document.getElementById('assist-form-enddate');

	if (!dateCheck.test(startDate.value)) {
		startDate.style.backgroundColor = '#FF9999';
	}
	else {
		startDate.style.backgroundColor = '';
		endDate.value = startDate.value;
	}
}

function startTimeCheck() {

	var startTime = document.getElementById('assist-form-starttime');
	var endTime = document.getElementById('assist-form-endtime');

	if (!timeCheck.test(startTime.value)) {
		startTime.style.backgroundColor = '#FF9999';
	}
	else {
		startTime.style.backgroundColor = '';

		var minutes;
		var hour = getHour.exec(startTime.value);

		if (colonCheck.test(startTime.value)) {
			minutes = getMinutes.exec(startTime.value);
		}
		else {
			minutes = "00";
		}

		startTime.value = hour + ":" + minutes;
	}
}

function endDateCheck() {

	var endDate = document.getElementById('assist-form-enddate');

	if (!dateCheck.test(endDate.value)) {
		endDate.style.backgroundColor = '#FF9999';
	}
	else {
		endDate.style.backgroundColor = '';
	}
}

 //Homepage reveal buttons
  var opened = 0;
$(".getinvolved").click(function (e) {
	e.preventDefault();
	var whichBtn = "." + $(this).attr("id");

	if( opened == 0 ){
		$(whichBtn).slideDown();
		if( whichBtn == ".agency-info" ){
			opened = 1;
			console.log(opened);
		}
		else if( whichBtn == ".rso-info" ){
			opened = 2;
			console.log(opened);
		}	
	}
	else if( opened == 1 ){
			$(".agency-info").slideUp();
			opened = 0;
			if( whichBtn == ".rso-info" ){
				$(".rso-info").slideDown();
				opened = 2;
			}
			console.log(opened);
	}
	else if( opened == 2 ){
			$(".rso-info").slideUp();
			opened = 0;
			if( whichBtn == ".agency-info" ){
				$(".agency-info").slideDown();
				opened = 1;
			}
			console.log(opened);
	}
});
//End Homepage reveal buttons

//Header Images

function rotateHeaders(currentIndex){

	var newIndex = (currentIndex+1) % headers.length;
	var reverse = headers.length - newIndex - 1;
	var title = headers[reverse].title;
	var src = headers[reverse].src;
	var shade = headers[reverse].shade;
	var link = headers[reverse].link;

	$(".featured-event").attr("href",link);
	$(".featured-event").css("background-image","url(" + src + ")");
	$(".logo").removeClass("logo-light").removeClass("logo-dark").addClass("logo-" +shade);

}


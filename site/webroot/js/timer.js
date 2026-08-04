/* ------- time -------- */
const launchDate = new Date("Aug 14, 2026 00:00:00").getTime();

const c = {
	context: {},
	values: {}, 
	times: {}
};

function deg(d) {
	return (Math.PI/180)*d-(Math.PI/180)*90;
}

function render(cmn_wdth,cmn_heth,circle_cx,circle_cy,circle_r,circle_thick,circle_color) {
	
	if(c.times.days > 0)
	{
		c.context.days.clearRect(0, 0, cmn_wdth, cmn_heth);
		c.context.days.beginPath();
		c.context.days.strokeStyle = circle_color;
		c.context.days.arc(circle_cx, circle_cy, circle_r, deg(0), deg(c.times.days));
		c.context.days.lineWidth = circle_thick;
		c.context.days.lineCap = "round"; 
		c.context.days.stroke();
	}
	else if(c.times.days <= 0)
	{
		c.context.days.clearRect(0, 0, cmn_wdth, cmn_heth);
	}
	
	if(c.times.days > 0 || c.times.hours > 0)
	{
		c.context.hours.clearRect(0, 0, cmn_wdth, cmn_heth);
		c.context.hours.beginPath();
		c.context.hours.strokeStyle = circle_color;
		c.context.hours.arc(circle_cx, circle_cy, circle_r, deg(0), deg(15 * c.times.hours));
		c.context.hours.lineWidth = circle_thick;
		c.context.hours.lineCap = "round"; 
		c.context.hours.stroke();
	}
	else if(c.times.days <= 0 || c.times.hours <= 0)
	{
		c.context.hours.clearRect(0, 0, cmn_wdth, cmn_heth);
	}
	
	if(c.times.days > 0 || c.times.hours > 0 || c.times.minutes > 0)
	{
		c.context.minutes.clearRect(0, 0, cmn_wdth, cmn_heth);
		c.context.minutes.beginPath();
		c.context.minutes.strokeStyle = circle_color;
		c.context.minutes.arc(circle_cx, circle_cy, circle_r, deg(0), deg(6 * c.times.minutes));
		c.context.minutes.lineWidth = circle_thick;
		c.context.minutes.lineCap = "round"; 
		c.context.minutes.stroke();
	}
	else if(c.times.days <= 0 || c.times.hours <= 0 || c.times.minutes <= 0)
	{
		c.context.minutes.clearRect(0, 0, cmn_wdth, cmn_heth);
	}
	
	if(c.times.days > 0 || c.times.hours > 0 || c.times.minutes > 0 || c.times.seconds > 0)
	{
		c.context.seconds.clearRect(0, 0, cmn_wdth, cmn_heth);
		c.context.seconds.beginPath();
		c.context.seconds.strokeStyle = circle_color;
		c.context.seconds.arc(circle_cx, circle_cy, circle_r, deg(0), deg(6 * c.times.seconds));
		c.context.seconds.lineWidth = circle_thick;
		c.context.seconds.lineCap = "round"; 
		c.context.seconds.stroke();
	}
	else if(c.times.days <= 0 || c.times.hours <= 0 || c.times.minutes <= 0 || c.times.seconds <= 0)
	{
		c.context.seconds.clearRect(0, 0, cmn_wdth, cmn_heth);
	}
}

function init(cmn_wdth,cmn_heth,circle_cx,circle_cy,circle_r,circle_thick,circle_color) {
	
	$('canvas').attr("width",cmn_wdth);
	$('canvas').attr("height",cmn_heth);
	$('svg').attr("width",cmn_wdth);
	$('svg').attr("height",cmn_heth);
	$('circle').attr("cx",circle_cx);
	$('circle').attr("cy",circle_cy);
	$('circle').attr("r",circle_r);
	$('circle').attr("stroke-width",circle_thick);
	
	c.context.seconds = document.getElementById('seconds-canvas').getContext('2d');
	c.context.minutes = document.getElementById('minutes-canvas').getContext('2d');
	c.context.hours = document.getElementById('hours-canvas').getContext('2d');
	c.context.days = document.getElementById('days-canvas').getContext('2d');
  
	c.values.seconds = document.getElementById('seconds-value');
	c.values.minutes = document.getElementById('minutes-value');
	c.values.hours = document.getElementById('hours-value');
	c.values.days = document.getElementById('days-value');
  
	setInterval(function() {
		const now = new Date().getTime();

		const distance = launchDate - now;

		c.times.days = Math.floor(distance / (1000 * 60 * 60 * 24));
		c.times.hours = Math.floor(
			(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
		);
		c.times.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		c.times.seconds = Math.floor((distance % (1000 * 60)) / 1000);

		(c.times.days > 0 || c.times.days == 0) ? c.values.days.innerText = c.times.days : 0;
		(c.times.hours > 0 || c.times.hours == 0) ? c.values.hours.innerText = c.times.hours : 0;
		(c.times.minutes > 0 || c.times.minutes == 0) ? c.values.minutes.innerText = c.times.minutes : 0;
		(c.times.seconds > 0 || c.times.seconds == 0) ? c.values.seconds.innerText = c.times.seconds : 0;

		if(c.times.days >= 0 || c.times.hours >= 0 || c.times.minutes >= 0 || c.times.seconds >= 0)
		{
			render(cmn_wdth,cmn_heth,circle_cx,circle_cy,circle_r,circle_thick,circle_color); // Draw!
		}
	}, 1000);
}

window.onload = function() {
	
	var cmn_wdth = 200;
	var cmn_heth = 200;
	var circle_cx = 100;
	var circle_cy = 100;
	var circle_r = 80;
	var circle_thick = 5;
	var circle_color = '#000000';
	
	if ($(".imgbg.imgbg3").length > 0)
	{
		circle_color = '#000000';
	}
	else if ($(".blackbg").length > 0 || $(".imgbg").length > 0 || $(".videobg").length > 0)
	{
		circle_color = '#ffffff';
	}
	
	init(cmn_wdth,cmn_heth,circle_cx,circle_cy,circle_r,circle_thick,circle_color);
	
	$(".loader").fadeOut("slow");
}

/* --------- subscribe form submit ---------- */
$(document).on('click', 'form button[type=submit]', function(e) {

    var email = $('#email').val();
	
	var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	
	if (validEmail.test(email))
	{
		$('.subscribe-success-true').show();
		return false;
	}
	else
	{
		$('.subscribe-success-false').show();
		return false;
	}
});

$(document).on('click', '.close', function(e) {
	$('.subscribe-success-true').fadeOut("slow");
	$('.subscribe-success-false').fadeOut("slow");
});

$(document).ready(function(){
    $(document).bind('keydown', function(e) { 
        if (e.which == 27) {
			$('.subscribe-success-true').fadeOut("slow");
			$('.subscribe-success-false').fadeOut("slow");
        }
    }); 
});
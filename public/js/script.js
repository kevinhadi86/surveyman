// window.onbeforeunload = function()
// {
// 	window.scroll(0,0);
// }

// var wait = 0;

// var prevScroll = window.pageYOffset;

// function stopScroll(timer)
// {
// 	document.body.style.overflow = 'hidden';
// 	setTimeout(function()
// 	{
// 		document.body.style.overflow = 'auto';
// 	}, timer);
// }

// window.onscroll = function()
// {
// 	var currScroll = window.pageYOffset;
// 	var scrollPosition = window.pageYOffset + window.screen.height - 50;
// 	if(currScroll > prevScroll)
// 	{
// 		if(wait == 0)
// 		{
// 			if(scrollPosition >= document.getElementById('aboutUs').offsetTop)
// 			{
// 				if(document.getElementById('navAbout').classList.contains('active') == false)
// 				{
// 					window.scroll
// 					({
// 						top: document.getElementById('aboutUs').offsetTop-74,
// 						behavior: 'smooth'
// 					});
// 					changeNavBar('navAbout');
// 					stopScroll(600);
// 				}
// 			}
// 			else if(scrollPosition >= document.getElementById('services').offsetTop)
// 			{
// 				if(document.getElementById('navServices').classList.contains('active') == false)
// 				{
// 					window.scroll
// 					({
// 						top: document.getElementById('services').offsetTop-74,
// 						behavior: 'smooth'
// 					});
// 					changeNavBar('navServices');
// 					stopScroll(600);
// 				}
// 			}
// 		}
// 	}
// 	else if(currScroll < prevScroll)
// 	{
// 		if(wait == 0)
// 		{
// 			if(window.pageYOffset + 75 < document.getElementById('services').offsetTop)
// 			{
// 				if(document.getElementById('navHome').classList.contains('active') == false)
// 				{
// 					window.scroll
// 					({
// 						top: document.getElementById('home').offsetTop -74,
// 						behavior: 'smooth'
// 					});
// 					changeNavBar('navHome');
// 					stopScroll(600);
// 				}
// 			}
// 			else if(window.pageYOffset +75 < document.getElementById('aboutUs').offsetTop)
// 			{
// 				if(document.getElementById('navServices').classList.contains('active') == false)
// 				{
// 					window.scroll
// 					({
// 						top: document.getElementById('services').offsetTop-74,
// 						behavior: 'smooth'
// 					});
// 					changeNavBar('navServices');
// 					stopScroll(600);
// 				}
// 			}
// 		}
// 	}
// 	prevScroll = currScroll;		
// }

// function changeNavBar(divId)
// {
// 	var removeActive1 = document.getElementById("navHome");
// 	var removeActive2 = document.getElementById("navServices");
// 	var removeActive3 = document.getElementById("navAbout");
// 	var addActive = document.getElementById(divId);
// 	removeActive1.classList.remove("active");
// 	removeActive2.classList.remove("active");
// 	removeActive3.classList.remove("active");
// 	addActive.classList.add("active");
// }

// function changeNav(divId)
// {
// 	if(wait == 0)
// 	{
// 		wait = 1;
// 		var navTarget = 0;
// 		if(divId == 'navHome')
// 		{
// 			navTarget = document.getElementById('home').offsetTop;
// 		}
// 		else if(divId == 'navServices')
// 		{
// 			navTarget = document.getElementById('services').offsetTop;
// 		}
// 		else if(divId == 'navAbout')
// 		{
// 			navTarget = document.getElementById('aboutUs').offsetTop;
// 		}
// 		navTarget -= 74;
// 		window.scroll
// 		({
// 			top: navTarget,
// 			behavior: 'smooth'
// 		});
// 		setTimeout(function()
// 		{
// 			wait = 0;
// 		}, Math.abs(window.pageYOffset-navTarget)/1.5);
// 		changeNavBar(divId);
// 	}
// }

// function changeAbout(divId)
// {
// 	var removeActive1 = document.getElementById("about1");
// 	var removeActive2 = document.getElementById("about2");
// 	var removeActive3 = document.getElementById("about3");
// 	var addActive = document.getElementById(divId);
// 	removeActive1.classList.remove("aboutActive");
// 	removeActive2.classList.remove("aboutActive");
// 	removeActive3.classList.remove("aboutActive");
// 	addActive.classList.add("aboutActive");

// 	var slider = document.getElementById("sliderItem");
// 	var pos = slider.offsetLeft;
// 	var id = setInterval(move, 1);
// 	var target = 0;
// 	if(divId == 'about1')
// 	{
// 		target = 0;
// 	}
// 	else if(divId == 'about2')
// 	{
// 		target = 700;
// 	}
// 	else if(divId == 'about3')
// 	{
// 		target = 1400;
// 	}
// 	function move()
// 	{
// 		if(pos == -target)
// 		{
// 			clearInterval(id);
// 		}
// 		else
// 		{
// 			if(pos > -target)
// 			{
// 				pos-= 10;
// 			}
// 			else if(pos < -target)
// 			{
// 				pos+= 10;
// 			}
// 			slider.style.left = pos + 'px';
// 		}
// 	}
// }

var wait = true;
var activePage = 0;

$(document).ready(function(){
    $(this).scrollTop(0);
    activePage = 0;
    wait = true;
});

function delayBy(time){
	wait = false;
	$(this).delay(time).queue(function(){
		wait = true;
		$(this).dequeue();
	});
}

function scrollPageTo(target)
{
	if(target == 0)
	{
		$("html, body").animate({
			scrollTop: $("#home").offset().top - 74
		}, 1000);
		delayBy(1000);
		changeNavBar("navHome");
	}
	else if(target == 1)
	{
		$("html, body").animate({
			scrollTop: $("#services").offset().top - 74
		}, 1000);
		delayBy(1000);
		changeNavBar("navServices");
	}
	else if(target == 2)
	{
		$("html, body").animate({
			scrollTop: $("#aboutUs").offset().top - 74
		}, 1000);
		delayBy(1000);
		changeNavBar("navAbout");
	}
}

$(window).on('wheel', function(e){
	var delta = e.originalEvent.deltaY;
	if(wait == true)
	{
		if(delta > 0)
		{
			if(activePage <= 1)
			{
				activePage++;
				scrollPageTo(activePage);
			}
		}
		else if(delta < 0)
		{
			if(activePage >= 1)
			{
				activePage--;
				scrollPageTo(activePage);
			}
		}
	}
});

function changeNav(divId)
{
	if(wait == true)
	{
		changeNavBar(divId);
		if(divId == "navHome")
		{
			activePage = 0;
		}
		else if(divId == "navServices")
		{
			activePage = 1;
		}
		else if(divId == "navAbout")
		{
			activePage = 2;
		}
		scrollPageTo(activePage);
	}
}

function changeNavBar(divId)
{
	$("#navHome").removeClass("active");
	$("#navServices").removeClass("active");
	$("#navAbout").removeClass("active");
	$("#" + divId).addClass("active");
}

function changeAbout(divId)
{
	if(wait == true)
	{
		$("#about1").removeClass("aboutActive");
		$("#about2").removeClass("aboutActive");
		$("#about3").removeClass("aboutActive");
		$("#" + divId).addClass("aboutActive");

		var target = 0;
		if(divId == "about1")
		{
			target = 0
		}
		else if(divId == "about2")
		{
			target = 100
		}
		else if(divId == "about3")
		{
			target = 200
		}
		$("#sliderItem").animate({'right': target + '%'}, 500);
		delayBy(500);
	}
}
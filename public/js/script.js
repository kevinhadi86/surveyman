window.onbeforeunload = function()
{
	window.scroll(0,0);
}

var wait = 0;

window.onscroll = function()
{
	var scrollPosition = window.pageYOffset;
	if(wait == 0)
	{
		if(scrollPosition < document.getElementById('services').offsetTop -75)
		{
			changeNavBar('navHome');
		}
		else if(scrollPosition < document.getElementById('aboutUs').offsetTop-75)
		{
			changeNavBar('navServices');
		}
		else
		{
			changeNavBar('navAbout');
		}
	}
}

function changeNavBar(divId)
{
	var removeActive1 = document.getElementById("navHome");
	var removeActive2 = document.getElementById("navServices");
	var removeActive3 = document.getElementById("navAbout");
	var addActive = document.getElementById(divId);
	removeActive1.classList.remove("active");
	removeActive2.classList.remove("active");
	removeActive3.classList.remove("active");
	addActive.classList.add("active");
}

function changeNav(divId)
{
	var navTarget = 0;
	wait = 1;
	if(divId == 'navHome')
	{
		navTarget = document.getElementById('home').offsetTop;
	}
	else if(divId == 'navServices')
	{
		navTarget = document.getElementById('services').offsetTop;
	}
	else if(divId == 'navAbout')
	{
		navTarget = document.getElementById('aboutUs').offsetTop;
	}
	navTarget -= 74;
	setTimeout(function()
	{
		wait = 0;
	}, 600);
	window.scroll
	({
		top: navTarget,
		behavior: 'smooth'
	});
	changeNavBar(divId);
}

function changeAbout(divId)
{
	var removeActive1 = document.getElementById("about1");
	var removeActive2 = document.getElementById("about2");
	var removeActive3 = document.getElementById("about3");
	var addActive = document.getElementById(divId);
	removeActive1.classList.remove("aboutActive");
	removeActive2.classList.remove("aboutActive");
	removeActive3.classList.remove("aboutActive");
	addActive.classList.add("aboutActive");

	var slider = document.getElementById("sliderItem");
	var pos = slider.offsetLeft;
	var id = setInterval(move, 1);
	var target = 0;
	if(divId == 'about1')
	{
		target = 0;
	}
	else if(divId == 'about2')
	{
		target = 700;
	}
	else if(divId == 'about3')
	{
		target = 1400;
	}
	function move()
	{
		if(pos == -target)
		{
			clearInterval(id);
		}
		else
		{
			if(pos > -target)
			{
				pos-= 10;
			}
			else if(pos < -target)
			{
				pos+= 10;
			}
			slider.style.left = pos + 'px';
		}
	}
}function changeNav(divId)
{
	var removeActive1 = document.getElementById("navHome");
	var removeActive2 = document.getElementById("navServices");
	var removeActive3 = document.getElementById("navAbout");
	var addActive = document.getElementById(divId);
	removeActive1.classList.remove("active");
	removeActive2.classList.remove("active");
	removeActive3.classList.remove("active");
	addActive.classList.add("active");
}
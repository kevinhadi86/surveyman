function changeNav(divId)
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
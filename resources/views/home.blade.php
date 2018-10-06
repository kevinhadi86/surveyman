<!DOCTYPE html>
<html>
<head>
	<title>SurveyMan - Your Gateway to an Easier Survey Distribution</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
	<header>
		<a href="#">
			<div class="logo">
				<div class="icon">
					<img src="assets/Icon_SurveyMan.png">
				</div>
				<div class="brandName">
					SurveyMan
				</div>
			</div>
		</a>
		<div class="navContainer">
			<nav>
				<a href="#">
					<div class="navItems active" id="navHome" onclick="changeNav('navHome')">
						Home
					</div>
				</a>
				<a href="#">
					<div class="navItems" id="navServices" onclick="changeNav('navServices')">
						Services
					</div>
				</a>
				<a href="#">
					<div class="navItems" id="navAbout" onclick="changeNav('navAbout')">
						About
					</div>
				</a>
			</nav>
			<div class="searchBar">
				<input type="text" name="surveySearch">
			</div>
			<div class="accountManagement">
				<a href="#">
					<div class="LoginButton yellowHover">
						Login
					</div>
				</a>
				<a href="#">
					<div class="RegisterButton yellowHover">
						Register
					</div>
				</a>
			</div>
		</div>
	</header>

	<main>
		<div class="home">
			<div class="introduction">
				<div class="introductionText">
					<div class="introductionTitle">
						Easiest way to get money while helping researchers
					</div>
					<div class="introductionBody">
						There are currently many questionnaires distributed by researchers.<br>
						Now you can contribute to their research and earn as much money as you can.
					</div>
					<a href="#">
						<div class="getStartedButton yellowHover">
							Get Started
						</div>
					</a>
				</div>
			</div>
			<div class="advantage">
				<div class="advantageContainer">
					<div class="advantageContent">
						<div class="advantageTitle">
							Easy To Use
						</div>
						<div class="advantageImg">
							<img src="assets/easy.png">
						</div>
						<div class="advantageText">
							dbsbdkjsahdusjdjsanndsan<br>
							djsnajkdnsakjdnjsakndsjdn<br>
							djksdksndjksnadjksndjjndsj
						</div>
					</div>
					<div class="advantageContent">
						<div class="advantageTitle">
							Cost Effective
						</div>
						<div class="advantageImg">
							<img src="assets/price.png">
						</div>
						<div class="advantageText">
							dbsbdkjsahdusjdjsanndsan<br>
							djsnajkdnsakjdnjsakndsjdn<br>
							djksdksndjksnadjksndjjndsj
						</div>
					</div>
					<div class="advantageContent">
						<div class="advantageTitle">
							Time Efficiency
						</div>
						<div class="advantageImg">
							<img src="assets/time.png">
						</div>
						<div class="advantageText">
							dbsbdkjsahdusjdjsanndsan<br>
							djsnajkdnsakjdnjsakndsjdn<br>
							djksdksndjksnadjksndjjndsj
						</div>
					</div>
				</div>
			</div>
			<div class="homeQuotes">
				<div class="italicText">
					"The Best Human Being Is Helpful For Others"
				</div>
				<div class="footerAuthor">
					- Anonymous -
				</div>
			</div>
			
		</div>
	</main>

	<footer>
		
	</footer>

	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
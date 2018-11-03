<!DOCTYPE html>
<html>
<head>
	<title>SurveyMan - Your Gateway to an Easier Survey Distribution</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
</head>
<body>
	<header>
		<div class="logo cursorPointer">
			<div class="icon">
				<img src="assets/Icon_SurveyMan.png">
			</div>
			<div class="brandName">
				SurveyMan
			</div>
		</div>
		<div class="navContainer">
			<nav>
					<div class="navItems cursorPointer active" id="navHome" onclick="changeNav('navHome')">
						Home
					</div>
					<div class="navItems cursorPointer" id="navServices" onclick="changeNav('navServices')">
						Services
					</div>
					<div class="navItems cursorPointer" id="navAbout" onclick="changeNav('navAbout')">
						About
					</div>
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
		<div id="home">
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

		<div id="services">
			<div class="service">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
		</div>

		<div id="aboutUs">
			<div class="description">
				<div class="slider">
					<div class="descriptionContainer" id="sliderItem">
						<div class="descriptionText">
							<div class="aboutTitle">
								ABOUT US
							</div>
							<div class="aboutDescription">
								Surveyman is blalblablablablansajnsjandsandjsndwesndioednjied<br>
								dbshabdjasdjsandskjdkajdkldjbhbhkbjbjkbjbjbjjkbjkb
							</div>
						</div>
						<div class="descriptionText">
							<div class="aboutTitle">
								VISION
							</div>
							<div class="aboutDescription">
								Surveyman vision is blalblablablablansajnsjandsandjsndwesndioednjied<br>
								dbshabdjasdjsandskjdkajdkldjbhbhkbjbjkbjbjbjjkbjkb
							</div>
						</div>
						<div class="descriptionText">
							<div class="aboutTitle">
								MISSION
							</div>
							<div class="aboutDescription">
								Surveyman mission is blalblablablablansajnsjandsandjsndwesndioednjied<br>
								dbshabdjasdjsandskjdkajdkldjbhbhkbjbjkbjbjbjjkbjkb
							</div>
						</div>
						
					</div>
				</div>
				<div class="scrollButtonContainer">
					<div class="scrollButton cursorPointer aboutActive" id="about1" onclick="changeAbout('about1')"></div>
					<div class="scrollButton cursorPointer" id="about2" onclick="changeAbout('about2')"></div>
					<div class="scrollButton cursorPointer" id="about3" onclick="changeAbout('about3')"></div>
				</div>
			</div>
			<div class="projectTeam">
				<div class="teamTitle">
					OUR TEAM
				</div>
				<div class="teamMember">
					<div class="member">
						<div class="memberImgContainer"><img src="{{url('/assets/fotoDennis.jpg')}}"></div>
						Timoteus Dennis<br>
						<div class="memberPosition">
							Front-End<br>
							Developer
						</div>
					</div>
					<div class="member">
						<div class="memberImgContainer"><img src="{{url('/assets/fotoBernado.jpg')}}"></div>
						Bernado
						<div class="memberPosition">
							Front-End<br>
							Developer
						</div>
					</div>
					<div class="member">
						<div class="memberImgContainer"><img src="{{url('/assets/fotoKevin.jpg')}}"></div>
						Kevin Hadinata
						<div class="memberPosition">
							Project Leader<br>
							Back-End<br>
							Developer
						</div>
					</div>
					<div class="member">
						<div class="memberImgContainer"><img src="{{url('/assets/fotoRicky.jpg')}}"></div>
						Ricky Wijaya
						<div class="memberPosition">
							Back-End<br>
							Developer
						</div>
					</div>
					<div class="member">
						<div class="memberImgContainer"><img src="{{url('/assets/fotoAyu.jpg')}}"></div>
						Wahyu Ramadani
						<div class="memberPosition">
							Interface<br>
							Designer
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>

	<footer>
		
	</footer>

	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>SurveyMan - Your Gateway to an Easier Survey Distribution</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
</head>
<body>
<header>
	<div class="logo cursorPointer" onclick="goHome('navHome')">
		<div class="icon">
			<img src="{{asset('assets/Icon_SurveyMan.png')}}">
		</div>
		<div class="brandName">
			SurveyMan
		</div>
	</div>
	<div class="navContainer">
		<nav>
		@if(\Illuminate\Support\Facades\Session::get('user_id'))
			<div class="navItems cursorPointer active" id="navHome"">
				Home
			</div>
			<div class="navItems cursorPointer" id="navServices">
				<a href="{{url('/surveylist')}}">Survey List</a>
			</div>
			<div class="navItems cursorPointer" id="navAbout">
				<a href="{{url('/exchangepoints')}}">Exchange</a>
			</div>
		@else
			<div class="navItems cursorPointer active" id="navHome" onclick="changeNav('navHome')">
				Home
			</div>
			<div class="navItems cursorPointer" id="navServices" onclick="changeNav('navServices')">
				Services
			</div>
			<div class="navItems cursorPointer" id="navAbout" onclick="changeNav('navAbout')">
				About
			</div>
		@endif
		</nav>
		<div class="searchBar">
			<input type="text" name="surveySearch">
		</div>
		@if(\Illuminate\Support\Facades\Session::get('user_id'))
			<div class="accountManagement">
				<div class="LoginButton">
					<form action="{{url('/logout')}}" method="get" accept-charset="utf-8">
						<button type="submit" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer w80c" id="">
							Logout
						</button>
					</form>
				</div>
			</div>
		@else
		<div class="accountManagement">
			<a href="{{url('/login')}}">
				<div class="LoginButton yellowHover">
					Login
				</div>
			</a>
			<a href="{{url('/login')}}">
				<div class="RegisterButton yellowHover">
					Register
				</div>
			</a>
		</div>
		@endif
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
						<img src="{{asset('assets/easy.png')}}">
					</div>
					<div class="advantageText">
						Get Easy Money to Boost your Bussiness
					</div>
				</div>
				<div class="advantageContent">
					<div class="advantageTitle">
						Cost Effective
					</div>
					<div class="advantageImg">
						<img src="{{asset('assets/price.png')}}">
					</div>
					<div class="advantageText">
						Goin the advantage that your rivals missed out
					</div>
				</div>
				<div class="advantageContent">
					<div class="advantageTitle">
						Time Efficiency
					</div>
					<div class="advantageImg">
						<img src="{{asset('assets/time.png')}}">
					</div>
					<div class="advantageText">
						Efficient your way to achive your goals
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
		<div class="serviceContainer">
			<div class="serviceTitle">
				Survey
			</div>
			<div class="surveyList">
				@foreach($forms as $form)
				<div class="surveyItem">
					<div class="surveyIcon">
						<img src="{{asset('assets/coin.png')}}" width="100%" height="100%">
					</div>
					<div class="surveyText">
						<div class="surveyTitle">
							{{$form->title}}
						</div>
						<div class="surveyDescription">
							{{$form->description}}
						</div>
						<div class="surveyAuthor">
							Author: {{$form->user->firstname}}
						</div>
					</div>
					<div class="joinButton">
						Join
					</div>
				</div>
				@endforeach
			</div>
			<div class="loadMoreContainer">
				<div class="loadMoreButton">
					<a href="{{url('/login')}}">Load More</a>
				</div>
			</div>
		</div>
	</div>

	<div id="aboutUs">
		<div class="description">
			<div class="slider">
				<div class="descriptionContainer" id="sliderItem">
					<div class="descriptionText" id="aboutItem1">
						<div class="aboutTitle">
							ABOUT US
						</div>
						<div class="aboutDescription">
							Surveyman is here to help you boost your business
						</div>
					</div>
					<div class="descriptionText" id="aboutItem2">
						<div class="aboutTitle">
							VISION
						</div>
						<div class="aboutDescription">
							Surveyman vision is to be the number one survey platform to help other business
						</div>
					</div>
					<div class="descriptionText" id="aboutItem3">
						<div class="aboutTitle">
							MISSION
						</div>
						<div class="aboutDescription">
							Surveyman mission is providing an efficient survey platform for other business
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
					<div class="memberImgContainer"><img src="{{asset('assets/fotoDennis.jpg')}}"></div>
					<div class="memberName">Timoteus Dennis</div>
					<div class="memberPosition">
						Front-End<br>
						Developer
					</div>
				</div>
				<div class="member">
					<div class="memberImgContainer"><img src="{{asset('assets/fotoBernado.jpg')}}"></div>
					<div class="memberName">Bernado</div>
					<div class="memberPosition">
						Front-End<br>
						Developer
					</div>
				</div>
				<div class="member">
					<div class="memberImgContainer"><img src="{{asset('assets/fotoKevin.jpg')}}"></div>
					<div class="memberName">Kevin Hadinata</div>
					<div class="memberPosition">
						Project Leader<br>
						Back-End<br>
						Developer
					</div>
				</div>
				<div class="member">
					<div class="memberImgContainer"><img src="{{asset('assets/fotoRicky.jpg')}}"></div>
					<div class="memberName">Ricky Wijaya</div>
					<div class="memberPosition">
						Back-End<br>
						Developer
					</div>
				</div>
				<div class="member">
					<div class="memberImgContainer"><img src="{{asset('assets/fotoAyu.jpg')}}"></div>
					<div class="memberName">Wahyu Ramadani</div>
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
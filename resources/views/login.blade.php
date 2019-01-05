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
            <div class="navItems cursorPointer active" id="navHome" onclick="goHome('navHome')">
                Home
            </div>
            <div class="navItems cursorPointer" id="navServices" onclick="goHome('navServices')">
                Services
            </div>
            <div class="navItems cursorPointer" id="navAbout" onclick="goHome('navAbout')">
                About
            </div>
        </nav>
        <div class="searchBar">
            <input type="text" name="surveySearch">
        </div>
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
    </div>
</header>

<main>
    <div id="signUpPage">
        <div id="signUp">
            <div class="surveyTitle padV2c">
                <div id="signUpDiv">
                    <h1 class="margin0">Sign Up</h1>
                </div>
            </div>
            <div class="signUpText padV2c">
                We will need...
            </div>
            <form action="{{url('/register')}}" method="post">
                {{csrf_field()}}
                <div class="signUpForm">
                    <div class="nameForm padV10p">
                        <input type="text" name="firstname" placeholder="First Name">
                        <input type="text" name="lastname" placeholder="Last Name">
                    </div>
                    <div class="emailForm padV10p">
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="genderForm padV10p">
                        <div class="genderMale">
                            <input type="radio" name="gender" value="Male">Male
                        </div>
                        <div class="genderFemale">
                            <input type="radio" name="gender" value="Female">Female
                        </div>
                    </div>
                    <div class="birthForm padV10p">
                        <!--<input type="number" name="BirthDay" step="1" min="1" max="31" placeholder="Day">
                        <input type="number" name="BirthMonth" step="1" min="1" max="12" placeholder="Month">
                        <input type="number" name="BirthYear" step="1" min="1" max="2999" placeholder="Year">-->
                        <input type="date" name="birthdate" min="1900-01-01" max="2018-12-31">
                    </div>
                    <div class="occupationForm padV10p">
                        <input type="text" name="occupation" placeholder="Occupation">
                    </div>
                    <div class="passForm padV10p">
                        <input type="password" name="password" placeholder="Password">
                    </div>

                </div>
                <div style="color: red;">
                    @if(isset($errors))
                        {{$errors->first()}}
                    @endif
                </div>
                <button type="submit" class="signUpButton">
                    Sign Up
                </button>
            </form>

        </div>
        <div id="login">
            <div class="surveyTitle padV2c">
                <div id="loginDiv">
                    <h1 class="margin0">Login</h1>
                </div>
            </div>
            <div class="signUpText padV2c">
                We will need...
            </div>
            <form action="{{url('/login')}}" method="post">
                {{csrf_field()}}
                <div class="signUpForm">
                    <div class="emailForm padV10p">
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="passForm padV10p">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button class="signUpButton" type="submit">
                    Login
                </button>
                @if(\Illuminate\Support\Facades\Session::has('alert'))
                    {{\Illuminate\Support\Facades\Session::get('alert')}}
                @endif
            </form>

        </div>
    </div>
    <div id="inactiveCover">

    </div>
    <div id="loginsignupSwitch" class="signUpButton">
        <div id="loginButton" class="cursorPointer w100" onclick="moveCover('signUp')">
            Login
        </div>
        <div id="signUpButton" class="cursorPointer w100" onclick="moveCover('login')">
            SignUp
        </div>
    </div>
</main>

<footer>

</footer>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
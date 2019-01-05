<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SurveyList</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">--}}
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
{{--    <script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
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
            <div class="navItems cursorPointer" id="navHome" onclick="goHome('navHome')">
                Home
            </div>
            <div class="navItems cursorPointer active" id="navServices">
                <a href="{{url('/surveylist')}}">Survey List</a>
            </div>
            <div class="navItems cursorPointer" id="navAbout">
                <a href="{{url('/exchangepoints')}}">Exchange</a>
            </div>
        </nav>
        <div class="searchBar">
            <input type="text" name="surveySearch">
        </div>
        <div class="accountManagement">
            <div class="LoginButton">
                <form action="{{url('/logout')}}" method="get" accept-charset="utf-8">
                    <button type="submit" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer w80c" id="">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="minH83VH grayBG margH10c dFlex">
        <div id="DashboardMenu" class="w25c">
            <div id="DashboardProfile" class="dFlex flexDirCol justifyCenter fAlignCenter h40c boldFont textCenter">
                <h2>{{$user->firstname}}</h2>
                <img src="{{asset('assets/Icon_SurveyMan.png')}}" width="100px" height="100px" class="circleBG greenBG margA10p">
                Points: {{$user->wallet->points}}<br>
                {{$user->email}}
            </div>
            <div class="greenLine"></div>
            <div id="DashboardMenuItem" class="h60c">
                <div id="DBSurveyList" class="dbMenuItem cursorPointer " onclick="changeDBMenu('DBSurveyList')">
                    <img src="{{asset('assets/survey_list_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/surveylist')}}">SURVEY LIST</a>
                </div>
                <div id="DBHistory" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBHistory')">
                    <img src="{{asset('assets/history_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/history')}}">HISTORY</a>
                </div>
                <div id="DBEditProfile" class="dbMenuItem cursorPointer dbActiveMenu" onclick="changeDBMenu('DBEditProfile')">
                    <img src="{{asset('assets/edit_profile_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/changeprofile')}}">EDIT PROFILE</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/point_info_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/exchangepoints')}}">EXCHANGE POINT</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer " onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/searchicon.png')}}" height="60%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/viewanswer')}}">VIEW ANSWER</a>
                </div>
            </div>
        </div>

        <!--Content-->
        <form action="{{url('/changeprofile/'.$user->id)}}" method="post" id="DBEditProfileContent" class="whiteBG w75c dbContent">
            {{csrf_field()}}
            <div class="h10c dFlex w80c justifySpaceBetween fAlignCenter marg0Auto">
                <button type="reset" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer">Cancel Changes</button>
                <button type="submit" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer">Save Changes</button>
            </div>
            <div class="h78c w60c marg0Auto dFlex flexDirCol justifyFlexStart fAlignStart">
                <div class="padV10p w100c dFlex justifySpaceBetween">
                    <input type="text" id="FirstName" name="firstname" value="{{$user->firstname}}" placeholder="First Name" class="w45c greenBox grayBG fs16p padA5p borderRad">
                    <input type="text" id="LastName" name="lastname" value="{{$user->lastname}}" placeholder="Last Name" class="w45c greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c padV10p">
                    <input type="text" id="Email" name="email" value="{{$user->email}}" placeholder="Email" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c dFlex justifySpaceBetween fAlignCenter padV10p">
                    @if($user->gender == "Male")
                        <div class="w45c greenBox grayBG fs16p padA5p borderRad">
                            <input type="radio" name="gender" value="Male" checked>Male
                        </div>
                        <div class="w45c greenBox grayBG fs16p padA5p borderRad">
                            <input type="radio" name="gender" value="Female">Female
                        </div>
                    @else
                        <div class="w45c greenBox grayBG fs16p padA5p borderRad">
                            <input type="radio" name="gender" value="Male">Male
                        </div>
                        <div class="w45c greenBox grayBG fs16p padA5p borderRad">
                            <input type="radio" name="gender" value="Female" checked>Female
                        </div>
                    @endif
                </div>
                <div class="w100c padV10p">
                    <input type="date" name="birthdate" min="1900-01-01" max="2018-12-31" value="{{$user->birtdate}}" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c padV10p">
                    <input type="text" name="occupation" value="{{$user->occupation}}" placeholder="Occupation" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c padV10p">
                    <input type="text" name="rekening" value="{{$user->rekening}}" placeholder="Rekening" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c padV10p">
                    <input type="password" name="password" placeholder="New Password" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div class="w100c padV10p">
                    <input type="password" name="old" placeholder="Old Password" class="w100c bzBox greenBox grayBG fs16p padA5p borderRad">
                </div>
                <div>
                    <select class="grayBox boldTxt fs16p padA5p" name="tag" >
                        <option disabled selected hidden>Select Tag</option>
                        @foreach($tags as $tag)
                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="color: red;">
                @if(isset($errors))
                    {{$errors->first()}}
                @endif
                @if(\Illuminate\Support\Facades\Session::has('alert'))
                    {{\Illuminate\Support\Facades\Session::get('alert')}}
                @endif
            </div>
        </form>
    </div>
</main>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
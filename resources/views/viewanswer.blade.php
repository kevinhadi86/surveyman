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
    <style>
        tr:nth-child(odd){background-color: #f2f2f2}
    </style>
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
                    <img src="{{asset('assets/survey_list_symbol.png')}}" height="50%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/surveylist')}}">SURVEY LIST</a>
                </div>
                <div id="DBHistory" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBHistory')">
                    <img src="{{asset('assets/history_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/history')}}">HISTORY</a>
                </div>
                <div id="DBEditProfile" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBEditProfile')">
                    <img src="{{asset('assets/edit_profile_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/changeprofile')}}">EDIT PROFILE</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/point_info_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/exchangepoints')}}">EXCHANGE POINT</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer dbActiveMenu" onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/searchicon.png')}}" height="60%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/viewanswer')}}">VIEW ANSWER</a>
                </div>
            </div>
        </div>

        <!--SurveyList-->
        <div id="DBSurveyListContent" class="whiteBG w75c dbContent dBlock">
            <div id="dbMySurvey" class="h40c dFlex flexDirCol justifyCenter">
                <div id="MySurveyTitle" class="padA5p fs14p boldFont">
                    My Survey
                </div>
                <div class="grayLine w10c"></div>
                <div id="CreateNewSurveyButton" class="margA10p">
                    <form method="post" action="{{url('/form')}}">
                        {{csrf_field()}}
                        <button type="submit" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer">Create New Survey</button>
                    </form>
                </div>
                <div>
                    <?php $count=0?>
                    @foreach($forms as $form)
                        @if($form->user_id == \Illuminate\Support\Facades\Session::get('user_id'))
                            <?php $count++?>
                        @endif
                    @endforeach
                    @if($count!=0)
                        {{--@foreach($forms as $form)--}}
                                <div style="overflow-y: scroll;max-height: 470px">
                                    <table style="border-collapse: collapse; border-spacing: 0;width: 100%; border: 1px solid #ddd; width: 94%; margin-left: 3%">
                                        <thead style="text-align: left; padding: 8px;">
                                        <tr>
                                            <th>No</th>
                                            <th>Form Title</th>
                                            <th>Form Description</th>
                                            <th>Point</th>
                                            <th>Responden</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody style="text-align: left; padding: 8px;">
                                        <?php $no=0?>
                                        @foreach($forms as $form)
                                            <?php $no++?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$form->title}}</td>
                                                <td>{{$form->description}}</td>
                                                <td>{{$form->points}}</td>
                                                <td>{{count($form->questions[0]->answers)}}</td>
                                                <td>
                                                    <a href="{{url('/viewdetail/'.$form->id)}}">
                                                        <button type="button" class=" bgGreen borderRad padA5p boldTxt cursorPointer w80c">Preview</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        {{--@endforeach--}}
                    @else
                        <div class="boldFont fs14p">You don't have any survey yet</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
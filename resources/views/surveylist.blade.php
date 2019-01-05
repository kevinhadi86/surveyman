<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SurveyList</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">--}}
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    {{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
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
                <div id="DBSurveyList" class="dbMenuItem cursorPointer dbActiveMenu" onclick="changeDBMenu('DBSurveyList')">
                    <img src="{{asset('assets/survey_list_symbol.png')}}" height="50%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/surveylist')}}">SURVEY LIST</a>
                </div>
                <div id="DBHistory" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBHistory')">
                    <img src="{{asset('assets/history_symbol.png')}}" height="50%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/history')}}">HISTORY</a>
                </div>
                <div id="DBEditProfile" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBEditProfile')">
                    <img src="{{asset('assets/edit_profile_symbol.png')}}" height="50%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/changeprofile')}}">EDIT PROFILE</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/point_info_symbol.png')}}" height="50%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/exchangepoints')}}">EXCHANGE POINT</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer" onclick="changeDBMenu('DBExchangePoint')">
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
                <div id="style-1" class="scrollbar">
                    <?php $count=0?>
                    @foreach($forms as $form)
                        @if($form->user_id == \Illuminate\Support\Facades\Session::get('user_id'))
                            <?php $count++?>
                        @endif
                    @endforeach
                    @if($count!=0)
                        @foreach($forms as $form)
                                @if($form->user_id == \Illuminate\Support\Facades\Session::get('user_id'))
                            <div class="force-overflow dFlex justifySpaceAround fAlignCenter grayLine">
                                <div style="width: 5%" class="SurveyReward bgGreen margA10p">
                                    <div class="wh50p dFlex flexDirCol justifyCenter fAlignCenter fs12p">
                                        <img src="{{asset('assets/coin.png')}}" width="50%" height="50%">
                                        {{$form->points}}
                                    </div>
                                </div>
                                <div style="width: 80%" class="SurveyDesc dFlex flexDirCol fs12p justifySpaceBetween">
                                    <div class="boldFont fs14p">{{$form->title}}</div>
                                    <div>{{$form->description}}</div>
                                    <div>Quota:{{$form->quota}}</div>
                                </div>
                                <div style="width: 15%" class="SurveyJoinButton w20c">
                                    <a href="{{url('form/'.$form->id.'/question')}}">
                                        <button type="button" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer w80c">
                                            Edit
                                        </button>
                                    </a>
                                    <form action="{{url('form/delete/'.$form->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="borderRed bgRed borderRad padA5p boldTxt cursorPointer w80c" value="Delete">
                                    </form>
                                </div>
                            </div>
                    @endif
                        @endforeach
                    @else
                        <div class="boldFont fs14p">You don't have any survey yet</div>
                    @endif
                </div>
            </div>
            <!--OtherSurvey-->
            <div id="dbOtherSurvey" class="h60c">
                <div id="OtherSurveyTitle" class="padA5p fs14p boldFont">
                    Survey List
                </div>
                <div class="grayLine w10c"></div>
                <div id="style-1"  class="scrollbar h80c dFlex justifySpaceAround fAlignCenter flexDirCol">
                    <?php $count=0?>
                    @foreach($forms as $form)
                        @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                            <?php $count++?>
                        @endif
                    @endforeach
                    @if($count!=0)
                        @if(!(\Illuminate\Support\Facades\Session::get('tag')))
                            <div style="flex-wrap: wrap;" class="w90c h45c dFlex justifySpaceBetween">
                                @foreach($forms as $form)
                                    @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                        <div style="margin-left: 2%;margin-right: 2%; margin-bottom: 2%;" class="bgGreen w20c dFlex justifyCenter fAlignCenter">
                                            <div class="dFlex flexDirCol justifyCenter fAlignCenter fs14p h100c w80c">
                                                <img src="{{asset('assets/coin.png')}}" width="50%" height="50%">
                                                <div>{{$form->points}}</div>
                                                <div class="boldFont">{{$form->title}}</div>
                                                <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                                    <button type="button" class="borderGreen bgGreen aboutDescription borderRad padA5p boldTxt cursorPointer w80c">Join</button>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div style="flex-wrap: wrap;" class="w90c h45c dFlex justifySpaceBetween">
                                @foreach($forms as $form)
                                    @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                        <?php $form_tag = $form->tag;?>
                                        @if($form_tag->tag == \Illuminate\Support\Facades\Session::get('tag'))
                                            <div style="margin-left: 2%;margin-right: 2%;" class="bgGreen w20c dFlex justifyCenter fAlignCenter">
                                                <div class="dFlex flexDirCol justifyCenter fAlignCenter fs14p h100c w80c">
                                                    <img src="assets/coin.png" width="50%" height="50%">
                                                    <div>{{$form->points}}</div>
                                                    <div class="boldFont">{{$form->title}}</div>
                                                    <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                                        <button type="button" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer w80c">Join</button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($forms as $form)
                                    @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                        <?php $form_tag = $form->tag;?>
                                        @if($form_tag->tag != \Illuminate\Support\Facades\Session::get('tag'))
                                            <div style="margin-left: 2%;margin-right: 2%;" class="bgGreen w20c dFlex justifyCenter fAlignCenter">
                                                <div class="dFlex flexDirCol justifyCenter fAlignCenter fs14p h100c w80c">
                                                    <img src="assets/coin.png" width="50%" height="50%">
                                                    <div>{{$form->points}}</div>
                                                    <div class="boldFont">{{$form->title}}</div>
                                                    <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                                        <button type="button" class="borderGreen bgGreen borderRad padA5p boldTxt cursorPointer w80c">Join</button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="boldFont fs14p">Others don't have any survey yet</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
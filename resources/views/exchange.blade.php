<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchange Points</title>
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
            <div class="navItems cursorPointer " id="navServices">
                <a href="{{url('/surveylist')}}">Survey List</a>
            </div>
            <div class="navItems cursorPointer active" id="navAbout">
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
                <div id="DBEditProfile" class="dbMenuItem cursorPointer " onclick="changeDBMenu('DBEditProfile')">
                    <img src="{{asset('assets/edit_profile_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/changeprofile')}}">EDIT PROFILE</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer dbActiveMenu" onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/point_info_symbol.png')}}" height="70%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/exchangepoints')}}">EXCHANGE POINT</a>
                </div>
                <div id="DBExchangePoint" class="dbMenuItem cursorPointer " onclick="changeDBMenu('DBExchangePoint')">
                    <img src="{{asset('assets/searchicon.png')}}" height="60%" width="8%" style="padding-right: 10px">
                    <a href="{{url('/viewanswer')}}">VIEW ANSWER</a>
                </div>
            </div>
        </div>

        <!--content-->
        <div id="DBExchangePointContent" class="whiteBG w75c dbContent ">
            <div class="h30c dFlex flexDirCol justifyCenter fAlignCenter">
                <div class="fs16p boldFont margA10p">Total Points :</div>
                <div class="fs18p boldFont">{{$wallet->points}}</div>
                <div id="rekening" class="fs14p margA10p dFlex">
                    @if(empty($wallet->rekening))
                        <div class="padA5p">
                            No. Rek :
                        </div>
                        <form method="post" action="{{url('/exchangepoints/'.$wallet->id)}}">
                            {{csrf_field()}}
                            <input type="text" name="rekening" class="w75c borderNone grayBG padA10p fs14p borderRad">
                            <button type="submit">Submit</button>
                        </form>
                    @else
                        <div class="padA5p">
                            No. Rek :
                        </div>
                        <div class="padA5p">
                            {{$wallet->rekening}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="grayLine"></div>
            <div class="h70c dFlex">
                <div class="w50c dFlex flexDirCol fAlignCenter justifyFlexStart">
                    <div class="greenBox w40c textCenter padA5p margA5c">
                        Buy Points
                    </div>
                    <form method="post" action="{{url('exchangepoints/add/'.$wallet->id)}}" id="hargabeli" class="w60c justifySpaceAround fAlignCenter">
                    {{csrf_field()}}
                        Point :
                        <input id="inputbeli" type="text" name="points" onchange="calculate('beli',$(this).val())" class="w75c borderNone grayBG padA10p fs14p borderRad">
                        <button style="padding: 3%;" class="w45c h10c margA10p bgGreen borderNone pad0marg0 cursorPointer boldFont borderRad fs16p">Buy</button>
                    </form>
                    <div style="color: red;" class="fs12p">Price = Point x Rp. 1.000,-</div>
                </div>
                <div class="grayVLine"></div>
                <div method="post" action="{{url('exchangepoints/sub/'.$wallet->id)}}" class="w50c dFlex flexDirCol fAlignCenter justifyFlexStart">
                    <div class="greenBox w40c textCenter padA5p margA5c">
                        Exchange Points
                    </div>
                    <form method="post" action="{{url('exchangepoints/sub/'.$wallet->id)}}" id="hargajual" class="w60c justifySpaceAround fAlignCenter">
                    {{csrf_field()}}
                        Point :
                        <input id="inputjual" type="text" name="points" onchange="calculate('jual',$(this).val())" class="w75c borderNone grayBG padA10p fs14p borderRad">
                        <button style="padding: 3%;" class="w45c h10c margA10p bgGreen borderNone cursorPointer boldFont borderRad fs16p">Exchange</button>
                    </form>
                    <div style="color: red;" class="fs12p">Cash Earned = Point x Rp. 1.000,-</div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('js/script.js')}}"></script>
<script>
    // $(document).ready(function () {
    //     if($('#rekening').has("form")){
    //         console.log("true");
    //         $('#inputbeli').prop('disabled',true);
    //         $('#inputjual').prop('disabled',true);
    //     }else {
    //         console.log('flase');
    //     }
    // })
    function calculate(type,val) {
        console.log("Calling...");
        let price = val * 1000;
        if (type == "beli"){
            console.log('beli');
            $('#hargabeli').append('<br>Harga = Rp '+price);
            $('#inputjual').prop('disabled',true);
        }else {
            $('#hargajual').append('<br>Uang yang didapat = '+price);
            $('#inputbeli').prop('disabled',true);
        }

    }
</script>
</body>
</html>
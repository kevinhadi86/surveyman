<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta id="token" name="csrf-token" content="{{ csrf_token() }}">--}}
    <title>Answer</title>
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

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!--bagian atas-->
                    <main>
                        <div class="margH5c minH83VH">
                            <div class="grayBox minH23VH">
                                <div style="margin-left: 5%">
                                    <h1>{{$form->title}}</h1>
                                    <h5>Points: {{$form->points}}</h5>
                                    <h4>{{$form->description}}</h4>
                                </div>

                            </div>
                            <div class="grayBox minH60VH">
                                <div id="question-list">
                                    <?php $user_id=\Illuminate\Support\Facades\Session::get('user_id') ?>
                                    <form class="card-body" id="{{$user_id}}">
                                        {{csrf_field()}}
                                        <?php $count=0?>
                                        @foreach($questions as $question)
                                            <?php $count++?>
                                            <div style="margin: 2%;" id="answer{{$count}}" class="{{$question->type}}">
                                                <!--buat ambil tipe questionnya, pake id answer 1-seterusnya -->
                                                <h1 id="question{{$count}}" class="{{$question->id}}">{{$question->question}}</h1>
                                                <!--buat ambil id questionnya, pake id question 1-seterusnya-->
                                                @if($question->type == "Multiple Choice")
                                                    @foreach($question->options as $option)
                                                        <input type="radio" value="{{$option->option}}" name="answer{{$question->id}}">{{$option->option}}
                                                    <!--buat ambil valuenya, pake name answer +question_id-->
                                                    @endforeach
                                                @else
                                                    <input type="text" class="boldTxt grayBox padA5p fs16p" name="answer{{$question->id}}">
                                                @endif
                                            </div>
                                            <hr>
                                        @endforeach
                                        <div class="counter" id="{{$count}}"></div>
                                        @if($form->user_id != $user_id)
                                            <button class="borderGreen bgGreen borderRad padA5p boldTxt fs16p cursorPointer " style="margin-left:47%; !important" type=submit>Submit</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="{{asset('js/script.js')}}"></script>
<script>
    console.log($('.card-body').attr('id'));
    $(document).ready(function(){
        $('form').on('submit',function(e) {
            console.log("Calling...");
            let arr = [];
            let id = [];
            let count = $('.counter').attr('id');
            let user_id = $('.card-body').attr('id');
            for(let i=0;i<count;i++){
                {{--console.log("count: {{$count}}");--}}
                // console.log("i: "+i);
                let question_id = $('#question'+(i+1)).attr('class');
                arr[i]={};
                id[i]={};
                // console.log("if: #question"+(i+1));
                id[i]= question_id;
                // console.log("arr["+i+"]: "+$('#question'+(i+1)).attr('class'));
                if ($('#answer'+(i+1)).attr('class') === "Multiple Choice"){
                    // console.log($('#answer'+(i+1)).attr('class'));
                    arr[i] = $('input[name="answer'+question_id+'"]:checked').val();
                }else{
                    // console.log($('#answer'+(i+1)).attr('class'));
                    arr[i] = $('input[name="answer'+question_id+'"]').val();
                }
            }
            // console.log("arr["+i+"]: "+arr[i]);
            let url = "{{url('api/form')}}"+"/"+"{{$form->id}}"+"/answer/submit";
            $.ajax({
                url:url,
                type: "POST",
                data: {
                    'user':user_id,
                    'q_id':id,
                    'data':arr
                },
                success: function(resp){
                    console.log(resp);
                    alert("Berhasil!");
                }
            });
            e.preventDefault();
        });
    });
</script>
</body>
</html>
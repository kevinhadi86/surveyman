<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
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

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!--bagian atas-->
                        <main>
                            <div class="margH5c minH83VH">
                                <div class="grayBox minH23VH">
                                    <div class="dFlex">
                                        <div class="grayBG boldTxt fs18p padA5p">
                                            Create New Survey
                                        </div>
                                    </div>
                                    <div class="dFlex fAlignCenter margA3c justifySpaceAround">
                                        <input type="text" class="boldTxt grayBox margH5c padA5p fs16p w50c" name="titleForm" value="{{$form->title}}" onchange="titleChange({{$form->id}},$(this).val())">
                                        <input type="text" class="boldTxt grayBox margH5c padA5p fs16p w50c" name="pointForm" placeholder="Points: {{$form->points}}" onchange="pointsChange({{$form->id}},$(this).val())">
                                        <input type="text" class="boldTxt grayBox margH5c padA5p fs16p w50c" name="quotaForm" placeholder="Quota: {{$form->quota}}" onchange="quotaChange({{$form->id}},$(this).val())">
                                    </div>
                                    <div class="dFlex fAlignCenter margA3c">
                                        <textarea type="text" class="boldTxt grayBox margH5c padA5p fs16p w50c" name="descriptionForm" placeholder="Description" onchange="descriptionChange({{$form->id}},$(this).val())">{{$form->description}}</textarea>
                                    </div>
                                    <div class="dFlex fAlignCenter margA3c">
                                        <select class="grayBox boldTxt fs16p padA5p" onchange="tagChange({{$form->id}},$(this).val())">
                                            <option disabled selected hidden>Select Tag</option>
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="grayBox minH60VH">
                                    <div class="dFlex margA3c">
                                        <button id="add-question" type="button" class="borderGreen bgGreen borderRad padA5p boldTxt fs16p cursorPointer margH5c">Add Question</button>
                                    </div>
                                    <div id="question-list">
                                        @foreach($questions as $question)
                                            <div class="padA5p dFlex w50c justifySpaceAround margA3c" id="question{{$question->id}}">
                                                <div class="margH5c">
                                                    <select name="type" id="select{{$question->id}}" class="grayBox boldTxt fs16p padA5p" onchange="changeType({{$question->id}},$(this).val())">
                                                        @if($question->type == "Multiple Choice")
                                                            <option selected disabled>{{$question->type}}</option>
                                                            <option value="Text">Text</option>
                                                        @elseif($question->type== "Text")
                                                            <option selected disabled>{{$question->type}}</option>
                                                            <option value="Multiple Choice">Multiple Choice</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <!--masuk bagian tengah-->
                                                <div class="dFlex flexDirCol justifyFlexStart">
                                                    <div class="questionTextBox">
                                                        <input type="text" name="question" class="boldTxt grayBox padA5p fs16p" placeholder="{{$question->question}}"
                                                               onchange="changeTitle({{$question->id}},$(this).val())">
                                                    </div>
                                                    {{-- answer section --}}
                                                    <div class="dFlex flexDirCol justifySpaceAround" id="answer{{$question->id}}">
                                                        @if($question->type == "Multiple Choice")
                                                            <div id="choice{{$question->id}}" class=" alignCenter justifySpaceAround margA3p">
                                                                @foreach ($question->options as $option)
                                                                    <div class="dFlex alignCenter justifySpaceAround margA3p" id="input{{$option->id}}">
                                                                        <input class="pad0marg0" type="radio"><input class="boldTxt grayBox" type="text" id="option{{$option->id}}" name="option" placeholder="{{$option->option}}" onchange="changeOption({{$option->id}},$(this).val())">
                                                                        <button type="button" class="redXButton" onclick="deleteOption({{$option->id}})">   Delete
                                                                        </button>
                                                                        <br>
                                                                    </div>
                                                                @endforeach
                                                                {{-- disini gw taro question->id biar gw bisa masukin question id ke database gw pas gw --}}
                                                                <div class=" alignCenter justifySpaceAround margA3p" id="newoption{{$question->id}}">
                                                                    <input class="pad0marg0" type="radio"><input type="text" class="boldTxt grayBox new" id="{{$question->id}}" placeholder="">
                                                                </div>
                                                            </div>
                                                        @elseif($question->type == "Text")
                                                            <div id="choice{{$question->id}}">
                                                                <input class="boldTxt grayBox padA5p fs16p" type="text"><br>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="bgRed borderRed borderRad padA5p boldTxt fs16p cursorPointer" onclick="deleteQuestion({{$question->id}})">Delete</button>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
    //ajax error: delete abis add opt, new abis add q, neww abis add opt
    $(document).ready(function(){
        $('#add-question').click(function(){
            let url = "{{url('api/form/')}}"+"/"+"{{$form->id}}"+"/question/append";
            $.ajax({
                url: url,
                type: "POST",
                async:false,
                success: function(data){
                    $('#question-list').append(
                        '<div class="padA5p dFlex w50c justifySpaceAround margA3c" id="question'+data['id']+'">'+
                            '<div class="margH5c">'+
                                '<select name="type" id="select'+data['id']+'" class="grayBox boldTxt fs16p padA5p" onchange="changeType('+data['id']+',$(this).val())">'+
                                    '<option selected disabled>'+data['type']+'</option>'+
                                    '<option value="Multiple Choice">Multiple Choice</option>'+
                                    '<option value="Text">Text</option>'+
                                '</select>'+
                            '</div>'+
                            '<div class="dFlex flexDirCol justifyFlexStart">'+
                                '<div class="questionTextBox">'+
                                    '<input class="boldTxt grayBox padA5p fs16p" type="text" name="question" placeholder="'+data['question']+'" '+
                                    'onchange="changeTitle('+data['id']+',$(this).val())">'+
                                '</div>'+
                                '<div class="dFlex flexDirCol justifySpaceAround" id="answer'+data['id']+'">'+
                                    '<div class=" alignCenter justifySpaceAround margA3p" id="newoption'+data['id']+'">'+
                                        '<input class="pad0marg0" type="radio"><input type="text" class="boldTxt grayBox new" id="'+data['id']+'" placeholder="">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    console.log(data['id']);
                }
            });
        });

        $(document).on('change','.new',function(e){
            // event.preventDefault();
            console.log($(this).attr('id'));
            let id = $(this).attr('id');
            let url = "{{url('api/form/')}}"+"/"+$(this).attr('id')+"/question/option";
            $(this).removeClass("new");
            $.ajax({
                url: url,
                type: "POST",
                async:false,
                data:{
                    value: $(this).val()
                },
                success: function(data){
                    console.log("flag");
                    console.log('#answer'+data['question_id']);
                    console.log($('#'+id).attr('id'));
                    $('#'+id).attr('id','option'+data['id']);
                    console.log($('#option'+data['id']).attr('id'));
                    $('#newoption'+id).attr('id','input'+data['id']);
                    $('#input'+data['id']).append(
                        '<button type="button" class="redXButton" onclick="deleteOption('+data['id']+')">Delete</button><br>'
                    );
                    $('#answer'+data['question_id']).append(
                        '<div class=" alignCenter justifySpaceAround margA3p" id="newoption'+data['question_id']+'">'+
                            '<input class="pad0marg0" type="radio"><input type="text" class="boldTxt grayBox new" id="'+id+'"+ placeholder="">'+
                        '</div>'
                    );
                }
            });
        });
    });
    function deleteQuestion(id){
        let url= "{{url('api/form/question')}}"+"/"+id+"/delete";
        $('#question'+id).html("");
        $.ajax({
            url: url,
            type: "DELETE",
            async:false
        })
    }
    function deleteOption(id){
        let url= "{{url('api/form/question/option')}}"+"/"+id+"/delete";
        $('#input'+id).html("");
        $.ajax({
            url: url,
            type: "DELETE",
            async:false
        })
    }
    function changeTitle(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/question/update/title";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            async: false,
            success: function(data){
                console.log("Question Title Changed");
            }
        });
    }
    //kalo pencet multiple choice lagi dia jadi FEnya ke reset, tp BEnya nambah
    function changeType(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/"+value+"/question/update/type";
        $.ajax({
            url: url,
            type: "POST",
            async: false,
            success: function(data){

                if (value == "Multiple Choice") {
                    $('#select'+id).html(
                        '<option selected disabled>'+data['type']+'</option>'+
                        '<option value="Text">Text</option>'
                    );
                    $('#answer'+id).html(
                        '<div class=" alignCenter justifySpaceAround margA3p" id="newoption'+data['id']+'">'+
                            '<input class="pad0marg0" type="radio"><input type="text" class="boldTxt grayBox new" id="'+data['id']+'" placeholder="">'+
                        '</div>'
                    );
                }else if (value == "Text") {
                    $('#select'+id).html(
                        '<option selected disabled>'+data['type']+'</option>'+
                        '<option value="Multiple Choice">Multiple Choice</option>'
                    );
                    $('#answer'+id).html(
                        '<div id="choice'+data['id']+'">'+
                            '<input class="boldTxt grayBox padA5p fs16p" type="text"></input>'+
                        '</div>'
                    );
                }
            }
        });
    }
    function changeOption(option_id,value){
        let url = "{{url('api/form')}}"+"/"+option_id+"/question/update/option";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            async: false,
            success: function(data){
                console.log("Question Option Changed");
            }
        });
    }
    function titleChange(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/update/title";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            success: function(data){
                console.log("Form Title Changed");
            }
        });
    }
    function pointsChange(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/update/points";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            success: function(data){
                console.log("Form Points Changed");
            }
        });
    }
    function quotaChange(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/update/quota";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            success: function(data){
                console.log("Form Quota Changed");
            }
        });
    }
    function tagChange(id,value){
        console.log(value);
        let url = "{{url('api/form')}}"+"/"+id+"/update/tag";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            success: function(data){
                console.log("Form Tag Changed");
            }
        });
    }
    function descriptionChange(id,value){
        let url = "{{url('api/form')}}"+"/"+id+"/update/description";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                value: value,
            },
            success: function(data){
                console.log("Form Description Changed");
            }
        });
    }

</script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
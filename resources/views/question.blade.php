<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body>
<a href="{{url('/surveylist')}}">
    <button class="btn btn-primary" type="submit">
        Survey List
    </button>
</a>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <input type="text" name="titleForm" id="title" placeholder="{{$form->title}}"
                                   onchange="titleChange({{$form->id}},$(this).val())">
                            <div>
                                <input type="text" name="descriptionForm" placeholder="{{$form->description}}"
                                       onchange="descriptionChange({{$form->id}},$(this).val())">
                            </div>
                            <div>
                                <input type="text" name="pointsForm" placeholder="Points: {{$form->points}}"
                                       onchange="pointsChange({{$form->id}},$(this).val())">
                            </div>
                            <div>
                                <input type="text" name="quotaForm" placeholder="Quota: {{$form->quota}}"
                                       onchange="quotaChange({{$form->id}},$(this).val())">
                            </div>
                            <div>
                                <select onchange="tagChange({{$form->id}},$(this).val())">
                                    <option>Select Tag</option>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->name}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body">


                            <button id="add-question" class="btn btn-primary">Add Question</button>
                            <hr>
                            <div id="question-list">
                                @foreach($questions as $question)
                                    <div class="question" id="question{{$question->id}}">
                                        <input type="text" name="question" placeholder="{{$question->question}}"
                                               onchange="changeTitle({{$question->id}},$(this).val())">
                                        <select name="type" id="select{{$question->id}}" class="select" onchange="changeType({{$question->id}},$(this).val())">
                                            @if($question->type == "Multiple Choice")
                                                <option selected disabled>{{$question->type}}</option>
                                                <option value="Text">Text</option>
                                            @elseif($question->type== "Text")
                                                <option selected disabled>{{$question->type}}</option>
                                                <option value="Multiple Choice">Multiple Choice</option>
                                            @endif
                                        </select>
                                        <button type="button" class="btn btn-danger" onclick="deleteQuestion({{$question->id}})">Delete</button>
                                        {{-- answer section --}}
                                        <div id="answer{{$question->id}}">
                                            @if($question->type == "Multiple Choice")
                                                <div id="choice{{$question->id}}">
                                                    @foreach ($question->options as $option)
                                                        <div id="input{{$option->id}}">
                                                            <input type="radio"><input type="text" id="option{{$option->id}}" name="option" placeholder="{{$option->option}}" onchange="changeOption({{$option->id}},$(this).val())">
                                                            <button type="button" class="btn btn-danger" onclick="deleteOption({{$option->id}})">   Delete
                                                            </button>
                                                            <br>
                                                        </div>
                                                    @endforeach
                                                    <div id="newoption{{$question->id}}">
                                                        <input type="radio"><input type="text" class="new" id="{{$question->id}}" placeholder="">
                                                    </div>
                                                    {{-- disini gw taro question->id biar gw bisa masukin question id ke database gw pas gw --}}
                                                </div>
                                            @elseif($question->type == "Text")
                                                <div id="choice{{$question->id}}">
                                                    <input type="text"><br>
                                                </div>
                                            @endif
                                        </div>
                                        <hr>
                                    </div>

                                @endforeach
                            </div>
                        </div>

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
                        '<div class="question" id="question'+data['id']+'">'+
                        '<input type="text" name="question" placeholder="'+data['question']+'" '+
                        'onchange="changeTitle('+data['id']+',$(this).val())">'+
                        '<select name="type" id="select'+data['id']+'" class="select" onchange="changeType('+data['id']+',$(this).val())">'+
                        '<option selected disabled>'+data['type']+'</option>'+
                        '<option value="Multiple Choice">Multiple Choice</option>'+
                        '<option value="Text">Text</option>'+
                        '</select>'+
                        '<div id="answer'+data['id']+'">'+
                        '<div id="newoption'+data['id']+'">'+
                        '<input type="radio"><input type="text" class="new" id="'+data['id']+'" placeholder="">'+
                        '</div>'+
                        '</div>'+
                        '</div>'
                    );
                    alert(data['id']);
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
                    alert("flag");
                    console.log('#answer'+data['question_id']);
                    console.log($('#'+id).attr('id'));
                    $('#'+id).attr('id','option'+data['id']);
                    console.log($('#option'+data['id']).attr('id'));
                    $('#newoption'+id).attr('id','input'+data['id']);
                    $('#input'+data['id']).append(
                        '<button type="button" class="btn btn-danger" onclick="deleteOption('+data['id']+')">Delete</button><br>'
                    );
                    $('#answer'+data['question_id']).append(
                        '<div id="newoption'+data['question_id']+'">'+
                        '<input type="radio"><input type="text" class="new" id="'+id+'"+ placeholder="">'+
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
                        '<input type="radio"><input type="text" id="'+data['id']+'" class="new" value="" placeholder="">'
                    );
                }else if (value == "Text") {
                    $('#select'+id).html(
                        '<option selected disabled>'+data['type']+'</option>'+
                        '<option value="Multiple Choice">Multiple Choice</option>'
                    );
                    $('#answer'+id).html(
                        '<div id="choice'+data['id']+'">'+
                        '<input type="text"></input>'+
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
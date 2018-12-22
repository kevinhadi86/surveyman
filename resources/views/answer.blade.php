<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <title>Answer</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1>{{$form->title}}</h1>
            <h2>{{$form->description}}</h2>
            <?php $user_id=\Illuminate\Support\Facades\Session::get('user_id') ?>
        </div>
        <form class="card-body" id="{{$user_id}}">
            {{csrf_field()}}
            <?php $count=0?>
            @foreach($questions as $question)
                <?php $count++?>
                <div id="answer{{$count}}" class="{{$question->type}}">
<!--buat ambil tipe questionnya, pake id answer 1-seterusnya -->
                    <h3 id="question{{$count}}" class="{{$question->id}}">{{$question->question}}</h3>
                    <!--buat ambil id questionnya, pake id question 1-seterusnya-->
                    @if($question->type == "Multiple Choice")
                        @foreach($question->options as $option)
                            <input type="radio" value="{{$option->option}}" name="answer{{$question->id}}">{{$option->option}}
                            <!--buat ambil valuenya, pake name answer +question_id-->
                        @endforeach
                    @else
                            <input type="text" name="answer{{$question->id}}">
                    @endif
                </div>
            @endforeach
                <div class="counter" id="{{$count}}"></div>
        <button type=submit>Submit</button>
        </form>
    </div>
</div>


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
            // console.log(user_id);
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
                // console.log("arr["+i+"]: "+arr[i]);
                let url = "{{url('api/form')}}"+"/"+"{{$form->id}}"+"/answer/submit";
                {{--let url= "http://localhost/surveyman/public/api/form/{{$form->id}}/answer/submit";--}}
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:url,
                    type: "POST",
                    data: {
                        'user':user_id,
                        'q_id':id,
                        'data':arr,
                    },
                    success: function(resp){
                        console.log(resp);
                        alert("Berhasil!");
                    }
                });
                e.preventDefault();
            }
        })
    })
</script>
</body>
</html>
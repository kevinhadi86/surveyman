<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistic</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <a href="{{url('/surveylist')}}">
                <button class="btn btn-primary" type="submit">
                    Survey List
                </button>
            </a>
            <a href="{{url('/history')}}">
                <button class="btn btn-primary" type="submit">
                    History
                </button>
            </a>
            <a href="{{url('/changeprofile')}}">
                <button class="btn btn-primary" type="submit">
                    Change profile
                </button>
            </a>
            <a href="{{url('/exchangepoints')}}">
                <button class="btn btn-primary" type="submit">
                    Exchange Points
                </button>
            </a>
            <a href="{{url('/viewanswer')}}">
                <button class="btn btn-primary" type="submit">
                    View Answer
                </button>
            </a>
            <form action="{{url('/logout')}}" method="get" accept-charset="utf-8">
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>
        <div class="card-body">
            <h1>Form ID: {{$form->id}}</h1>
            <h1>Form Title: {{$form->title}}</h1>
            <h1>Form Description: {{$form->description}}</h1><hr>
            <?php $count=0?>
            @foreach($form->questions as $question)
                <hr>
                <h2>Question: {{$question->question}}</h2>
                @foreach($array as $data)
                    @foreach($data as $a)
                        @foreach($a as $b)
                            {{$b}}
                        @endforeach
                    @endforeach
                @endforeach
                @for($i=0;$i<count($array[$count][0]);$i++)
                    <h2>answer: {{$array[0][0][0]}}</h2>
                    <h2>stats: {{$array[0][0][0]}}</h2>
                @endfor
                <?php $count++?>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
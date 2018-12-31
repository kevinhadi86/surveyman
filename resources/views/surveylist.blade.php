<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SurveyList</title>
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
            <div>
                <h1>Your Survey</h1>
                <?php $count=0?>
                @foreach($forms as $form)
                    @if($form->user_id == \Illuminate\Support\Facades\Session::get('user_id'))
                        <?php $count++?>
                    @endif
                @endforeach
                @if($count!=0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Form Title</th>
                            <th>Form Description</th>
                            <th>Point</th>
                            <th>Quota</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0?>
                    @foreach($forms as $form)
                        @if($form->user_id == \Illuminate\Support\Facades\Session::get('user_id'))
                        <?php $no++?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$form->title}}</td>
                            <td>{{$form->description}}</td>
                            <td>{{$form->points}}</td>
                            <td>{{$form->quota}}</td>
                            <td>
                                <a href="{{url('form/'.$form->id.'/question')}}">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>
                                <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                    <button type="button" class="btn btn-primary">Preview</button>
                                </a>
                                <form action="{{url('form/delete'.$form->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input class="btn btn-danger " type="submit" value="Delete Form">
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h1>Kamu belum punya Survey, pergi bikin dulu gih. Aku tungguin kok disini :D</h1>
                @endif
                <form method="post" action="{{url('/form')}}">
                    {{csrf_field()}}
                    <button class="btn btn-outlin-primary" type="submit">New Form</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div>
                <h1>Other Survey</h1>
                <?php $count=0?>
                @foreach($forms as $form)
                    @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                        <?php $count++?>
                    @endif
                @endforeach
                @if($count!=0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Form Title</th>
                            <th>Form Description</th>
                            <th>Point</th>
                            <th>Quota</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=0?>
                        @if(!(\Illuminate\Support\Facades\Session::get('tag')))
                            @foreach($forms as $form)
                            @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                <?php $no++?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$form->title}}</td>
                                    <td>{{$form->description}}</td>
                                    <td>{{$form->points}}</td>
                                    <td>{{$form->quota}}</td>
                                    <td>
                                        <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                            <button type="button" class="btn btn-primary">Isi</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @else
                            @foreach($forms as $form)
                                @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                    <?php $form_tag = $form->tag;?>
                                    @if($form_tag->tag == \Illuminate\Support\Facades\Session::get('tag'))
                                        <?php $no++?>
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$form->title}}</td>
                                            <td>{{$form->description}}</td>
                                            <td>{{$form->points}}</td>
                                            <td>{{$form->quota}}</td>
                                            <td>
                                                <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                                    <button type="button" class="btn btn-primary">Isi</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                            @foreach($forms as $form)
                                @if($form->user_id != \Illuminate\Support\Facades\Session::get('user_id'))
                                    <?php $form_tag = $form->tag;?>
                                    @if($form_tag->tag != \Illuminate\Support\Facades\Session::get('tag'))
                                        <?php $no++?>
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$form->title}}</td>
                                            <td>{{$form->description}}</td>
                                            <td>{{$form->points}}</td>
                                            <td>{{$form->quota}}</td>
                                            <td>
                                                <a href="{{url('form/'.$form->id.'/question/answer')}}">
                                                    <button type="button" class="btn btn-primary">Isi</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    //cek kalo dia tagnya sama ngk kae user punya
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                @else
                    <h1>Temen-temen kamu belum punya survey, ajakin dulu gih. Aku tungguin kok disini :D</h1>
                @endif
            </div>
        </div>
    </div>

</div>


<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
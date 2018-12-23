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
        </div>
        <div class="card-body">
            <h1>Change Profile</h1>
            <form action="{{url('changeprofile/'.$user->id)}}" method="post">
                {{csrf_field()}}
                <div class="signUpForm">
                    <div class="nameForm padV10p">
                        <input type="text" name="firstname" placeholder="{{$user->firstname}}" value="{{$user->firstname}}">
                        <input type="text" name="lastname" placeholder="{{$user->lastname}}" value="{{$user->lastname}}">
                    </div>
                    <div class="emailForm padV10p">
                        <input type="text" name="email" placeholder="{{$user->email}}" value="{{$user->email}}">
                    </div>
                    <div class="genderForm padV10p">
                        <div class="genderMale">
                            <input type="radio" name="gender" value="Male">Male
                        </div>
                        <div class="genderFemale">
                            <input type="radio" name="gender" value="Female">Female
                        </div>
                    </div>
                    <div class="birthForm padV10p">
                        <!--<input type="number" name="BirthDay" step="1" min="1" max="31" placeholder="Day">
                        <input type="number" name="BirthMonth" step="1" min="1" max="12" placeholder="Month">
                        <input type="number" name="BirthYear" step="1" min="1" max="2999" placeholder="Year">-->
                        <input type="date" name="birthdate" min="1900-01-01" max="2018-12-31" value="{{$user->birthdate}}">
                    </div>
                    <div class="occupationForm padV10p">
                        <input type="text" name="occupation" placeholder="{{$user->occupation}}" value="{{$user->occupation}}">
                    </div>
                    <div>
                        <select name="tag">
                            <option>Select Tag</option>
                            @foreach($tags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" placeholder="Update Rekening" name="rekening">
                    </div>
                </div>
                <button type="submit" class="signUpButton">
                    Sign Up
                </button>
            </form>
        </div>
    </div>

</div>


<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
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
        </div>
        <div class="card-body">
            <h1>History</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Point</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Title 1</td>
                        <td>Description 1</td>
                        <td>1000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>


<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
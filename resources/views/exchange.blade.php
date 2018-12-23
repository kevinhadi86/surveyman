<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchange Points</title>
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
            <div class="col-6">
                <h1>Jumlah Point:{{$wallet->points}}</h1>
            </div>
            <div class="col-6">
                @if(empty($wallet->rekening))
                    <div>
                        <h1>Isi nomor rekening dulu:</h1>
                        <form method="post" action="{{url('/exchangepoints/'.$wallet->id)}}">
                            {{csrf_field()}}
                            <input type="text" name="rekening">
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                @else
                    <div>
                        <h1>Nomor Rekening:</h1>
                        <h2>{{$wallet->rekening}}-{{$user->firstname}} {{$user->lastname}}</h2>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <h1>Beli Point</h1>
                <form method="post" action="{{url('exchangepoints/add/'.$wallet->id)}}">
                    {{csrf_field()}}
                    <h3>Jumlah point yang ingin dibeli:</h3>
                    <input type="text" id="beli" name="points" onchange="calculate('beli',$(this).val())">
                    <h4 id="hargabeli"></h4>
                    <h6>Harga = Jumlah Point x Rp 1.000</h6>
                    <button type="submit">Beli</button>
                </form>
            </div>
            <div class="col-6">
                <h1>Tukar Point</h1>
                <form method="post" action="{{url('exchangepoints/sub/'.$wallet->id)}}">
                    {{csrf_field()}}
                    <h3>Jumlah point yang ingin ditukar:</h3>
                    <input type="text" id="jual" name="points" onchange="calculate('jual',$(this).val())">
                    <h4 id="hargajual"></h4>
                    <h6>Harga = Jumlah Point x Rp 1.000</h6>
                    <button type="submit">Tukar</button>
                </form>
            </div>
        </div>
    </div>

</div>


<script src="{{asset('js/script.js')}}"></script>
<script>
    function calculate(type,val) {
        console.log("Calling...");
        let price = val * 1000;
        if (type == "beli"){
            console.log('beli');
            $('#hargabeli').html('Harga = Rp '+price);
        }else {
            $('#hargajual').html('Harga = '+price);
        }

    }
</script>
</body>
</html>
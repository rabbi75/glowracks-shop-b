<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @foreach($mainlogo as $key=>$value)
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset($value->image)}}">
    <link rel="icon" rel="apple-touch-icon" sizes="120x120" href="{{asset('public/frontEnd/images/')}}/apple-icon-120x120.png"/>
    @endforeach
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @foreach($generalInfoes as $metadesc)
    <meta name="description" content="{{ $metadesc->metadescrp }}">
    @endforeach
    @foreach($generalInfoes as $metatag)
    <meta name="keywords" content="{{ $metatag->metatag }}">
    @endforeach
    <title>@foreach($generalInfoes as $sitename){{ $sitename->sitename }}@endforeach</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{asset('public/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/all.css')}}" rel="stylesheet">
    <!-- <base href="https://localhost/mirrorbd/" target="_blank"> -->
    <base href="https://glowracksit.com/mirrorbd/" target="_blank">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    @foreach($generalInfoes as $ganalyticshead)
    <script>
        {{ $ganalyticshead->googleanyh }}
    </script>
    @endforeach
     <!-- Scripts -->
</head>
<body>
    <div id="app">
        <App></App>
        <transition name="fade"></transition>
        <Home></Home>
    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/all.js') }}"></script>
    @foreach($generalInfoes as $ganalyticsbody)
    <script>
        {{ $ganalyticsbody->googleanybo }}
    </script>
    @endforeach
</body>
</html>

<script>
   var ctx = document.getElementById('myChart').getContext('2d');
   var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: [@foreach($ordertypes as $ordertype)'{{$ordertype->name}}',@endforeach],
        datasets: [{
            label: 'Order Statistics',
            backgroundColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
            borderColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
             data: [@foreach($ordertypes as $ordertype)
             @php
             $parcelcount = App\Order::where('orderStatus',$ordertype->id)->count();
             @endphp {{$parcelcount}}, @endforeach]
        }]
    },

    // Configuration options go here
    options: {}
});
 </script>

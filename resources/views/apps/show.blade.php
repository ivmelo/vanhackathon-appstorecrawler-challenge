@extends('app')

@section('content')
<div class="searchbar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.searchwidget')
            </div>
        </div>
    </div>
</div>
<div class="app-details mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ $app->icon_url }}" alt="App Icon" class="full-width app-icon">
            </div>
            <div class="col-md-6">
                <h2>{{ $app->name }}
                    @if ($app->os == 'ios')
                        <a href="{{ $app->store_url }}" target="_blank"><img src="{{ asset('img/app-store.png') }}" alt="App Store Logo" class="store-logo"></a>
                    @else
                        <a href="{{ $app->store_url }}" target="_blank"><img src="{{ asset('img/play-store.png') }}" alt="App Store Logo" class="store-logo"></a>
                    @endif
                </h2>

                <p class="fw-400">{{ $app->developer }}</p>

                <p>{{ str_limit($app->description, 230) }}</p>
                <p class="fw-400">Price: {{ $app->price }}
                    <span class="tag">{{ $app->category }}</span>
                    <span class="tag">{{ $app->price == 'Free' ? 'Free' : 'Paid' }}</span>
                </p>
            </div>
            <div class="col-md-3">
                <h3>Rating</h3>
                <hr>
                <div class="rating-box text-center">
                    <h1>{{ number_format($app->rating, 1) }}</h1>
                    @include('partials.stars')
                    <p><small>{{ $app->rating_count }} ratings</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="stats mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="with-hr">Ranking</h3>
                @if ($app->rankingEntries->count() > 0)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="stats-box">
                                <p>General</p>
                                <hr>
                                <h1 class="text-center">#{{ $app->rankingEntries->last()->position }}</h1>
                                <p class="text-center">
                                    {{ ucfirst($app->rankingEntries->last()->type) }} Apps
                                    <br>
                                    @if ($app->os == 'ios')
                                        App Store
                                    @else
                                        Google Play
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box inverse">
                                <p>By Category</p>
                                <hr>
                                <h1 class="text-center">#{{ $categoryPosition }}</h1>
                                <p class="text-center">
                                    {{ $app->category }},
                                    {{ ucfirst($app->rankingEntries->first()->type) }}
                                    <br>
                                    @if ($app->os == 'ios')
                                        App Store
                                    @else
                                        Google Play
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <p>This app hasn't been featured in the top 100 rank.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h3 class="with-hr">Statistics</h3>
                @if ($app->rankingEntries->count() > 1)
                <canvas id="appChart" width="400" height="200"></canvas>
                @else
                <p>There's not enough data to generate a chart for this app.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="screens mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="with-hr">Screenshots</h3>
                <div class="screenshots">
                    @foreach ($app->screenshots as $screenshot)
                        <img src="{{ $screenshot->img_url }}" alt="App screenshot." class="app-screenshot">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
var ctx = document.getElementById("appChart");
var myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: [@foreach($app->rankingEntries as $entry) "{{ $entry->created_at->format('M d') }}", @endforeach],
    datasets: [{
        label: 'General Store Ranking',
        data: [@foreach($app->rankingEntries as $entry) {{ $entry->position }}, @endforeach],
        fill: false,
        borderColor: '#f89622',
        backgroundColor: '#f89622',
    }]
},
options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: false,
                fixedStepSize: true,
                reverse: true,
            }
        }]
    }
}
});
</script>
@endsection

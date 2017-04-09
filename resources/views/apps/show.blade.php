@extends('app')

@section('content')
<div class="searchbar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="search" value="Search for apps..." class="form-control">
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="store" value="Choose your store..." class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="country" value="Choose your country" class="form-control">
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="app-details mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $app->icon_url }}" alt="App Icon" class="full-width app-icon">
                <a href="{{ $app->store_url }}" target="_blank" class="btn buy-button mt-2">{{ $app->price }}</a>
            </div>
            <div class="col-md-7">
                <h2>{{ $app->name }}
                    @if ($app->os == 'ios')
                        <img src="{{ asset('img/app-store.png') }}" alt="App Store Logo" class="store-logo">
                    @else
                        <img src="{{ asset('img/play-store.png') }}" alt="App Store Logo" class="store-logo">
                    @endif
                </h2>

                <p class="fw-400">{{ $app->developer }}</p>
                <span class="tag">{{ $app->category }}</span>
                <span class="tag">{{ $app->price == 'Free' ? 'Free' : 'Paid' }}</span>
                <p>{{ str_limit($app->description, 230) }}</p>
            </div>
            <div class="col-md-3">
                <h3>Rating</h3>
                <hr>
                <div class="rating-box text-center">
                    <h1>{{ round($app->rating, 1) }}</h1>
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
                {{-- <hr> --}}
                @if ($app->rankingEntries->count() > 0)
                    <div class="stats-box">
                        <p>Today</p>
                        <hr>
                        <h1 class="text-center">#{{ $app->rankingEntries->first()->position }}</h1>
                        <p class="text-center">
                            {{ ucfirst($app->rankingEntries->first()->type) }} apps,
                            @if ($app->os == 'ios')
                                App Store
                            @else
                                Google Play
                            @endif
                        </p>
                    </div>
                @else
                    <p>This app hasn't been featured in the top 100 rank.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h3 class="with-hr">Statistics</h3>
                {{-- <hr> --}}
                <p>There's not enough rank data to generate a chart yet.</p>
            </div>
        </div>
    </div>
</div>
<div class="screens mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="with-hr">Screenshots</h3>
                {{-- <hr> --}}
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

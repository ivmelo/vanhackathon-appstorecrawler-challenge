@extends('app')

@section('content')
<div class="searchbar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="search" value="Search for apps..." class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="store" value="Choose your store..." class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2 mt-2">
                    <input type="text" name="country" value="Choose your country" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-details mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $app->icon_url }}" alt="App Icon" class="full-width app-icon">
            </div>
            <div class="col-md-7">
                <h2>{{ $app->name }}</h2>
                <h5>{{ $app->developer }}</h5>
                <div class="list">

                </div>
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
<div class="stats">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Ranking</h3>
                <hr>
                <div class="stats-box">
                    <h1>#{{ $app->rankingEntries->first()->position }}</h1>
                    <p>US Ranking, Apps</p>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Statistics</h3>
                <hr>
                <p>Graph goes here...</p>
            </div>
        </div>
    </div>
</div>
<div class="screens">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Screenshots</h3>
                <hr>
                <div class="screenshots">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                    <img src="https://unsplash.it/720/1280" alt="App screenshot." class="app-screenshot">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

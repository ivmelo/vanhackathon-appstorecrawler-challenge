@extends('app')

@section('content')
<div class="searchbar-inverse">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.searchwidget')
            </div>
        </div>
    </div>
</div>
<div class="charts">
    <div class="container">
        <h1 class="text-center margin-bottom-5">Search Results</h1>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h3 class="mb-4 text-center">{{ $searchResults->count() }} results for "{{ $query }}"</h3>

                @if (count($searchResults) == 0)
                    <p class="lead text-center">Can't find what you're looking for? Just paste a Google Play or App Store URL in the search bar and we'll automatically start tracking your app.</p>
                @endif

                <div class="ranking-list">
                    @foreach ($searchResults as $searchResult)
                        <a href="{{ action('AppController@show', $searchResult->id) }}" class="ranking-entry @if($loop->last) borderless-bottom @endif">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="{{ $searchResult->icon_url }}" class="full-width app-icon">
                                </div>
                                <div class="col-sm-7">
                                    <h4 class="ellipsis-2">{{ $searchResult->name }}</h4>
                                    <p class="ellipsis-1">{{ $searchResult->developer }}</p>
                                </div>
                                <div class="col-sm-1">
                                    @if ($searchResult->os == 'ios')
                                        <img src="{{ asset('img/app-store.png') }}" alt="App Store Logo" class="store-logo block-center">
                                    @else
                                        <img src="{{ asset('img/play-store.png') }}" alt="App Store Logo" class="store-logo block-center">
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <span class="tag mini">{{ $searchResult->price }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

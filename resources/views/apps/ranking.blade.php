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
        <h1 class="text-center margin-bottom-5">Top 100 Free Apps</h1>

        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3"><img src="{{ asset('img/app-store.png') }}" class="store-logo" alt="App store logo."> App Store</h3>

                <div class="ranking-list">
                    @foreach ($appStoreFreeRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3"><img src="{{ asset('img/play-store.png') }}" class="store-logo" alt="App store logo."> Google Play</h3>

                <div class="ranking-list">
                    @foreach ($googlePlayFreeRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
        </div>

        <h1 class="text-center margin-top-5 margin-bottom-5">Top 100 Paid Apps</h1>

        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3"><img src="{{ asset('img/app-store.png') }}" class="store-logo" alt="App store logo."> App Store</h3>

                <div class="ranking-list">
                    @foreach ($appStorePaidRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3"><img src="{{ asset('img/play-store.png') }}" class="store-logo" alt="App store logo."> Google Play</h3>

                <div class="ranking-list">
                    @foreach ($googlePlayPaidRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

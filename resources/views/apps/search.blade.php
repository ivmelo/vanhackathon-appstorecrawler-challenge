@extends('app')

@section('content')
<div class="charts">
    <div class="container">
        <h1 class="text-center margin-bottom-5">Search Results</h1>

        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3">App Store</h3>

                <div class="ranking-list">
                    @foreach ($appStoreFreeRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3">Google Play</h3>

                <div class="ranking-list">
                    @foreach ($googlePlayFreeRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

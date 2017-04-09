@extends('app')

@section('content')
<div class="jumbo">
    <div class="container">
        <div class="call-to-action">
            <h1 class="text-center">Get insights on your apps!</h1>
            <p class="lead text-center">Mobile add planning, execution and analysis are complicated for startups <br>
                because they cannot reach all available app marketing tools.</p>
            <p class="lead text-center">App samurai makes it easy for them without requiring in depth mobild ads knowledge.</p>
        </div>
    </div>
</div>
<div class="charts">
    <div class="container">
        <h1 class="text-center mb-5">Top 10 Free Apps</h1>

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

        <h1 class="text-center mb-5">Top 10 Paid Apps</h1>

        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3">App Store</h3>

                <div class="ranking-list">
                    @foreach ($appStorePaidRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3">Google Play</h3>

                <div class="ranking-list">
                    @foreach ($googlePlayPaidRankingEntry as $rankingEntry)
                        @include('partials.rankingentry')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="company-info">

</div>
@endsection

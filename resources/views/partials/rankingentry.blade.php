<a href="{{ action('AppController@show', $rankingEntry->app->id) }}" class="ranking-entry @if($loop->last) borderless-bottom @endif">
    <div class="row">
        <div class="col-sm-1">
            <h3>{{ $rankingEntry->position }}</h3>
        </div>
        <div class="col-sm-3">
            <img src="{{ $rankingEntry->app->icon_url }}" class="full-width app-icon">
        </div>
        <div class="col-sm-6">
            <h4 class="ellipsis-2">{{ $rankingEntry->app->name }}</h4>
            <p class="ellipsis-1">{{ $rankingEntry->app->developer }}</p>
        </div>
        <div class="col-sm-2">
            <span class="tag mini">{{ $rankingEntry->app->price }}</span>
        </div>
    </div>
</a>

<form action="{{ action('AppController@index') }}" method="get">
    <div class="input-group mb-2 mt-2">
        <input type="text" name="q" id="q" class="form-control search-input" value="@if(isset($query)) {{ $query }} @endif" placeholder="Search for an app, or paste a URL from the App Store or Google Play store.">
        <span class="input-group-addon search-icon"><span class="fa fa-search"></span></span>
    </div>
</form>

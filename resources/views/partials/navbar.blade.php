<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ action('AppController@index') }}">
            <h3><span class="fa fa-app"></span>StoreCrawler</h3>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item @if(Request::is('apps')) active @endif">
                    <a class="nav-link" href="{{ action('AppController@index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(Request::is('ranking')) active @endif">
                    <a class="nav-link" href="{{ action('AppController@ranking') }}">App Ranking</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

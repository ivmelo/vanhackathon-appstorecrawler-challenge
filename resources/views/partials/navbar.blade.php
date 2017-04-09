<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ action('AppController@index') }}">
            <img src="{{ asset('img/appsamurai-logo.png') }}" height="35" class="d-inline-block align-top" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">App Ranking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features and Benefits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Case Studies</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

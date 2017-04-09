<div class="stars">
    @for ($i = 0; $i < explode('.', number_format($app->rating, 2))[0]; $i++)
        <span class="fa fa-star"></span>
    @endfor

    @if (explode('.', number_format($app->rating, 1))[1] >= 5)
        <span class="fa fa-star-half"></span>
    @endif
</div>

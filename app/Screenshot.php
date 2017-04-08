<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    //

    public function app()
    {
        return $this->belongsTo(App\App::class);
    }
}

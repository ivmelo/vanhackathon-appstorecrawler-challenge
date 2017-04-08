<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    //

    public function screenshots()
    {
        return $this->hasMany(App\Screenshot::class);
    }
}

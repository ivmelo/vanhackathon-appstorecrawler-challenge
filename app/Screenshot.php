<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    protected $fillable = ['img_url'];

    public function app()
    {
        return $this->belongsTo(App\App::class);
    }
}

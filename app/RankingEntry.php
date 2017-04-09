<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankingEntry extends Model
{
    protected $fillable = ['position', 'type'];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}

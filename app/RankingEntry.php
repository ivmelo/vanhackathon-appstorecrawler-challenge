<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankingEntry extends Model
{
    protected $fillable = ['position', 'type'];

    public function apps()
    {
        return $this->belongsTo(App\App::class);
    }
}

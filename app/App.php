<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = [
        'name', 'developer', 'icon_url',
        'description', 'price', 'category',
        'last_updated', 'version', 'languages',
        'copyright', 'rating', 'rating_count', 'os', 'store_url'
    ];

    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }

    public function rankingEntries()
    {
        return $this->hasMany(RankingEntry::class);
    }
}

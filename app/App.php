<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ivmelo\StoreScraper\Scraper;

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

    public static function findOrCreateFromUrl($url) {
        $store = null;
        $storeId = null;
        $betterURL = null;

        $parsedURL = parse_url($url);

        // Guess the store.
        if (strpos($url, 'itunes.apple.com')) {
            $store = 'itunes';

            $urlParts = explode('/', $parsedURL['path']);

            $storeId = substr($urlParts[4], 2);
            // Creates an APP URL for the US store.
            $betterURL = 'https://' . $parsedURL['host'] . '/us/app/' . $urlParts[3] . '/' . $urlParts[4] . '?mt=8';
        } else if (strpos($url, 'play.google.com')) {
            $store = 'gplay';
        }

        dd(parse_url($url));

        $scraper = new Scraper();

        if ($store) {
            // Defines which store to query.
            if ($store == 'itunes') {
                $appDetails = $scraper->getAppStoreAppData($url);
            } else if ($store == 'gplay') {
                $appDetails = $scraper->getPlayStoreAppData($url);
            }

            // Find the entry or create if doesn't exist.
            $app = App::firstOrCreate([
                'name' => $appDetails['name'],
                'developer' => $appDetails['developer'],
                'os' => $store == 'itunes' ? 'ios' : 'android',
            ],
            [
                'icon_url' => $appDetails['icon_url'],
                'description' => $appDetails['description'],
                'price' => $appDetails['price'],
                'category' => $appDetails['category'],
                'last_updated' => $appDetails['last_update'],
                'rating' => round($appDetails['rating'], 4),
                'rating_count' => $appDetails['rating_count'],
                'store_url' => $url,
            ]);


            foreach ($appDetails['screens'] as $screenshot) {
                $app->screenshots()->firstOrCreate([
                    'img_url' => $screenshot
                ]);
            }

            return $app;
        }

    }
}

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
        'copyright', 'rating', 'rating_count',
        'os', 'store_id', 'store_url',
    ];

    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }

    public function rankingEntries()
    {
        return $this->hasMany(RankingEntry::class);
    }

    public static function findOrCreateFromUrl($url)
    {
        $store = null;
        $storeId = null;
        $betterURL = null;

        $parsedURL = parse_url($url);

        // Guess the store, grabs the unique App ID and creates a standardised URL.
        if (strpos($url, 'itunes.apple.com')) {
            $store = 'itunes';
            $urlParts = explode('/', $parsedURL['path']);
            // Grabs the app unique ID.
            $storeId = substr($urlParts[4], 2);
            // Creates an APP URL for the US store.
            $betterURL = 'https://' . $parsedURL['host'] . '/us/app/' . $urlParts[3] . '/' . $urlParts[4] . '?mt=8';
        } elseif (strpos($url, 'play.google.com')) {
            $store = 'gplay';
            $queryParts = [];
            parse_str($parsedURL['query'], $queryParts);
            // Grabs the app unique ID.
            $storeId = $queryParts['id'];
            // Creates an APP URL for the US store and using EN as the language.
            $betterURL = 'https://play.google.com/store/apps/details?id=' . $storeId . '&hl=en';
        }

        $scraper = new Scraper();

        if ($store) {
            // First, try to find the app by it's store id.
            $app = self::where('store_id', '=', $storeId)->first();

            if (!$app) {
                // Defines which store to query.
                if ($store == 'itunes') {
                    $appDetails = $scraper->getAppStoreAppData($betterURL);
                } elseif ($store == 'gplay') {
                    $appDetails = $scraper->getPlayStoreAppData($betterURL);
                }

                // If not found by store ID, find by the combination of name + developer + store.
                $app = self::firstOrCreate([
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
                    'rating' => $appDetails['rating'] ? round($appDetails['rating'], 4) : null,
                    'rating_count' => $appDetails['rating_count'],
                    'store_url' => $betterURL,
                    'store_id' => $storeId,
                ]);

                foreach ($appDetails['screens'] as $screenshot) {
                    $app->screenshots()->firstOrCreate([
                        'img_url' => $screenshot,
                    ]);
                }
            }

            return $app;
        }
    }
}

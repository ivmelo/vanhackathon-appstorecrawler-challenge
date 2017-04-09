<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ivmelo\StoreScraper\Scraper;
use App\App;

class PopulateTopAppsList extends Command
{
    const IOS = 0;
    const ANDROID = 1;
    const FREE = 0;
    const PAID = 1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charts:update {--paid} {--android} {--ios}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the top apps list.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $os = $this::IOS;
        $price = $this::FREE;

        if ($this->option('android')) {
            $os = $this::ANDROID;
        }

        if ($this->option('paid')) {
            $price = $this::PAID;
        }

        $scraper = new Scraper();

        // Defines the store and the ranking that will be used.
        if ($os == $this::ANDROID) {
            if ($price == $this::FREE) {
                $topApps = $scraper->getPlayStoreTopFree();
            } else {
                $topApps = $scraper->getPlayStoreTopPaid();
            }
        } else {
            if ($price == $this::FREE) {
                $topApps = $scraper->getAppStoreTopFree();
            } else {
                $topApps = $scraper->getAppStoreTopPaid();
            }
        }

        print_r($topApps);

        // Progress bar for information purposes.
        $bar = $this->output->createProgressBar(count($topApps));

        foreach ($topApps as $topAppsEntry) {

            // print_r($topAppsEntry);

            if ($os == $this::ANDROID) {
                $appDetails = $scraper->getPlayStoreAppData($topAppsEntry['url']);
            } else {
                $appDetails = $scraper->getAppStoreAppData($topAppsEntry['url']);
            }

            // print_r($appDetails);

            $app = App::firstOrCreate([
                'name' => $appDetails['name'],
                'developer' => $appDetails['developer'],
                'os' => $os == $this::IOS ? 'ios' : 'android',
            ],
            [
                'icon_url' => $appDetails['icon_url'],
                'description' => $appDetails['description'],
                'price' => $appDetails['price'],
                'category' => $appDetails['category'],
                'last_updated' => $appDetails['last_update'],
                'rating' => round($appDetails['rating'], 4),
                'rating_count' => $appDetails['rating_count'],
                'store_url' => $topAppsEntry['url'],
            ]);

            $app->rankingEntries()->create([
                'position' => $topAppsEntry['position'],
                'type' => $price == $this::FREE ? 'free' : 'paid',
            ]);

            foreach ($appDetails['screens'] as $screenshot) {
                $app->screenshots()->firstOrCreate([
                    'img_url' => $screenshot
                ]);
            }

            $bar->advance();
        }

        $bar->finish();
    }
}

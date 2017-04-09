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

            $app = App::findOrCreateFromUrl($topAppsEntry['url']);

            $app->rankingEntries()->create([
                'position' => $topAppsEntry['position'],
                'type' => $price == $this::FREE ? 'free' : 'paid',
            ]);

            $bar->advance();
        }

        $bar->finish();
    }
}

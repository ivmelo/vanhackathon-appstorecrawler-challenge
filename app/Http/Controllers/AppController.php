<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use App\RankingEntry;
use Carbon\Carbon;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {

            // First, check if it's a valid itunes or play store url, and search for the app using the app ID.
            if (strpos($request->get('q'), 'itunes.apple.com') || strpos($request->get('q'), 'play.google.com')) {
                $app = App::findOrCreateFromUrl($request->get('q'));
                return redirect()->action('AppController@show', $app->id);
            }

            // Find apps by name.
            $searchValues = preg_split('/\s+/', $request->get('q'), -1, PREG_SPLIT_NO_EMPTY);

            $apps = App::where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            })->get();

            return view('apps.search', [
                'searchResults' => $apps,
                'query' => $request->get('q'),
            ]);

        } else {
            $googlePlayFreeRankingEntry = RankingEntry::where('type', '=', 'free')->whereHas('App', function($q){
                $q->where('os', '=', 'android');
            })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(10)->orderBy('position', 'asc')->with('app')->get();

            $appStoreFreeRankingEntry = RankingEntry::where('type', '=', 'free')->whereHas('App', function($q){
                $q->where('os', '=', 'ios');
            })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(10)->orderBy('position', 'asc')->with('app')->get();

            $googlePlayPaidRankingEntry = RankingEntry::where('type', '=', 'paid')->whereHas('App', function($q){
                $q->where('os', '=', 'android');
            })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(10)->orderBy('position', 'asc')->with('app')->get();

            $appStorePaidRankingEntry = RankingEntry::where('type', '=', 'paid')->whereHas('App', function($q){
                $q->where('os', '=', 'ios');
            })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(10)->orderBy('position', 'asc')->with('app')->get();

            return view('apps.index', [
                'googlePlayFreeRankingEntry' => $googlePlayFreeRankingEntry,
                'appStoreFreeRankingEntry' => $appStoreFreeRankingEntry,
                'googlePlayPaidRankingEntry' => $googlePlayPaidRankingEntry,
                'appStorePaidRankingEntry' => $appStorePaidRankingEntry,
            ]);
        }
    }

    public function ranking(Request $request) {
        $googlePlayFreeRankingEntry = RankingEntry::where('type', '=', 'free')->whereHas('App', function($q){
            $q->where('os', '=', 'android');
        })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(100)->orderBy('position', 'asc')->with('app')->get();

        $appStoreFreeRankingEntry = RankingEntry::where('type', '=', 'free')->whereHas('App', function($q){
            $q->where('os', '=', 'ios');
        })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(100)->orderBy('position', 'asc')->with('app')->get();

        $googlePlayPaidRankingEntry = RankingEntry::where('type', '=', 'paid')->whereHas('App', function($q){
            $q->where('os', '=', 'android');
        })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(100)->orderBy('position', 'asc')->with('app')->get();

        $appStorePaidRankingEntry = RankingEntry::where('type', '=', 'paid')->whereHas('App', function($q){
            $q->where('os', '=', 'ios');
        })->whereDate('created_at', '=', Carbon::today()->toDateString())->limit(100)->orderBy('position', 'asc')->with('app')->get();

        return view('apps.ranking', [
            'googlePlayFreeRankingEntry' => $googlePlayFreeRankingEntry,
            'appStoreFreeRankingEntry' => $appStoreFreeRankingEntry,
            'googlePlayPaidRankingEntry' => $googlePlayPaidRankingEntry,
            'appStorePaidRankingEntry' => $appStorePaidRankingEntry,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = App::findOrFail($id);

        // Try to guess the app category's position by counting how many apps
        // of the same category are in the main ranking, and finding it's position.
        $rankingEntries = RankingEntry::with('app')->whereHas('App', function($q) use ($app){
            $q->where('os', '=', $app->os);
            $q->where('category', '=', $app->category);
            if ($app->price != 'Free') {
                $q->where('price', '<>', 'Free');
            } else {
                $q->where('price', '=', 'Free');
            }
        })->orderBy('position', 'asc')->get();

        $categoryPosition = 0;

        foreach ($rankingEntries as $rankingEntry) {
            $categoryPosition++;

            if($rankingEntry->app->id == $app->id)
                break;
        }

        return view('apps.show', [
            'app' => $app,
            'categoryPosition' => $categoryPosition
        ]);
    }
}

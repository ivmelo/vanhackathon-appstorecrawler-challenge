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
            $apps = App::where('name', 'like', '%'. $request->get('q') . '%')->get();

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

    public function search(Request $request) {
        return view('apps.search');
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
        return view('apps.show', compact('app'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}

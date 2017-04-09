@extends('app')

@section('content')
<div class="charts">
    <div class="container">
        <h1 class="text-center margin-bottom-5">Search Results</h1>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h3 class="mb-3 text-center">{{ $searchResults->count() }} results for "{{ $query }}"</h3>

                <div class="ranking-list">
                    @foreach ($searchResults as $searchResult)
                        <a href="{{ action('AppController@show', $searchResult->id) }}" class="ranking-entry @if($loop->last) borderless-bottom @endif">
                            <div class="row">
                                {{-- <div class="col-sm-1">
                                    <h3>{{ $searchResult->position }}</h3>
                                </div> --}}
                                <div class="col-sm-2">
                                    <img src="{{ $searchResult->icon_url }}" class="full-width app-icon">
                                </div>
                                <div class="col-sm-8">
                                    <h4 class="ellipsis-2">{{ $searchResult->name }}</h4>
                                    <p class="ellipsis-1">{{ $searchResult->developer }}</p>
                                </div>
                                <div class="col-sm-2">
                                    <span class="tag mini">{{ $searchResult->price }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

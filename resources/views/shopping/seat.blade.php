@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')

@section('content')
<script src="https://www.paypal.com/sdk/js?client-id=AdeKmKTa4nB9aWe7oZbheexKhuDFwXkfJIwjf8qcbdVlek869ZnqJ34TvF-rUvJcjVSRcXh26ff7VdDk"></script>
<div id="vue">
    @if(Auth::check())
        <booking id="{{ Auth::user()->id }}"></booking>
    @else
        <booking id="0"></booking>
    @endif
</div>
@endsection
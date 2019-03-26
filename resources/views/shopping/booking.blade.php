@extends('shopping.layout.master')
@section('title', 'Welcome to CM Boxing')
@section('content')


<!--====================================================
                        Booking
======================================================-->

<style>
    .seatSelection {
        text-align: center;
        padding: 5px;
        margin: 15px;
    }

    .seatsReceipt {
        text-align: center;
    }

    .seatNumber {
        display: inline;
        padding: 10px;
        background-color: #5c86eb;
        color: #FFF;
        border-radius: 5px;
        cursor: default;
        height: 25px;
        width: 25px;
        line-height: 25px;
        text-align: center;
    }

    .seatRow {
        padding: 10px;
    }

    .seatSelected {
        background-color: lightgreen;
        color: black;
    }

    .seatUnavailable {
        background-color: gray;
    }

    .seatRowNumber {
        clear: none;
        display: inline;
    }

    .hidden {
        display: none;
    }

    .seatsAmount {
        max-width: 2em;
    }
</style>
้<h1 align="center">Booking</h1>
<div class="seatSelection col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="seatRow">
                @foreach ($seats_group_1 as $key => $seat)
                <div id="VIP_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}" aria-checked="false"
                    focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if($key == 19 || $key == 39 || $key == 59)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="seatRow">
                @foreach ($seats_group_2 as $key => $seat)
                <div id="Ringside_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}"
                    aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if(($key+1)%10 == 0)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <div class="seatRow">
                @foreach ($seats_group_3 as $key => $seat)
                <div id="Ringside_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}"
                    aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if(($key+1)%10 == 0)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="seatRow">
                @foreach ($seats_group_4 as $key => $seat)
                <div id="Ringside_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}"
                    aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if(($key+1)%3 == 0)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div style="background-color: aqua; width: 100%; height: 96%;"></div>
        </div>
        <div class="col-md-4">
            <div class="seatRow">
                @foreach ($seats_group_5 as $key => $seat)
                <div id="Ringside_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}"
                    aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if(($key+1)%3 == 0)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="seatRow">
                @foreach ($seats_group_6 as $key => $seat)
                <div id="Ringside_{{ $seat->name }}" role="checkbox" value="{{ $seat->ticket->price }}"
                    aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">{{ $seat->name }}</div>
                @if(($key+1)%15 == 0)
                <br>
                <br>
                @endif
                @endforeach
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <label for="visit">Select Date of visit</label>
            <input type="date" class="form-control" id="visit">
        </div>
        <div class="seatsReceipt col-md-12" style="padding-top: 150px">
            <p>
                <strong>Selected Seats: <span class="seatsAmount" />0 </span></strong>
                <button id="btnClear" class="btn">Clear</button>
            </p>
            <ul id="seatsList" class="list-group list-group-flush"></ul>
        </div>
    </div>
    <br>
    <br>
    <div class="checkout">
        <span>Total: </span><span class="txtSubTotal">0.00</span>
        <br/>
        <button id="btnCheckout" name="btnCheckout" class="btn btn-primary"> Check out </button>
    </div>
</div>

@endsection
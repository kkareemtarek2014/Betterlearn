@extends('layout')
@section('content')




<div class="wrapper">
    <div class="container">
        <form class="card-body" action="{{route('python')}}" method="get">

            <h1>
                <i class="far fa-credit-card"></i> Payment Information
            </h1>
            <div class="cc-name">
                <label for="card-name">Credit Card No.</label>
                <input type="text" name="card-name">
            </div>
            <div class="cc-num">
                <label for="card-num">Credit Card No.</label>
                <input type="text" name="card-num">
            </div>
            <div class="cc-info">
                <div>
                    <label for="card-num">Exp</label>
                    <input type="text" name="expire">
                </div>
                <div>
                    <label for="card-num">CCV</label>
                    <input type="text" name="security">
                </div>
            </div>
            <div class="btns">
                <button type="submit" type="button" href = "{{route('python')}}" class="btn btn-primary btn-lg btn-block" >Purchase</button>
            </div>
        </form>
    </div>
</div>

@endsection

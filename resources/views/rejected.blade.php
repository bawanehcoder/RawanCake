@extends('site.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
@endsection
@section('content')
<style>
     h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

      
</style>
<div class="container" style="text-align: center;
padding:100px 0;">
    <h1 style="
    font-family: myFirstFont !important;
    color: #9E76B4;
    font-weight: bold;
">Payment Declined</h1>
    <p>Unfortunately, your order has been rejected due to a payment issue.</p>
    
    
</div>
@endsection

@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Below you can configure your Stripe account. It will be used to process payments</p>
        <form method="POST">
            <div class="form-group">
                <label>Stripe Private key</label>

                <div class="form-controls">
                    <input id="stripe_private_key" type="text" class="form-control" name="stripe_private_key" value="{{$stripe_private_key}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>Stripe Publishable key</label>

                <div class="form-controls">
                    <input id="stripe_pub_key" type="text" class="form-control" name="stripe_pub_key" value="{{$stripe_pub_key}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>Stripe Test private key</label>

                <div class="form-controls">
                    <input id="stripe_test_private_key" type="text" class="form-control" name="stripe_test_private_key" value="{{$stripe_test_private_key}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>Stripe Test publishable key</label>

                <div class="form-controls">
                    <input id="stripe_test_pub_key" type="text" class="form-control" name="stripe_test_pub_key" value="{{$stripe_test_pub_key}}"/>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Next</button>
        </form>
    </div>
    </div>
</div>
@endsection
@extends('FrontEnd.master')

@section('title')
    Withdraw-confirm
@endsection

@section('content')

    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">

            <a class="float-right mb-3 btn btn-sm btn-info" href="{{ route('withdraw_index') }}">
                <i class="fas fa-list"></i> Withdraw List
            </a>

            <div class="offset-2 col-xl-8 col-md-8 col-sm-12 col-12">

                <form action="{{ route('withdraw_confirm') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <h4 class="mt-3">Your available <strong>withdraw coins {{ $user->balance }}</strong></h4>
                        <input type="hidden" class="form-control" value="{{ $user->id }}" name="user_id">
                    </div>
                    <div class="form-group">
                        <h5>Service <strong>Charge 20% [{{ $charge = $user->balance*20/100  }}] coins.</strong></h5>
                        <input type="hidden" class="form-control" value="{{ $charge }}" name="service_charge">
                    </div>
                    @if($user->balance > 10)
                        <button type="submit" class="btn btn-success float-right">Confirm</button>
                    @else
                        <a href="#" aria-disabled="true" disabled class="btn btn-danger" title="You can't withdraw this coins">
                            Confirm
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

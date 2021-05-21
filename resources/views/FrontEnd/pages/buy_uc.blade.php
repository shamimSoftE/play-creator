@extends('FrontEnd.master')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">

                    <div class="widget-content widget-content-area">
                        <div class="container">

                            <div id="pricingWrapper" class="row">
                                <div class="container" style="margin-top:10%;margin-bottom:10%">
                                    <div class="row justify-content-center">
                                        <div class="offset-1 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="card">
                                                <form action="{{route ('uc_buy_complete') }}"  method="post" class="form-inline">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="card-header">
                                                            <label for="card-element">You'll be charged {{ $post->point }} coins</label>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $post->id }}" />
                                                        <button id="card-button" class="btn btn-dark" type="submit">
                                                            Confirm To Buy This
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


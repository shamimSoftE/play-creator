@extends('FrontEnd.master')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                {{--<h4>{{ $section->title }}</h4>--}}
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="container">

                            <div id="pricingWrapper" class="row">

                                @php
                                    // stripe  publisher key
                                    $stripe_key = 'pk_test_51ImrtVLRsujEO00RgmKWBoBZJZm89TBOWM1IkVJQOUN6jsvAvLgu3ITXY0jhOCR9zUk7mPSgUWJWZoUYlqdeuZd400YTTHCtBd';
                                @endphp
                                <div class="container" style="margin-top:10%;margin-bottom:10%">
                                    <div class="row justify-content-center">
                                        <div class="offset-1 col-lg-10 col-md-10 col-sm-12">
                                            <div class="">
                                                <p>You will be charged ${{ $coin->coin_price }}</p>
                                            </div>
                                            <div class="card">
                                                <form action="{{route('payment_completed')}}"  method="post" id="payment-form">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="{{ $coin->id}}">
                                                        <div class="card-header">
                                                            <label for="card-element">
                                                                Enter your credit card information
                                                            </label>
                                                        </div>
                                                        <div class="card-body">
                                                            <div id="card-element">
                                                                <!-- A Stripe Element will be inserted here. -->
                                                            </div>
                                                            <!-- Used to display form errors. -->
                                                            <div id="card-errors" role="alert"></div>
                                                            <input type="hidden" name="plan" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button
                                                            id="card-button"
                                                            class="btn btn-dark"
                                                            type="submit"
                                                            data-secret="{{ $intent }}"
                                                        > Pay Now </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center mt-3">
                                        <div class="offset-1 col-lg-10 col-md-10 col-sm-12">
                                            <div class="">
                                                <strong>Or</strong>
                                                <p>You can pay with your bank account</p>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{route('pay_with_bank')}}"  method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">

                                                            <div class="card-header">
                                                                <label for="card-element">Give us your bank money transfer check image</label>

                                                                <input type="hidden"  name="amount" value="{{ $coin->coin_price }}" />
                                                                <input type="hidden" name="coin_id" value="{{ $coin->id}}">
                                                                <input type="file" accept="image/*"  name="screenshot" class="form-control-file" />
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-dark float-right" type="submit">
                                                            Proceed
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center mt-5">
                                        <div class="offset-1 col-lg-10 col-md-10 col-sm-12">
                                            <div class="card">

                                                <div class="text-center">
                                                    <h4>Choose a bank account number</h4>
                                                </div>

                                                <div class="card-body">
                                                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                                                        <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Bank Name</th>
                                                            <th>Account Holders Name</th>
                                                            <th>Account Number</th>
                                                        </tr>
                                                        </thead>

                                                        @php
                                                            $banks = \App\Models\BankAccount::where('status',1)->latest()->get();
                                                        @endphp
                                                        <tbody>
                                                        @php($i = 1)
                                                        @foreach($banks as $bank)
                                                            <tr>

                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $bank->bank_name }}</td>
                                                                <td>{{ $bank->account_holder_name }}</td>
                                                                <td>{{ $bank->account_number }}</td>

                                                            </tr>
                                                        @endforeach

                                                        </tbody>

                                                    </table>
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

@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection



@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
                .then(function(result) {
                    console.log(result);
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        console.log(result);
                        form.submit();
                    }
                });
        });
    </script>

@endsection

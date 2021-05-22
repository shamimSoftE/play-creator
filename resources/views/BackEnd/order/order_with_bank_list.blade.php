@extends('BackEnd.master')

@section('title')
    Order | By Bank
@endsection

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                {{-- display error message --}}
                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- //display error message --}}
                <div class="widget-content widget-content-area br-6 p-2">

                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Coins</th>
                            <th>Bank Check</th>
                            <th>Coin Price</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->coin->coin_amount }}</td>
                                <td>
                                    <img src="{{ asset("Back/images/check/".$order->screenshot) }}" height="80px" alt="cate-img">
                                </td>
                                <td>
                                    {{ $order->amount }}$
                                </td>

                                <td>
                                    @if($order->status == 0)
                                        <a class="btn text-dark" href="{{ route('order_confirm',$order->id) }}" title="Click to confirm">
                                            <i class="fas fa-arrow-down"></i>Pending
                                        </a>
                                    @else
                                        <span class="btn text-success" title="Order Completed">
                                            <i class="fas fa-arrow-up"></i> Confirmed
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('order-delete-{{ $order->id }}').submit()
                                        }">
                                        <i class="fas fa-trash text-danger"></i>
                                        <form method="post" action="{{--{{ route('order_destroy',$order) }}--}}" id="{{ 'order-delete-'.$order->id }}">
                                            @csrf
                                        </form>
                                    </a>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Coins</th>
                            <th>Bank Check</th>
                            <th>Coin Price</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection


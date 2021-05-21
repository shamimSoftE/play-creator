@extends('BackEnd.master')

@section('title')
    Coin | List
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
                <div class="widget-content widget-content-area br-6">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Sell Date</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($soldBy as $sell)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $sell->user->name }}</td>
                                <td>${{ $sell->coin->coin_price }}</td>
                                <td>{{ $sell->coin->coin_amount }}</td>
                                <td>{{ $sell->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('coin-del-{{ $sell->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('coin_sold_destroy',$sell->id) }}" id="{{ 'coin-del-'.$sell->id }}">
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
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Sell Date</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>


@endsection


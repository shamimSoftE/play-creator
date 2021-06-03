@extends('BackEnd.master')

@section('title')
    Seller | List
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
                    {{-- <div class="">
                         <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('product.create') }}">
                             <i class="fas fa-plus-circle"></i> Product-Generate
                         </a>
                     </div>
 --}}
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Seller Name</th>
                            <th>Coin Amount</th>
                            <th>Service Charge</th>
                            <th>Status</th>
                            <th>Withdraw Date</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>

                        <tbody>
                        @php($i = 1)
                        @forelse($withdraw as $key => $draw)
                            <tr>
                                <td>{{ ++$key }}</td>

                                <td>{{ $draw->user->name }} </td>
                                <td>{{ $draw->coin_amount }} </td>
                                <td>{{ $draw->service_charge }} [20%]</td>
                                <td>
                                    @if($draw->status == 0)
                                        <a href="{{ route('completed', $draw->id) }}" class="btn btn-sm btn-dark" title="click to complete" >
                                            Pending
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-success" >
                                            Completed
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $draw->created_at->format('d-M-y') }}</td>
                                {{--<td>
                                    <a href="{{ route('delete', $draw->id) }}" class="btn btn-sm btn-success" >
                                        Completed
                                    </a>
                                </td>--}}
                            </tr>
                        @empty
                            <tr>
                                <th colspan="8" style="text-align: center">
                                    Oops.. No data found.
                                </th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Seller Name</th>
                            <th>Coin Amount</th>
                            <th>Service Charge</th>
                            <th>Status</th>
                            <th>Withdraw Date</th>
{{--                            <th></th>--}}
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection


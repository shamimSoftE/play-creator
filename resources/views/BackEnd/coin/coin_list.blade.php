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
                <div class="widget-content widget-content-area br-6 p-2">
                    <div class="">
                        <a class="btn btn-sm float-right mr-4 mt-4" href="{{ route('coin.create') }}">
                            <i class="fas fa-plus-circle"></i>Coin Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($coins as $coin)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $coin->coin_amount }}</td>
                                <td>${{ $coin->coin_price }}</td>

                                <td>
                                    @if($coin->status == '1')
                                        <a class="text-success" href="{{ route('coin_inactive',$coin->id) }}" title="Active">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="text-danger" href="{{ route('coin-active',$coin->id) }}" title="Inactive">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('coin-delete-{{ $coin->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('coin.destroy',$coin->id) }}" id="{{ 'coin-delete-'.$coin->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    <a class="btn" data-toggle="modal" data-target="#coinEdit{{ $coin->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="coinEdit{{ $coin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Coin Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('coin.update',$coin) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group mb-3">
                                                        <label>Coin Amount</label>
                                                        <input type="text" class="form-control" name="coin_amount" value="{{ $coin->coin_amount }}" >
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Coin Price</label>
                                                        <input type="text" class="form-control" name="coin_price" value="{{ $coin->coin_price }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Coin Title<sup style="color: red">(optional)</sup></label>
                                                        <input type="text" class="form-control" name="coin_title" value="{{ $coin->coin_title }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Coin Excerpt<sup style="color: red">(optional)</sup></label>
                                                        <input type="text" class="form-control" name="coin_excerpt" value="{{ $coin->coin_excerpt }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--// modal --}}

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Amount</th>
                            <th>Price</th>
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


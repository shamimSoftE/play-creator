@extends('BackEnd.master')

@section('title')
    Bank | List
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
                        <a class="btn btn-sm float-right mr-4 mt-4" href="{{ route('bank.create') }}">
                            <i class="fas fa-plus-circle"></i>Bank Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name</th>
                            <th>Account Holders Name</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($banks as $bank)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $bank->bank_name }}</td>
                                <td>{{ $bank->account_holder_name }}</td>
                                <td>{{ $bank->account_number }}</td>

                                <td>
                                    @if($bank->status == '1')
                                        <a class="text-success" href="{{ route('bank_inactive',$bank->id) }}" title="Active">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="text-danger" href="{{ route('bank_active',$bank->id) }}" title="Inactive">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('bank-delete-{{ $bank->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('bank.destroy',$bank->id) }}" id="{{ 'bank-delete-'.$bank->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    <a class="btn" data-toggle="modal" data-target="#coinEdit{{ $bank->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="coinEdit{{ $bank->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Bank Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('bank.update',$bank) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group mb-3">
                                                        <label>Bank Name</label>
                                                        <input type="text" class="form-control" name="bank_name" value="{{ $bank->bank_name }}" >
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Account Holders Name</label>
                                                        <input type="text" class="form-control" name="account_holder_name" value="{{ $bank->account_holder_name }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Account Number</label>
                                                        <input type="text" class="form-control" name="account_number" value="{{ $bank->account_number }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
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
                            <th>Bank Name</th>
                            <th>Account Holders Name</th>
                            <th>Account Number</th>
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


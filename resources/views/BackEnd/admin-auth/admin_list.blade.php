@extends('BackEnd.master')

@section('title')
    Admin List
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
                        <a class="btn btn-sm float-right mr-4 mt-4" href="{{ route('admin_create') }}">
                            <i class="fas fa-plus-circle"></i>Admin Create
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
{{--                            <th>Status</th>--}}
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($admins as $admin)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>

{{--                                <td>--}}
{{--                                    @if($admin->status == '1')--}}
{{--                                        <a class="text-success" href="--}}{{--{{ route('coin_inactive',$admin->id) }}--}}{{--" title="Active">--}}
{{--                                            <i class="fas fa-arrow-up"></i>--}}
{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        <a class="text-danger" href="--}}{{--{{ route('coin-active',$admin->id) }}--}}{{--" title="Inactive">--}}
{{--                                            <i class="fas fa-arrow-down"></i>--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('admin-delete-{{ $admin->id }}').submit()
                                        }">
                                        <span class="fas fa-trash text-danger" title="Destroy"></span>
                                        <form method="post" action="{{ route('admin_destroy',$admin->id) }}" id="{{ 'admin-delete-'.$admin->id }}">
                                            @csrf
                                            @method('POST')
                                        </form>
                                    </a>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
{{--                            <th>Status</th>--}}
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection


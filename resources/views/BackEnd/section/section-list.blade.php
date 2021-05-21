@extends('BackEnd.master')

@section('title')
    Section | List
@endsection

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
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
                <div class="widget-content widget-content-area br-6 p-4">
                    <div class="">
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('section.create') }}">
                            <i class="fas fa-plus-circle"></i>Section Add
                        </a>
                    </div>
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($sections as $sec)
                                <tr>

                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sec->title }}</td>
                                    <td>
                                        @if($sec->status == 1)
                                            <a class="text-success" href="{{ route('section_hide',$sec->id) }}" title="Active">
                                                <i class="fas fa-arrow-up"></i>
                                            </a>
                                        @else
                                            <a class="text-danger" href="{{ route('section_active',$sec->id) }}" title="Inactive">
                                                <i class="fas fa-arrow-down"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn" onclick="event.preventDefault();
                                            if(confirm('Are you really want to delete?')){
                                            document.getElementById('sect-delete-{{ $sec->id }}').submit()
                                            }">
                                            <span class="fas fa-trash text-danger" title="Destroy"></span>
                                            <form method="post" action="{{ route('section.destroy',$sec->id) }}" id="{{ 'sect-delete-'.$sec->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </a>

                                        <a class="btn" data-toggle="modal" data-target="#contentEdit{{ $sec->id }}">
                                            <i class="fas fa-pencil-alt" title="Edit"></i>
                                        </a>
                                    </td>
                                    {{-- modal --}}

                                    <div class="modal fade" id="contentEdit{{ $sec->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Section Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('section.update',$sec) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" name="title" value="{{ $sec->title }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
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
                            <th>Title</th>
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


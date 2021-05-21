@extends('BackEnd.master')

@section('title')
    Product | List
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
                        <a class="btn btn-sm float-right mt-3 mr-4" href="{{ route('product.create') }}">
                           <i class="fas fa-plus-circle"></i> Product-Generate
                        </a>
                    </div>

                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            {{--<th>Title</th>--}}
                            <th>Quantity</th>
                            <th>Point</th>
                            <th>Category</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($products as $pro)
                            <tr>
                                <td>{{ $i++ }}</td>
                                {{--<td>{{ $pro->title }}</td>--}}

                                <td>{{ $pro->quantity }}</td>
                                <td>{{ $pro->point }}</td>

                                <td>
                                    @isset($pro->category->image)
                                        <img src="{{ asset("Back/images/category/".$pro->category->image) }}" height="80px" alt="cate-img">
                                    @endisset
                                </td>
                                <td>
                                    @isset($pro->section->title)
                                        {{ $pro->section->title }}
                                    @endisset
                                </td>

                                <td>
                                    @if($pro->status == 1)
                                        <a class="btn text-success" href="{{ route('post_hide',$pro->id) }}" title="Active">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                    @else
                                        <a class="btn text-primary" href="{{ route('post_active',$pro->id) }}" title="Inactive">
                                            <i class="fas fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn" onclick="event.preventDefault();
                                        if(confirm('Are you really want to delete?')){
                                        document.getElementById('product-delete-{{ $pro->id }}').submit()
                                        }">
                                        <i class="fas fa-trash text-danger"></i>
                                        <form method="post" action="{{ route('product.destroy',$pro) }}" id="{{ 'product-delete-'.$pro->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>

                                    <a class="btn" data-toggle="modal" data-target="#postEdit{{ $pro->id }}">
                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                    </a>
                                </td>
                                {{-- modal --}}

                                <div class="modal fade" id="postEdit{{ $pro->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Category Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('product.update',$pro) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    {{--<div class="form-group">
                                                        <label for="name">Product Title</label>
                                                        <input type="text" class="form-control" value="{{ $pro->title }}" name="title">
                                                    </div>--}}
                                                    <input type="hidden" name="id" value="{{ $pro->id }}">

                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="section_id">Product Category </label>
                                                                <select class="form-control select2" name="category_id" >
                                                                    {{--<option value="">Select</option>--}}
                                                                    @foreach($categories as $cate)
                                                                        <option value="{{ $cate->id }}" @if($cate->id == $pro->category_id) selected @endif>
                                                                            {{ $cate->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="name">Product Point</label>
                                                                <input type="text" class="form-control" value="{{ $pro->point }}" name="point">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="name">Product Quantity</label>
                                                                <input type="text" class="form-control" value="{{ $pro->quantity }}" name="quantity">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                            <div class="form-group">
                                                                <label for="section_id">Product Section</label>
                                                                <select class="form-control select2" name="section_id" >
                                                                    {{--<option value="">Select</option>--}}
                                                                    @foreach($section as $sec)
                                                                        <option value="{{ $sec->id }}" {{--@if--}}
                                                                            {{ ($sec->id == $pro->section_id) ? 'selected' : ''}} {{--@endif--}}>
                                                                            {{ $sec->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
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
                            {{--<th>Title</th>--}}
                            <th>Quantity</th>
                            <th>Point</th>
                            <th>Category</th>
                            <th>Section</th>
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


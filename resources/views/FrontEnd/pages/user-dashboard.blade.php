@extends('FrontEnd.master')

@section('title')
    user-dashboard
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                {{-- display success message--}}
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- display success message--}}

            <div class="skills layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="text-center">Here you can customize your data history</h3>
                        @php
                            $user = auth()->user()->id;

                            $seller = \App\Models\Seller::where('user_id',$user)->first();
                        @endphp

                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2 ml-5">
                                        @if(isset($seller->status))

                                                @if($seller->status == 1 )

                                                <a href="{{ route('user_product_create') }}" class="btn btn-sm btn-success">
                                                    Create Product
                                                </a>
                                            @else
                                                <a href="{{ route('user_product_create') }}" aria-disabled="true" class="btn btn-sm btn-success" disabled title="Please apply first, to want be a seller.">
                                                    Create Product
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{--{{ route('user_product_create') }}--}}" aria-disabled="true" class="btn btn-sm btn-success" disabled title="Please apply first, to want be a seller.">
                                                Create Product
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2 ml-5">
                                        <a href="{{ route('user_order') }}" class="btn btn-sm btn-info">
                                            @php
                                              $user = auth()->user()->id;
                                                $order = \App\Models\Order::where('user_id',$user)->latest()->get();
                                            @endphp
                                            <sup style="font-size: 15px;color: #980054">{{ $order->count() }}</sup>New Order
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2 ml-5">
                                        <a href="{{ route('purchased_coin') }}" class="btn btn-sm btn-primary">
                                            Purchased Coins
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2 ml-5">
                                        <a href="{{ route('purchased_product') }}" class="btn btn-sm btn-dark">
                                            Purchased Product
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  layout-spacing">

                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="widget-content widget-content-area br-6">
                    <h4 class="text-center">
                        Your product list
                    </h4>
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
                            @forelse($products as $pro)
                                <tr>

                                    <td>{{ $i++ }}</td>
{{--                                    <td>{{ $pro->title }}</td>--}}

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
                                            <a class="btn text-success" href="{{ route('product_hide',$pro->id) }}" title="Active">
                                                <i class="fas fa-arrow-up"></i>
                                            </a>
                                        @else
                                            <a class="btn text-primary" href="{{ route('product_active',$pro->id) }}" title="Inactive">
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
                                            <form method="post" action="{{ route('product_destroy',$pro) }}" id="{{ 'product-delete-'.$pro->id }}">
                                                @csrf
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
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Product Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pro_update',$pro->id) }}" method="post">
                                                        @csrf
                                                        {{--<div class="form-group">
                                                            <label for="name">Product Title</label>
                                                            <input type="text" class="form-control" value="{{ $pro->title }}" name="title">
                                                        </div>--}}

                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="section_id">Product Category </label>
                                                                    <select class="form-control select2" name="category_id" >
                                                                        <option value="">Select</option>
                                                                        @foreach($categories as $cate)
                                                                            <option value="{{ $cate->id }}"@if($pro->category_id == $cate->id ) selected @endif>
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
                                                                        <option value="">Select</option>
                                                                        @foreach($section as $sec)
                                                                            <option value="{{ $sec->id }}" @if($sec->id == $pro->section_id) selected @endif>
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
{{--                            <th>Title</th>--}}
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

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- BEGIN PAGE LEVEL DATA Table STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->
@endsection


@section('script')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('Back') }}/plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->

@endsection


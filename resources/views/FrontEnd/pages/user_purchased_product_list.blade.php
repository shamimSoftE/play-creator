@extends('FrontEnd.master')

@section('title')
    purchased-item
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-spacing">
            <div class="offset-1 col-xl-10 col-lg-8 col-md-8 col-sm-12 layout-top-spacing">

                <div class="skills layout-spacing ">

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

                    <div class="widget-content widget-content-area">
                        <h3 class="text-center">Here is your purchased product list</h3>
                        <div class="d-flex b-skills">
                            <div class="mt-2 ml-5">
                                <a href="{{ route('user_profile') }}" class="btn btn-sm btn-success mb-3">
                                    Back To Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offset-1 col-xl-10 col-lg-8 col-md-8 col-sm-12  layout-spacing">
            <div id="purchaseCoin" class="widget-content widget-content-area br-6 p-2">
                <div class="">
                    <a class="mt-2 mr-4 text-center" href="#">
                        Your Purchase Product
                    </a>
                </div>

                <table id="zero-config" class="table dt-table-hover" style="width:100%">

                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Product Name</th>
                        <th>Product Coins</th>
                        <th>Product Qty</th>
                        <th>Product Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php($i = 1)
                    @forelse($purchasedPro as $key => $pro)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $pro->product->title }}</td>
                            <td>{{ $pro->product->point }} coins</td>
                            <td>{{ $pro->product->quantity }} pcs</td>
                            <td>{{ $pro->status }}</td>

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
                        <th>Product Name</th>
                        <th>Product Coins</th>
                        <th>Product Qty</th>
                        <th>Product Status</th>
                    </tr>
                    </tfoot>
                </table>
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

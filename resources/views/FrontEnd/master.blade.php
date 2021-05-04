<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title> @yield('title') </title>
        <link rel="icon" type="image/x-icon" href="{{ asset('Back') }}/assets/img/favicon.ico"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('Back') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('Back') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/table/datatable/dt-global_style.css">

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('Back') }}/assets/css/forms/switches.css">
        <link href="{{ asset('Back') }}/plugins/pricing-table/css/component.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL STYLES -->
        {{--stripe--}}
       {{-- <link href="{{ asset('/css') }}/stripe.css" rel="stylesheet" type="text/css"/>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('/js') }}/stripe.js"></script>--}}
        {{--stripe--}}


        @yield('style')
    </head>

    <body>

    <!--  BEGIN NAVBAR  -->
    @include('FrontEnd.include.header')
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Project5</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>@yield('title')</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('FrontEnd.include.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            @yield('content')

            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © {{ now()->year }} <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

        @yield('script')
        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="{{ asset('Back') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
        <script src="{{ asset('Back') }}/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('Back') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('Back') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('Back') }}/plugins/blockui/jquery.blockUI.min.js"></script>
        <script src="{{ asset('Back') }}/assets/js/app.js"></script>

        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src="{{ asset('Back') }}/plugins/highlight/highlight.pack.js"></script>
        <script src="{{ asset('Back') }}/assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/Back') }}/plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-category'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-category d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
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

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script>
        var getInputStatus = document.getElementById('radio-6');
        var getPricingContainer = document.getElementsByClassName('pricing-plans-container')[0];
        var getYearlySwitch = document.getElementsByClassName('billed-yearly-radio')[0];
        getInputStatus.addEventListener('change', function() {
            var isChecked = getInputStatus.checked;
            if (isChecked) {
                getPricingContainer.classList.add("billed-yearly");
                getYearlySwitch.classList.add("billed-yearly-switch");
            } else {
                getYearlySwitch.classList.remove("billed-yearly-switch");
                getPricingContainer.classList.remove("billed-yearly");
            }
        })
    </script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->


    </body>
    </html>


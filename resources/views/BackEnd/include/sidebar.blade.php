<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            @if(auth()->guard('admin')->user()->status == 1 )

            <li class="menu" title="This is Category">
                <a href="#cate" data-toggle="collapse" data-active="true" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <span>Category</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="cate" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('category.index') }}"> Category List</a>
                    </li>
                </ul>
            </li>

            <li class="menu" title="You can create/show section here">
                <a href="#section" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                    <div class="">
                        <span>Section</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="section" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('section.index') }}"> Section List</a>
                    </li>

                </ul>
            </li>

            <li class="menu" title="You can create/show product here">
                <a href="#pro" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                    <div class="">
                        <span>Product</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="pro" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('product.index') }}"> Product List</a>
                    </li>
                </ul>
            </li>

            <li class="menu" title="You can create/show coin here">
                <a href="#coin" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                    <div class="">
                        <span>Coin</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="coin" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('coin.index') }}"> Coin List</a>
                    </li>

                </ul>
            </li>

            <li class="menu" title="Show sold by coin here">
                <a href="#sold" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                    <div class="">
                        <span>Sold by Coin</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sold" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('soldBy_index') }}"> Sold by Coin List</a>
                    </li>

                </ul>
            </li>

            <li class="menu" title="You can create/show post here">
                <a href="#bank" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                    <div class="">
                        <span>Bank</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="bank" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('bank.index') }}"> Bank List</a>
                    </li>

                </ul>
            </li>

            @else

                <li class="menu" title="You can create/show post here">
                    <a href="#pro" data-toggle="collapse" data-active="" aria-expanded="" class="dropdown-toggle">
                        <div class="">
                            <span>Buy Point</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="pro" data-parent="#accordionExample">
                        <li>
                            <a href=""> Post List</a>
                        </li>

                    </ul>
                </li>

            @endif


        </ul>

    </nav>

</div>

@extends('FrontEnd.master')

@section('title')
    {{ \request()->query('query') }}
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 col-md-12">

                <div class="row">
                    @forelse($searchCate as $cate)
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2">
                            <div class="card-body form-inline">
                                <a href="{{ route('cate_pro', $cate->id) }}">
                                    <img src="{{ asset("Back/images/category/".$cate->image) }}"  class="img-thumbnail" style="height: 160px; width: 160px;" alt="pro img">
                                    <p class="card-text mr-2">
                                        {{ $cate->name }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-6 col-lg-4 my-5">
                            <div class="card component-card_3">
                                <div class="card-body">
                                    <span class="text-center text-success"> Oops No Product Found</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

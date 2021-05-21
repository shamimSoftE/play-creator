@extends('FrontEnd.master')

@section('title')
    category-product
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 col-md-12">

                <div class="row">
                    @forelse($product as $pro)

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2">
                            <div class="card component-card_3">
                                <div class="card-body text-center">
                                    <img src="{{ asset("Back/images/category/". $pro->category->image) }}"  {{--class="rounded-circle"--}} style="height: 160px; width: 160px; border-radius: 50%" alt="pro img">
                                    <h5 class="card-user_name">{{ $pro->point }} coins / {{ $pro->quantity }} </h5>
                                    {{--<p class="card-text">
                                        {{ $pro->title }}
                                    </p>--}}
                                    @auth
                                        <button type="button" class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#proView{{ $pro->id }}">
                                            Buy This
                                        </button>

                                    @endauth
                                    @guest
                                        <a title="Login/Register First" href="{{ route('login') }}" class="btn btn-success">Buy This</a>
                                    @endguest
                                </div>
                            </div>



                            <!-- Modal -->
                            <div class="modal fade modal-notification" id="proView{{ $pro->id }}" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" id="standardModalLabel">
                                    <div class="modal-content">
                                        <form action="{{ route('buy_product') }}" method="post">
                                            @csrf
                                            <div class="modal-body text-center">
                                                <div class="icon-content">
                                                    <img src="{{ asset("Back/images/category/". $pro->category->image) }}" width="120" alt="pro_img">
                                                    <input type="hidden" name="id" value="{{ $pro->id }}" />
                                                </div>
                                                <div class="modal-text">
                                                    {{--{{ $pro->title }} <br/>--}}
                                                    You need to <strong>{{ $pro->point }} coins</strong> to buy this {{ $pro->quantity }} <strong>{{ $pro->section->title }}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <label for="card-element">Enter ID Number</label>
                                                    <input type="text" name="game_id" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                <button type="submit" class="btn btn-primary">Confirm To Buy This</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--// modal --}}


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

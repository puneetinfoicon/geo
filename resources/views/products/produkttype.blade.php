@extends('layout.master')
@section('title', 'Add Page')
@section('content')

    <section>
        <div class="product-sec produkter-section produkt-type">
            <div class="container-fluid">
                <div class="product-heading">
                    <ul>
                        <li><a href="{{url('search-produkt')}}">Produkter</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ asset('assets/img/icon/Arrow-left.svg') }}"></a>
                        </li>
                        <li><a href="{{url('produktkategori',$area->id)}}">{{$area->name}}</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ asset('assets/img/icon/Arrow-left.svg') }}"></a>
                        </li>
                        <li>{{$category->name}}</li>
                    </ul>
                    <h1>{{$category->name}}</h1>
                    <p>{{$category->description}}</p>
                </div>

                <div class="row">
                    @if(!empty($products))
                        @foreach($products as $product)
                            <div class="col-md-2 mb-4">
                                <div class="product-box">
                                    <a href="{{route('produkt',[$area->id,$product->id, Str::slug($product->api_name)])}}">
                                        <div class="product-zoom">
										@if(isset($product ->imagess[0]))
                                            <img src="{{ asset('public/'.$product ->imagess[0]->url) }}"  title="{{$product ->imagess[0]->title_image}}" alt="{{$product ->imagess[0]->alt_image}}">
										@else
											 <img src="{{ asset('public/assets/img/no-product.png') }}">
										@endif
                                        </div>
                                    </a>
                                    <div class="pro-name-heading">
                                        <h4><a href="{{route('produkt',[$area->id,$product->id, Str::slug($product->api_name)])}}">{{$product->api_name}}</a></h4>
                                        <p><?= $product->short_text ?></p>
                                        <ul>
                                            <li><strong> @if($product->hide_amount !=1){{ isset($productApiPrices[$product->api_id]) ? str_replace(",",".",number_format($productApiPrices[$product->api_id]->basePrice)): "0"}} kr. ekskl. moms @else Ring for en pris @endif</strong></li>
                                            <li><span class="green"  style="background-color: <?= isset($productApiPrices[$product->api_id]) ? $productApiPrices[$product->api_id]->availability->color: "white"?>"></span> <?= isset($productApiPrices[$product->api_id]) ? $productApiPrices[$product->api_id]->availability->text: ""?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

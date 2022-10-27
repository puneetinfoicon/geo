@extends('layout.master')
@section('title', 'Add Page')
@section('content')

        <div class="product-category-section">
            <div class="container-fluid">
                <div class="category w-96p">
                    @if(!empty($categories))
                        @foreach($categories as $key=>$category)
                            <div class="cat-box cat-box-{{$key}}">
                                <a href="{{route('produkttype',[$category['id'],$areaId])}}">
                                    <div class="icon">
									@if(isset($category['image']))
                                        <img src="{{asset('public/'.$category['image'])}}" alt="">
									@else
										 <img src="{{ asset('public/assets/img/no-product.png') }}">
									@endif
                                    </div>
                                    <p><b>{{$category['name']}}</b></p>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="product-sec produkter-section">
            <div class="container-fluid">
                <div class="product-heading">
                    <ul>
                        <li><a href="{{url('search-produkt')}}">Produkter</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ asset('assets/img/icon/Arrow-left.svg') }}"></a>
                        </li>
                        <li>{{$area->name}}</li>
                    </ul>
                    <h1>{{$area->name}}</h1>
                    <p><?= $area->description;?></p>
                </div>
                <div class="row">
                    @if(!empty($products))
                        @foreach($products as $keys=>$product)
                            <?php $pid = $product['api_id']; ?>
                            <div class="col-md-2 col-sm-3 mb-4">
                                <div class="product-box">
                                    <a href="{{url('produkt',[$area->id,$product['id'], Str::slug($product->api_name)])}}">
                                        <div class="product-zoom">
										@if(isset($product ->imagess[0]))
                                            <img src="{{ asset('public/'.$product ->imagess[0]->url) }}" title="{{$product ->imagess[0]->title_image}}" alt="{{$product ->imagess[0]->alt_image}}">
										@else
											 <img src="{{ asset('public/assets/img/no-product.png') }}">
										@endif
                                        </div>
                                    </a>
                                    <div class="pro-name-heading">
                                        <h4><a href="{{url('produkt',[$area->id,$product->id, Str::slug($product->api_name)])}}">{{$product['api_name']}}</a></h4>
                                        <p><?= $product['short_text']?></p>
                                        <ul>
                                            <li><strong> @if($product['hide_amount'] !=1){{ isset($productApiPrices[$pid]) ? number_format($productApiPrices[$pid]->basePrice, 2, ',', '.') : "0"}} kr. ekskl. moms @else Ring for en pris @endif</strong></li>
                                            <li><span class="green" style="background-color: <?= isset($productApiPrices[$pid]) ? $productApiPrices[$pid]->availability->color: "white"?>"></span> <?= isset($productApiPrices[$pid]) ? $productApiPrices[$pid]->availability->text: ""?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="row text-cener">
                  <div class="col-md-12 text-center">
{{--                      {!! $products->render() !!}--}}
                  </div>
                </div>
            </div>
        </div>
    </section>

@endsection

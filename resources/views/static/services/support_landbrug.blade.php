@extends('layout.master')
@section('title', 'Add Page')
@section('content')

<section>
    <div class="product-sec produkter-section produkt-type gpsnet-se">
        <div class="container-fluid">
            <div class="product-heading">
                <ul>
                    <li><a href="javascript:void(0);">Service & support</a></li>
                    <li><a href="javascript:void(0);"><img src="{{ asset('assets/img/icon/Arrow-left.svg')}}"></a></li>
                    <li><a href="javascript:void(0);">Landbrug</a></li>
                    <li></li>
                </ul>


                <h3>Service & support - Landbrug</h3>
                <p class="gpsnet-text">{!! $content['description_1'] !!}</p>
                <br>
                <div class="row no-margin">
                    <div class="col-md-3">
                        <p>{!! $content['title_1'] !!}</p>
                        <p>{!! $content['title_2'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-0">
    <div class="full-width-banner white-bg">
        <img src="{{ asset('assets/img/mask-group-2.png')}}" alt="" class="img-fluid">

        <div class="blandt">
            <h3>{!! $content['search_text'] !!}</h3>

            <div class="blandt_input">
                <input type="text" name="search" id="search" class="blandt_input_search">
                <i class="fa fa-search"></i>
            </div>
        </div>
    </div>
</section>

<section class="mb-64 bg-main">
    <div class="instruction">
        <div class="container-fluid">
            <div class="instruction_other">
                <h3>{!! $content['title_3'] !!}</h3>

                <ul>
                    <li>
                        <a href="{{ url($content['link_1']) }}">{!! $content['link_text_1'] !!}<i class="fa fa-angle-right"></i></a>
                        <a href="{{ url($content['link_2']) }}">{!! $content['link_text_2'] !!}<i class="fa fa-angle-right"></i></a>
                    </li>
                    <li>
                        <a href="{{ url($content['link_3']) }}">{!! $content['link_text_3'] !!}<i class="fa fa-angle-right"></i></a>
                        <a href="{{ url($content['link_4']) }}">{!! $content['link_text_4'] !!}<i class="fa fa-angle-right"></i></a>
                    </li>
                    <li>
                        <a href="{{ url($content['link_5']) }}">{!! $content['link_text_5'] !!}<i class="fa fa-angle-right"></i></a>
                        <a href="{{ url($content['link_6']) }}">{!! $content['link_text_6'] !!}<i class="fa fa-angle-right"></i></a>
                    </li>
                    <li>
                        <a href="{{ url($content['link_7']) }}">{!! $content['link_text_7'] !!}<i class="fa fa-angle-right"></i></a>
                        <a href="{{ url($content['link_8']) }}">{!! $content['link_text_8'] !!}<i class="fa fa-angle-right"></i></a>
                    </li>
                    <li><a href="{{ url($content['link_9']) }}">{!! $content['link_text_9'] !!}<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="make-it-easy mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mediaBox mb-64">
                    <div class="mediaBox_left mr-64">
                        <img src="{{ asset($content['image_1'])}}" alt="" class="img-fluid">
                    </div>

                    <div class="mediaBox_body">
                        <h4>{!! $content['title_4'] !!}</h4>
                        <h3>{!! $content['title_5'] !!}</h3>
                        <p>{!! $content['title_5_description'] !!}</p>
                        <a href="{{ url($content['link_10']) }}" class="btn-custom">{!! $content['link_text_10'] !!}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mediaBox mb-64">
                    <div class="mediaBox_body mob-second">
                        <h4>{!! $content['title_6'] !!}</h4>
                        <h3>{!! $content['title_7'] !!}</h3>
                        <p>{!! $content['title_7_description'] !!}</p>
                        <a href="{{ url($content['link_11']) }}" class="btn-custom">{!! $content['link_text_11'] !!}</a>
                    </div>

                    <div class="mediaBox_left ml-64">
                        <img src="{{ asset($content['image_2'])}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="mediaBox mb-64">
                    <div class="mediaBox_left mr-64">
                        <img src="{{ asset($content['image_3'])}}" alt="" class="img-fluid">
                    </div>

                    <div class="mediaBox_body">
                        <h4>{!! $content['title_8'] !!}</h4>
                        <h3>{!! $content['title_9'] !!}</h3>
                        <p>{!! $content['title_9_description'] !!}</p>
                        <a href="{{ url($content['link_12']) }}" class="btn-custom">{!! $content['link_text_12'] !!}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mediaBox">
                    <div class="mediaBox_body mob-second">
                        <h4>{!! $content['title_10'] !!}</h4>
                        <h3>{!! $content['title_11'] !!}</h3>
                        <p>{!! $content['title_11_description'] !!}</p>
                        <a href="{{ url($content['link_13']) }}" class="btn-custom">{!! $content['link_text_13'] !!}</a>
                    </div>

                    <div class="mediaBox_left ml-64">
                        <img src="{{ asset($content['image_4'])}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="highest-accuracy mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_12'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_13'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_14'] !!}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
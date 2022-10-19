@extends('layout.master')
@section('title', 'Add Page')
@section('content')
<section>
    <div class="product-category-section">
        <div class="container-fluid">
            <div class="category  w-57p">

                <div class="cat-box">
                    <a href="{{ url($content['header_link_1']) }}">
                        <div class="icon">
                             <img src="{{ asset('assets/img/Nivelleringsinstrumenter.png ')}}" alt="" class="img-fluid">
                        </div>

                        <p><b>{!! $content['header_link_text_1'] !!}</b></p>
                    </a>
                </div>

                <div class="cat-box">
                    <a href="{{ url($content['header_link_2']) }}">
                        <div class="icon">
                            <img src="{{ asset('assets/img/traktor.png ')}}" alt="" class="img-fluid">
                        </div>
                        <p><b>{!! $content['header_link_text_2'] !!}</b></p>
                    </a>
                </div>

                <div class="cat-box">
                    <a href="{{ url($content['header_link_3']) }}">
                        <div class="icon">
                            <img src="{{ asset('assets/img/group-258.png ')}}" alt="" class="img-fluid">
                        </div>
                        <p><b>{!! $content['header_link_text_3'] !!}</b></p>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


<section>
    <div class="product-sec produkter-section produkt-type gpsnet-se">
        <div class="container-fluid">
            <div class="product-heading">
                <ul>
                    <li>Service & support</li>
                </ul>


                <h3>Service & support</h3>
                <p class="gpsnet-text">{!! $content['description'] !!}</p>
                <br>
                <div class="row no-margin">
                    <div class="col-md-3">
                        <p>{!! $content['title_1'] !!}</p>
                        <p>{!! $content['title_2'] !!}</p>
                    </div>
                    <div class="col-md-3">
                        <p>{!! $content['title_3'] !!}</p>
                        <p>{!! $content['title_4'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-64">
    <div class="full-width-banner white-bg">
        <img src="{{ asset('assets/img/mask-group-1.png ')}}" alt="" class="img-fluid">

        <div class="blandt">
            <h3>{!! $content['search_text'] !!}</h3>

            <div class="blandt_input">
                <input type="text" name="search" id="search" class="blandt_input_search">
                <i class="fa fa-search"></i>
            </div>
        </div>
    </div>
</section>

<section class="highest-accuracy mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_5'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_6'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_7'] !!}</h3>
                </div>
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
                        <h4>{!! $content['title_8'] !!}</h4>
                        <h3>{!! $content['title_9'] !!}</h3>
                        <p>{!! $content['title_9_description'] !!}</p>
                        <a href="{{ url($content['link_1']) }}" class="btn-custom">{!! $content['link_text_1'] !!}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mediaBox mb-64">
                    <div class="mediaBox_body mob-second">
                        <h4>{!! $content['title_10'] !!}</h4>
                        <h3>{!! $content['title_11'] !!}</h3>
                        <p>{!! $content['title_11_description'] !!}</p>
                        <a href="{{ url($content['link_2']) }}" class="btn-custom">{!! $content['link_text_2'] !!}</a>
                    </div>

                    <div class="mediaBox_left ml-64">
                        <img src="{{ asset($content['image_2'])}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mediaBox">
                    <div class="mediaBox_left mr-64">
                        <img src="{{ asset($content['image_3'])}}" alt="" class="img-fluid">
                    </div>

                    <div class="mediaBox_body">
                        <h4>{!! $content['title_12'] !!}</h4>
                        <h3>{!! $content['title_13'] !!}</h3>
                        <p>{!! $content['title_13_description'] !!}</p>
                        <a href="{!! $content['link_3'] !!}" class="btn-custom">{!! $content['link_text_3'] !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
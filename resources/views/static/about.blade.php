@extends('layout.master')
@section('title', 'Add Page')
@section('content')

<section>
        <div class="product-sec produkter-section produkt-type gpsnet-se">
            <div class="container-fluid">
                <div class="product-heading">
                    <ul>
                        <li>Om os</li>
                    </ul>


                    <h3>Om os</h3>
                    <p class="gpsnet-text">{!! $content['description_1'] !!}</p> <br>

                    <p class="gpsnet-text">{!! $content['description_2'] !!}</p>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-64">
        <div class="full-width-banner">
            <img src="{{ asset($content['image_1']) }}" alt="" class="img-fluid">
        </div>
    </section>

    <section class="highest-accuracy mb-64">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="highest-accuracy-text">
                        <h3>{!! $content['title_1'] !!}</h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="highest-accuracy-text">
                        <h3>{!! $content['title_2'] !!}</h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="highest-accuracy-text">
                        <h3>{!! $content['title_3'] !!}</h3>
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
                            <img src="{{ asset($content['image_2']) }}" alt="" class="img-fluid">
                        </div>

                        <div class="mediaBox_body">
                            <h4>{!! $content['title_4'] !!}</h4>
                            <h3>{!! $content['title_5'] !!}</h3>
                            <p>{!! $content['title_5_description'] !!}</p>
                            <a href="{{ url($content['link_1']) }}" class="btn-custom">{!! $content['link_text_1'] !!}</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mediaBox mb-64">
                        <div class="mediaBox_body mob-second">
                            <h4>{!! $content['title_6'] !!}</h4>
                            <h3>{!! $content['title_7'] !!}</h3>
                            <p>{!! $content['title_7_description'] !!}</p>
                            <a href="{{ url($content['link_2']) }}" class="btn-custom">{!! $content['link_text_2'] !!}</a>
                        </div>

                        <div class="mediaBox_left ml-64">
                            <img src="{{ asset($content['image_3']) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mediaBox">
                        <div class="mediaBox_left mr-64">
                            <img src="{{ asset($content['image_4']) }}" alt="" class="img-fluid">
                        </div>

                        <div class="mediaBox_body">
                            <h4>{!! $content['title_8'] !!}</h4>
                            <h3>{!! $content['title_9'] !!}</h3>
                            <p>{!! $content['title_9_description'] !!}</p>
                            <a href="{{ url($content['link_3']) }}" class="btn-custom">{!! $content['link_text_3'] !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    

    @endsection
@extends('layout.master')
@section('title', 'Add Page')
@section('content')

<section>
    <div class="product-sec produkter-section produkt-type gpsnet-se">
        <div class="container-fluid">
            <div class="product-heading">
                <ul>
                    <li>Kontakt</li>
                </ul>


                <h3>Kontakt os</h3>
                <p class="gpsnet-text">{!! $content['description_1'] !!}</p>
                <br>

                <div class="row no-margin">
                    <div class="col-md-3">
                        <p>{!! $content['title_1'] !!}</p>
                        <p>{!! $content['title_2'] !!}</p>
                    </div>
                    <div class="col-md-3">
                        <p>{!! $content['title_3'] !!}</p>
                        <p><strong><i class="fa fa-map-marker"></i> {!! $content['title_4'] !!}</strong></p>
                    </div>
                </div>

                <div class="line-50 mb-24 mt-24"></div>

                <div class="row no-margin">
                    <div class="col-md-3">
                        <p>{!! $content['title_5'] !!}</p>
                        <p>{!! $content['title_6'] !!}</p>
                    </div>
                    <div class="col-md-3">
                        <p>{!! $content['title_7'] !!}</p>
                        <p>{!! $content['title_8'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-64">
    <div class="full-width-map">
        <div id="map" class="map">
            <img src="assets/img/map.png" alt="map" class="img-fluid">

            <div class="map-location mp1">
                <a href="javascript:;">
                    <p>Landbrugskonsulent Nordjylland</p>

                    <div class="onclick-show">
                        <ul>
                            <li>Navn navnesen</li>
                            <li>Bynavn</li>
                            <li>+45 123 5678</li>
                            <li>abc@geoteam.dk</li>
                        </ul>
                    </div>
                    <span class="show_ul"></span>
                </a>
            </div>

            <div class="map-location mp2">
                <a href="javascript:;">
                    <p>Landmålingskonsulent Vest</p>

                    <div class="onclick-show">
                        <ul>
                            <li>Navn navnesen</li>
                            <li>Bynavn</li>
                            <li>+45 123 5678</li>
                            <li>abc@geoteam.dk</li>
                        </ul>
                    </div>
                    <span class="show_ul"></span>
                </a>
            </div>

            <div class="map-location mp3">
                <a href="javascript:;">
                    <p>Hovedkontor & værksted</p>

                    <div class="onclick-show">
                        <ul>
                            <li>Navn navnesen</li>
                            <li>Bynavn</li>
                            <li>+45 123 5678</li>
                            <li>abc@geoteam.dk</li>
                        </ul>
                    </div>
                    <span class="show_ul"></span>
                </a>
            </div>

            <div class="map-location mp4">
                <a href="javascript:;">
                    <p>Landbrugskonsulent Sønderjylland</p>

                    <div class="onclick-show">
                        <ul>
                            <li>Navn navnesen</li>
                            <li>Bynavn</li>
                            <li>+45 123 5678</li>
                            <li>abc@geoteam.dk</li>
                        </ul>
                    </div>
                    <span class="show_ul"></span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="highest-accuracy mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_9'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_10'] !!}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="highest-accuracy-text">
                    <h3>{!! $content['title_11'] !!}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="medarbejdere mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="product-add pt-0 pb-0">
                    <h3>{!! $content['title_12'] !!}</h3>
                </div>
            </div>
            @if(sizeof($teams)> 0)
                @foreach ($teams as $key => $team)
                    <div class="col-sm-4 col-md-3 col-lg-2 col-medarbejdere">
                        <div class="medarbejdere_box">
                            <div class="medarbejdere_box_img">
                                <a href="javascript:;">
                                    @if($team->image != null)
                                    <img src="{{ asset($team->image) }}" alt="" class="img-fluid">
                                    @else
                                        <img src="{{ asset('media/default.jpg') }}" alt="" class="img-fluid">
                                    @endif
                                </a>
                            </div>

                            <div class="medarbejdere_box_content">
                                <h3><a href="javascript:;"><?= utf8_encode($team->name) ?></a></h3>
                                <ul>
                                    <li>{{$team->designation}}</li>
                                    <a href="tel:<?= utf8_encode($team->contact) ?>"> <li><?= utf8_encode($team->contact) ?></li></a>
                                    <a href="mailto:<?= utf8_encode($team->email) ?>"> <li><?= utf8_encode($team->email); ?></li></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection

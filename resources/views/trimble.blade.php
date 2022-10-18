@extends('layout.master')
@section('title', 'Add Page')
@section('content')
    @php
        $service_context = getRootParent();
        getParent($service_context);
        $contexts =getParent($service_context);
    @endphp

    <!-- search-page-section start-->
    <section class="search-section">
        <div class="product-sec produkter-section">
            <div class="container-fluid">
                <div class="product-heading">
                    <ul>
                        <li><a href="javascript:void(0);">Service & Support</a></li>
                        <li><a href="javascript:void(0);"><img src="assets/img/icon/Arrow-left.svg"></a></li>
                        <li><a href="javascript:void(0);">Landmåling</a></li>
                        <li><a href="javascript:void(0);"><img src="assets/img/icon/Arrow-left.svg"></a></li>
                        <li>Trimble Access</li>
                    </ul>

                    <h3>Vejledninger - Trimble Access</h3>
                </div>

                <div class="filter">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="filter_lists">
                                <h3>Filter</h3>
                                <div class="description-section">
                                    @if(sizeof($contexts)>0)
                                        @foreach($contexts as $superParent)
                                            @if(sizeof(myParent($superParent->id))>0)
                                                <div class="accordion-bral">
                                                    <input class="ac-input" id="ac-{{$superParent->id}}" name="accordion-1" type="checkbox">
                                                    <label class="ac-label toggle-btn" for="ac-{{$superParent->id}}">
                                                        <span class="arrow"></span>{{$superParent->name}}</label>

                                                    @if(sizeof(myParent($superParent->id))>0)
                                                        @foreach(myParent($superParent->id) as $p2)
                                                            @if(sizeof(myParent($p2->id))>0)
                                                                <div class="article ac-content  second_accordion">
                                                                    <div class="accordion-bral">
                                                                        <input class="ac-input" id="ac-4" name="accordion-1" type="checkbox">
                                                                        <label class="ac-label toggle-btn" for="ac-4">
                                                                            <span class="arrow"></span>{{$p2->name}}
                                                                        </label>
                                                                        <div class="article ac-content">
                                                                            <div class="content-aa">
                                                                                <ul>
                                                                                    @if(sizeof(myParent($p2->id))>0)
                                                                                        @foreach(myParent($p2->id) as $p3)
                                                                                            <li><a href="#">{{$p3->name}}</a></li>
                                                                                        @endforeach
                                                                                    @endif

                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="article ac-content">
                                                                    <div class="content-aa">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="#">{{$p2->name}}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif


                                                </div>

                                            @else
                                                <div class="links">
                                                    <a href="#">{{$superParent->name}}</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-9">
                            <div class="vejledninger">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="title">
                                            <h3>Trimble Access Intro</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="vejledninger_content">
                                            <p>Trimble Access ser - i de seneste versioner (Access 2018 - 2019 - 2020) -
                                                noget anderledes ud i forhold til tidligere.</p>
                                            <p>Der kom således mange ændringer da Access gik fra Windows Mobile
                                                styresystem
                                                til alm PC Windows styresystem.</p>
                                            <p>Den indeholder alle tidligere funktioner; men de er lidt anderledes
                                                organiseret.</p>
                                            <p>I mange tilfælde ligger funktionerne på én side i stedet for flere sider,
                                                og
                                                der er kommet en scroll-bar i højre side af skærmen.</p>
                                            <p>På <strong>Trimble's egen hjælpe-portal</strong> findes både videoer og
                                                PDF guides.</p>
                                            <p>Nærværende vejledning på dansk er et udpluk af de vigtigste funktioner i
                                                Access.
                                                Hvis man har behov for flere detaljer findes de på Trimble's hjemmeside.
                                            </p>
                                            <p>Står du i marken kan du også sagtens finde hjælp til de enkelte
                                                funktioner
                                                inde i Access</p>

                                            <div class="line"></div>

                                            <ul>
                                                <li><a href="#"><img src="assets/img/icon-play.png" alt=""
                                                                     class="img-fluid"> Se Trimble's grundige video om
                                                        Trimble
                                                        Access</a></li>
                                                <li><a href="#"><img src="assets/img/download1.png" alt=""
                                                                     class="img-fluid"> Gå til Trimble's
                                                        hjælpe-portal</a></li>
                                                <li><a href="#"><img src="assets/img/download.png" alt=""
                                                                     class="img-fluid"> Download PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="vejledninger_img">
                                            <img src="assets/img/gd1.png" alt="" class="img-fluid">
                                            <img src="assets/img/gd2.png" alt="" class="img-fluid">
                                        </div>
                                    </div>

                                    <!-- ================ -->
                                    <div class="col-md-12">
                                        <div class="title">
                                            <h3>Hvad er nyt?</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="vejledninger_content">
                                            <p>I de seneste versioner er brugeroplevelsen ændret væsentligt og minder
                                                mere om andre app's på smartphones og tablets</p>

                                            <p> Hele bruger grænse fladen er blevet opdateret, og nogle funktioner er
                                                blevet flyttet. <br>
                                                Softwaren gør også bedre brug, af de større skærme på f.eks en TSC7
                                                kontroller eller en T10 tablet</p>

                                            <p> Hovedmenuen er tilgængelig fra de fleste undermenuer. <br>
                                                Det er blevet muligt at konfigurere genveje og favoritter.</p>

                                            <p> Bemærk at favoritter har et nummer. Det korresponderer direkte til en
                                                numeriske tast på TSC7. TSC7 er også udstyret med 6 F taster, der
                                                konfigureres på samme måde som favoritter(billede til højre).</p>

                                            <p> Filstrukturen er ændret. I stedet for en bruger-mappe, skal man nu lave
                                                et projekt.</p>

                                            <p> De enkelte job oprettes herunder.</p>

                                            <p> De 6 ikoner, som udgjorde generel opmåling, er nu fordelt i
                                                hoved-menuen.</p>

                                            <p> De menuer, der tidligere lå under Job ikonet, er nu fordelt i mellem og
                                                med den tilføjelse, at stifinder er flyttet fra Access start-menu
                                                hertil. </p>

                                            <p> De 5 andre knapper: Indtast, Coco, Opmåling, Afsætning og Instrument, er
                                                der ikke ændret på.</p>

                                            <p> Det er også inde i "job" at synkroniseringen med Trimble Connect styres.
                                                Ved tryk på ikonet åbnes login til Trimble ID (TID).</p>

                                            <p> Det er den såkaldte Trimble Sync Manager, der bruges til at udføre
                                                synkroniseringen med Trimble's sky.</p>

                                            <p> Nye projekter skal oprettes i dette program, hvis projektet skal
                                                synkroniseres. <br>
                                                Læs mere om Trimble Connect, og Trimble Sync Manager andet sted på
                                                siden.</p>

                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="vejledninger_img">
                                            <img src="assets/img/gd3.png" alt="" class="img-fluid">
                                            <img src="assets/img/gd4.png" alt="" class="img-fluid">
                                            <img src="assets/img/gd5.png" alt="" class="img-fluid">
                                            <img src="assets/img/gd6.png" alt="" class="img-fluid">
                                            <img src="assets/img/gd7.png" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- search-page-section end-->


    <!-- ================Product Section Code Start==================== -->
    <section>
        <div class="mail-section">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-6">
                        <div class="mail-text">
                            <p>Abonner på vores nyhedsbrev og modtag<br>
                                seneste nyt om udstyr, metoder og tendenser</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="mail-button text-right">
                            <input type="text" placeholder="Email">
                            <button type="button" class="mail-btn">Tilmeld</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

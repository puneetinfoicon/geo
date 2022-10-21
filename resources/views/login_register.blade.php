@extends('layout.master')
@section('title', 'Add Page')
@section('content')

    <section>
        <div class="product-add account">
            <div class="container-fluid">
                <div class="row">
                    @if(Session::has('message'))
                        <div id="myModal" class="modal fade" role="dialog" style="margin-top:5% ">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">

                                    <div class="modal-body text-center">
                                        <p class="mb-0">
                                            <strong>{{htmlspecialchars_decode(Session::get('message')) }}</strong></p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="col-lg-5">
                        <div class="left-section login-section">
                            <h3>Log ind</h3>
                            <p>{{$details[0]->data}}</p>
                            <div class="form-sec">
                                <form action="{{route('submit_login')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="email">E-mail</label>
                                            <div class="pos-rel">
                                                <input type="text" name="email" id="email" class="form-control"
                                                       placeholder="E-mail">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="password">Adgangskode</label>
                                            <div class="pos-rel">
                                                <input type="password" name="password" id="password"
                                                       class="form-control" placeholder="Adgangskode">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="forgot-password">
                                        <a href="{{ url(''). $forgot[1]->data}}">{{$forgot[0]->data}}</a>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-submit active-bg">Log ind</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="left-line"></div>
                    </div>
                    <div class="col-lg-5">


                        <form action="{{url('organization-register')}}" method="post" id="myform">
                            @csrf
                            <div class="left-section register-section">
                                <h3>Opret konto</h3>
                                <p>{{$details[1]->data}}</p>
                                <div class="form-sec">

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="crv">CVR-nummer</label>
                                            <div class="pos-rel">
                                                <input type="text" name="cvr" id="crv" class="form-control"
                                                       value="{{old('cvr')}}" placeholder="CVR-nummer" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="cname">Firmanavn</label>
                                            <div class="pos-rel">
                                                <input type="text" name="customerName" id="cname" class="form-control"
                                                       value="{{old('customerName')}}" placeholder="Firmanavn" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="cname">Navn og efternavn</label>
                                            <div class="pos-rel">
                                                <input type="text" name="fullName" id="fullName" class="form-control"
                                                       value="{{old('fullName')}}" placeholder="Navn og efternavn"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address">Faktureringsadresse</label>
                                            <div class="pos-rel">
                                                <input type="text" name="address1" id="address1"
                                                       value="{{old('address1')}}" class="form-control"
                                                       placeholder="Adresse" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-md-5 pr-1">
                                                    <label for="address">Postnummer</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="postalNo" id="postalNo"
                                                               value="{{old('postalNo')}}" class="form-control"
                                                               placeholder="Postnummer">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-7 pl-1">
                                                    <label for="by">By</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="postalCity" id="postalCity"
                                                               value="{{old('postalCity')}}" class="form-control"
                                                               placeholder="By">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="telno">Telefonnummer</label>
                                            <div class="pos-rel">
                                                <input type="text" name="phone" id="phone" value="{{old('phone')}}"
                                                       class="form-control" placeholder="Telefonnummer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address">E-mail</label>
                                            <div class="pos-rel">
                                                <input type="email" name="email" id="email" value="{{old('email')}}"
                                                       class="form-control" placeholder="E-mail">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address">Adgangskode</label>
                                            <div class="pos-rel">
                                                <input type="password" name="password" id="password1"
                                                       value="{{old('password')}}" class="form-control"
                                                       placeholder="Adgangskode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address">Bekræft adgangskode</label>
                                            <div class="pos-rel">
                                                <input type="password" name="confirm" id="confirm"
                                                       value="{{old('confirm')}}" class="form-control"
                                                       placeholder="Bekræft adgangskode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-checkbox">
                                        <div class="form-group">
                                            <input type="checkbox" id="check1">
                                            <label for="check1">Ja tak, jeg vil gerne modtage nyhedsbrev</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" name="check2" id="check2" required>
                                            <label for="check2">Jeg accepterer <a href="{{url('').$details[3]->data}}">Geoteams
                                                    forretningsbetingelser</a></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <p><a href="<?= url('').$details[4]->data?>">{{$details[2]->data}}</a></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-submit active-bg" type="submit">Opret konto</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

@endsection

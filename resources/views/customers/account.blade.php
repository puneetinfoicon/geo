@extends('layout.master')
@section('title', 'Add Page')
@section('content')
    <style>
        .gemSlet a {
            font-size: 16px;
            text-transform: uppercase;
            font-family: "Gotham Bold";
            text-align: center;
            padding: 13px 34px;
            line-height: 19px;
            border: 2px solid var(--main);
            border-radius: 0;
            min-width: 177px;
            transition: 0.5s;
        }

        /****** LOGIN MODAL ******/
        .loginmodal-container {
            padding: 30px;
            max-width: 350px;
            width: 100% !important;
            background-color: #F7F7F7;
            margin: 0 auto;
            border-radius: 2px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            font-family: roboto;
        }

        .loginmodal-container h2 {
            text-align: center;
            font-size: 1.8em;
            font-family: roboto;
        }

        .loginmodal-container a {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            position: relative;

        }

        .loginmodal-container input[type=text], input[type=password] {
            height: 44px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
            -webkit-appearance: none;
            background: #fff;
            border: 1px solid #d9d9d9;
            border-top: 1px solid #c0c0c0;
            /* border-radius: 2px; */
            padding: 0 8px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .loginmodal-container input[type=text]:hover, input[type=password]:hover {
            border: 1px solid #b9b9b9;
            border-top: 1px solid #a0a0a0;
            -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }

        .loginmodal-submit {
            /* border: 1px solid #3079ed; */
            border: 0px;
            color: #fff;
            text-shadow: 0 1px rgba(0,0,0,0.1);
            background-color: #4d90fe;
            padding: 17px 0px;
            font-family: roboto;
            font-size: 16px;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
        }

        .loginmodal-submit:hover {
            /* border: 1px solid #2f5bb7; */
            border: 0px;
            text-shadow: 0 1px rgba(0,0,0,0.3);
            background-color: #357ae8;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
        }

        .loginmodal-container a {
            text-decoration: none;
            color: #FFFFFF;
            font-weight: 400;
            text-align: center;
            display: inline-block;
            font-size: 16px;
        }
        .perror{
            background-color: red;
            padding: 4px;
            color: #FFFFFF;
            font-size: 17px;
            font-family: "Gotham Book";
            font-weight: initial;
        }
        .full-section .table-responsive table tr td.custom_width {
            max-width: 450px;
            white-space: normal;
        }
        .dataTables_length label{
            display: none !important;
        }
    </style>
    <!-- ================Product Section Code Start==================== -->
    @if(Session::has('message'))
        <div id="myModal" class="modal fade modal_center" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p class="mb-0"> <strong>{{htmlspecialchars_decode(Session::get('message')) }}</strong></p>
                    </div>
                </div>

            </div>
        </div>
    @endif
    <section>
        <div class="product-add account">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <?php
//                        echo "<pre>";
//                        print_r($profileDetails);
//                        echo "</pre>";

                        ?>
                        @if(is_object($profileDetails))
                        <h1>Velkommen til din side</h1>
                        <div class="left-section">
                            <h3>Kontooplysninger</h3>
                            <div class="form-sec">
                                <form action="{{route('userAcountUpdate')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="accountResponsible">Kontoansvarlig</label>
                                            <div class="pos-rel">
                                                <input type="text" name="accountResponsible" id="accountResponsible" class="form-control" value="{{$profileDetails->accountResponsible}}"
                                                       placeholder="Steen Hagelskjær" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="companyName">Firmanavn</label>
                                            <div class="pos-rel">
                                                <input type="text" name="companyName" id="companyName" class="form-control" value="{{$profileDetails->companyName}}"
                                                       placeholder="Geoteam A/S" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="cvr">CVR-nummer</label>
                                            <div class="pos-rel">
                                                <input type="text" name="cvr" id="cvr" class="form-control" value="{{$profileDetails->cvr}}"
                                                       placeholder="1234 5678" readonly>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="password">Adgangskode</label>
                                            <div class="pos-rel">
                                                <input type="password" name="password" id="password" class="form-control"
                                                       placeholder="******">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="accountResponsibleEmail">Kontoansvarlig e-mail</label>
                                            <div class="pos-rel">
                                                <input type="email" name="accountResponsibleEmail" id="accountResponsibleEmail" class="form-control" value="{{$profileDetails->accountResponsibleEmail}}"
                                                       placeholder="xxx@kunde.dk" readonly>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="address">Adresse</label>
                                            <div class="pos-rel">
                                                <input type="text" name="address" id="address" class="form-control" value="{{$profileDetails->address}}"
                                                       placeholder="Energivej 34" required>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="phoneNumber">Telefonnummer</label>
                                            <div class="pos-rel">
                                                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control numericOnly" value="{{$profileDetails->phoneNumber}}"
                                                                        placeholder="1234 5678" required>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="passwordConfirmed">Bekræft adgangskode</label>
                                            <div class="pos-rel"><input type="password" name="passwordConfirmed" id="passwordConfirmed"
                                                                        class="form-control" placeholder="******">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="accountResponsiblePhoneNumber">Kontoansvarlig telefonnummer</label>
                                            <div class="pos-rel">
                                                <input type="text" name="phoneNumber" id="accountResponsiblePhoneNumber" class="numericOnly form-control" value="{{$profileDetails->accountResponsiblePhoneNumber}}"
                                                                        placeholder="" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <label for="postalNo">Postnummer</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="postalNo" id="postalNo" class="form-control" value="{{$profileDetails->postalNo}}"
                                                               placeholder="2750" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 pl-1">
                                                    <label for="postalCity">By</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="postalCity" id="postalCity" class="form-control" value="{{$profileDetails->city}}"
                                                               placeholder="Ballerup" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="invoiceemail">Faktura e-mail</label>
                                            <div class="pos-rel">
                                                <input type="email" name="invoiceemail" id="invoiceemail" class="form-control" value="{{$profileDetails->invoiceEmail}}"
                                                       placeholder="info@geoteam.dk" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-25">
                                        <button class="btn btn-submit">Gem ændringer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="full-section">
                            <div class="titieWithsearch">
                                <h3>Ordreoversigt</h3>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable_example" class="table" width="100%"  data-ordering="true">
                                    <thead>
                                    <tr>
                                        <th>Ordrenummer <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                        <th>Dato <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                        <th>Produkt <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                        <th>Ordrebekræftelse/faktura <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                        <th>Beløb <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                    </tr>
                                    </thead>
                                </table>
                                <div class="export-excel orderExport">
                                    <a href="{{route('exportAllOrder')}}">Eksportér til excel</a>
                                </div>
                             </div>


                        </div>

 <!------- GPSNetSubscriptions  ----------------->
                        <div class="full-section">
                            <div class="titieWithsearch">
                                <h3>GPSnet.dk abonnementer</h3>
                            </div>


                            <div class="table-responsive">
                                <?php
                                $pDetails = getProductPrice();
                                //echo $pDetails[1]->Dealer;
                                // echo "<pre>"; print_r($pDetails[1]->Dealer); die;
                                ?>
                                <table class="table" id="example2">
                                    <thead>
                                    <tr>
                                        <th>GPSnet.dk login <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></th>
                                        <th>Organisation <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></th>
                                        <th>Servicekontrakt <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></th>
                                        <th>Tegningsdato <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></th>
                                        <th>SIM-kortnummer <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></td>
                                        @if($pDetails[1]->Dealer == true)
                                        <th>Forhandler reference <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></td>
                                        @endif
                                        <th>Reference <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></td>
                                        <th>Actions <a href="#"><img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                         class="img-sort"></a></td>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if(sizeof($GPSNetSubscriptions)>0)
                                        @foreach($GPSNetSubscriptions as $GPSNetSubscription)
                                    <tr id="trr{{$GPSNetSubscription->id}}">
                                        <td>#{{$GPSNetSubscription->login}}</td>
                                        <td>{{$GPSNetSubscription->organisation}}</td>
                                        <td>{{$GPSNetSubscription->serviceContractNo}}</td>
                                        <td>{{ date('Y-m-d h:i:s', strtotime($GPSNetSubscription->effectiveDate))}}</td>

                                        <td class="editable_td"> <span class="d-none">{{$GPSNetSubscription->simNo}}</span> <input type="text" value="{{$GPSNetSubscription->simNo}}" id="A{{$GPSNetSubscription->id}}" class="form-control" readonly></td>

                                        @if($pDetails[1]->Dealer == true)
                                        <td class="editable_td"> <span class="d-none">{{$GPSNetSubscription->dealersReference}}</span> <input type="text" value="{{$GPSNetSubscription->dealersReference}}" id="B{{$GPSNetSubscription->id}}" class="form-control" readonly></td>
                                        @endif
                                        <td class="editable_td"> <span class="d-none">{{$GPSNetSubscription->customersReference}}</span> <input type="text" value="{{$GPSNetSubscription->customersReference}}" id="C{{$GPSNetSubscription->id}}" class="form-control" readonly> <a data-id="{{$GPSNetSubscription->id}}" id="ZZ{{$GPSNetSubscription->customersReference}}" class="pencil"><img src="{{url('public/assets/img/edit-2.png')}}" alt="sim" class="img-edit"></a></td>
                                        <td>
                                            <ul class="handlinger">
                                                <li>
                                                    <a onclick="deleteGPSNetSubscriptions('{{$GPSNetSubscription->id}}')">
                                                        <img src="{{url('public/')}}/assets/img/delete.png" alt="del" class="img-del"
                                                             title="Anmod om opsigelse">
                                                        <div class="hover-title">Anmod om opsigelse</div>
                                                    </a>
                                                </li>
                                                <li><a class="passwordUpdate" data-toggle="modal" data-target="login{{$GPSNetSubscription->id}}" id="{{$GPSNetSubscription->id}}"><img src="{{url('public/')}}/assets/img/key.png" alt="key"
                                                                     class="img-key"></a></li>
                                                <li title="Save" class="d-none btn btn-primary saveSubscription" id="AZ{{$GPSNetSubscription->id}}" style="margin-left: 10px;"><i class="fa fa-save"></i></li>
                                                <li title="Cancel" class="d-none btn btn-danger cancelEdit" id="AZZ{{$GPSNetSubscription->id}}" style="margin-left: 10px;"> <i class="fa fa-times"></i> </li>
                                            </ul>
                                        </td>
                                    </tr>

                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

<!--------- NonGPSNetSubscriptions  --------------->
                        <div class="full-section">
                            <div class="titieWithsearch">
                                <h3>NonGPSNetSubscriptions</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="example1">
                                    <thead>
                                    <tr>
                                        <th>Service Contact Number <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                                        class="img-sort"></th>
                                        <th>Type <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                      class="img-sort"></th>
                                        <th>Startdato <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                           class="img-sort"></th>
                                        <th>Status <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></td>
                                        <th>Handlinger <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                            class="img-sort"> </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($NonGPSNetSubscriptions))
                                        @foreach($NonGPSNetSubscriptions as $NonGPSNetSubscription)
                                            @if($NonGPSNetSubscription->status ==1)
                                    <tr>
                                        <td>#{{$NonGPSNetSubscription->serviceContractNo}}</td>
                                        <td>{{$NonGPSNetSubscription->serviceContractAccGrCode}}</td>
                                        <td>{{ date('Y-m-d h:i:s', strtotime($NonGPSNetSubscription->startDate))}}</td>
                                        <td>{{$NonGPSNetSubscription->status}}</td>
                                        <td>
                                            <ul class="handlinger">
                                                <li>
                                                    <a href="javascript:;" class="delNonGPS" id="{{$NonGPSNetSubscription->serviceContractNo}}">
                                                        <img src="{{url('public/')}}/assets/img/delete.png" alt="del" class="img-del"
                                                             title="Anmod om opsigelse">
                                                        <div class="hover-title">Anmod om opsigelse</div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
 <!---------- Udstyr  -------------->
                        <div class="full-section">
                            <div class="titieWithsearch">
                                <h3>Udstyr</h3>
                            </div>
                            <div class="table-responsive">
                                <table  class="table" width="100%" id="example">
                                    <thead>
                                    <tr>
                                        <th>Nummer <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                        class="img-sort"></th>
                                        <th>Fakturadato <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                             class="img-sort"></th>
                                        <th>Beskrivelse <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                             class="img-sort"></th>
                                        <th>Serienummer <img src="{{url('public/')}}/assets/img/sort.png" alt="SORT"
                                                             class="img-sort"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(sizeof($ServiceItem)>0)
                                        @foreach($ServiceItem as $equipment)
                                    <tr>
                                        <td>#{{$equipment->itemNo}}</td>
                                        <td>{{ date('Y-m-d h:i:s', strtotime($equipment->salesDate))}}</td>
                                        <td>{{$equipment->description}}</td>
                                        <td>{{$equipment->serialNumber}}</td>
                                    </tr>
                                        @endforeach
                                   @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
<!------ Webshop-brugere  -------->
                        <div class="left-section">
                            <h3>Webshop-brugere</h3>
                            <div class="form-sec">
                                @if(sizeof($GPSNetUser)>0)
                                    @foreach($GPSNetUser as $GPSuser)
                                        @if($GPSuser->deleted == false)
                                    <div class="row align-items-end">
                                        <div class="form-group col-md-3">
                                            <label for="name">Fuldt navn</label>
                                            <div class="pos-rel">
                                                <input type="text" name="name" id="name{{$GPSuser->userId}}" class="form-control"
                                                       value="{{$GPSuser->fullname}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="email">E-mail</label>
                                            <div class="pos-rel">
                                                <input type="email" name="email" id="email{{$GPSuser->userId}}" class="form-control"
                                                       value="{{$GPSuser->email}}" required>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="tel">Telefonummer</label>
                                            <div class="pos-rel">
                                                <input type="tel" name="phoneNumber" id="phone{{$GPSuser->userId}}" class="form-control"
                                                       value="{{$GPSuser->phoneNumber}}"  required>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="gemSlet">
                                                <a class="btn btn-gem GPSNetUser_Update" id="{{$GPSuser->userId}}">Gem</a>
                                                <a class="btn btn-slet GPSNetUser_Delete" id="{{$GPSuser->userId}}">Slet</a>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach
                                @endif
                                <form action="{{route('createGPSNetUser')}}" autocomplete="off" method="post">
                                    @csrf
                                    <div class="row align-items-end">
                                        <div class="form-group col-md-3">
                                            <label for="name">Fuldt navn</label>
                                            <div class="pos-rel">
                                                <input type="text" name="name" id="name" class="form-control"
                                                       placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="email">E-mail</label>
                                            <div class="pos-rel">
                                                <input type="email" name="email" id="email" class="form-control"
                                                       placeholder="" required>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="tel">Telefonummer</label>
                                            <div class="pos-rel">
                                                <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control"
                                                       placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="gemSlet">
                                                <button class="btn btn-gem gem_new">Gem</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="full-section d-none">
                            <h3>Aftaler</h3>
                            <div class="box-agrement"></div>
                            <div class="box-agrement"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================Product Section Code End==================== -->
<div id="myModelData"></div>
@endsection

@section('js')
    <link href="{{url('public/assets/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"/>
    <link href="{{url('public/assets/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>

    <script src="{{url('public/assets/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('public/assets/datatable/js/jszip.min.js')}}"></script>
    <script src="{{url('public/assets/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{url('public/assets/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{url('public/assets/datatable/js/buttons.html5.min.js')}}"></script>

    <script>
        $(document).ready(function (){
            $('.GPSNetUser_Delete').click(function (){
              var userId =   $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "<?= route('GPSNetUser_Delete')?>",
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>',
                    success: function (data) {
                        // alert("success");
                        location.reload();
                    }
                });
            })
            $('.delNonGPS').click(function (){
              var userId =   $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "<?= route('terminateSubscription')?>",
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>',
                    success: function (data) {
                         alert(data);
                        //location.reload();
                    }
                });
            })

            $('.passwordUpdate').click(function (){
                var userId = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "<?= route('passwordUpdate')?>",
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>',
                    success: function (data) {
                       $('#myModelData').html(data);
                        $('#login'+userId).modal('show');
                    }
                });
            });
            $(".numericOnly").keypress(function (e) {
                if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5'
                ],
                order: [[1, 'desc']],
                language: {
                    search: "Søg:",
                    'paginate': {
                        'previous': '<',
                        'next': '>'
                    }
                },
                "oLanguage": {
                     "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoFiltered": "",
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoEmpty":     "Viser 0 af 0",
                }
            } );
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ],
                order: [[1, 'desc']],
                language: {
                    search: "Søg:",
                    'paginate': {
                        'previous': '<',
                        'next': '>'
                    }
                },
                "oLanguage": {
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoFiltered": "",
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoEmpty":     "Viser 0 af 0",
                }
            } );
            $('#example2').DataTable( {
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5'
                ],
                order: [[1, 'desc']],
                language: {
                    search: "Søg:",
                    'paginate': {
                        'previous': '<',
                        'next': '>'
                    }
                },
                "oLanguage": {
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoFiltered": "",
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoEmpty":     "Viser 0 af 0",
                }
            } );
        } );
    </script>
    <script>
        $(document).ready(function (){
            $('.pencil').click(function (){
               var userId = $(this).attr('data-id');

               $(this).prev('input').focus();
                $('#A'+userId).removeAttr('readonly');
                @if($pDetails[1]->Dealer == true)
                $('#B'+userId).removeAttr('readonly');
                @endif
                $('#C'+userId).removeAttr('readonly');
                $('#AZ'+userId).removeClass('d-none');
                $('#AZZ'+userId).removeClass('d-none');
                $('#trr'+userId).css('background-color','#aacde1');
            });
            $('.cancelEdit').click(function (){
                var tempId = $(this).attr('id');
                var arrId = tempId.split('AZZ');

                $('#A'+arrId[1]).attr('readonly','readonly').val('');
                @if($pDetails[1]->Dealer == true)
                $('#B'+arrId[1]).attr('readonly','readonly').val('');
                @endif
                $('#C'+arrId[1]).attr('readonly','readonly').val('');
                $('#AZ'+arrId[1]).addClass('d-none');
                $('#AZZ'+arrId[1]).addClass('d-none');
                $('#trr'+arrId[1]).css('background-color','#FFF');
            })


            $('.saveSubscription').click(function (){
                    var tp =$(this).attr('id');
                    var tempId = tp.split('AZ');

                var userId = tempId[1];
                var simNo =  $('#A'+userId).val();
                var dealersReference =  $('#B'+userId).val();
                var customersReference =  $('#C'+userId).val();
                $.ajax({
                    type: "POST",
                    url: "<?= route('GPSNetSubscriptions_update')?>",
                    @if($pDetails[1]->Dealer == true)
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>&simNo='+simNo+'&dealersReference='+dealersReference+'&customersReference='+customersReference,
                    @else
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>&simNo='+simNo+'&customersReference='+customersReference,
                    @endif
                    success: function (data) {
                        // alert("success");
                        location.reload();
                    }
                })
            });

            $('.GPSNetUser_Update').click(function (){
                var userId = $(this).attr('id');
                var name = $('#name'+userId).val();
                var email = $('#email'+userId).val();
                var phone = $('#phone'+userId).val();

                $.ajax({
                    type: "POST",
                    url: "<?= route('GPSNetUser_update')?>",
                    data: "userId=" + userId + '&_token=<?= csrf_token()?>&email='+email+'&fullname='+name+'&phoneNumber='+phone,
                    success: function (data) {
                        // alert("success");
                        location.reload();
                    }
                })
            })
        })

        function deleteGPSNetSubscriptions(subscriptionId)
        {
            $.ajax({
                type: "POST",
                url: "<?= route('deleteGPSNetSubscriptions')?>",
                data: "subscriptionId=" + subscriptionId + '&_token=<?= csrf_token()?>',
                success: function (data) {
                    alert(data);
                  // location.reload();
                }
            })
        }

        function updatePass(id)
        {
           var password = $('.password'+id).val();
           var confirm = $('.cpassword'+id).val();
           if (password != confirm){
               $('.perror').removeClass('d-none');
            $('.perror').html('Password and confirm password should be equal');
           }else{
               $.ajax({
                   type: "POST",
                   url: "<?= route('updatePass')?>",
                   data: "userId=" + id + '&_token=<?= csrf_token()?>&password='+password,
                   success: function (data) {
                       alert(data);
                       // location.reload();
                   }
               })
           }
        }
    </script>

    <!-- Datatable JS -->

    <script>
        $(document).ready(function(){
            fill_datatable();
        });
        function fill_datatable()
        {
            $('#datatable_example').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'GET',
                'bFilter':true,
                'order': [[1, 'desc']],
                "aoColumnDefs": [{
                    'bSortable': true,
                     'aTargets': [ 2 ]
                    }
                ],
                // dom: 'lBfrtip',
                // buttons: [
                //     'excel'
                // ],
                'searching':true,
                'info':true,
                'ajax': {
                    'url':"{{route('getUserData')}}"
                },
                'columns': [
                    { data: 'Ordrenummer' },
                    { data: 'Dato' },
                    { data: 'Produkt', className: "custom_width" },
                    { data: 'Ordrebekræftelse' },
                    { data: 'Beløb' },
                ],
                language: {
                    search: "Søg:",
                    "infoFiltered": "",
                    'paginate': {
                        'previous': '<',
                        'next': '>'
                    }
                },
                "oLanguage": {
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoFiltered": "",
                    "sInfo": "Viser _START_ - _END_ af  _TOTAL_",
                    "sInfoEmpty":     "Viser 0 af 0",
                },
            });
        }

    </script>
@endsection



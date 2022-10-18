@extends('layout.master')
@section('title', 'Add Page')
@section('content')


<div class="product-add account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

            <div class="full-section">
                            <div class="titieWithsearch">
                                <h3>GPSnet.dk abonnementer</h3>

                                <div class="titieWithsearch_search">
                                    <input type="text" class="text" placeholder="Trimble R12">
                                    <img src="assets/img/search.png" alt="" class="img-fluid">
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>GPSnet.dk login <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a></th>
                                            <th>Abonnement <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a></th>
                                            <th>SIM-kortnummer <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a></th>
                                            <th>Tegningsdato <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a>
                                            </th><th>Reference <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a>
                                            </th><th>Forhandler reference <a href="#"><img src="assets/img/sort.png" alt="SORT" class="img-sort"></a>
                                            </th><th>Handlinger
                                        </th></tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>#12345678</td>
                                            <td>VRS-RTK - 3 år</td>
                                            <td>12355544885568824854 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>01/01-2020</td>
                                            <td>GPS-42 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>Erstatter GPS-41 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>
                                                <ul class="handlinger">
                                                    <li>
                                                        <a href="#">
                                                            <img src="assets/img/delete.png" alt="del" class="img-del" title="Anmod om opsigelse">
                                                            <div class="hover-title">Anmod om opsigelse</div>
                                                        </a>
                                                    </li>
                                                    <li><a href="#"><img src="assets/img/key.png" alt="key" class="img-key"></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#12345678</td>
                                            <td>VRS-RTK - 1 år</td>
                                            <td>12355544885568824854 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>01/01-2020</td>
                                            <td>Stor traktor 1 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>Erstatter traktor 1 <a href="#"><img src="assets/img/edit-2.png" alt="sim" class="img-edit"></a></td>
                                            <td>
                                                <ul class="handlinger">
                                                    <li>
                                                        <a href="#">
                                                            <img src="assets/img/delete.png" alt="del" class="img-del" title="Anmod om opsigelse">
                                                            <div class="hover-title">Anmod om opsigelse</div>
                                                        </a>
                                                    </li>
                                                    <li><a href="#"><img src="assets/img/key.png" alt="key" class="img-key"></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tfoot">
                                <div class="export-excel">
                                    <a href="#">Eksportér til excel</a>
                                </div>

                                <ul class="pagination">
                                    <li class="pre"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">9</a></li>
                                    <li><a href="#">10</a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>

                                <div class="viser">
                                    <h2>Viser <span class="viser-page">1-10</span> af <span class="viser-total">61</span></h2>
                                </div>
                            </div>
                        </div>


            </div>
        </div>
    </div>
</div>


@endsection
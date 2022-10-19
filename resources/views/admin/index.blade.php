@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')





 <!--start content-->
 <main class="page-content">














              @if(Session::has('message'))
                  <div >
                      <strong>{{htmlspecialchars_decode(Session::get('message')); }}</strong>
                  </div>
              @endif


              <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="breadcrumb-title pe-3">eCommerce</div>
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Products List</li>
                  </ol>
                </nav>
              </div>
            </div>



              <div class="card radius-10">
                <div class="card-header bg-transparent">
                  <div class="row g-3 align-items-center">
                    <div class="col">
                      <h5 class="mb-0">Recent Orders</h5>
                    </div>
                    <div class="col">
                      <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                        <div class="dropdown">
                          <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table align-middle mb-0">
                      <thead class="table-light">
                        <tr>
                          <th>#ID</th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#89742</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/11.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Smart Mobile Phone</h6>
                              </div>
                            </div>
                          </td>
                          <td>2</td>
                          <td>$214</td>
                          <td>Apr 8, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>#68570</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/07.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Sports Time Watch</h6>
                              </div>
                            </div>
                          </td>
                          <td>1</td>
                          <td>$185</td>
                          <td>Apr 9, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>#38567</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/17.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Women Red Heals</h6>
                              </div>
                            </div>
                          </td>
                          <td>3</td>
                          <td>$356</td>
                          <td>Apr 10, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>#48572</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/04.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Yellow Winter Jacket</h6>
                              </div>
                            </div>
                          </td>
                          <td>1</td>
                          <td>$149</td>
                          <td>Apr 11, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>#96857</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/10.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Orange Micro Headphone</h6>
                              </div>
                            </div>
                          </td>
                          <td>2</td>
                          <td>$199</td>
                          <td>Apr 15, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>#68527</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <div class="product-box border">
                                 <img src="assets/images/products/05.png" alt="">
                              </div>
                              <div class="product-info">
                                <h6 class="product-name mb-1">Men Sports Shoes Nike</h6>
                              </div>
                            </div>
                          </td>
                          <td>1</td>
                          <td>$124</td>
                          <td>Apr 22, 2021</td>
                          <td>
                            <div class="d-flex align-items-center edit-view-delete-img gap-3 fs-6">
                              <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views">
                              <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                            </a>
                              <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit">
                              <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                              </a>
                              <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                              <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


            </main>
         <!--end page main-->


          <div class="overlay nav-toggle-icon"></div>



         <!--Start Back To Top Button-->
               <a href="javaScript:;" class="back-to-top">
            <i class='bx bxs-up-arrow-alt'></i>
          </a>
         <!--End Back To Top Button-->



@endsection

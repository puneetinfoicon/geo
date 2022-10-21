@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

<!--start content-->
<main class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">Content</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Dynamic Page List</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->

  <div class="card">

    <div class="card-body">

      <div class="table-responsive">
        <table class="table align-middle table-striped ecommerce-products-list">
          <thead class="table-light">
            <tr>
              <th>Sno</th>
              <th>Page</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">1</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Home</h6>
                        </div>
                    </a>
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('editHome', 'home_page')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit home" aria-label="Views">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>

            <tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">2</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Footer</h6>
                        </div>
                    </a>
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('edit.footer')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit footer" aria-label="Views">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">3</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Social Media Links</h6>
                        </div>
                    </a>
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('social-media')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Add Social Media Links" aria-label="Add Social Media Links">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">4</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Login & Register</h6>
                        </div>
                    </a>
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('login_reg')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Login & Register" aria-label="Login & Register">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">5</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Manage SEO</h6>
                        </div>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('manage_seo')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Manage SEO Page" aria-label="Manage SEO Page">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">6</h6>
                        </div>
                    </a>
                </td>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">News letters</h6>
                        </div>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('newsletters')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="News letters" aria-label="News letters">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">7</h6>
                        </div>
                    </a>
                </td>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title"> Kontakt os</h6>
                        </div>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('kontakat_os_modal')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title=" Kontakt os" aria-label=" Kontakt os">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">8</h6>
                        </div>
                    </a>
                </td>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title"> Bliv ringet op </h6>
                        </div>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('bliv_ringet_modal')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Bliv ringet op" aria-label="Bliv ringet op">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">9</h6>
                        </div>
                    </a>
                </td>
                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title"> Checkout Page (Terms & Conditions) </h6>
                        </div>
                    </a>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('checkout_terms')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Checkout Page (Terms & Conditions)" aria-label="Checkout Page (Terms & Conditions)">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>

            <!--tr>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">3</h6>
                        </div>
                    </a>
                </td>

                <td class="productlist">
                    <a class="d-flex align-items-center gap-2" href="#">
                        <div>
                        <h6 class="mb-0 product-title">Service/Support</h6>
                        </div>
                    </a>
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="{{route('editSupport')}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit support" aria-label="Views">
                            <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                        </a>
                    </div>
                </td>
            </tr-->

          </tbody>
        </table>
      </div>

    </div>
  </div>

</main>
<!--end page main-->

@endsection

@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

<!--start content-->
<main class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->

  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="card">
        <div class="card-header py-3 bg-transparent">
          <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
          <div class="border p-3 rounded">
            <form class="row g-3" action="{{route('submitProducts')}}" method="post" enctype="multipart/form-data">

              @csrf

              <div class="col-12 mb-3">
                <label class="form-label">Areas</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="" selected>AG</option>
                  <option value="" selected>Survey</option>
                  <option value="">GPS</option>
                  <option value="">Antenna</option>
                  <option value="">7" monitor</option>
                  <option value="">TILT</option>
                  <option value="">R12i-PSU</option>
                  <option value="">R12i-CT</option>
                  <option value="">R12i-CTR</option>
                  <option value="">Firmware Link</option>
                  <option value="">Peoduct Manual</option>
                  <option value="">Video Guide</option>
                </select>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">Product Categories</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="">AG</option>
                  <option value="">Survey</option>
                  <option value="" selected>GPS</option>
                  <option value="" selected>Antenna</option>
                  <option value="">7" monitor</option>
                  <option value="">TILT</option>
                  <option value="">R12i-PSU</option>
                  <option value="">R12i-CT</option>
                  <option value="">R12i-CTR</option>
                  <option value="">Firmware Link</option>
                  <option value="">Peoduct Manual</option>
                  <option value="">Video Guide</option>
                </select>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">Search Categories</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="">AG</option>
                  <option value="">Survey</option>
                  <option value="">GPS</option>
                  <option value="">Antenna</option>
                  <option value="" selected>7" monitor</option>
                  <option value="" selected>TILT</option>
                  <option value="">R12i-PSU</option>
                  <option value="">R12i-CT</option>
                  <option value="">R12i-CTR</option>
                  <option value="">Firmware Link</option>
                  <option value="">Peoduct Manual</option>
                  <option value="">Video Guide</option>
                </select>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">Tilbehør</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="">AG</option>
                  <option value="">Survey</option>
                  <option value="">GPS</option>
                  <option value="">Antenna</option>
                  <option value="">7" monitor</option>
                  <option value="">TILT</option>
                  <option value="" selected>R12i-PSU</option>
                  <option value="" selected>R12i-CT</option>
                  <option value="">R12i-CTR</option>
                  <option value="">Firmware Link</option>
                  <option value="">Peoduct Manual</option>
                  <option value="">Video Guide</option>
                </select>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">Passer til</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="">AG</option>
                  <option value="">Survey</option>
                  <option value="">GPS</option>
                  <option value="">Antenna</option>
                  <option value="">7" monitor</option>
                  <option value="">TILT</option>
                  <option value="">R12i-PSU</option>
                  <option value="">R12i-CT</option>
                  <option value="" selected>R12i-CTR</option>
                  <option value="">Firmware Link</option>
                  <option value="">Peoduct Manual</option>
                  <option value="">Video Guide</option>
                </select>
              </div>

              <div class="col-12 mb-3">
                <label class="form-label">Contents</label>
                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                  <option value="">AG</option>
                  <option value="">Survey</option>
                  <option value="">GPS</option>
                  <option value="">Antenna</option>
                  <option value="">7" monitor</option>
                  <option value="">TILT</option>
                  <option value="">R12i-PSU</option>
                  <option value="">R12i-CT</option>
                  <option value="">R12i-CTR</option>
                  <option value="" selected>Firmware Link</option>
                  <option value="" selected>Peoduct Manual</option>
                  <option value="" selected>Video Guide</option>
                </select>
              </div>

              <div class="row align-items-start mb-3">
                <div class="col-8">
                  <label class="form-label">Images</label>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card card-with-close">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <img src="<?= url('assets/img/prod-1.jpg')?>" class="card-img-top" alt="...">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card card-with-close">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <img src="<?= url('assets/img/prod-1.jpg')?>" class="card-img-top" alt="...">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card card-with-close">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <img src="<?= url('assets/img/prod-1.jpg')?>" class="card-img-top" alt="...">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4 input-file">
                  <label class="btn btn-primary px-5"> Add Images
                    <input type="file" size="60" >
                  </label>
                </div>
              </div>

              <div class="hide" style="display: none;">
                <div class="col-12">
                  <label class="form-label">Product title</label>
                  <input type="text" name="name" class="form-control" placeholder="Product title" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Full description</label>
                  <textarea class="form-control" name="description" placeholder="Full description" rows="4" cols="4" required></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label">Images</label>
                  <input class="form-control" name="images[]" type="file" multiple required>
                </div>
                <div class="col-12">
                  <label class="form-label">Skus</label>
                  <input type="text" name="sku" class="form-control" placeholder="Enter tags">
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Category</label>
                  <select class="form-select categoryId" name="categoryId" id="categoryId" required>
                    <option disabled>-Select Category-</option>
                    @foreach($categories as $key => $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12 col-md-6" name="subcategoryGroup" id="subcategoryGroup" style="display:none">
                  <label class="form-label">Sub-category</label>
                  <input type="hidden" id="subCategoryFlag" name="subCategoryFlag" value="">
                  <select class="form-select subcategoryId" name="subcategoryId" id="subcategoryId">
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Price</label>
                  <div class="row g-3">
                    <div class="col-lg-9">
                      <input type="text" class="form-control" placeholder="Price" name="amount" pattern="^\d*(\.\d{0,2})?$" required>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <label class="form-label">Quantity</label>
                  <div class="row g-3">
                    <div class="col-lg-9">
                      <input type="number" class="form-control" name="quantity" placeholder="Quantity" required>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Publish on website
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary px-4">Submit Item</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end row-->

</main>
<!--end page main-->
@endsection
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('#categoryId').change(function() {
      $cId = $(this).val();
      var url = "{{url('admin/get_subcategories')}}";

      $.ajax({
        url: url,
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        type: "POST",
        data: {
          'categoryId': $cId
        },
        context: this,
        success: function(response, status, jqXHR) {
          if (response.success == true) {
            str = ""
            $.each(response.subCategories, function(k, subCategory) {
              str += "<option value=" + subCategory.id + " >" + subCategory.name + "</option>";
            });
            $('#subCategoryFlag').val(1);

            $('#subcategoryGroup').show();
            $('#subcategoryId').html($(str));
          } else {
            var myobj = document.getElementById("subcategoryGroup");
            // myobj.remove();
            $('#subcategoryGroup').hide();
            $('#subCategoryFlag').val(0);
          }

        },
        error: function(error) {
          console.log(error.responseText);
        }
      });
    });
  });
</script>

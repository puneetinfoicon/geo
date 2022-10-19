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
                    <li class="breadcrumb-item"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('dynamicPages')}}">Dynamic Page List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Support/Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Edit Support/Service</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <form class="row g-3" action="{{route('updateSupport')}}" method="post" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea id="" class="form-control summernote" name="description" placeholder="Full description" rows="4" cols="4" required>@isset($service->data){{ $service->data}}@endif</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Contents</label>
                                <select class="multiple-select" name='contexts[]' data-placeholder="Choose anything" multiple="multiple">
                                @foreach($contexts as $key => $content)
                                <option value="{{$content->id}}" {{ (in_array($content->id, $productContexts)) ? 'selected': '' }}>{{$content->name}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary px-4">Update</button>
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

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function() {
        $(".summernote").summernote({
            placeholder: "Write your content here",
            height: 200,

        });
    });

</script>
@endsection

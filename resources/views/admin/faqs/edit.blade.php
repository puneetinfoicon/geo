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
                <li class="breadcrumb-item">Content</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('faqs')}}">FAQs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit FAQ</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit FAQ</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('updateFaq')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <input type="hidden" name = "id" value = "{{$produkter->id}}">
                                    </div>

                                    <div class="col-12">

                                        <label class="form-label">Question</label>
                                        <textarea id="editor0" class="form-control summernote" name="question" placeholder="Full description" rows="4" cols="4" required>{{ $produkter->question }}</textarea>

                                    </div>

                                    <div class="col-12">

                                        <label class="form-label">Answer</label>
                                        <textarea id="editor1" class="form-control summernote" name="answer" placeholder="Full description" rows="4" cols="4" required>{{ $produkter->answer }}</textarea>

                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Areas</label>
                                        <select class="multiple-select" name='areas[]' data-placeholder="Choose anything" multiple="multiple" required>
                                        <option disabled>-Select Area-</option>
                                        @foreach($areas as $key => $category)
                                            <option value="{{$category->id}}" {{ (in_array($category->id, $productAreas)) ? 'selected': '' }}>{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckDefault2" {{ ($produkter->status == 1) ? 'checked': '' }}>
                                            <label class="form-check-label" for="flexCheckDefault2">Status</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
    <!--end page main-->
@endsection

@section('js')

    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>

        //initSample();
        CKEDITOR.replace( 'editor0', {
            // customConfig: '/custom/ckeditor_config.js'
            height: 200
        });
        CKEDITOR.replace( 'editor1', {
            //customConfig: '/custom/ckeditor_config.js'
            height: 200
        });
    </script>
@endsection

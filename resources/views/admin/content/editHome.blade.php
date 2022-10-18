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
                    <li class="breadcrumb-item"><a href="{{route('dynamicPages')}}">Dynamic Content List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit {{ucwords(str_replace("_", " ", $page))}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Edit {{ucwords(str_replace("_", " ", $page))}}</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <form class="row g-3" action="{{route('updateContent')}}" method="post" enctype="multipart/form-data">

                            @csrf
                            @php $checkedVideo = 0; $x = 0; @endphp
                            @foreach ($content as $key => $data)
                                @if($key == 'page')
                                    <input type="hidden" name="{{ $key }}" value="{{ $data[0] }}">
                                @elseif($data[1] == 'checkbox')
                                    <div class="col-12 form-check">
                                        <input class="form-check-input" name="{{ $key }}" type="checkbox" value="1" id="flexCheckDefault2" {{ ($data[0] == 1) ? 'checked': '' }}>
                                        <label class="form-check-label" for="flexCheckDefault2">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                                    </div>
                                    @elseif($data[1] == 'textarea')
                                    <div class="col-12">
                                        <label class="form-label">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                                        <textarea id="editor{{$x++}}" class="form-control summernote" name="{{ $key }}" placeholder="Full description" rows="4" cols="4" required>{{ $data[0] }}</textarea>
                                    </div>
                                @elseif($data[1] == 'radio')
                                    @php $checkedVideo = $data[0]; @endphp

                                @elseif($data[1] == 'link')
                                    <div class="col-12">
                                        <label class="form-label">{{ ucwords(str_replace("_", " ", $key)) }}</label>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">{{str_replace(request()->path(), "", url()->current())}}</span>
                                            </div>
                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="{{ $key }}" value="{{ $data[0] }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <label class="form-label">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                                        <input type="text" name="{{ $key }}" value="{{$data[0] }}" class="form-control" placeholder="content title" required>
                                    </div>
                                @endif
                            @endforeach

                            @if(isset($homeVideos) && sizeof($homeVideos) > 0)
                                @php $count = 1;  @endphp
                                <label class="form-label">select Video(s) to be shown on front page</label>

                                @foreach ($homeVideos as $key => $video)

                                    <input type="radio" name="video" value="{{$video->id}}" {{ ($video->id == $checkedVideo) ? 'checked': ''; }}>
                                    <label class="form-label">Video {{$count}}</label>

                                    @php $count++;  @endphp
                                @endforeach
                                <input type="radio" name="video" value="0" {{ ('0' == $checkedVideo) ? 'checked': ''; }}>
                                <label class="form-label">Random shuffle</label>
                            @endif
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

    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>

        //initSample();
        CKEDITOR.replace( 'editor0', {
            // customConfig: '/custom/ckeditor_config.js'
        });
        CKEDITOR.replace( 'editor1', {
            //customConfig: '/custom/ckeditor_config.js'
        });
    </script>
@endsection

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css">
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>

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

                            <div id="editor-container"></div>
                            <input type="hidden" name="about_content" id="get_data" value=''>

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
<script>

var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike', 'justify'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [ 'link', 'image', 'video', 'formula' ],          // add's image support
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean']                                         // remove formatting button
            ];
var quill = new Quill('#editor-container', {
    modules: {
                toolbar: toolbarOptions
            },
  placeholder: 'Your Text Here...',
  theme: 'snow'  // or 'bubble'
});
$(document).ready(function(){
    var about = '<h3>Title</h3><a href="javascript:;"><img src="<?= url("/media/1651151037/download.png")?>" alt="" class="img-fluid"></a><p>Lorem2: Ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>';
    var content = <?php echo json_encode($content);?>;
    // content = about;
    console.log(content);
    $(".ql-editor").html( content );

    $(".ql-toolbar").click(function(){
        var formdata = $('.ql-editor').html();
        $('input[name="about_content"]').val(formdata);
    });

    $(".ql-editor").keyup(function(){
        var formdata = $('.ql-editor').html();
        $('input[name="about_content"]').val(formdata);
    });
});

</script>
@endsection

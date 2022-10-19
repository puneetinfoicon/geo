@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <style>
        .form-check {
            display: inline-block !important;
        }
    </style>
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
                        <li class="breadcrumb-item active" aria-current="page">Manage Seo page</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">SEO</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('update_seoTbl')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="sitemap"><b> Sitemap.xml</b></label>
                                            <input type="file" class="form-control" id="sitemap" name="sitemap">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="robots"><b> Robots.txt</b></label>
                                            <input type="file" class="form-control" id="robots" name="robots">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="google_analytics"><b> Google Analytics</b></label>
                                            <textarea name="google_analytics" rows="5" class="form-control" id="google_analytics" placeholder="Paste Here Google Analytics source Code.">{{$files->google_analytics}}</textarea>
                                        </div>
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
         <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">SEO Product Pages</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <div class="responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Page Name</th>
                                            <th>Title</th>
                                            <th>Keywords</th>
                                            <th>Descriptions</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as $key=>$page)
                                        <tr>
                                            <td>{{1+$key++}}</td>
                                            <td>{{$page->page_name}}</td>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->keyword}}</td>
                                            <td>{{$page->description}}</td>
                                            <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seo{{$page->id}}" >Edit</button></td>
                                        </tr>

                                        <div class="modal fade" id="seo{{$page->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{$page->page_name}} </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{route('update_seoPage')}}" autocomplete="off">
                                                    <div class="modal-body">

                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$page->id}}">
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Title:</label>
                                                                <input type="text" class="form-control" name="title" value="{{$page->title}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="keyword" class="col-form-label">Keywords:</label>
                                                                <input type="text" class="form-control" name="keyword" value="{{$page->keyword}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="col-form-label">Descriptions:</label>
                                                                <textarea class="form-control" name="description">{{$page->description}}</textarea>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

    </main>
    <!--end page main-->

@endsection

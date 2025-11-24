<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
@extends('backend.layouts.master')
@section('title', 'Edit Contact')

@section('backend')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous">
	</script>
    <style>
        .elem, .elem * {
            box-sizing: border-box;
            margin: 0 !important;
        }
        .elem {
            display: inline-block;
            font-size: 0;
            width: 33%;
            border: 20px solid transparent;
            border-bottom: none;
            background: #fff;
            padding: 10px;
            height: auto;
            background-clip: padding-box;
        }
        .elem > span {
            display: block;
            cursor: pointer;
            height: 0;
            padding-bottom:	70%;
            background-size: cover;
            background-position: center center;
        }
        .lcl_fade_oc.lcl_pre_show #lcl_overlay,
        .lcl_fade_oc.lcl_pre_show #lcl_window,
        .lcl_fade_oc.lcl_is_closing #lcl_overlay,
        .lcl_fade_oc.lcl_is_closing #lcl_window {
            opacity: 0 !important;
        }
        .lcl_fade_oc.lcl_is_closing #lcl_overlay {
            -webkit-transition-delay: .15s !important;
            transition-delay: .15s !important;
        }
    </style>
    <script src="{{ asset('lightbox/LC-Lightbox-LITE-master/lib') }}/jquery.js" type="text/javascript"></script>

    <script src="{{ asset('lightbox/LC-Lightbox-LITE-master/js') }}/lc_lightbox.lite.js" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('lightbox/LC-Lightbox-LITE-master/css') }}/lc_lightbox.css" />

    <!-- SKINS -->
    <link rel="stylesheet" href="{{ asset('lightbox/LC-Lightbox-LITE-master/skins') }}/minimal.css" />

    <!-- ASSETS -->
    <script src="{{ asset('lightbox/LC-Lightbox-LITE-master/lib') }}/AlloyFinger/alloy_finger.min.js" type="text/javascript"></script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Contact</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Contact</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body mb-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-2">
                                            <label for="Input1" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="Input1" value="{{ $contact->name }}" placeholder="Enter Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-2">
                                            <label for="Input2" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="Input2" value="{{ $contact->phone }}" placeholder="Enter Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-2">
                                            <label for="Input3" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="Input3" value="{{ $contact->subject }}" placeholder="Enter Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <label for="Input4" class="form-label">Message</label>
                                            <textarea type="text" class="form-control" id="Input4" placeholder="Enter Message" name="message" rows="3">{{ $contact->message }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                {{-- Start Multi Image Update --}}
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body mb-0">
                            <h5>
                                <b>
                                    Corresponding Multi Images
                                </b>
                            </h5>
                            <div class="mt-1">
                                <div class="row">
                                    @forelse ($multi_images as $key => $multi_image)
                                    <a class="elem" href="{{ asset($multi_image->photo_name) }}" title="image {{ $key + 1 }}" data-lcl-txt="{{ $contact->subject }}" data-lcl-author="{{ $contact->name }}" data-lcl-thumb="{{ asset($multi_image->photo_name) }}">
                                        <span style="background-image: url({{ asset($multi_image->photo_name) }});"></span>
                                    </a>
                                    @empty
                                    <h4>No Images Found</h4>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Multi Image Update --}}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- LIGHTBOX INITIALIZATION -->
    <script type="text/javascript">
    $(document).ready(function(e) {

        // live handler
        lc_lightbox('.elem', {
            wrap_class: 'lcl_fade_oc',
            gallery : true,
            thumb_attr: 'data-lcl-thumb',

            skin: 'minimal',
            radius: 0,
            padding	: 0,
            border_w: 0,
        });

    });
    </script>
@endsection

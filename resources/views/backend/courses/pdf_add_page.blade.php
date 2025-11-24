@extends('backend.layouts.master')
@section('title', 'Quiz')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .hide {
            display: none;
        }
    </style>
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add PDF for <b>{{ $lesson->name }}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Videos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('admin.courses.module.lesson.pdf_add_post') }}" method="post"
                enctype="multipart/form-data" id="lessonForm">
                @csrf

                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <div class="card-body">
                     @if($errors->any())
               {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                                   @endif

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lesson details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              <div class="mb-3">
                                <label class="form-label">Add PDF</label>
                                <input type="file" name="pdf" class="form-control" id="pdfInput" accept="application/pdf">
                              </div>
                              <div id="pdfPreview" style="width: 100%; height: 500px; border: 1px solid #ccc;"></div>


                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">--Select Status--</option>
                                        <option value="1">On</option>
                                        <option value="0">Off</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>



                    <!-- /.card-body -->
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsScript')
    {{-- for multiple file insertion --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();
            });
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#pdfInput').on('change', function(e) {
                var file = e.target.files[0];

                if (file.type === "application/pdf") {
                    var fileReader = new FileReader();

                    fileReader.onload = function() {
                        var pdfData = new Uint8Array(this.result);

                        // Create the URL for the PDF
                        var pdfUrl = URL.createObjectURL(new Blob([pdfData], { type: 'application/pdf' }));

                        // Embed the PDF in an iframe
                        var $iframe = $('<iframe>', {
                            src: pdfUrl,
                            style: 'width: 100%; height: 100%;'
                        });

                        // Clear previous preview and append new one
                        $('#pdfPreview').empty().append($iframe);
                    };

                    // Read the file as an ArrayBuffer
                    fileReader.readAsArrayBuffer(file);
                } else {
                    alert("Please upload a valid PDF file.");
                }
            });
        });
    </script>
@endsection

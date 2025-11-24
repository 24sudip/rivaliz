@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PDF's of <strong>{{ $lesson->name }}</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Courses</li>
                        <li class="breadcrumb-item">Modules</li>
                        <li class="breadcrumb-item active">Add PDF</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.courses.module.pdf_add_page', $lesson->id) }}"
                                class="btn btn-outline-primary">Add
                                PDF</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>PDF</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                 <tbody>
                                      @forelse($pdfs as $key=>$pdf)
                                      <tr>
                                          <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                     <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$pdf->id}}" data-lesson-id="{{ $pdf->id }}">Edit</a>

                                                      
                                                       <a class="dropdown-item"
                                                      href="{{ route('admin.courses.module.lesson.delete', $pdf->id) }}"> Delete</a>

                                                    </div>
                                          </td>
                                          <td>
                                             <iframe src="{{ asset($pdf->pdf) }}" style="width:100%; height:300px;" frameborder="0"></iframe>

                                          </td>
                                          <td>
                                              @if($pdf->status == 1)
                                               <span class="badge badge-success">Status On</span>
                                              @else
                                                <span class="badge badge-danger">Status OFF</span>
                                              @endif
                                             
                                          </td>
                                         
                                          
                                          
                                      </tr>
                                      
                                      
                                      <div class="modal fade" id="editModal{{$pdf->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="editModalLabel">Edit PDF</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <form action="{{route('admin.courses.module.lesson.pdf_edit_post')}}" method="POST" enctype="multipart/form-data">
                                                       @csrf
                                                       
                                                   
                                                   <div class="modal-body">
                                                       <input type="hidden" value="{{$pdf->id}}" name="pdf_id">
                                                       <div class="mb-3">
                                                            <iframe src="{{ asset($pdf->pdf) }}" style="width:100%; height:300px;" frameborder="0"></iframe>
                                                       </div>
                                                         <div id="pdfPreviews{{ $pdf->id }}" style="width: 100%; height: 250px; border: 1px solid #ccc;"></div>

                                                       <div class="mb-3">
                                                           <label class="form-label">Update Pdf</label>
                                                          <input type="file" name="pdf" class="form-control pdfInput" id="pdfInput{{$pdf->id}}" data-modal-id="{{$pdf->id}}" accept="application/pdf">

                                                       </div>
                                                       <div class="mb-3">
                                                           <select name="status" class="form-control">
                                                                <option value="1" {{ $pdf->status == 1 ? 'selected' : '' }}>On</option>
                                                                <option value="0" {{ $pdf->status == 0 ? 'selected' : '' }}>Off</option>
                                                          </select>
                                                       </div>
                                                   </div>
                                                   
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       <button type="submit" class="btn btn-primary" >Save changes</button>
                                                   </div>
                                                   </form>
                                               </div>
                                           </div>
                                       </div>
                                 @empty
                                 Sorry No Pdf Added
                                @endforelse
                                   
                                </tbody>
                               
                               
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
   
    <!-- /.content -->
@endsection
@section('jsScript')
 <script>
      $(document).ready(function() {
    $(document).on('change', '.pdfInput', function(e) {
        var file = e.target.files[0];
        var modalId = $(this).data('modalId'); // Extract modal ID from data-modal-id attribute

        if (file && file.type === "application/pdf") {
            var fileReader = new FileReader();

            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                var pdfUrl = URL.createObjectURL(new Blob([pdfData], { type: 'application/pdf' }));

                // Embed the PDF in an iframe
                var $iframe = $('<iframe>', {
                    src: pdfUrl,
                    style: 'width: 100%; height: 100%;'
                });

                // Clear previous preview and append new one
                $('#pdfPreviews' + modalId).empty().append($iframe);
            };

            fileReader.readAsArrayBuffer(file);
        } else {
            alert("Please upload a valid PDF file.");
        }
    });
});

    </script>
@endsection

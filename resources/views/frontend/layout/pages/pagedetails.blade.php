@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Page Details - {{ env('APP_NAME') }}</title>
    @endsection

    <section id="quikctech-teachers-title" class="pt-100">
        <div class="overlay">
            <div class="container">
                <div class="row">
                 <div class="col-lg-12">
                 <div class="quikctech-teachers-head text-center">
                   <h1>Page Details</h1>
                   <h5> <i class="fa-solid fa-house"></i> Home / Page Details</h5>
                    </div> 
                    </div>
                </div>
            </div>
        </div>
    
     </section>
<!-- exam -->
  <section id="quicktech-exam-details" class="pt-5">
    <div class="container pt-5">
        <div class="row gapp mt-5 mb-5">
           <h1>{{ $page->name}}</h1>

           <p>{!! $page->details  !!}</p>
       
       
       
        </div>
    </div>
</section>


   <!-- exam -->

@endsection

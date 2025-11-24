@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Videos - {{ env('APP_NAME') }}</title>
    @endsection
    


   <!-- checkout -->
   <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
             <div class="col-lg-12">
             <div class="quikctech-teachers-head text-center">
               <h1>Free Videos</h1>
               <h5><i class="fa-solid fa-house"></i> Home / Free Videos</h5>
                </div> 
                </div>
            </div>
        </div>
    </div>

 </section>

    <section id="quikctech-free-videos">
        <div class="container">

         {{--   @forelse ($freevideoscategories as $category) --}}
            <div class="row gap my-5">
                <div class="col-lg-12">
                    <div class="quikctech-video-section">
                        <h4>{{$freevideoscategories->name}}</h4>
                    </div>
                </div>

              @forelse ($freevideoscategories->videos as $video )
                <div class="col-lg-4 col-sm-6">
                    <div class="quikctech-videos-main">
                      <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/9DTyINOeY-Y?si=AAUw2MG-KLbknrrx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                    
                      <iframe width="100%" height="200"
                      src="https://www.youtube.com/embed/{{ getYoutubeId($video->video) }}"
                      frameborder="0" allowfullscreen>
                  </iframe>
                    </div>
                </div>
                @empty
                    <h6>No videos found</h6>
                @endforelse 
               
            </div>
       {{--     @empty
                
            @endforelse --}}
          
         
            
        </div>
    </section>
        



   <!-- checkout -->


@endsection
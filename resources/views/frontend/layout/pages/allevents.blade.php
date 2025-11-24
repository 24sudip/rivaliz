
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Events - {{ env('APP_NAME') }}</title>
    @endsection
    


  

   <!-- event -->
   <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
             <div class="col-lg-12">
             <div class="quikctech-teachers-head text-center">
               <h1>Events</h1>
               <h5><i class="fa-solid fa-house"></i> Home / Events</h5>
                </div> 
                </div>
            </div>
        </div>
    </div>
    
 </section>

 <section id="quicktech-events-all">
    <div class="container">
        <div class="row gap my-5">
           @forelse($events as $event)
              <div class="col-lg-4 col-md-6">
                <a href="{{ route('eventdetails', $event->id) }}">
                  <div class="quikctech-all-event-inner">
                      <div class="quikctech-event-img">
                          <img src="{{asset($event->image)}}" class="w-100" alt="">
                      </div>
                      <div class="quikctech-all-event-text">
                          <ul class="quikctech-dettt">
                              <li><i class="fa-solid fa-user"></i> By admin</li>
                              <li><i class="fa-solid fa-folder"></i> Air Transport</li>
                          </ul>
                          <h5>{{$event->title}}</h5>
                          <p class="two-line-text">
                            {!!Str::limit($event->description, 10) !!}
                           
                            </p>
                            <a href="{{ route('eventdetails', $event->id) }}">Read More..</a>
                      </div>
                  </div>
                </a>
              </div>
              @empty
            @endforelse
        </div>
    </div>
 </section>

        



   <!-- event -->
   
@endsection

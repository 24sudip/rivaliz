@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Events - {{ env('APP_NAME') }}</title>
    @endsection
    




 <!-- event details -->
 <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
             <div class="col-lg-12">
             <div class="quikctech-teachers-head text-center">
               <h1>Event Details</h1>
               <h5><i class="fa-solid fa-house"></i> Home / Event Details</h5>
                </div> 
                </div>
            </div>
        </div>
    </div>

 </section>


   <section id="quicktech-evenet-details-main">
    <div class="container">
        <div class="row my-5">
         <div class="col-lg-8">
         <div class="quicktech-event-d-img">
            <img src="{{asset($event->image)}}" class="w-100" alt="">
         </div> 
         <div class="quicktech-event-d-text">
            <ul class="quikctech-dettt">
                <li><i class="fa-solid fa-user"></i> By admin</li>
                <li><i class="fa-solid fa-folder"></i> {{$event->location}}</li>
                <li><i class="fa-solid fa-calendar-days"></i>  {{ date('d F, Y', strtotime($event->date)) }}</li>
               
            </ul>
            {{-- <ul class="quikctech-dettt">
                <li><i class="fa-solid fa-user"></i> By admin</li>
                <li><i class="fa-solid fa-folder"></i> Air Transport</li>
                <li><i class="fa-solid fa-calendar-days"></i>  28 JANUARY, 2020</li>
            </ul> --}}
            {{-- <h1>Flock by when MTV ax quiz prog quiz graced
                </h1>
                <p>Lorem ipsum dolor sit amet, elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                <p>labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
                </p> --}}
                <h1>{{$event->title}}
                </h1>
                <p>
                    {!!$event->description!!}
                           

                </p>
         </div>
         </div>
         <div class="col-lg-4">
            <div class="quicktech-recent-notice">
                <h3>Recent Event</h3>
          <div class="quicktech-recent-event-scroll">
                
            @forelse (  $recentevents as  $recentevent)
            <div class="quicktech-recent-event-all mt-3">
                <a href="{{ route('eventdetails', $recentevent->id) }}">
                  <div class="quikctech-recent-n-inner">
                      <div class="quikctech-notice-re-img">
                          <img src="{{asset($recentevent->image)}}" alt="">
                      </div>
                      <div class="quicktech-notice-re">
                          <h6>{{$recentevent->title}}</h6>
                          <p><i class="fa-solid fa-calendar-days"></i>  {{ date('d F, Y', strtotime($recentevent->date)) }}</p>
                      </div>
                  </div>
                </a>
             </div>
            @empty
                <p>No recent event</p>
            @endforelse
               
          
          </div>
           
            </div>
         </div>
        </div>
    </div>
   </section>

        



   <!-- event details -->
   @endsection
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Exams - {{ env('APP_NAME') }}</title>
    @endsection

    <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
        <div class="overlay">
            <div class="container">
                <div class="row">
                 <div class="col-lg-12">
                 <div class="quikctech-teachers-head text-center">
                   <h1>Exam Details</h1>
                   <h5> <i class="fa-solid fa-house"></i> Home / Exam Details</h5>
                    </div> 
                    </div>
                </div>
            </div>
        </div>
    
     </section>
   <!-- exam details -->
   <section id="quikctech-details-exam">
    <div class="container">
        <div class="row gapp my-5">
            <div class="col-lg-9">
              <div class="quikctech-ex-inner-details">
                <div class="quikctech-daily-main">
                    <div class="quikctech-daily-sets">
                       {{-- <h4> {{$exam }} </h4> --}}
                    <h4>Daily Day Set : 15</h4>
                    </div>
                    <div class="quikctech-share">
                    <ul>
                        <li>Share:</li>
                        <li><a href="#" style="color: #1877F2;"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#" style="color: #25D366;"><i class="fa-brands fa-whatsapp"></i></a></li>
                        <li><a href="#" style="color: #E1306C;"><i class="fa-brands fa-instagram"></i></a></li>

                    </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="quikctech-text-exam-main">
                            <h5>{{$exam->name }}</h5>
                            <p>published 202 days ago <br>

                                </p>
                                {{-- <p>This model set is fully based on the syllabus which especially made for students who are preparing English</p> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="quicktech-exam-time">
                            <ul>
                                <li>
                                    <span>Time:</span>
                                    <p>{{$exam->timer }} min</p>
                                </li>
                                <li>
                                    <span>Full Marks:</span>
                                    <p>{{ $exam->questions->count() }}  marks</p>
                                </li>
                                <li>
                                    <span>Pass Marks:</span>
                                    <p>{{$exam->passingpoint ?? null}} marks</p>
                                </li>
                                {{-- <li>
                                    <span>Negative Marking:</span>
                                    <p>0 Percent</p>
                                </li> --}}
                                <li>
                                    <span>Questions:</span>
                                    <p>{{ $exam->questions->count() }} question</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quikctech-rating-inner d-flex justify-content-between align-items-center">
                            <div class="quiktech-stars d-flex gap-2 align-items-center">
                                <img src="images/star_rating.svg" alt="">
                                 <p>5.0 rating</p>
                            </div>
                            <div class="quiktech-stars d-flex gap-2 align-items-center">
                                <img src="images/team-blue.svg" alt="">
                                <p>5.0  appeared</p>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
                <div class="quicktech-exam-start">
                    <div class="quikctech-exam-start-inner text-center">
                       <h4>FREE</h4>

                       <div class="ban-btn justify-content-center">
                        <a href="{{route('examstart',$exam->id)}}">Start Now</a>
                        <div class="hover"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </section>


   <!-- exam details -->




@endsection
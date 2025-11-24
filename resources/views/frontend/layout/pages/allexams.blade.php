@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Exams - {{ env('APP_NAME') }}</title>
    @endsection
<!-- exam -->
  <section id="quicktech-exam-details" class="pt-5">
    <div class="container pt-5 pb-5">
        <div class="row gapp mt-5 mb-5">
        @forelse($exams as $exam)
                         <div class="col-lg-3 col-sm-6">
                            <a href="{{route('examdetails',$exam->id)}}">
                             <div class="quicktech-exam-inner">
                                 <div class="quicktech-exam-img text-center">
                                     <img src="{{ asset('assets/frontend/images') }}/exam.png" alt="">
                                 </div>
                                 <div class="quikctech-exam-text mt-2 text-center">
                                     <hr>
                                     <h5>{{$exam->name}}</h5>
                                     <hr>
                                     <h4>{{ $exam->questions->count() }} Questions</h4>

                                 </div>
                                 <div class="quikctech-rating-inner d-flex justify-content-between align-items-center">
                                     <div class="quiktech-stars d-flex gap-2 align-items-center">
                                         <img src="{{ asset('assets/frontend/images') }}/star_rating.svg" alt="">
                                          <p>5.0 <br> rating</p>
                                     </div>
                                     <div class="quiktech-stars d-flex gap-2 align-items-center">
                                         <img src="{{ asset('assets/frontend/images') }}/team-blue.svg" alt="">
                                         <p>10 <br> appeared</p>
                                     </div>
                                 </div>
                                 <div class="quicktech-published-date">
                                     <p>Published: {{ \Carbon\Carbon::parse($exam->created_at)->format('d.m.Y') }}</p>
                                 </div>
                                </div>
                            </a>
                             </div>

                    @empty
                    @endforelse

       
       
       
                            </div>
    </div>
</section>


   <!-- exam -->

@endsection

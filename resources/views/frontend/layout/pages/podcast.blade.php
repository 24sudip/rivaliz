<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Podcasts - {{ env('APP_NAME') }}</title>
    @endsection
<!-- music -->
<section style="background: url({{ asset('assets/frontend/images') }}/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quikctech-teachers-head text-center">
                        <h1>Podcast</h1>
                        <h5><i class="fa-solid fa-house"></i> Home / Podcast</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>

<section id="quikctech-free-videos">
    <div class="container">
        <div class="row gap my-5">
            @foreach ($podcasts as $podcast)
            <div class="col-lg-3 col-sm-6">
                <div class="quikctech-podcast-main">
                    <div class="quikctech-podcast-inner">
                        <img src="{{ asset($podcast->photo) }}" class="w-100" style="object-fit: cover;">
                        <h4>{{ $podcast->title }}</h4>
                        {{-- <audio src="{{ asset($podcast->audio) }}" controls></audio> --}}
                        <p>{!! \Illuminate\Support\Str::words(strip_tags($podcast->description),6, '...') !!}</p>
                        <div class="quicktech-share-podcast">
                            <ul>
                                <li>
                                    <a class="btn btn-success" href="{{ route('podcast.detail', $podcast->id) }}">
                                        Visit To hear:
                                    </a>
                                </li>
                                {{-- <li><a href="#" style="color: #4267B2;"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#" style="color: #1DA1F2;"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#" style="color: #C13584;"><i class="fa-brands fa-instagram"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- music -->
@endsection

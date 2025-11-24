<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
   {{-- <title>{{ $podcast->title }} - {{ env('APP_NAME') }}</title>
    <meta property="og:title" content="{{ $podcast->title }}">
    <meta property="og:description" content="{{ $podcast->description }}">
    <meta property="og:image" content="{{ $podcast->photo }}">
    <meta property="og:audio" content="{{ $podcast->audio }}">  --}}
    <title>{{ $podcast->title }} - {{ env('APP_NAME') }}</title>
    <meta property="og:title" content="{{ $podcast->title }}">
    <meta property="og:description" content="{{ $podcast->description }}">
    <meta property="og:image" content="{{ asset($podcast->photo) }}">
    <meta property="og:audio" content="{{ asset($podcast->audio) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <!-- Optional for Twitter Card -->
    <meta name="twitter:title" content="{{ $podcast->title }}">
    <meta name="twitter:description" content="{{ $podcast->description }}">
    <meta name="twitter:image" content="{{ asset($podcast->photo) }}">
    <meta name="twitter:card" content="summary_large_image">
    @endsection
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> --}}
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
        margin-right: 25px;
    }
    div#social-links ul li {
        display: inline-block;
    }
    div#social-links ul li a {
        padding: 20px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #ccc;
    }
    div#social-links ul li a:hover {
        background-color: #1DA1F2;
        color: white;
    }
</style>
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
            <div class="col-lg-7 col-sm-6 m-auto">
                <div class="quikctech-podcast-main">
                    <div class="quikctech-podcast-inner">
                        <!-- Podcast Image -->
                        <img src="{{ asset($podcast->photo) }}" alt="" class="img-fluid mb-3" style="border-radius: 10px;">

                        <!-- Title -->
                        <h4 class="mb-3">{{ $podcast->title }}</h4>

                        <!-- Audio Player -->
                        <audio src="{{ asset($podcast->audio) }}" controls controlsList="nodownload" class="w-100 mb-3"></audio>

                        <!-- Description -->
                        <p class="text-muted">{!! $podcast->description !!}</p>

                        <!-- Social Share Buttons -->
                        <div class="quicktech-share-podcast">
                            <ul>
                                <li>
                                    <span class="btn btn-info">Share this podcast:</span>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="facebook" target="_blank" title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" class="twitter" target="_blank" title="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" class="linkedin" target="_blank" title="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" class="whatsapp" target="_blank" title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                               <!-- New Copy Link Button -->
        <li>
            <button type="button" class="btn btn-secondary" onclick="copyLink()" title="Copy Link">
                <i class="fas fa-copy"></i> Copy Link
            </button>
            <span id="copySuccess" style="display: none; margin-left: 10px; font-weight: bold;">Link copied!</span>
        </li>

        <!--                        <li>-->
        <!--    <button type="button" class="btn btn-secondary" onclick="copyLink()" title="Copy Link">-->
        <!--        <i class="fas fa-copy"></i> Copy Link-->
        <!--    </button>-->
        <!--</li>-->
        <script>
    function copyLink() {
        const url = "{{ url()->current() }}";
        navigator.clipboard.writeText(url).then(function() {
            // Show success message
            var msgEl = document.getElementById('copySuccess');
            msgEl.style.display = 'inline';
            // Hide the message after 2 seconds
            setTimeout(function(){
                msgEl.style.display = 'none';
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy the link: ', err);
        });
    }
</script>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Button Styles -->
<style>
    .quicktech-share-podcast ul {
        list-style: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin-top: 20px;
    }

    .quicktech-share-podcast ul li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        color: white;
        font-size: 18px;
        transition: 0.3s;
        text-decoration: none;
    }

    .quicktech-share-podcast ul li a.facebook {
        background-color: #3b5998;
    }

    .quicktech-share-podcast ul li a.twitter {
        background-color: #1da1f2;
    }

    .quicktech-share-podcast ul li a.linkedin {
        background-color: #0077b5;
    }

    .quicktech-share-podcast ul li a.whatsapp {
        background-color: #25D366;
    }

    .quicktech-share-podcast ul li a.telegram {
        background-color: #0088cc;
    }

    .quicktech-share-podcast ul li a:hover {
        transform: scale(1.1);
        opacity: 0.9;
    }
</style>

<!-- FontAwesome (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<!-- music -->
@endsection

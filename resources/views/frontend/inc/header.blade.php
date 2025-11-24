
<!DOCTYPE html>
<html lang="en">
<head>
  @php
  $companyinfo = \App\Models\CompanyInfo::first();
  $freevideoscategories = \App\Models\Freevideoscategory::get();
    $podcastcategories = \App\Models\Podcastcategory::get();
@endphp
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta_content')
    <meta name="keywords" content="php,laravel,html,css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" type="image/png" href="../../../assets/frontend/img/favicon.png"> --}}
    <link rel="icon" type="image/png" href="{{asset( $companyinfo->favicon )}}"> 
    <link rel="stylesheet" href="../../../assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/slick.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/colorfulTab.min.css">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="../../../assets/frontend/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/animate.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/venobox.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/style.css">
    <link rel="stylesheet" href="../../../assets/frontend/css/responsive.css">
    {{-- Toastr css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    
    
    
    <meta name="google-site-verification" content="br3h1Sa1MJLYCTJl0ZuAzBtuHVvqQCtwSNtvG5S-9AY" />
    
    
    
</head>
<body>
<style>
    @media (max-width: 575.98px) {
        .quicktech-desktop-navbar {
            display: none !important;
        }
    }

        .quicktech-desktop-navbar {
            display: block;
        }
 
</style>
<!-- desktop navbar -->
 <nav class="navbar quicktech-desktop-navbar navbar-expand-lg bg-light">
 <div class="container">


{{-- <a class="navbar-brand quikctech-desktop-nav-logo" href="/"><img src="../../../assets/frontend/images/logo (3).png" alt=""></a> --}}
<a class="navbar-brand quikctech-desktop-nav-logo" href="/"><img src="{{asset( $companyinfo->logo )}}" alt=""></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="/">Home</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Courses
      </a>
      <ul class="dropdown-menu">

         @foreach($categories as $category)
        <li><a class="dropdown-item" href="{{route('allcourse.categorywise',$category->id)}}">{{$category->name}}</a></li>
        {{-- <li><a class="dropdown-item" href="#">Vocabulary</a></li> --}}
          @endforeach

      </ul>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{route('allcourse')}}">All Course</a>
    </li> --}}
    <!--align-items-center-->
        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::guard('student')->user(); // or just Auth::user() if default
        @endphp
    <!--<div class="quikctech-login-signup"> -->
    <!--</div>-->
    <!--<ul>-->
    <!--  <li class="nav-item dropdown" id="profileDropdown">-->
    <!--    <a class="nav-link dropdown-toggle d-flex" href="#" id="navbarDropdown" role="button">-->
    <!--      @if($user)-->
    <!--      <img class="profile_img" style="height: 30px; width: 30px; border-radius: 50%;" src="{{ asset($user->image) }}" alt="">-->
    <!--          <span  style="color: black;margin-left:4px">-->
    <!--              {{$user->name }}-->
    <!--              My Dashboard-->
    <!--            </span>-->
    <!--      @else-->
    <!--         <span><a href="{{ route('লগইন করুন') }}">Login</a></span> -->
    <!--          <i style="color: black; font-size: 20px;" class="fa fa-user me-2"></i>-->
    <!--      @endif-->
    <!--    </a>-->
    <!--    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown" id="dropdownMenu">-->
    <!--      @if($user)-->
    <!--      <li>-->
    <!--        <a class="dropdown-item" href="{{url('/student/dashboard')}}"> -->
    <!--            <img class="profile_img" style="height: 30px;width:30px; border-radius: 50%;" src="{{ asset($user->image) }}" alt=""> Dashboard-->
    <!--        </a>-->
    <!--      </li>-->
    <!--      <li><a class="dropdown-item text-danger" href="{{url('/student/logout')}}"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>-->
    <!--      @else-->
    <!--      <li><a class="dropdown-item" href="{{route('লগইন করুন')}}"><i class="fa fa-sign-in-alt me-2"></i>Log in</a></li>-->
    <!--      @endif-->
    <!--    </ul>-->
    <!--  </li>-->
    <!--</ul>-->
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('allebook') }}">Ebooks</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{url('/allexam')}}">Exams</a>
    </li>

    <!--<li class="nav-item">-->
    <!--  <a class="nav-link" aria-current="page" href="{{ route('podcast') }}">Podcasts</a>-->
    <!--</li>-->
    
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
       Podcasts
      </a>
      <ul class="dropdown-menu">

         @foreach($podcastcategories as $category)
        <li><a class="dropdown-item" href="{{route('podcast.category',$category->id)}}">{{$category->name}}</a></li>
     
          @endforeach

      </ul>
    </li>
    <!--<li class="nav-item">-->
    <!--  <a class="nav-link" aria-current="page" href="{{route('videos')}}">Free Videos</a>-->
    <!--</li>-->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
     Free Videos
      </a>
      <ul class="dropdown-menu">

         @foreach($freevideoscategories as $category)
        <li><a class="dropdown-item" href="{{route('videos.category',$category->id)}}">{{$category->name}}</a></li>
        {{-- <li><a class="dropdown-item" href="#">Vocabulary</a></li> --}}
          @endforeach

      </ul>
    </li>
     <li class="nav-item">
      <a class="nav-link" aria-current="page" href="">Study</a>
    </li>
   {{-- <div class="quicktech-search">
    <form role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="quicktech-search-icon" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
   </div> --}}

   <style>
    #search-suggestions {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ddd;
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    z-index: 999;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.suggestion-item {
    padding: 10px;
    cursor: pointer;
}

.suggestion-item:hover {
    background-color: #f1f1f1;
}

.suggestion-item a {
    text-decoration: none;
    color: #000;
}

    </style>
<div class="quicktech-search">
    <form role="search" id="search-form">
        <input class="form-control me-2" type="search" id="search-input" name="search" placeholder="Search for a course" aria-label="Search">
        <button class="quicktech-search-icon" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
    <div id="search-suggestions" class="suggestions-dropdown" style="display:none;">
        <!-- Suggestions will be loaded here -->
    </div>
</div>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    @if($user)
      <span  style="color: black;margin-left:4px">
          My Dashboard
        </span>
  @else
      <i style="color: black; font-size: 20px;" class="fa fa-user me-2"></i>
  @endif
  </a>
  <ul class="dropdown-menu">
        @if($user)
      <li>
        <a class="dropdown-item" href="{{url('/student/dashboard')}}"> 
            <img class="profile_img" style="height: 30px;width:30px; border-radius: 50%;" src="{{ $user->image ? asset($user->image) :  'https://learnengwithshahan.com/images/site/WhatsApp Image 2025-04-21 at 6.23.46 PM.jpeg' }}" alt=""> Dashboard
        </a>
       
      </li>
      <li><a class="dropdown-item text-danger" href="{{url('/student/logout')}}"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
      @else
      <li><a class="dropdown-item" href="{{route('লগইন করুন')}}"><i class="fa fa-sign-in-alt me-2"></i>Log in</a></li>
      @endif
  </ul>
</li>
@if(!$user)
<li class="quicktech-sign-up">
  <a style="color: black; z-index: 999;" href="/register">Get Started</a>
</li>
@endif
<script>
 
    
    document.getElementById('search-input').addEventListener('input', function () {
        let query = this.value;

        if (query.length > 2) {  // Trigger search only after 3 characters
            fetch(`/search-suggestions?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let suggestionsDropdown = document.getElementById('search-suggestions');
                    suggestionsDropdown.innerHTML = ''; // Clear previous suggestions

                    if (data.suggestions.length > 0) {
                        suggestionsDropdown.style.display = 'block';
                        data.suggestions.forEach(item => {
                            let suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('suggestion-item');
                            suggestionItem.innerHTML = `<a href="/coursedetails/${item.id}">${item.name}</a>`;
                            suggestionsDropdown.appendChild(suggestionItem);
                        });
                    } else {
                        suggestionsDropdown.style.display = 'none';
                    }
                });
        } else {
            document.getElementById('search-suggestions').style.display = 'none';
        }
    });
    document.addEventListener('click', function (e) {
      if (!document.getElementById('search-form').contains(e.target)) {
          document.getElementById('search-suggestions').style.display = 'none';
      }
  });
  </script>
  </ul>
  <!--previous dropdown -->
</div>
</div>
  </nav>
<!-- desktop navbar -->
<style>
    @media (max-width: 575.98px) {
        #quicktech-mob-nav {
            display: block !important;
        }
    }
    @media (min-width: 575.98px) {
        #quicktech-mob-nav {
            display: none;
        }
    }
</style>
<!-- mobile navbar -->
    <section id="quicktech-mob-nav">
      <div class="container">
        <div class="row">
          <div class="col-10">
            <div class="quicktech-nav-logo-mob mt-3">
              <a class="navbar-brand quikctech-desktop-nav-logo" href="/"><img src="{{asset( $companyinfo->logo )}}" alt=""></a>
            </div>
          </div>
          <div class="col-2">
              <style>
                  .quikctech-mob-navbar {
                    padding-left: 5px;
                    padding-right: 5px;
                    margin-top: 22px;
                    margin-bottom: 22px;
                    border: none;
                    background-color: transparent;
                    font-size: 22px;
              </style>
            <button
              class="quikctech-mob-navbar"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasExampleTwo"
              aria-controls="offcanvasExampleTwo"
            >
              <i class="fa-solid fa-bars"></i>
            </button>

            <div
              class="offcanvas offcanvas-start"
              tabindex="-1"
              id="offcanvasExampleTwo"
              aria-labelledby="offcanvasExampleTwoLabel"
            >
              <div class="offcanvas-header">
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="offcanvas"
                  aria-label="Close"
                ></button>
              </div>
              <div class="offcanvas-body">
                <div class="accordion" id="accordionExample">
                    <style>
                        ul.quicktech-mm li a {
                            margin: 10px;
                            font-size: 20px;
                        }
                    </style>
                  <ul class="quicktech-mm">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Courses
                      </a>
                      <ul class="dropdown-menu">
                
                         @foreach($categories as $category)
                        <li><a class="dropdown-item" href="{{route('allcourse.categorywise',$category->id)}}">{{$category->name}}</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Vocabulary</a></li> --}}
                          @endforeach
                
                      </ul>
                    </li>
                  </ul>
                  
                  <ul class="quicktech-mm">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if($user)
                          <span  style="color: rgba(0, 0, 0, 0.705);">
                              My Dashboard
                            </span>
                      @else
                          <i style="color: black; font-size: 20px;" class="fa fa-user me-2"></i>
                      @endif
                      </a>
                      <ul class="dropdown-menu">
                            @if($user)
                          <li>
                            <a class="dropdown-item" href="{{url('/student/dashboard')}}"> 
                                <img class="profile_img" style="height: 30px;width:30px; border-radius: 50%;" src="{{ asset($user->image) }}" alt=""> Dashboard
                            </a>
                           
                          </li>
                          <li><a class="dropdown-item text-danger" href="{{url('/student/logout')}}"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                          @else
                          <li><a class="dropdown-item" href="{{route('লগইন করুন')}}"><i class="fa fa-sign-in-alt me-2"></i>Log in</a></li>
                          @endif
                      </ul>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="{{ route('allebook') }}">Ebooks</a>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="{{url('/allexam')}}">Exams</a>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Podcasts
                      </a>
                      <ul class="dropdown-menu">
                
                         @foreach($podcastcategories as $category)
                        <li><a class="dropdown-item" href="{{route('podcast.category',$category->id)}}">{{$category->name}}</a></li>
                     
                          @endforeach
                
                      </ul>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Free Videos
                      </a>
                      <ul class="dropdown-menu">
                
                         @foreach($freevideoscategories as $category)
                        <li><a class="dropdown-item" href="{{route('videos.category',$category->id)}}">{{$category->name}}</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Vocabulary</a></li> --}}
                          @endforeach
                
                      </ul>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="">Study</a>
                    </li>
                  </ul>
                  <ul class="quicktech-mm">
                    @if(!$user)
                      <li class="quicktech-sign-up ms-2">
                          <a style="color: black; z-index: 999;" href="/register">Get Started</a>
                      </li>
                      @endif
                  </ul>
                  
                  <div class="quicktech-search">
                        <form role="search" id="search-form">
                            <input class="form-control me-2" type="search" id="search-input" name="search" placeholder="Search for a course" aria-label="Search">
                            <button class="quicktech-search-icon" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                        <div id="search-suggestions" class="suggestions-dropdown" style="display:none;">
                            <!-- Suggestions will be loaded here -->
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- mobile navbar -->

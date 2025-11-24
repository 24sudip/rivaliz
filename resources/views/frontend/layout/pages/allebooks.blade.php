@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Ebooks - {{ env('APP_NAME') }}</title>
    @endsection
<!-- all courses -->
<section style="background: url({{ asset('assets/frontend/images') }}/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quikctech-teachers-head text-center">
                        <h1>Ebooks</h1>
                        <h5> <i class="fa-solid fa-house"></i> Home / Ebooks</h5>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>

<section id="quicktech-all-courses">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quicktech-filter d-flex justify-content-end align-items-center gap-3 text-end">
                    
                    <!-- Paid/Free Filter -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('allebook', array_merge(request()->query(), ['buy' => 'Paid'])) }}">Paid</a></li>
                            <li><a class="dropdown-item" href="{{ route('allebook', array_merge(request()->query(), ['buy' => 'Free'])) }}">Free</a></li>
                            <li><a class="dropdown-item" href="{{ route('allebook') }}">All</a></li>
                        </ul>
                    </div>

                    <!-- Skill Level Filter -->
                    <div class="quicktech-advance">
                        <select name="skillLevel" id="skillLevel" class="form-select" onchange="filterBySkillLevel(this.value)">
                            <option value="" disabled selected>Skill level</option>
                            <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="advanced" {{ request('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-3 mb-5 gapp">
            @forelse($ebooks as $ebook)
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('ebookdetails', $ebook->id) }}">
                        <div class="quicktech-ebooks-inner">
                            <div class="quikctech-ebook-img">
                                <img src="{{ asset('assets/frontend/images/ebook.jpg') }}" class="w-100" alt="">
                            </div>
                            <div class="quicktech-ebook-text">
                                <h4>{{ $ebook->title }}</h4>
                                <p>{{ $ebook->description }}</p>
                            </div>
                            <div class="quikctech-enroll-btn mt-3">
                                <p>{{ $ebook->price }} tk</p>
                                <a class="quikctech-entroll" href="{{ route('ebookdetails', $ebook->id) }}">View Now</a>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No ebooks found at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
    function filterBySkillLevel(level) {
        let url = new URL(window.location.href);
        url.searchParams.set('level', level);
        window.location.href = url.href;
    }
</script>
@endsection

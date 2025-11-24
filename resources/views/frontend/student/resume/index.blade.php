@extends('frontend.student.studentmaster')
@section('title', "Resume | $resume->title")
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="mx-auto">
                        <div class="container">
                            <div>
                                <a class="btn btn-success float-end" href="{{ route('student.resumesave') }}">Save Image</a>

                                <a class="btn btn-primary float-end mx-2 mb-2"
                                    href="{{ route('student.resumedownload') }}">Download</a>
                                <button class="btn btn-primary float-end" onclick="printResume()">Print</button>
                            </div>
                            <div class="resume">
                                <style>
                                    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap");

                                    * {
                                        margin: 0;
                                        padding: 0;
                                        box-sizing: border-box;
                                        list-style: none;
                                    }
                                </style>
                                <div class="resume_left">
                                    <div class="resume_profile">
                                        <img src="{{ asset($resume->student->image) }}" class="rounded-circle p-4"
                                            alt="profile_pic">
                                    </div>
                                    <div class="resume_content">
                                        <div class="resume_item resume_info">
                                            <div class="title">
                                                <p class="bold">{{ $resume->title }}</p>
                                                <p class="regular">{{ $resume->designation }}</p>
                                            </div>
                                            <ul>
                                                <li>
                                                    <div class="icon">
                                                        <i class="fas fa-map-signs"></i>
                                                    </div>
                                                    <div class="data">
                                                        {!! $resume->student->address !!}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <i class="fas fa-mobile-alt"></i>
                                                    </div>
                                                    <div class="data">
                                                        {{ $resume->student->phone }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                    <div class="data">
                                                        {{ $resume->student->email }}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="resume_item resume_skills">
                                            <div class="title">
                                                <p class="bold">skill's</p>
                                            </div>
                                            <ul>
                                                @foreach ($resume->skills as $skill)
                                                    <li>
                                                        <div class="skill_name">
                                                            {{ $skill->name }}
                                                        </div>
                                                        <div class="skill_progress">
                                                            <span style="width: {{ $skill->level }}%;"></span>
                                                        </div>
                                                        <div class="skill_per">{{ $skill->level }}%</div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="resume_item resume_social">
                                            <div class="title">
                                                <p class="bold">Social</p>
                                            </div>
                                            <ul>
                                                @foreach ($resume->socials as $social)
                                                    <li>
                                                        <div class="icon">
                                                            <i class="{{ $social->icon }}"></i>
                                                        </div>
                                                        <div class="data">
                                                            <p class="semi-bold">{{ $social->name }}</p>
                                                            <p class="">
                                                                <small>
                                                                    <a class="text-decoration-none text-light"
                                                                        href="{{ $social->link }}">{{ $social->link }}</a>
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        @if ($resume->references)
                                            <div class="resume_item resume_social">
                                                <div class="title">
                                                    <p class="bold">References</p>
                                                </div>
                                                <ul>
                                                    @foreach ($resume->references as $reference)
                                                        <li>
                                                            <div class="data">
                                                                <p class="semi-bold">{{ $reference->name }}</p>
                                                                <p class="">
                                                                    <small>
                                                                        {{ $reference->designation }}
                                                                    </small>
                                                                </p>
                                                                <p class="">{{ $reference->phone }}</p>
                                                                <p class="">{{ $reference->email }}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="resume_right">
                                    <div class="resume_item resume_about">
                                        <div class="title">
                                            <p class="bold">About</p>
                                        </div>
                                        <p style="text-align: justify;">{{ $resume->summary }}</p>
                                    </div>

                                    @if ($resume->educations)
                                        <div class="resume_item resume_work">
                                            <div class="title">
                                                <p class="bold">Education</p>
                                            </div>
                                            <ul>
                                                @foreach ($resume->educations as $education)
                                                    <li>
                                                        <div class="date">
                                                            {{ \Carbon\Carbon::parse($education->start_date)->format('Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($education->end_date)->format('Y') }}
                                                        </div>
                                                        <div class="info">
                                                            <p class="semi-bold">{{ $education->institute }}</p>
                                                            <p>{{ $education->degree }} ({{ $education->study }})</p>
                                                            <p>{{ $education->grade }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($resume->achievements)
                                        <div class="resume_item resume_education">
                                            <div class="title">
                                                <p class="bold">Achievements</p>
                                            </div>
                                            <ul>
                                                @foreach ($resume->achievements as $achievement)
                                                    <li>
                                                        <div class="date fw-bold">{{ $achievement->name }}</div>
                                                        <div class="info">
                                                            <p class="semi-bold">
                                                                <a href="{{ $achievement->link }}" target="_blank"
                                                                    class="text-decoration-none">{{ $achievement->link }}</a>
                                                            </p>
                                                            <p>{{ $achievement->details }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($resume->interests)
                                        <div class="resume_item">
                                            <div class="title">
                                                <p class="bold">Interests</p>
                                            </div>
                                            <ul class="d-flex flex-wrap">
                                                @foreach ($resume->interests as $interest)
                                                    <li class="border alert m-1">{{ $interest->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($resume->languages)
                                        <div class="resume_item">
                                            <div class="title">
                                                <p class="bold">Language</p>
                                            </div>
                                            <ul class="d-flex flex-wrap">
                                                @foreach ($resume->languages as $language)
                                                    <li class="border alert m-1">{{ $language->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printResume() {
            // var originalContents = document.body.innerHTML;
            // var resumeBox = document.querySelector('.resume');
            // var resumeContent = resumeBox.innerHTML;

            // document.body.innerHTML = resumeContent;
            // window.print();
            // document.body.innerHTML = originalContents;

            var container = $('.resume').clone();
            var originalBody = $('body').html();

            $('body').empty();

            var printDiv = $('<div id="printDiv"></div>').appendTo('body');

            printDiv.append(container);
            window.print();

            $('body').html(originalBody);
        }
    </script>

@endsection

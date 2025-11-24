@extends('frontend.student.studentmaster')
@section('title', 'Profile')
@section('content')

    <div class="container mt-5">
        <div class="row qqq">
            <div class="col-md-12 text-center">
                <span class="text-uppercase" style="color:black">Upcoming</span>
                <h2 style="color:black" class="text-capitalize font-weight-bold">Live Classes</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($classes as $class)
                <div class="col-md-10 mx-auto my-4 stretch-card card">
                    <div class="d-flex align-items-center bg-light p-1 row quicktech-h">
                        <a style="font-size:20px;" href="{{ $class->link }}" target="_blank" class="stretched-link"></a>
                        <div class="text-center col-md-4">
                            <span style="color:black" class="d-block mb-3"
                                style="line-height: 0;color: #9b5de5">{{ \Carbon\Carbon::parse($class->scheduled_at)->format('A') }}</span>
                            <h2 style="color:black">{{ \Carbon\Carbon::parse($class->scheduled_at)->format('h:i') }}</h2>
                            <h3 style="color:black">{{ \Carbon\Carbon::parse($class->scheduled_at)->format('d M, Y') }}</h3>
                            @if ($class->duration)
                                <h5 style="color:black" class="mt-4"><i class="mdi mdi-clock-outline"></i> {{ $class->duration }}</h5>
                            @endif
                        </div>
                        <div class="col-md-8 ">
                            <div class="quicktech-dd d-flex justify-content-between my-3">
                                <h3 style="color:black" class="text-capitalize">{{ $class->name }}</h3>
                                <p style="z-index: 99; color:black;">
                                    <i class="mdi mdi-cube-outline"></i>
                                    <a href="/student/enrolled/course/{{ @$class->course->id }}">
                                        <span style="color:black" class="d-inline-block ml-2"
                                            style="color: black">{{ @$class->course->name }}</span>
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p style="color:black" class="my-2">{{ $class->description }}</p>
                               
                            </div>
                            <div class="d-flex justify-content-between align-items-center quicktech-ga">
                                <div> 
                                <img style="width: 70px;height: 70px;border: 5px solid #7d37ce"
                                    src="{{ asset(@$class->instructor->image ?? @$class->course->thumbnil_image) }}"
                                    alt="" class="rounded-circle my-3">
                                <p style="color:black" class="d-inline-block ml-2">{{ @$class->instructor->name }}</p>
                                </div>
                                <div>
                                    <a style="color: white; padding: 15px 14px; background-color:#7d37ce ; border-radius: 8px; font-size:14px;" href="#"> Click here to join the live class </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection

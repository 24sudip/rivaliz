@extends('frontend.student.studentmaster')
@section('title', 'Profile')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                  <div class="row">
            <div class="col-lg-12">
                  <div class="mt-2 text-end">
                                    <a style="background-color:#2B70B7;" href="{{ route('student.resume') }}" class="btn text-light">
                                        Generate Resume
                                    </a>
                                </div>
            </div>
        </div>
                <!-- Student Profile -->
                <div class="student-profile py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent text-center">
                                        <!--<img class="profile_img" src="{{ asset($profile->image) }}" alt="">-->
                                        <img class="profile_img" src="{{ $profile->image ? asset($profile->image) : 'https://learnengwithshahan.com/images/site/WhatsApp Image 2025-04-21 at 6.23.46 PM.jpeg' }}" alt="">
                                        <h3>{{ $profile->name }}</h3>
                                    </div>
                                    <div class="card-body overflow-auto">
                                        <p class="mb-0"><strong class="pr-1">Student ID:</strong> {{ $profile->id }}
                                        </p>
                                        <p class="mb-0"><strong class="pr-1">Phone:</strong> {{ $profile->phone }}</p>
                                        <p class="mb-0"><strong class="pr-1">E-mail:</strong> {{ $profile->email }}</p>
                                        <p class="mb-0"><strong class="pr-1">Address:</strong> {{ $profile->address }}
                                        </p>
                                    </div>
                                </div>

                                <div class="card shadow-sm mt-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>General Information
                                        </h3>
                                        <a href="{{ route('student.editprofile') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Edit</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">
                                        <table class="table">
                                            <tr>
                                                <th width="30%">Roll</th>
                                                <td width="2%">:</td>
                                                <td>125</td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Joined Year </th>
                                                <td width="2%">:</td>
                                                <td>{{ $profile->created_at->format('Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Gender</th>
                                                <td width="2%">:</td>
                                                <td>{{ $profile->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Religion</th>
                                                <td width="2%">:</td>
                                                <td>{{ $profile->religion }}</td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Blood</th>
                                                <td width="2%">:</td>
                                                <td>{{ $profile->blood }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                              
                            </div>
                            <div class="col-lg-8">


                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Resume Infos
                                        </h3>
                                        <a href="{{ route('student.editresume') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Edit</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                        <div>
                                            <h3 style="font-weight:bold;" >Title</h3>
                                            <h2>{{ $resume->title ?? '' }}</h2>
                                            <p>{{ $resume->designation ??'' }}
                                        </div>
                                        <hr>
                                        <div>
                                            <h3 style="color:black; font-weight:bolder;" >Summary</h3>
                                            <p>{{ $resume->summary ?? '' }}</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Educational Infos
                                        </h3>
                                        <a href="{{ route('student.educationcreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                        {{--<table class="table">
                                            <tr>
                                                <th>Degree</th>
                                                <th>Institute</th>
                                                <th>Department</th>
                                                <th>Grade</th>
                                                <th>Session</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($resume->educations as $education)
                                                <tr>
                                                    <td>{{ $education->degree }}</td>
                                                    <td>{{ $education->institute }}</td>
                                                    <td>{{ $education->study }}</td>
                                                    <td>{{ $education->grade }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($education->start_date)->format('M, Y') }}
                                                        - {{ \Carbon\Carbon::parse($education->end_date)->format('M, Y') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('student.educationedit', $education->id) }}">
                                                            <small><i class="fa fa-edit text-secondary"></i></small>
                                                        </a>
                                                    </td>
                                                </tr>
                                                
                                            @endforeach

                                        </table> --}}

                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i
                                                class="mdi mdi-content-duplicate pr-1"></i>Projects/Achievements
                                        </h3>
                                        <a href="{{ route('student.achievementcreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                         {{--  <table class="table">
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Achievement</th>
                                                <th>Details</th>
                                                <th>Link</th>
                                                <th></th>
                                            </tr>
                                         @foreach ($resume->achievements as $achievement)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $achievement->name }}</td>
                                                    <td>{{ $achievement->details }}</td>
                                                    <td>{{ $achievement->link }}</td>

                                                    <td>
                                                        <a href="{{ route('student.achievementedit', $achievement->id) }}">
                                                            <small><i class="fa fa-edit text-secondary"></i></small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach 

                                        </table>--}}

                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Skills
                                        </h3>
                                        <a href="{{ route('student.skillcreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                       {{-- @foreach ($resume->skills as $skill)
                                            <a href="{{ route('student.skilledit', $skill->id) }}"
                                                class="btn border-secondary m-1">
                                                {{ $skill->name }} <span
                                                    class="badge badge-light">{{ $skill->level }}%</span>
                                            </a>
                                        @endforeach --}}
                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Interests
                                        </h3>
                                        <a href="{{ route('student.interestcreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                      {{--  @foreach ($resume->interests as $interest)
                                            <a href="{{ route('student.interestedit', $interest->id) }}"
                                                class="btn border-secondary m-1">
                                                {{ $interest->name }}
                                            </a>
                                        @endforeach  --}}

                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Languages
                                        </h3>
                                        <a href="{{ route('student.languagecreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                           {{--   @foreach ($resume->languages as $language)
                                            <a href="{{ route('student.languageedit', $language->id) }}"
                                                class="btn border-secondary m-1">
                                                {{ $language->name }}
                                            </a>
                                        @endforeach  --}}
 
                                    </div>
                                </div>



                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>Social Accounts
                                        </h3>
                                        <a href="{{ route('student.socialcreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                          {{-- <table class="table">
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Name</th>
                                                <th>Link</th>
                                                <th>Icon</th>
                                                <th></th>
                                            </tr>
                                          @foreach ($resume->socials as $social)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $social->name }}</td>
                                                    <td>{{ $social->link }}</td>
                                                    <td>{{ $social->icon }}</td>

                                                    <td>
                                                        <a href="{{ route('student.socialedit', $social->id) }}">
                                                            <small><i class="fa fa-edit text-secondary"></i></small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach 

                                        </table>--}}

                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                        <h3 class="mb-0"><i class="mdi mdi-content-duplicate pr-1"></i>References
                                        </h3>
                                        <a href="{{ route('student.referencecreate') }}"
                                            class="btn btn-outline-primary py-2 px-4 border-secondary">Add</a>
                                    </div>
                                    <div class="card-body overflow-auto pt-0">

                                    {{--    <table class="table">
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Phone</th>
                                                <th>E-Mail</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($resume->references as $reference)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $reference->name }}</td>
                                                    <td>{{ $reference->designation }}</td>
                                                    <td>{{ $reference->phone }}</td>
                                                    <td>{{ $reference->email }}</td>

                                                    <td>
                                                        <a href="{{ route('student.referenceedit', $reference->id) }}">
                                                            <small><i class="fa fa-edit text-secondary"></i></small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>--}}

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@extends('frontend.student.studentmaster')
@section('title', 'Support Instructors')
@section('content')

<style>
@media (max-width: 576px) {
    .q-t{
        width:180% !important;
    }
}
  
</style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Your Instructors </h4>

                                <div class="table-responsive">
                                    <table class="table table-striped q-t">
                                        <thead>
                                            <tr>
                                                <th>
                                                    User
                                                </th>
                                                <th>
                                                    First name
                                                </th>
                                                <th>
                                                    Department
                                                </th>
                                                <th>
                                                    Profession
                                                </th>
                                                <th>
                                                    Institution
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($instructors as $instructor)
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="{{ asset($instructor->image) }}" alt="image" />
                                                    </td>
                                                    <td>
                                                        {{ $instructor->name }}
                                                    </td>
                                                    <td>
                                                        {{ $instructor->department }}
                                                    </td>
                                                    <td>
                                                        {{ $instructor->profession }}
                                                    </td>
                                                    <td>
                                                        {{ $instructor->institution }}
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

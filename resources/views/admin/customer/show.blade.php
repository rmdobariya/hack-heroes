@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'User Detail'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Details</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold">
                                <tr>
                                    <th class="fw-bold" scope="row">User Type</th>
                                    <td>{{ $user->user_type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th class="fw-bold" scope="row">Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                @if(!is_null($user->contact_no))
                                    <tr>
                                        <th class="fw-bold" scope="row">Contact Number</th>
                                        <td>{{ $user->contact_no }}</td>
                                    </tr>
                                @endif
                                @foreach($user_children as $key =>$children)
                                    <tr>
                                        <th class="fw-bold" scope="row">Children {{$key+1}}</th>
                                        <td>{{ $children->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-bold" scope="row">Created Plan For - {{$children->name}}</th>
                                        <td>{{ $children->is_plan == 1 ? 'Yes' : 'No' }}</td>
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
@endsection
@section('custom-script')

@endsection

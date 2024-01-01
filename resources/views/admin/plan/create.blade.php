@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Add Plan'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="0" name="edit_value">

                                <input type="hidden" id="form-method" value="add">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="title">
                                                Title
                                            </label>
                                            <input type="text" class="form-control form-control-solid" required
                                                   name="title"
                                                   id="title"
                                                   placeholder="Title"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="amount">
                                                Amount
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer" required
                                                   name="amount"
                                                   id="amount"
                                                   placeholder="Amount"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="start_date">
                                                Start Date
                                            </label>
                                            <input type="text" class="form-control form-control-solid date-picker" required
                                                   name="start_date"
                                                   id="start_date"
                                                   placeholder="Start Date"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="end_date">
                                                End Date
                                            </label>
                                            <input type="text" class="form-control form-control-solid date-picker" required
                                                   name="end_date"
                                                   id="end_date"
                                                   placeholder="End Date"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.plan.index') }}">
                                    <button class="btn btn-secondary" type="button">
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/plan'
        var redirect_url = '/plan'
    </script>

    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection

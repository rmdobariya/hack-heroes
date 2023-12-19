@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Subscription'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{$subscription->id}}" name="edit_value">

                                <input type="hidden" id="form-method" value="add">

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="title">
                                            Title
                                        </label>
                                        <input type="text" class="form-control form-control-solid" required
                                               name="title"
                                               id="title"
                                               value="{{$subscription->title}}"
                                               placeholder="Title"/>
                                    </div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"
                                              id="description">{{$subscription->description}}</textarea>
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="price">
                                            Price
                                        </label>
                                        <input type="text" class="form-control form-control-solid integer" required
                                               name="price"
                                               id="price"
                                               value="{{$subscription->price}}"
                                               placeholder="Price"/>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.subscription.index') }}">
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
        var form_url = '/subscription'
        var redirect_url = '/subscription'
    </script>

    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection

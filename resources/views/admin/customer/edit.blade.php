@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Edit Customer'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{$user->id}}" name="edit_value">

                                <input type="hidden" id="form-method" value="add">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2">Roles</label>
                                            <select class="form-select form-select-solid fw-bold" name="role_id"
                                                    id="role_id">
                                                <option value="">Select Option</option>
                                                @foreach($roles as $role)
                                                    <option
                                                        value="{{$role->id}}"
                                                        @if($user->user_type == strtolower($role->name)) selected @endif>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="contact_no">
                                                Contact No
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="contact_no"
                                                   id="contact_no"
                                                   value="{{$user->contact_no}}"
                                                   placeholder="Contact No"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="first_name">
                                                First Name
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="first_name"
                                                   id="first_name"
                                                   value="{{$user->name}}"
                                                   placeholder="First Name"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="last_name">
                                                Last Name
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="last_name"
                                                   id="last_name"
                                                   value="{{$user->last_name}}"
                                                   placeholder="Last Name"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="email">
                                                Email
                                            </label>
                                            <input type="email" class="form-control form-control-solid"
                                                   name="email"
                                                   id="email"
                                                   value="{{$user->email}}"
                                                   placeholder="Email"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="password">
                                                Password
                                            </label>
                                            <input type="password" class="form-control form-control-solid"
                                                   name="password"
                                                   id="password"
                                                   placeholder="Password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row @if($user->user_type != 'seller') d-none @endif"
                                     id="corporate_seller_part">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="is_corporate_seller">
                                                Corporate Seller
                                            </label>
                                            <input type="checkbox" class="form-check"
                                                   name="is_corporate_seller"
                                                   value="0"
                                                   id="is_corporate_seller"
                                                   @if($user->is_corporate_seller == 1) checked @endif/>
                                        </div>
                                    </div>
                                </div>
                                @if(count($user_children) > 0)
                                    <div class="col-12">
                                        @foreach($user_children as $key =>$child)
                                            <div class="row child_part" id="child_part_{{$key}}">
                                                <div class="mb-3 col-md-6">
                                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                                        <label class="required fs-6 fw-bold mb-2" for="child_name">
                                                            Child Name
                                                        </label>
                                                        <input type="text" class="form-control form-control-solid"
                                                               name="child_name[{{$key}}]"
                                                               id="child_name[{{$key}}]"
                                                               value="{{$child->name}}"
                                                               placeholder="Child Name"/>
                                                    </div>
                                                </div>
                                                @if($key === 0)
                                                    <div class="col-md-6 mt-8">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <button type="button" id="add_child"
                                                                    class="btn btn-primary">
                                                                Add
                                                            </button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-6 mt-8">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <button type="button" class="btn btn-danger"
                                                                    onclick="deleteRow({{$key}})">Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-12">
                                        <div class="row child_part" id="child_part_1">
                                            <div class="mb-3 col-md-6">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label class="required fs-6 fw-bold mb-2" for="child_name">
                                                        Child Name
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="child_name[1]"
                                                           id="child_name[1]"
                                                           placeholder="Child Name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-8">
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <button type="button" id="add_child" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.customer.index') }}">
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
        var form_url = '/customer'
        var redirect_url = '/customer'
    </script>
    <script>
        $('#role_id').on('change', function () {
            var val = $(this).val();
            if (val == 11) {
                $('#corporate_seller_part').removeClass('d-none')
                $('#is_corporate_seller').val(1)
            } else {
                $('#corporate_seller_part').addClass('d-none')
                $('#is_corporate_seller').val(0)
            }
        })
        function deleteRow(rowNo) {
            $('#child_part_' + rowNo).remove()

        }
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection

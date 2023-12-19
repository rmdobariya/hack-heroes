@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Subscriptions'])
{{--                @include('admin.layouts2.components.create-button',['url'=>route('admin.subscription.create')])--}}
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="d-flex justify-content-end align-items-center d-none"
                             data-kt-customer-table-toolbar="selected" id="select_delete_btn">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"
                                      id="selected_count"></span> Selected
                            </div>

                            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected"
                                    id="multiple_record_delete">
                                Delete Selected
                            </button>
                        </div>
                        {{--                        @include('admin.layouts2.components.status-active-inactive')--}}
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                            <thead>
                            <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
{{--                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label=""--}}
{{--                                    style="width: 29.8906px;">--}}
{{--                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">--}}
{{--                                        <input class="form-check-input" id="all_selected" type="checkbox" value="">--}}
{{--                                    </div>--}}
{{--                                </th>--}}
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        const sweetalert_delete_title = "Subscription Delete?"
        const sweetalert_delete_text = "Are You Sure Delete This Subscription"
        const cancel_button_text = "Cancel"
        const delete_button_text = "Delete"
        const sweetalert_change_status = "Subscription Status Change"
        const sweetalert_change_status_text = "Are You Sure Status Change This Record"
        const yes_change_it = "Yes"
        const form_url = '/subscription'
        const datatable_url = '/get-subscription-list'
        var arr = [];
        const multiple_select_title = "Selected Page Delete ?"
        const multiple_select_text = "Are You Sure Selected Record Delete"
        const multiple_delete_url = '/multiple-subscription-delete'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'price', name: 'price'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection

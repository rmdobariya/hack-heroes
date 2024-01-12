@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Contact Us'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('admin.layouts2.components.search-text-box',['search_place_holder'=>'Search Contact Us'])
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                            class="path2"></span></i> Filter
                                </button>
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                     id="kt-toolbar-filter">
                                    <div class="px-7 py-5">
                                        <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fs-5 fw-semibold mb-3">Filter</label>
                                            <div class="d-flex flex-column flex-wrap fw-semibold"
                                                 data-kt-customer-table-filter="payment_type">
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                    <input class="form-check-input" type="checkbox" name="deleted_at" id="deleted_at">
                                                    <span class="form-check-label text-gray-600">Deleted Record </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset"
                                                    id="reset-filter">
                                                Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary" id="filter"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-customer-table-filter="filter">Apply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label=""
                                    style="width: 29.8906px;">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" id="all_selected" type="checkbox" value="">
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
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
        const sweetalert_delete_title = "Contact Us Delete?"
        const sweetalert_delete_text = "Are You Sure Delete This Contact Us"
        const cancel_button_text = "Cancel"
        const delete_button_text = "Delete"
        const sweetalert_change_status = "Contact Us Status Change"
        const sweetalert_change_status_text = "Are You Sure Status Change This Record"
        const yes_change_it = "Yes"
        const form_url = '/contact-us'
        const datatable_url = '/get-contact-us-list'
        var arr = [];
        const multiple_select_title = "Selected Contact Us Delete ?"
        const multiple_select_text = "Are You Sure Selected Record Delete"
        const multiple_delete_url = '/multiple-contact-us-delete'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'check', name: 'check', orderable: false, searchable: false},
                {data: 'name', name: 'contact_us.name'},
                {data: 'email', name: 'contact_us.email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection

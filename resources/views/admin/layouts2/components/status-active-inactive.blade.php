<div class="card-toolbar">
    <div class="w-100 mw-150px">
        <select class="form-select form-select-solid status-filter min-w-100px"
                id="status"
                data-control="select2"
                data-hide-search="true"
                data-placeholder="Status"
                data-kt-ecommerce-product-filter="{{ trans('vendor_string.common_status') }}">
            <option></option>
            <option value="all">{{ trans('vendor_string.all') }}</option>
            <option value="active">{{ trans('vendor_string.common_status_active') }}</option>
            <option value="inActive">{{ trans('vendor_string.common_status_inActive') }}</option>
        </select>
    </div>
</div>

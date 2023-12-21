<div class="row child_part" id="child_part_{{$rowNo}}">
    <div class="mb-3 col-md-6">
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fs-6 fw-bold mb-2" for="child_name">
                Child Name
            </label>
            <input type="text" class="form-control form-control-solid"
                   name="child_name[{{$rowNo}}]"
                   id="child_name[{{$rowNo}}]"
                   placeholder="Child Name" required/>
        </div>
    </div>
    <div class="col-md-6 mt-8">
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <button type="button" class="btn btn-danger" onclick="deleteRow({{$rowNo}})">Remove</button>
        </div>
    </div>
</div>

<script>
    function deleteRow(rowNo) {
        $('#child_part_' + rowNo).remove()

    }
</script>

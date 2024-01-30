<div class="sec-add-child">
    <div class="input-box attribute-row attribute-row-{{$rowNo}}">
        <div class="form-check">
            <?php /*
        <div class="input-group">
            <input class="form-check-input me-2" type="checkbox" name="create_plan[{{$rowNo}}]" id="create_plan_{{$rowNo}}">
            <label class="form-check-label" for="create_plan_{{$rowNo}}"></label>
            <input type="text" name="child[{{$rowNo}}]" class="child-name form-control mb-0" value="" style="border: none;" required>            
            <select name="gender[{{$rowNo}}]" class="form-control mb-0">
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
                <option value="intersex">Intersex</option>
            </select>
        </div> */ ?>

            <input class="form-check-input me-2 p-0" type="checkbox" name="create_plan[{{$rowNo}}]" id="create_plan_{{$rowNo}}" checked>
            <input type="text" name="child[{{$rowNo}}]" class="child-name form-control mb-0 p-0" value="" placeholder="Child’s Name" style="border: none;">
        </div>
    </div>
    <select name="gender[{{$rowNo}}]" class="form-control child-sex with-arrow">
        <option value="">Child's sex</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="intersex">Intersex</option>
    </select>
</div>
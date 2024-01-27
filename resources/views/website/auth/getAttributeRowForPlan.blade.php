<div class="input-box attribute-row attribute-row-{{$rowNo}}">
    <div class="form-check">        
        <div class="input-group">
            <input class="form-check-input me-2" type="checkbox" name="create_plan[{{$rowNo}}]" id="create_plan_{{$rowNo}}">
            <label class="form-check-label" for="create_plan_{{$rowNo}}"></label>
            <input type="text" name="child[{{$rowNo}}]" class="child-name form-control mb-0" value="" style="border: none;" required>            
            <select name="gender[{{$rowNo}}]" class="form-control mb-0">
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
                <option value="intersex">Intersex</option>
            </select>
        </div>
    </div>
</div>
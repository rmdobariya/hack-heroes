{{--<input type="text" name="name[{{$rowNo}}]"  placeholder="Child’s Name"--}}
{{--       class="form-control attribute-row-{{$rowNo}}" required>--}}
<div class="input-group mb-3">
    <input type="text" name="name[{{$rowNo}}]" placeholder="Child’s Name"
           class="form-control child-name attribute-row-{{$rowNo}}"
           value="">
    <select name="gender[{{$rowNo}}]" class="form-control">
        <option value="male" selected>Male</option>
        <option value="female">Female</option>
        <option value="intersex">Intersex</option>        
    </select>
</div>

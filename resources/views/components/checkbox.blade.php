<label for="{{$field}}">{{$label}}</label>
<input name="{{$field}}"
       value="1"
       id="{{$field}}"
       type="checkbox"
       checked="{{$checked ? "checked":""}}">
@error("$field")
<span class="text-danger">{{$message}}</span>
@enderror

<label>{{$label}}</label>
<textarea  class="form-control"
           name="{{$field}}"
           placeholder="{{$placeholder}}"
           cols="20" rows="5">{{old("$field", "$value")}}</textarea>
@error("$field")
<span class="text-danger">{{$message}}</span>
@enderror

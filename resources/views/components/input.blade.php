<label for="{{$field}}">{{$label}}</label>
<input type="{{$type}}"
       class="form-control"
       name="{{$field}}"
       value="{{$value}}"
       id="{{$field}}"
       placeholder="{{$placeholder}}">
@error("$field")
<span class="text-danger">{{$message}}</span>
@enderror

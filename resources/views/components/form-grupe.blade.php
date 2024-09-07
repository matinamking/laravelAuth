@php
    $value = $value ?? "" ;
    $attributes = $attributes ?? "required" ;
    $type = $type ?? "text";
@endphp
<div class="form-group">
    <label for="{{$id}}">{{$title}}</label>
    <input name="{{$name}}" type="{{$type}}" class="form-control" id="{{$id}}" value="{{$value}}" {{$attributes}}>
</div>

@php
    $class= $class ?? "btn btn-success mb-3";
@endphp
<button class="{{$class}}" data-toggle="modal" data-target="{{$id}}">
    {{$value}}
</button>

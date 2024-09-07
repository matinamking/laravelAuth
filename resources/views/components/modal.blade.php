@php
    $actionValue = $actionValue ?? [];
@endphp

<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route($action,$actionValue)}}" method="POST">
                    @csrf
                    {{$slot}}
                    <button type="submit" class="btn btn-primary">{{$name}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


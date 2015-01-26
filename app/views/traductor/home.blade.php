@extends('traductor.template.master')
@section ('content')
<section>
    <div class="welcome">
        @if($bolFirstSession)
            trad nuevo
        @else
            trad old
        @endif
    </div>
</section>
@stop

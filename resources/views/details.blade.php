@extends('layouts.frontend')

@section('title', '| Laravel - ' . $object->name)

@section('content')

    <div class="row">
        <div class="col-md-3">
            @include('includes.categories')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $object->name }}</div>

                <div class="panel-body">
                    <p>{{ $object->description }}</p>
                    <hr>
                    <p>{{ $object->price }} {{ $object->currency->symbol }}</p>
                    <hr>

                    @if (!is_null($object->weight))
                        <p>Weight - {{ $object->weight }}</p>
                        <hr>
                    @endif
                    @if (!is_null($object->type_id))
                        <p>Type - {{ $object->type->name }}</p>
                        <hr>
                    @endif

                    @if (!empty($object->photos))
                        <div class="row">
                            @foreach($object->photos as $key => $photo)
                                <div class="col-md-6">
                                    <img src="/images/{{ $photo->name }}">
                                </div>
                                @if (($key+1) % 2 == 0)
                                    <div class="clearfix"></div>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </div>

@endsection
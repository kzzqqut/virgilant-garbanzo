@extends('layouts.frontend')

@section('title', '| Laravel objects list')

@section('content')

    <div class="row">
        <div class="col-md-3">
            @include('includes.categories')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">List of objects</div>

                <div class="panel-body">

                    @if (!empty($objects))
                        @foreach($objects as $key => $object)
                            <div class="col-md-3">
                                @if (!empty($object->mainPhoto))
                                    <a href="{{ route('details',['id' => $object->id]) }}">
                                        <img src="/images/{{ $object->mainPhoto->th_name }}">
                                    </a>
                                @else
                                    <p>No photo</p>
                                @endif
                                <p><a href="{{ route('details',['id' => $object->id]) }}">{{ $object->name }}</a></p>
                            </div>
                            @if ($key != 0 && ($key+1)%4 == 0)
                                <div class="clearfix"></div>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    {{ $objects->links() }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
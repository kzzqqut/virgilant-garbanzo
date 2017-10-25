@extends('layouts.backend')

@section('title','| Object')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of objects</div>

                <div class="panel-body">

                    @if (!empty($objects) && count($objects) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Photo</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($objects as $object)
                                    <tr>
                                        <td>{{ $object->name }}</td>
                                        <td class="small">{{ $object->mainCategory->name }} - {{ $object->category->name }} - {{ $object->subcategory->name }}</td>
                                        <td>
                                            @if (!empty($object->mainPhoto))
                                                <img src="/images/{{ $object->mainPhoto->th_name }}">
                                            @else
                                                No photo
                                            @endif
                                        </td>
                                        <td>{{ $object->description }}</td>
                                        <td>{{ $object->price }} {{ $object->currency->symbol }}</td>
                                        <td>{{ $object->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('objects.manage',['id' => $object->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['objects.destroy', $object->id] ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">{{ $objects->links() }}</div>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('title', '| Edit Category')

@section('content')

    <div class='row'>
        <div class="col-md-6">
            <h1> Edit {{$category->name}}</h1>
            <hr>

            {{ Form::model($category, array('route' => array('categories.update', $category->id), 'method' => 'PUT')) }}
            {{-- Form model binding to automatically populate our fields with user data --}}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent category') }}
                {{ Form::select('parent_id',[
                    '0' => 'none',
                    '1' => 'Main',
                    'main' => $main,
                    '2' => 'Default',
                    'default' => $default,
                    ],null, ['class' => 'form-control'])
                }}
            </div>

            {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection
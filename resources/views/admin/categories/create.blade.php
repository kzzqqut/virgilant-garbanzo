@extends('layouts.app')

@section('title', '| Add Category')

@section('content')

    <div class='row'>
        <div class="col-md-6">
            <h1>Add Category</h1>

            {{ Form::open(array('url' => 'categories')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', '', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent category') }}
                {{ Form::select('parent_id',[
                    '1' => 'Main',
                    'main' => $main,
                    '2' => 'Default',
                    'default' => $default,
                    ],null, ['class' => 'form-control'])
                }}
            </div>

            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection
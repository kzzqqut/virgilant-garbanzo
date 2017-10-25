@extends('layouts.app')

@section('title', '| Add Category')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1>Add Category</h1>

        {{ Form::open(array('url' => 'categories')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('parent_category', 'Parent category') }}
            {{ Form::select('parent_category',[
                '1' => 'Main',
                'main' => $main,
                '2' => 'Default',
                'default' => $default,
                ])
            }}
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection
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
                {{ Form::label('parent_id', 'Parent category',['class' => 'control-label']) }}
                <select class="form-control" name="parent_id">
                    <option value="0">none</option>
                        @foreach ($categories as $category)
                            @include('admin.partials.category_select', $category)
                        @endforeach
                </select>
            </div>

            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection
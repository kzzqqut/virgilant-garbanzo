@extends('layouts.app')

@section('title', '| Add Category')

@section('content')

    <div class='row'>
        <div class="col-md-9">
            <h3>Add Category</h3>

            {{ Form::open(array('url' => 'categories','class' => 'form-horizontal')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name',['class' => 'control-label col-md-3']) }}
                <div class="col-md-9">
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent category',['class' => 'control-label col-md-3']) }}
                <div class="col-md-9">
                    <select class="form-control" name="parent_id">
                        <option value="0">none</option>
                            @foreach ($categories as $category)
                                @include('admin.partials.category_select', $category)
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    @include('admin.categories.options')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
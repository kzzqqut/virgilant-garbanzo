@extends('layouts.app')

@section('title', '| Edit Category')

@section('content')

    <div class='row'>
        <div class="col-md-6">
            <h3> Edit {{$categoryData->name}}</h3>
            <hr>

            {{ Form::model($categoryData, array('route' => array('categories.update', $categoryData->id), 'method' => 'PUT','class' => 'form-horizontal')) }}
            {{-- Form model binding to automatically populate our fields with user data --}}

            <div class="form-group">
                {{ Form::label('name', 'Name',['class' => 'control-label col-md-3']) }}
                <div class="col-md-9">
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent category',['class' => 'control-label col-md-3']) }}
                <div class="col-md-9">
                    <select class="form-control" name="parent_id">
                        <option value="0">none</option>
                            @foreach ($categories as $category)
                                @include('admin.partials.category_select', ['category' => $category,'categoryData' => $categoryData])
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    @include('admin.categories.options',['options' => $categoryData->options])
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
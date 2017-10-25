@extends('layouts.app')

@section('title', '| Edit Category')

@section('content')

    <div class='row'>
        <div class="col-md-6">
            <h1> Edit {{$categoryData->name}}</h1>
            <hr>

            {{ Form::model($categoryData, array('route' => array('categories.update', $categoryData->id), 'method' => 'PUT')) }}
            {{-- Form model binding to automatically populate our fields with user data --}}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('parent_id', 'Parent category',['class' => 'control-label']) }}
                <select class="form-control" name="parent_id">
                    <option value="0">none</option>
                    @foreach ($categories as $category)
                        @include('admin.partials.category_select', ['category' => $category,'categoryData' => $categoryData])
                    @endforeach
                </select>
            </div>

            {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection
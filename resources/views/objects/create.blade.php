@extends('layouts.backend')

@section('title','| New object')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create new object</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('objects.category') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3" for="main">Chose main category</label>
                            <div class="col-md-6">
                                <select size="10" class="form-control" name="main">
                                    @foreach( \App\Categories::where('type','main')->get() as $mainCategory)
                                        <option {{ !empty(session('main') && session('main') == $mainCategory->id) ? 'selected' : '' }} value="{{ $mainCategory->id }}"> {{ $mainCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if (!empty($categories))
                            <div class="form-group">
                                <label class="control-label col-md-3" for="category">Chose category</label>
                                <div class="col-md-6">
                                    <select size="10" class="form-control" name="category">
                                        @foreach( $categories as $category)
                                            <option {{ !empty(session('category') && session('category') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-9 pull-right">
                                <button type="submit" class="btn btn-primary">Chose</button>
                            </div>
                        </div>
                    </form>

                    {{ Form::open(array('url' => 'objects','class' => 'form-horizontal')) }}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', 'Name',['class' => 'control-label col-md-3','for' => 'name']) }}
                        <div class="col-md-6">
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        {{ Form::label('description', 'Description',['class' => 'control-label col-md-3','for' => 'description']) }}
                        <div class="col-md-6">
                            {{ Form::textarea('description', '', array('class' => 'form-control')) }}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                        {{ Form::label('price', 'Price',['class' => 'control-label col-md-3','for' => 'price']) }}
                        <div class="col-md-6">
                            {{ Form::text('price', '', array('class' => 'form-control')) }}
                            @if ($errors->has('price'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('currency_id') ? ' has-error' : '' }}">
                        {{ Form::label('currency_id', 'Price',['class' => 'control-label col-md-3','for' => 'currency_id']) }}
                        <div class="col-md-6">
                            {{ Form::select('currency_id', $currencies, null, ['class' => 'form-control']) }}
                            @if ($errors->has('currency_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('currency_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 pull-right">
                            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
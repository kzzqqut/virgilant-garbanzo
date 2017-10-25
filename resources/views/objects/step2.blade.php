@extends('layouts.backend')

@section('title','| New object')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create new object</div>

                <div class="panel-body">

                    <form action="{{ route('objects.post.step2') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="description">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="price">Price</label>
                            <div class="col-md-6">
                                <input type="text" name="price" value="" class="form-control">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('currency_id') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="currency_id">Currency</label>
                            <div class="col-md-6">
                                <select name="currency_id" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>

                    <form action="{{ route('objects.post.step2') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="description">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="price">Price</label>
                            <div class="col-md-6">
                                <input type="text" name="price" value="" class="form-control">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('currency_id') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="currency_id">Currency</label>
                            <div class="col-md-6">
                                <select name="currency_id" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
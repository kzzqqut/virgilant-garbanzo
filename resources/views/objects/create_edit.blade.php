@extends('layouts.backend')

@section('title','| Object')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create new object</div>

                <div class="panel-body">

                    <form class="form-horizontal" action="{{ route('objects.post.category') }}" method="post">
                        {{ csrf_field() }}

                        @if (!empty($mainCategory))
                            <p>
                                Selected main category - {{ $mainCategory->name }}
                                <a href="{{ route('objects.category.change',['type' => 'main']) }}">Change</a>
                            </p>
                        @else
                            <div class="form-group">
                                <label class="control-label col-md-3" for="main">Chose main category</label>
                                <div class="col-md-6">
                                    <select size="10" class="form-control" name="main">
                                        @foreach( \App\Categories::where('type','main')->get() as $main)
                                            <option value="{{ $main->id }}"> {{ $main->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if (!empty($category))
                            <p>
                                Category selected - {{ $category->name }}
                                <a href="{{ route('objects.category.change',['type' => 'category']) }}">Change</a>
                            </p>
                        @elseif(!empty($mainCategory->id))
                            <div class="form-group">
                                <label class="control-label col-md-3" for="category">Chose category</label>
                                <div class="col-md-6">
                                    <select size="10" class="form-control" name="category">
                                        @foreach( \App\Categories::where('parent_id', $mainCategory->id)->get() as $cat)
                                            <option value="{{ $cat->id }}"> {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif


                        @if (!empty($subcategory))
                            <p>
                                Subcategory selected - {{ $subcategory->name }}
                                <a href="{{ route('objects.category.change',['type' => 'subcategory']) }}">Change</a>
                            </p>
                        @elseif (!empty($category))
                            <div class="form-group">
                                <label class="control-label col-md-3" for="subcategory">Chose category</label>
                                <div class="col-md-6">
                                    <select size="10" class="form-control" name="subcategory">
                                        @foreach( \App\Categories::where('parent_id', $category->id)->get() as $subcat)
                                            <option value="{{ $subcat->id }}"> {{ $subcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if (empty($subcategory))
                            <div class="form-group">
                                <div class="col-md-9 pull-right">
                                    <button type="submit" class="btn btn-primary">Chose</button>
                                </div>
                            </div>
                        @endif
                    </form>

                    <form method="post" action="{{ !empty($object->id) ? route('objects.post.manage',['id' => $object->id]) : route('objects.post.manage') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ !empty($object->name) ? $object->name : '' }}" class="form-control">
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
                                <textarea class="form-control" name="description">{{ !empty($object->description) ? $object->description : '' }}</textarea>
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
                                <input type="text" name="price" value="{{ !empty($object->price) ? $object->price : '' }}" class="form-control">
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
                                        <option {{ !empty($object->currency_id) && $object->currency_id == $currency->id ? 'selected' : '' }} value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('currency_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label" for="photo">Photos</label>
                            <div class="col-md-6">
                                <input type="file" name="photo[]" multiple>
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if (!empty($object->photos) && count($object->photos) > 0)
                            @foreach($object->photos as $photo)
                                <img src="/images/{{ $photo->th_name }}"> <a href="{{ route('objects.photo.remove',['id' => $photo->id]) }}" class="btn-sm">Remove</a>
                            @endforeach
                        @endif


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
@extends('layouts.backend')

@section('title','| Object')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create new object</div>

                <div class="panel-body">

                    <form class="form-horizontal" action="{{ route('objects.post.step1') }}" method="post">
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
                        @else
                            <div class="form-group">
                                <div class="col-md-9 pull-right">
                                    <a href="{{ route('objects.step2') }}" class="btt btn-primary">Next</a>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
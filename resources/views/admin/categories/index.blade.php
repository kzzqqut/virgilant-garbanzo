@extends('layouts.app')

@section('title', '| Categories')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Categories Administration</h1>
            <a href="{{ route('categories.create') }}">Create category</a>
            <hr>
            <div class="tree">
                @if (count($categories) > 0)
                    <ul>
                        @foreach ($categories as $category)
                            @include('admin.partials.category', $category)
                        @endforeach
                    </ul>
                @else
                    @include('admin.partials.categories-none')
                @endif
            </div>
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('title', '| Categories')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1>Categories Administration</h1>
        <a href="{{ route('categories.create') }}">Create category</a>
        <hr>
        <nav class="nav-tabs">
            @if (count($categories) > 0)
                <ul>
                    @foreach ($categories as $category)
                        @include('admin.partials.category', $category)
                    @endforeach
                </ul>
            @else
                @include('admin.partials.categories-none')
            @endif
        </nav>

    </div>

@endsection
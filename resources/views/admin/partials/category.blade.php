<li>{{ $category['name'] }}
    <a href="{{ route('categories.edit',['id' => $category['id']]) }}" class="btn btn-sm">Edit</a>
    @if ($category['parent_id'] != 0)
        {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category['id']] ]) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-sm']) !!}
        {!! Form::close() !!}
    @endif
</li>

@if (!empty($category['children']) && count($category['children']) > 0)
    <ul>
        @foreach($category['children'] as $category)
            @include('admin.partials.category', $category)
        @endforeach
    </ul>
@endif
<li>{{ $category['name'] }}

    @if ($category['parent_id'] != 0)
        <a href="{{ route('categories.edit',['id' => $category['id']]) }}" class="btn btn-sm">Edit</a>

        {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category['id']], 'style' => 'display:inline' ]) !!}
        {!! Form::submit('Delete', ['class' => 'btn-sm btn-link']) !!}
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
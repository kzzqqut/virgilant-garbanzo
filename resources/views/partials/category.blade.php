<li>
    <a href="{{ route('index',['cat' => $category['id']]) }}">{{ $category['name'] }}</a>
</li>

@if (!empty($category['children']) && count($category['children']) > 0)
    <ul>
        @foreach($category['children'] as $category)
            @include('partials.category', $category)
        @endforeach
    </ul>
@endif
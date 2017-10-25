<option value="{{ $category['id'] }}" {{ ( !empty($categoryData) && $category['id'] == $categoryData->parent_id) ? 'selected' :'' }}> {{ $category['name'] }}</option>

@if (!empty($category['children']) && count($category['children']) > 0)
    <optgroup label="{{ $category['name'] }} - childs">
        @foreach($category['children'] as $category)
            @include('admin.partials.category_select', $category)
        @endforeach
    </optgroup>
@endif
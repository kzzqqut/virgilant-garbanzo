<div class="panel panel-default">
    <div class="panel-heading">Categories</div>

    <div class="panel-body">
        <ul class="nav nav-list">
            @foreach(\App\Categories::categoriesTree(\App\Categories::all()->toArray()) as $category)
                @include('partials.category', $category)
            @endforeach
        </ul>
    </div>
</div>
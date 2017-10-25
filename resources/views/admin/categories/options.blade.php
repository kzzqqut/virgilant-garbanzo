@foreach(config('custom.options') as $key => $name)
    <input type="checkbox" name="options[{{ $key }}]" {{ !empty($options) && !empty($options->{$key}) ? 'checked' : '' }}> {{ $name }}
    <hr>
@endforeach
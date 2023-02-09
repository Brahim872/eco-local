@if ($errors->has($name??''))
    <small id="name-error"  class="{{$errors->has('first_name') ? 'text-red-400' : ''}}">{{ $errors->first($name??'') }}</small>
@endif

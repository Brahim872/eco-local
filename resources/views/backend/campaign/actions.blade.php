
<div class="flex">
    <a  href="{{route($prefixName.'.edit',$rows['hide_slug'])}}">
        <x-icons.edit />
    </a>

    <button  onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
        <x-icons.delete />
    </button>
</div>

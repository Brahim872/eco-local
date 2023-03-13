<x-admin.wrapper>
    <x-slot name="title">
        <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
            Update permission
        </h2>

    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <form method="POST" action="{{ route('permission.update', $permission->id) }}">
        @csrf
        @method('PUT')

            <div class="py-2">
            <x-admin.form.label for="name" class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('Name') }}</x-admin.form.label>

            <x-admin.form.input id="name" class="{{$errors->has('name') ? 'border-red-400' : ''}}"
                                type="text"
                                name="name"
                                value="{{ old('name', $permission->name) }}"
                                />
            </div>

            <div class="flex justify-end mt-4">
                <x-admin.form.button>{{ __('Update') }}</x-admin.form.button>
            </div>
        </form>
    </div>
</x-admin.wrapper>

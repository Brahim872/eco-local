<x-admin.wrapper>
    <x-slot name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                {{ __('Create product') }}
            </h2>
        </div>
    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="py-2">

                <x-admin.form.image id="image" class="{{$errors->has('image') ? 'border-red-400' : ''}} w-[50%]"
                                    name="image"
                                    accept="image/*"

                                    value="{{ old('image') }}"
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="name"
                                    class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('name') }}</x-admin.form.label>

                <x-admin.form.input id="name" class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"></x-admin.form.input>
            </div>


            <div class="py-2">
                <x-admin.form.label for="description"
                                    class="{{$errors->has('description') ? 'text-red-400' : ''}}">{{ __('description') }}</x-admin.form.label>

                <x-admin.form.input id="description" class="{{$errors->has('description') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="description"
                                    value="{{ old('description') }}"></x-admin.form.input>
            </div>



            <div class="flex justify-start mt-4">
                <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush
</x-admin.wrapper>

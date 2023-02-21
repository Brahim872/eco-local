<x-admin.wrapper>
    <x-slot name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                {{ __('Create company') }}
            </h2>
        </div>
    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="py-2">

                <x-admin.form.image id="image" class="{{$errors->has('image') ? 'border-red-400' : ''}} w-[50%]"
                                    name="image"
                                    accept="image/*"

                                    value="{{ old('image') }}"
                />
            </div>
{{--            users--}}
            <div class="py-2">
                <x-admin.form.label for="user_id"
                                    class="block font-medium text-sm text-gray-700{{$errors->has('user_id') ? 'text-red-400' : ''}}">{{ __('user_id') }}</x-admin.form.label>

                <x-admin.form.select id="user_id"
                                     class="{{$errors->has('user_id') ? 'border-red-400' : ''}} w-[50%]"
                                     type="text"
                                     name="user_id"
                >
                    <option value="">---</option>
                    @foreach($users as $id=>$user)
                        <option value="{{$id}}">{{$user}}</option>
                    @endforeach
                </x-admin.form.select>
                <x-admin.form.error-field name="user_id"/>

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
                <x-admin.form.label for="website"
                                    class="{{$errors->has('website') ? 'text-red-400' : ''}}">{{ __('website') }}</x-admin.form.label>

                <x-admin.form.input id="website" class="{{$errors->has('website') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="website"
                                    value="{{ old('website') }}"
                />
            </div>

            <div class="flex justify-end mt-4">
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

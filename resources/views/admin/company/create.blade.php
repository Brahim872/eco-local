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

            <div class="py-2">
                <x-admin.form.label for="name"
                                    class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('name') }}</x-admin.form.label>

                <x-admin.form.input id="name" class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"></x-admin.form.input>
            </div>

            <div class="py-2">
                <x-admin.form.label for="email"
                                    class="{{$errors->has('email') ? 'text-red-400' : ''}}">{{ __('Email') }}</x-admin.form.label>

                <x-admin.form.input id="email" class="{{$errors->has('email') ? 'border-red-400' : ''}} w-[50%]"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="address"
                                    class="{{$errors->has('address') ? 'text-red-400' : ''}}">{{ __('address') }}</x-admin.form.label>

                <x-admin.form.input id="address" class="{{$errors->has('address') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="address"
                                    value="{{ old('address') }}"
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="phone"
                                    class="{{$errors->has('phone') ? 'text-red-400' : ''}}">{{ __('phone') }}</x-admin.form.label>

                <x-admin.form.input id="phone" class="{{$errors->has('phone') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                />
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

            <div class="py-2">
                <x-admin.form.label for="password"
                                    class="{{$errors->has('password') ? 'text-red-400' : ''}}">{{ __('Password') }}</x-admin.form.label>

                <x-admin.form.input id="password" class="{{$errors->has('password') ? 'border-red-400' : ''}} w-[50%]"
                                    type="password"
                                    name="password"
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="password_confirmation"
                                    class="block font-medium text-sm text-gray-700{{$errors->has('password') ? 'text-red-400' : ''}}">{{ __('Password Confirmation') }}</x-admin.form.label>

                <x-admin.form.input id="password_confirmation"
                                    class="{{$errors->has('password') ? 'border-red-400' : ''}} w-[50%]"
                                    type="password"
                                    name="password_confirmation"
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

<x-admin.wrapper>
    <x-slot name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                {{ __('Create campaign') }}
            </h2>
        </div>
    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <form method="POST" action="{{ route('campaign.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="py-2">
                <x-admin.form.label for="title"
                                    class="{{$errors->has('title') ? 'text-red-400' : ''}}">{{ __('title') }}</x-admin.form.label>

                <x-admin.form.input id="title" class="{{$errors->has('title') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"></x-admin.form.input>
                <x-admin.form.error-field name="title"/>

            </div>

            <div class="py-2">
                <x-admin.form.label for="subject"
                                    class="block font-medium text-sm text-gray-700 {{$errors->has('subject') ? 'text-red-400' : ''}}">{{ __('subject') }}</x-admin.form.label>

                <x-admin.form.input id="subject"
                                    class="{{$errors->has('subject') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="subject"
                />
                <x-admin.form.error-field name="subject"/>
            </div>

            <div class="py-2">
                <x-admin.form.label for="message"
                                    class="block font-medium text-sm text-gray-700 {{$errors->has('message') ? 'text-red-400' : ''}}">{{ __('message') }}</x-admin.form.label>

                <x-admin.form.input id="subject"
                                    class="{{$errors->has('message') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="message"
                />
                <x-admin.form.error-field name="subject"/>
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

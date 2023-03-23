<x-admin.wrapper>
    <x-slot name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                {{ __('Create company') }}
            </h2>
        </div>
    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <form method="POST" action="{{ $action??'' }}" enctype="multipart/form-data">
            @csrf

            <div class="py-2">
                @if(isset($model->profile))
                    <input type="hidden" name="profile" value="{{$model->profile}}">
                @endif
                <x-admin.form.image id="image" class="{{$errors->has('image') ? 'border-red-400' : ''}} "
                                    name="image"
                                    accept="image/*"
                                    src="{{isset($model->profile)? asset('storage/'.$model->profile) : old('profile') }}"
                                    value="{{isset($model->profile)? $model->profile : old('profile') }}"
                />
            </div>

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
                        <option value="{{$id}}" @if(isset($model->user_id) && $model->user_id == $id) selected @endif>{{$user}}</option>
                    @endforeach
                </x-admin.form.select>
                <x-admin.form.error-field name="user_id"/>

            </div>

            <div class="py-2">
                <x-admin.form.label for="city_id"
                                    class="block font-medium text-sm text-gray-700{{$errors->has('city_id') ? 'text-red-400' : ''}}">{{ __('city_id') }}</x-admin.form.label>

                <x-admin.form.select id="city_id"
                                     class="search-select {{$errors->has('city_id') ? 'border-red-400' : ''}} w-[50%]"
                                     type="text"
                                     name="city_id" >
                    <option value="">---</option>
                    @foreach($cities as $id=>$city)
                        <option value="{{$id}}"  @if(isset($model->city_id) && $model->city_id == $id) selected @endif>{{$city}}</option>
                    @endforeach
                </x-admin.form.select>
                <x-admin.form.error-field name="city_id"/>

            </div>

            <div class="py-2">
                <x-admin.form.label for="name"
                                    class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('name') }}</x-admin.form.label>

                <x-admin.form.input id="name" class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="name"
                                    value="{{isset($model->name)? $model->name : old('name') }}"></x-admin.form.input>
            </div>

            <div class="py-2">
                <x-admin.form.label for="website"
                                    class="{{$errors->has('website') ? 'text-red-400' : ''}}">{{ __('website') }}</x-admin.form.label>

                <x-admin.form.input id="website" class="{{$errors->has('website') ? 'border-red-400' : ''}} w-[50%]"
                                    type="text"
                                    name="website"
                                    value="{{isset($model->website)? $model->website : old('website') }}"
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

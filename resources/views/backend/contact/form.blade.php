<x-admin.wrapper>
    <x-slot name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                {{ __('Create company') }}
            </h2>
        </div>
    </x-slot>


    <div class="w-full py-2 bg-white overflow-hidden">

        <div class=" mx-auto mt-4  rounded">
            <!-- Tabs -->
            <ul id="tabs" class="tabs-nav flex   space-x-2 overflow-x-auto overflow-y-hidden  flex-nowrap ">
                <li class="flex items-center flex-shrink-0 px-5 py-2 border-b-4 border-gray-700 text-gray-400">
                    <a id="default-tab" href="#first">Subscriber</a>
                </li>
                <li class="flex items-center flex-shrink-0 px-5 py-2 border-b-4 text-gray-400">
                    <a href="#second">Insert</a>
                </li>
                <li class="flex items-center flex-shrink-0 px-5 py-2 border-b-4 text-gray-400">
                    <a href="#third">Upload</a>
                </li>
                <li class="flex items-center flex-shrink-0 px-5 py-2 border-b-4 text-gray-400">
                    <a href="#fourth">Upload</a>
                </li>
            </ul>
            <!-- Tab Contents -->
            <div class="tab-content">
                <div id="first" class="p-4">

                    <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="py-2">
                            <x-admin.form.label for="company_id"
                                                class="block font-medium text-sm text-gray-700{{$errors->has('company_id') ? 'text-red-400' : ''}}">{{ __('company_id') }}</x-admin.form.label>

                            <x-admin.form.select id="company_id"
                                                 class="search-select {{$errors->has('company_id') ? 'border-red-400' : ''}} w-[50%]"
                                                 type="text"
                                                 name="company_id"
                            >

                                <option value="">-----</option>

                                @foreach($companies as $id=>$company)
                                    <option value="{{$id}}"
                                            @if(isset($model->company_id) && $model->company_id == $id || old('company_id') == $id) selected @endif>{{$company}}</option>
                                @endforeach

                            </x-admin.form.select>
                            <x-admin.form.error-field name="company_id"/>

                        </div>


                        <div class="py-2">
                            <x-admin.form.label for="first_name"
                                                class="{{$errors->has('first_name') ? 'text-red-400' : ''}}">{{ __('first_name') }}</x-admin.form.label>

                            <x-admin.form.input id="first_name"
                                                class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                                type="text"
                                                name="first_name"
                                                value="{{isset($model->first_name)? $model->first_name : old('first_name') }}"></x-admin.form.input>
                            <x-admin.form.error-field name="first_name"/>

                        </div>


                        <div class="py-2">
                            <x-admin.form.label for="last_name"
                                                class="{{$errors->has('last_name') ? 'text-red-400' : ''}}">{{ __('last_name') }}</x-admin.form.label>

                            <x-admin.form.input id="last_name"
                                                class="{{$errors->has('last_name') ? 'border-red-400' : ''}} w-[50%]"
                                                type="text"
                                                name="last_name"
                                                value="{{isset($model->last_name)? $model->last_name : old('last_name') }}"></x-admin.form.input>
                            <x-admin.form.error-field name="last_name"/>

                        </div>


                        <div class="py-2">
                            <x-admin.form.label for="email"
                                                class="{{$errors->has('email') ? 'text-red-400' : ''}}">{{ __('email') }}</x-admin.form.label>

                            <x-admin.form.input id="email"
                                                class="{{$errors->has('email') ? 'border-red-400' : ''}} w-[50%]"
                                                type="text"
                                                name="email"
                                                value="{{isset($model->email)? $model->email : old('email') }}"></x-admin.form.input>
                            <x-admin.form.error-field name="email"/>

                        </div>


                        <div class="flex justify-end mt-4">
                            <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
                        </div>
                    </form>

                </div>
                <div id="second" class="hidden p-4">

                    <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="py-2">
                            <x-admin.form.label for="company_id"
                                                class="block font-medium text-sm text-gray-700{{$errors->has('company_id') ? 'text-red-400' : ''}}">{{ __('company_id') }}</x-admin.form.label>

                            <x-admin.form.select id="company_id_2"
                                                 class="search-select_2 {{$errors->has('company_id') ? 'border-red-400' : ''}} w-full w-[50%]"
                                                 type="text"
                                                 name="company_id"
                            >
                                <option value="">-----</option>
                                @foreach($companies as $id=>$company)
                                    <option value="{{$id}}"
                                            @if(isset($model->company_id) && $model->company_id == $id || old('company_id') == $id) selected @endif>{{$company}}</option>
                                @endforeach
                            </x-admin.form.select>
                            <x-admin.form.error-field name="company_id"/>

                        </div>


                        <div class="py-2">
                            <x-admin.form.label for="content"
                                                class="{{$errors->has('content') ? 'text-red-400' : ''}}">{{ __('content') }}</x-admin.form.label>


                            <textarea name="content"
                                      class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full'>{{{ isset($model->content)? $model->content : old('content') }}}</textarea>

                            <x-admin.form.error-field name="content"/>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
                        </div>
                    </form>

                </div>
                <div id="third" class="hidden p-4">
                    <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="py-2">
                            <x-admin.form.label for="company_id"
                                                class="block font-medium text-sm text-gray-700{{$errors->has('company_id') ? 'text-red-400' : ''}}">{{ __('company_id') }}</x-admin.form.label>

                            <x-admin.form.select id="company_id_2"
                                                 class="search-select_2 {{$errors->has('company_id') ? 'border-red-400' : ''}} w-full w-[50%]"
                                                 type="text"
                                                 name="company_id"
                            >
                                <option value="">-----</option>
                                @foreach($companies as $id=>$company)
                                    <option value="{{$id}}"
                                            @if(isset($model->company_id) && $model->company_id == $id || old('company_id') == $id) selected @endif>{{$company}}</option>
                                @endforeach
                            </x-admin.form.select>

                            <x-admin.form.error-field name="company_id"/>

                        </div>


                        <div class="py-2">
                            <x-admin.form.label for="content"
                                                class="{{$errors->has('content') ? 'text-red-400' : ''}}">{{ __('content') }}</x-admin.form.label>


                            <input type="file" name="content"
                                   accept=".xlsx,.xls, .csv,.txt"
                            >
                            {{--                            <textarea name="content"--}}
                            {{--                                      class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full'>{{{ isset($model->content)? $model->content : old('content') }}}</textarea>--}}

                            <x-admin.form.error-field name="content"/>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
                        </div>
                    </form>
                </div>
                <div id="fourth" class="hidden p-4">
                    Fourth tab
                </div>
            </div>
        </div>


    </div>


</x-admin.wrapper>

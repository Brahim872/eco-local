<x-admin.wrapper id="tabs">
    <x-slot name="title">
        <div>
            <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Edit Profile</a></li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Change
                        Password</a></li>
            </ul>
        </div>

    </x-slot>


    <div id="tab-contents">
        <div class="  w-full py-2 bg-white overflow-hidden" id="first">

            <form method="POST" action="{{ route('client.update',$model->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="py-2">

                    <x-admin.form.image id="image" class="{{$errors->has('image') ? 'border-red-400' : ''}} w-[50%]"
                                        name="image"
                                        accept="image/*"
                                        src="{{asset('storage/'.$model->profile)}}"
                                        value="{{ old('image') }}"
                    />

                </div>

                <div class="py-2">
                    <x-admin.form.label for="first_name"
                                        class="{{$errors->has('first_name') ? 'text-red-400' : ''}}">{{ __('first_name') }}</x-admin.form.label>

                    <x-admin.form.input id="first_name"
                                        class="{{$errors->has('first_name') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="first_name"
                                        value="{{ $model->first_name??old('first_name') }}"
                    />
                </div>

                <div class="py-2">
                    <x-admin.form.label for="last_name"
                                        class="{{$errors->has('last_name') ? 'text-red-400' : ''}}">{{ __('last_name') }}</x-admin.form.label>

                    <x-admin.form.input id="last_name"
                                        class="{{$errors->has('last_name') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="last_name"

                                        value="{{ $model->last_name??old('last_name') }}"></x-admin.form.input>
                </div>

                <div class="py-2">
                    <x-admin.form.label for="email"
                                        class="{{$errors->has('email') ? 'text-red-400' : ''}}">{{ __('Email') }}</x-admin.form.label>

                    <x-admin.form.input id="email" class="{{$errors->has('email') ? 'border-red-400' : ''}} w-[50%]"
                                        type="email"
                                        name="email"
                                        value="{{ $model->email??old('email') }}"
                    />
                </div>


                <div class="py-2">
                    <x-admin.form.label for="phone"
                                        class="{{$errors->has('phone') ? 'text-red-400' : ''}}">{{ __('phone') }}</x-admin.form.label>

                    <x-admin.form.input id="phone" class="{{$errors->has('phone') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="phone"

                                        value="{{ $model->phone??old('phone') }}"
                    />

                </div>


                <div class="flex justify-end mt-4">
                    <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
                </div>

            </form>
        </div>


    </div>


    @push('scripts')
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }

            let tabsContainer = document.querySelector("#tabs");

            let tabTogglers = tabsContainer.querySelectorAll("a");
            console.log(tabTogglers);

            tabTogglers.forEach(function (toggler) {
                toggler.addEventListener("click", function (e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b", "-mb-px", "opacity-100");
                        tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");

                    }
                    e.target.parentElement.classList.add("border-blue-400", "border-b-4", "-mb-px", "opacity-100");
                });
            });

            document.getElementById("default-tab").click();

        </script>
    @endpush
</x-admin.wrapper>

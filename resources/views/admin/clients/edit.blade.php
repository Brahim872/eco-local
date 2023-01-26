<x-admin.wrapper id="tabs">
    <x-slot name="title">
        <div>
            <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50"><a id="default-tab" href="#first">Edit Profile</a></li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Change Password</a></li>
            </ul>
        </div>

    </x-slot>



    <div id="tab-contents">
        <div class="  w-full py-2 bg-white overflow-hidden"  id="first">

            <form method="POST" action="{{ route('user.update',$user->id) }}"  enctype="multipart/form-data">
                @csrf


                <div class="py-2">

                    <x-admin.form.image id="image" class="{{$errors->has('image') ? 'border-red-400' : ''}} w-[50%]"
                                        name="image"
                                        accept="image/*"
                                        src="{{asset('storage/'.$user->profile)}}"
                                        value="{{ old('image') }}"
                    />

                </div>

                <div class="py-2">
                    <x-admin.form.label for="name" class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('Name') }}</x-admin.form.label>

                    <x-admin.form.input id="name" class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="name"

                                        value="{{ $user->name??old('name') }}"
                    />
                </div>

                <div class="py-2">
                    <x-admin.form.label for="email" class="{{$errors->has('email') ? 'text-red-400' : ''}}">{{ __('Email') }}</x-admin.form.label>

                    <x-admin.form.input id="email" class="{{$errors->has('email') ? 'border-red-400' : ''}} w-[50%]"
                                        type="email"
                                        name="email"
                                        value="{{ $user->email??old('email') }}"
                    />
                </div>



                <div class="py-2">
                    <x-admin.form.label for="phone" class="{{$errors->has('phone') ? 'text-red-400' : ''}}">{{ __('Phone') }}</x-admin.form.label>

                    <x-admin.form.input id="phone" class="{{$errors->has('phone') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="phone"

                                        value="{{ $user->phone??old('phone') }}"
                    />
                </div>

                <div class="py-2">
                    <h3 class="inline-block text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight py-4 block sm:inline-block flex">Roles</h3>
                    <div class="grid grid-cols-4 gap-4">
                        @forelse ($roles as $role)
                            <div class="col-span-4 sm:col-span-2 md:col-span-1">
                                <label class="form-check-label">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @empty
                            ----
                        @endforelse
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <x-admin.form.button>{{ __('Create') }}</x-admin.form.button>
                </div>
            </form>
        </div>


        <div  id="second"  class="w-full py-2 mt-4  bg-white overflow-hidden hidden ">

        <form method="POST" action="{{ route('user.update.password',$user->id) }}"  enctype="multipart/form-data">
            @csrf

            <div class="py-2">
                <x-admin.form.label for="old_password" class="{{$errors->has('old_password') ? 'text-red-400' : ''}}">{{ __('old_password') }}</x-admin.form.label>

                <x-admin.form.input id="old_password" class="{{$errors->has('old_password') ? 'border-red-400' : ''}} w-[50%]"
                                    type="password"
                                    name="old_password"
                                    placeholder="Old password"
                                    value=""
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="new_password" class="{{$errors->has('new_password') ? 'text-red-400' : ''}}">{{ __('New password') }}</x-admin.form.label>

                <x-admin.form.input id="new_password" class="{{$errors->has('new_password') ? 'border-red-400' : ''}} w-[50%]"
                                    type="password"
                                    name="new_password"
                                    placeholder="New password"
                                    value=""
                />
            </div>

            <div class="py-2">
                <x-admin.form.label for="confirm_password" class="{{$errors->has('confirm_password') ? 'text-red-400' : ''}}">{{ __('confirm_password') }}</x-admin.form.label>

                <x-admin.form.input id="confirm_password" class="{{$errors->has('confirm_password') ? 'border-red-400' : ''}} w-[50%]"
                                    type="password"
                                    name="confirm_password"
                                    placeholder="Confirm password"
                                    value=""
                />
            </div>




            <div class="flex justify-end mt-4">
                <x-admin.form.button>{{ __('Change Password') }}</x-admin.form.button>
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

            tabTogglers.forEach(function(toggler) {
                toggler.addEventListener("click", function(e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
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

<x-admin.wrapper id="tabs">
    <x-slot name="title">

    </x-slot>


    <div id="tab-contents">
        <div class="  w-full py-2 bg-white overflow-hidden" id="first">

            <form method="POST" action="{{ route('product.update',$model->id) }}" enctype="multipart/form-data">
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
                    <x-admin.form.label for="name"
                                        class="{{$errors->has('name') ? 'text-red-400' : ''}}">{{ __('name') }}</x-admin.form.label>

                    <x-admin.form.input id="name"
                                        class="{{$errors->has('name') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="name"
                                        value="{{ $model->name??old('name') }}"
                    />
                </div>

                <div class="py-2">
                    <x-admin.form.label for="description"
                                        class="{{$errors->has('description') ? 'text-red-400' : ''}}">{{ __('description') }}</x-admin.form.label>

                    <x-admin.form.input id="description"
                                        class="{{$errors->has('description') ? 'border-red-400' : ''}} w-[50%]"
                                        type="text"
                                        name="description"

                                        value="{{ $model->description??old('description') }}"></x-admin.form.input>
                </div>





                <div class="flex sm:justify-start mt-4">
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

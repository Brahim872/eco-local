<x-admin.wrapper id="tabs">
    <x-slot name="title">
        <div>
            <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Profile</a>
                </li>

                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#second">Products</a>
                </li>
            </ul>
        </div>
    </x-slot>

    <div id="tab-contents">

        <div class="w-full py-2 bg-white overflow-hidden" id="first">

            <div class="min-w-full border-b border-gray-200 ">
                <div class="w-full px-6 py-6 mx-auto loopple-min-height-78vh text-slate-500">
                    <div class="relative flex flex-col flex-auto p-4 overflow-hidden break-words ">
                        <div class="flex flex-wrap -mx-3">

                            <div class="flex-none w-auto max-w-full px-3">
                                <div class="flex items-center justify-center w-28">
                                    <img src="{{asset('storage/'.$model->profile)}}" alt="profile_image"
                                         class="w-full shadow-soft-sm rounded-xl">
                                </div>
                            </div>

                            <div class="flex-none w-auto max-w-full px-3 my-auto">
                                <div class="h-full">
                                    <h5 class="mb-1 font-bold text-2xl flex mb-3">{{$model->name}}</h5>
                                    <p class="mb-1 font-semibold leading-normal text-size-sm flex">
                                        <x-icons.envlope/>
                                        <span class="px-4"> {{$model->email}}</span>
                                    </p>
                                    <p class="mb-1 font-semibold leading-normal text-size-sm flex ">
                                        <x-icons.phone/>
                                        <span class="px-4"> {{$model->phone}}  </span>
                                    </p>
                                    <p class="mb-1 font-semibold leading-normal text-size-sm flex ">
                                        <x-icons.admin/>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="w-full py-2 mt-4  bg-white overflow-hidden hidden" id="second">
           @include('admin.client.includes.products')
        </div>

    </div>

    @push('scripts')
        <script>
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

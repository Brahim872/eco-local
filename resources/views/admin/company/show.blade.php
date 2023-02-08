<x-admin.wrapper id="tabs">
    <x-slot name="title">

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

                                        <span class="px-4"> {{$admin->users->name}}  </span>
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

    </div>

</x-admin.wrapper>

<x-admin.wrapper id="tabs">
    <x-slot name="title">
        <div>
            <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Profile</a>
                </li>

                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#second">Contacts</a>
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
                                    <img src="{{$model->profile?asset('storage/'.$model->profile):"#"}}"
                                         alt="profile_image"
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

        <div class="w-full py-2 bg-white overflow-hidden hidden" id="second">
            <x-admin.grid.table>
                <x-slot name="head">
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <x-admin.grid.th>
                            @include('backend.includes.sort-link', ['label' => 'Name', 'attribute' => 'name'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('backend.includes.sort-link', ['label' => 'Email', 'attribute' => 'email'])
                        </x-admin.grid.th>
                        <x-admin.grid.th>
                            @include('backend.includes.sort-link', ['label' => 'Deactivaed_at', 'attribute' => 'deactivated_at'])
                        </x-admin.grid.th>

                        <x-admin.grid.th>
                            @include('backend.includes.sort-link', ['label' => 'Date create', 'attribute' => 'created_at'])
                        </x-admin.grid.th>
                        @canany(['company edit', 'company delete'])
                            <x-admin.grid.th>
                                {{ __('Actions') }}
                            </x-admin.grid.th>
                        @endcanany
                    </tr>
                </x-slot>

                <x-slot name="body">
                    @foreach($contacts->where('user_id','=',$model->id)->get() as $item)

                        <tr class="text-gray-700">
                            <x-admin.grid.td>
                                <div class="text-sm text-gray-900">
                                    <a href="{{route('client.show', $item->slug??'')}}"
                                       class="no-underline hover:underline text-cyan-600">{{ $item->first_name??'' }}</a>
                                </div>
                            </x-admin.grid.td>
                            <x-admin.grid.td>
                                <div class="text-sm text-gray-900">
                                    {{ $item->email??'' }}
                                </div>
                            </x-admin.grid.td>
                            <x-admin.grid.td>
                                <div class="text-sm text-gray-900">
                                    {{ $item->deactivated_at??'---' }}
                                </div>
                            </x-admin.grid.td>

                            <x-admin.grid.td>
                                <div class="text-sm text-gray-900">
                                    {{$item->created_at??''}}
                                </div>
                            </x-admin.grid.td>

                            @canany(['company edit', 'company delete'])
                                <x-admin.grid.td style="width: 150px">
                                    <form action="{{ route('client.destroy', $item->id??'') }}" method="POST">
                                        <div class="flex">
                                            @can('client edit')
                                                <a href="{{route('company.edit', $item->slug??'')}}">
                                                    <x-icons.edit/>
                                                </a>
                                            @endcan

                                            @can('client delete')
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                    <x-icons.delete/>
                                                </button>
                                            @endcan
                                        </div>
                                    </form>
                                </x-admin.grid.td>
                            @endcanany
                        </tr>
                    @endforeach

                    @if($contacts->where('user_id','=',$model->id)->get()->isEmpty())
                        <tr>
                            <td colspan="3">
                                <div class="flex flex-col justify-center items-center py-4 text-lg">
                                    {{ __('No Result Found') }}
                                </div>
                            </td>
                        </tr>
                    @endif

                </x-slot>
            </x-admin.grid.table>


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

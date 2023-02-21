<x-admin.wrapper>

    <x-slot  name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                List users
            </h2>
            @can('user.create')
                <x-admin.add-link href="{{ route('user.create') }}">
                    {{ __('Add User') }}
                </x-admin.add-link>
            @endcan
        </div>
    </x-slot>



    <div class="py-2">
        <div class="min-w-full border-b border-gray-200  overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
                <x-admin.grid.search action="{{ route('user.index') }}" />

            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg ">
                <div class="w-full overflow-x-auto">
                    <x-admin.grid.table>
                        <x-slot name="head">
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'Name', 'attribute' => 'name'])
                                </x-admin.grid.th>
                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'Email', 'attribute' => 'email'])
                                </x-admin.grid.th>

                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'Date create', 'attribute' => 'created_at'])
                                </x-admin.grid.th>
                                @canany(['user.create', 'user.delete'])
                                <x-admin.grid.th>
                                    {{ __('Actions') }}
                                </x-admin.grid.th>
                                @endcanany
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                        @foreach($users as $user)
                            <tr class="text-gray-700">

                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        <a href="{{route('user.show', $user->slug)}}" class="no-underline hover:underline text-cyan-600">{{ $user->name }}</a>
                                    </div>
                                </x-admin.grid.td>

                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{ $user->email }}
                                    </div>
                                </x-admin.grid.td>

                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{$user->created_at}}
                                    </div>
                                </x-admin.grid.td>

                                @canany(['user.create', 'user.delete'])
                                    <x-admin.grid.td style="width: 150px">
                                        <form action="{{ route('user.destroy', $user->slug) }}" method="POST">
                                            <div class="flex">
                                                @can('user.create')
                                                <a href="{{route('user.edit', $user->slug)}}" >
                                                    <x-icons.edit />
                                                </a>
                                                @endcan

                                                @can('user.delete')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                       <x-icons.delete />
                                                    </button>
                                                @endcan
                                            </div>
                                        </form>
                                    </x-admin.grid.td>
                                @endcanany
                            </tr>
                            @endforeach

                            @if($users->isEmpty())
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
        </div>

        <div class="py-8">
            {{ $users->appends(request()->query())->links() }}
        </div>

    </div>
</x-admin.wrapper>

<x-admin.wrapper>
    <x-slot  name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                List roles
            </h2>
            @can('role create')
                <x-admin.add-link href="{{ route('role.create') }}">
                    {{ __('Add Role') }}
                </x-admin.add-link>
            @endcan
        </div>
    </x-slot>


    <div class="py-2">
        <div class="min-w-full border-b border-gray-200 shadow overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
                <x-admin.grid.search action="{{ route('role.index') }}" />
            </div>

            <div class="w-full mb-8 overflow-hidden rounded-lg ">
                <div class="w-full overflow-x-auto">
                    <x-admin.grid.table>
                        <x-slot name="head">
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'Name', 'attribute' => 'name'])
                                </x-admin.grid.th>
                                @canany(['role edit', 'role delete'])
                                    <x-admin.grid.th>
                                        {{ __('Actions') }}
                                    </x-admin.grid.th>
                                @endcanany
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($roles as $role)
                                <tr class="text-gray-700">
                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        <a href="{{route('role.show', $role->id)}}" class="no-underline hover:underline text-cyan-600">{{ $role->name }}</a>
                                    </div>
                                </x-admin.grid.td>
                                @canany(['role edit', 'role delete'])
                                <x-admin.grid.td style="width: 150px">
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                        <div class="flex">
                                            @can('role edit')

                                            <a href="{{route('role.edit', $role->id)}}" >
                                                <x-icons.edit />
                                            </a>
                                            @endcan

                                            @can('role delete')
                                                @csrf
                                                @method('DELETE')
                                           <button  onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                     <x-icons.delete />
                                                </button>
                                            @endcan
                                        </div>
                                    </form>
                                </x-admin.grid.td>
                                @endcanany
                            </tr>
                            @endforeach
                            @if($roles->isEmpty())
                                <tr>
                                    <td colspan="2">
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
            {{ $roles->appends(request()->query())->links() }}
        </div>
    </div>
</x-admin.wrapper>

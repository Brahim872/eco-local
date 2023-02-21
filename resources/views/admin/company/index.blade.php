<x-admin.wrapper>

    <x-slot  name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                List companies
            </h2>
            @can('company.create')
                <x-admin.add-link href="{{ route('company.create') }}">
                    {{ __('Add company') }}
                </x-admin.add-link>
            @endcan
        </div>
    </x-slot>



    <div class="py-2">
        <div class="min-w-full border-b border-gray-200  overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
                <x-admin.grid.search action="{{ route('company.index') }}" />

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
                                @canany(['company.create', 'company.delete'])
                                <x-admin.grid.th>
                                    {{ __('Actions') }}
                                </x-admin.grid.th>
                                @endcanany
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                        @foreach($model as $item)
                            <tr class="text-gray-700">
                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        <a href="{{route('company.show', $item->slug)}}" class="no-underline hover:underline text-cyan-600">{{ $item->name }}</a>
                                    </div>
                                </x-admin.grid.td>
                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{ $item->email }}
                                    </div>
                                </x-admin.grid.td>

                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{$item->created_at}}
                                    </div>
                                </x-admin.grid.td>

                                @canany(['company.create', 'company.delete'])
                                    <x-admin.grid.td style="width: 150px">
                                        <form action="{{ route('company.destroy', $item->id) }}" method="POST">
                                            <div class="flex">
                                                @can('company.create')
                                                <a href="{{route('company.edit', $item->slug)}}" >
                                                    <x-icons.edit />
                                                </a>
                                                @endcan

                                                @can('company.delete')
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

                            @if($model->isEmpty())
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
            {{ $model->appends(request()->query())->links() }}
        </div>

    </div>
</x-admin.wrapper>

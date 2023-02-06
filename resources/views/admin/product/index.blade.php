<x-admin.wrapper>

    <x-slot  name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                List products
            </h2>
            @can('product create')
                <x-admin.add-link href="{{ route('product.create') }}">
                    {{ __('Add product') }}
                </x-admin.add-link>
            @endcan
        </div>
    </x-slot>



    <div class="py-2">
        <div class="min-w-full border-b border-gray-200  overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
                <x-admin.grid.search action="{{ route('product.index') }}" />

            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg ">
                <div class="w-full overflow-x-auto">
                    <x-admin.grid.table>
                        <x-slot name="head">
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'name', 'attribute' => 'name'])
                                </x-admin.grid.th>
                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'description', 'attribute' => 'description'])
                                </x-admin.grid.th>

                                <x-admin.grid.th>
                                    @include('admin.includes.sort-link', ['label' => 'Date create', 'attribute' => 'created_at'])
                                </x-admin.grid.th>
                                @canany(['product edit', 'product delete'])
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
                                       {{ $item->name }}
                                    </div>
                                </x-admin.grid.td>
                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{ $item->description }}
                                    </div>
                                </x-admin.grid.td>

                                <x-admin.grid.td>
                                    <div class="text-sm text-gray-900">
                                        {{$item->created_at}}
                                    </div>
                                </x-admin.grid.td>

                                @canany(['product edit', 'product delete'])
                                    <x-admin.grid.td style="width: 150px">
                                        <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                                            <div class="flex">
                                                @can('product edit')
                                                <a href="{{route('product.edit', $item->slug)}}" >
                                                    <x-icons.edit />
                                                </a>
                                                @endcan

                                                @can('product delete')
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

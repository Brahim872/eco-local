<x-admin.wrapper>

    <x-slot  name="title">
        <div class="flex justify-between items-center">
            <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
                List clients
            </h2>
            @can('client create')
                <x-admin.add-link href="{{ route('client.create') }}">
                    {{ __('Add client') }}
                </x-admin.add-link>
            @endcan
        </div>
    </x-slot>



    <div class="py-2">
        <div class="min-w-full border-b border-gray-200  overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
                <x-admin.grid.search action="{{ route('client.index') }}" />

            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg ">
                <div class="w-full overflow-x-auto">
                    <livewire:users-table />
                </div>
            </div>
        </div>

        <div class="py-8">
            {{ $model->appends(request()->query())->links() }}
        </div>

    </div>


</x-admin.wrapper>

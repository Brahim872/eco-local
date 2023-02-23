<x-admin.wrapper>

    <x-slot name="title">
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
        <div class="min-w-full overflow-x-auto">
            <div class="flex justify-between  items-center mb-5">
               @include('partials.table.search')
            </div>

            <div class="w-full mb-8 rounded-lg relative overflow-x-auto ">
                @include('partials.table.table')
            </div>

        </div>
    </div>


    @push('scripts')
        <script src="{{asset('js/datatable.js')}}"></script>
    @endpush
</x-admin.wrapper>

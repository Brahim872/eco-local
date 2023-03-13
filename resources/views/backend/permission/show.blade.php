<x-admin.wrapper>
    <x-slot name="title">
        <h2 class="inline-block text-2xl sm:text-3xl  text-slate-900   block sm:inline-block flex">
            View permission
        </h2>

    </x-slot>


    <div class="w-full py-2">
        <div class="min-w-full  border-gray-200 ">
            <table class="table-fixed w-full text-sm">
                <tbody class="bg-white">

                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">{{ __('Name') }}</td>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{$permission->name}}</td>
                    </tr>

                    <tr>
                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">{{ __('Created') }}</td>
                        <td class="border-b border-slate-100 p-4 text-slate-500">{{$permission->created_at}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</x-admin.wrapper>

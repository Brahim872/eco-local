<h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Choose technology:</h3>
<ul class="grid w-full gap-6 md:grid-cols-3">
    @foreach($products as $product)

        <li>
            <input type="checkbox" id="id-{{$product->slug}}" value="" data-client_id="{{$model->id}}" data-product_id="{{$product->id}}" data-url="{{route('switch.status')}}"
                   class="hidden peer switchStatus"  required="">
            <label for="id-{{$product->slug}}"
                   class="inline-flex items-center justify-between w-full p-5 text-gray-800  bg-white border-2  border-red-500 rounded-lg cursor-pointer peer-checked:border-green-500 hover:text-gray-900 hover:bg-gray-200">
                <div class="block">
                    <x-icons.dote class="mb-2 w-7 h-7 text-red-500"/>
                    <div class="w-full text-lg font-semibold">{{$product->name}}</div>
                    <div class="w-full text-sm">{{$product->description}}</div>
                </div>
            </label>
        </li>

    @endforeach
</ul>

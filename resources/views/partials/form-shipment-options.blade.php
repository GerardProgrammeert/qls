@if (!isset($productCombinations))
    <p class="text-center text-xl text-gray-500">No product combinations available.</p>
@else
    @foreach ($productCombinations as $item)
        <div class="flex items-center space-x-4">
            <input
                type="radio"
                id="service-{{ $item['id'] }}"
                name="product_combination_id"
                value="{{ $item['id'] }}"
                class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500"
                {{ old('product_combination_id', $order->product_combination_id ?? '') == $item['id'] ? 'checked' : '' }}
            >
            <label for="service-{{ $item['id'] }}" class="text-lg font-medium text-gray-700">{{ $item['name'] }}</label>
        </div>
    @endforeach
@endif
@error('product_combination_id')
<span class="text-red-500 text-sm">{{ $message }}</span>
@enderror

<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div class="max-w-4xl mx-auto p-6 space-y-8">
        <!-- Billing Address Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Billing Address</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label for="billing_company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" id="billing_company_name" name="billing[company_name]"
                           value="{{ old('billing.company_name') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('billing.company_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="billing_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="billing_name" name="billing[name]"
                           value="{{ old('billing.name') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Street -->
                <div>
                    <label for="billing_street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="billing_street" name="billing[street]"
                           value="{{ old('billing.street') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.street')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- House Number -->
                <div>
                    <label for="billing_house_number" class="block text-sm font-medium text-gray-700">House Number</label>
                    <input type="text" id="billing_house_number" name="billing[house_number]"
                           value="{{ old('billing.house_number') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.house_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Line 2 -->
                <div>
                    <label for="billing_address_line_2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                    <input type="text" id="billing_address_line_2" name="billing[address_line_2]"
                           value="{{ old('billing.address_line_2') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('billing.address_line_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Zipcode -->
                <div>
                    <label for="billing_zipcode" class="block text-sm font-medium text-gray-700">Zipcode</label>
                    <input type="text" id="billing_zipcode" name="billing[zipcode]"
                           value="{{ old('billing.zipcode') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.zipcode')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="billing_city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="billing_city" name="billing[city]"
                           value="{{ old('billing.city') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.city')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="billing_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="billing_email" name="billing[email]"
                           value="{{ old('billing.email') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="billing_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="billing_phone" name="billing[phone]"
                           value="{{ old('billing.phone') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('billing.phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Delivery Address Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Delivery Address</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label for="delivery_company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" id="delivery_company_name" name="delivery[company_name]"
                           value="{{ old('delivery.company_name') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('delivery.company_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="delivery_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="delivery_name" name="delivery[name]"
                           value="{{ old('delivery.name') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Street -->
                <div>
                    <label for="delivery_street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="delivery_street" name="delivery[street]"
                           value="{{ old('delivery.street') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.street')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- House Number -->
                <div>
                    <label for="delivery_house_number" class="block text-sm font-medium text-gray-700">House Number</label>
                    <input type="text" id="delivery_house_number" name="delivery[house_number]"
                           value="{{ old('delivery.house_number') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.house_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Line 2 -->
                <div>
                    <label for="delivery_address_line_2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                    <input type="text" id="delivery_address_line_2" name="delivery[address_line_2]"
                           value="{{ old('delivery.address_line_2') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('delivery.address_line_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Zipcode -->
                <div>
                    <label for="delivery_zipcode" class="block text-sm font-medium text-gray-700">Zipcode</label>
                    <input type="text" id="delivery_zipcode" name="delivery[zipcode]"
                           value="{{ old('delivery.zipcode') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.zipcode')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="delivery_city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="delivery_city" name="delivery[city]"
                           value="{{ old('delivery.city') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.city')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="delivery_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="delivery_email" name="delivery[email]"
                           value="{{ old('delivery.email') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="delivery_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="delivery_phone" name="delivery[phone]"
                           value="{{ old('delivery.phone') }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('delivery.phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Shipment</h2>
            @if (!isset($productCombinations))
                <p class="text-center text-xl text-gray-500">No product combinations available.</p>
            @else
                @foreach ($productCombinations as $item)
                    <div class="flex items-center space-x-4">
                        <input type="radio" id="service-{{ $item['id'] }}" name="service" value="{{ $item['id'] }}" class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <label for="service-{{ $item['id'] }}" class="text-lg font-medium text-gray-700">{{ $item['name'] }}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</form>

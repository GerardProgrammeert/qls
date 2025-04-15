<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Company Name -->
    <div>
        <label for="delivery_companyname" class="block text-sm font-medium text-gray-700">Company Name</label>
        <input type="text" id="delivery_companyname" name="delivery[companyname]"
               value="{{ old('delivery.companyname') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('delivery.companyname')
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
        <label for="delivery_housenumber" class="block text-sm font-medium text-gray-700">House Number</label>
        <input type="text" id="delivery_housenumber" name="delivery[housenumber]"
               value="{{ old('delivery.housenumber') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('delivery.housenumber')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Address Line 2 -->
    <div>
        <label for="delivery_address2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
        <input type="text" id="delivery_address2" name="delivery[address2]"
               value="{{ old('delivery.address2') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('delivery.address2')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- PostalCode -->
    <div>
        <label for="delivery_postalcode" class="block text-sm font-medium text-gray-700">postalcode</label>
        <input type="text" id="delivery_postalcode" name="delivery[postalcode]"
               value="{{ old('delivery.postalcode') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('delivery.postalcode')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- City -->
    <div>
        <label for="delivery_locality" class="block text-sm font-medium text-gray-700">City</label>
        <input type="text" id="delivery_locality" name="delivery[locality]"
               value="{{ old('delivery.locality') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('delivery.locality')
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
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('delivery.phone')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @if (session('order_id'))
        <input type="hidden" name="order_id" value="{{ session('order_id') }}">
    @endif
    <input type="hidden" name="receiver_contact[type]" value="receiver">
    <!-- Company Name -->
    <div>
        <label for="receiver_contact_companyname" class="block text-sm font-medium text-gray-700">Company Name</label>
        <input type="text" id="receiver_contact_companyname" name="receiver_contact[companyname]"
               value="{{ old('receiver_contact.companyname') ?? ($receiver_contact['companyname'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('receiver_contact.companyname')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Name -->
    <div>
        <label for="receiver_contact_name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="receiver_contact_name" name="receiver_contact[name]"
               placeholder="Klaas Vaak"
               value="{{ old('receiver_contact.name') ?? ($receiver_contact['name'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Street -->
    <div>
        <label for="receiver_contact_street" class="block text-sm font-medium text-gray-700">Street</label>
        <input type="text" id="receiver_contact_street" name="receiver_contact[street]"
               placeholder="e.g. Langeweg"
               value="{{ old('receiver_contact.street') ?? ($receiver_contact['street'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.street')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- House Number -->
    <div>
        <label for="receiver_contact_housenumber" class="block text-sm font-medium text-gray-700">House Number</label>
        <input type="text" id="receiver_contact_housenumber" name="receiver_contact[housenumber]"
               placeholder="e.g. 13"
               value="{{ old('receiver_contact.housenumber') ?? ($receiver_contact['housenumber'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.housenumber')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Address Line 2 -->
    <div>
        <label for="receiver_contact_address2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
        <input type="text" id="receiver_contact_address2" name="receiver_contact[address2]"
               value="{{ old('receiver_contact.address2') ?? ($receiver_contact['address2'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('receiver_contact.address2')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- postalcode -->
    <div>
        <label for="receiver_contact_postalcode" class="block text-sm font-medium text-gray-700">Postalcode</label>
        <input type="text" id="receiver_contact_postalcode" name="receiver_contact[postalcode]"
               placeholder="1234 AB"
               value="{{ old('receiver_contact.postalcode') ?? ($receiver_contact['postalcode'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.postalcode')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- City -->
    <div>
        <label for="receiver_contact_locality" class="block text-sm font-medium text-gray-700">City</label>
        <input type="text" id="receiver_contact_locality" name="receiver_contact[locality]"
               value="{{ old('receiver_contact.locality') ?? ($receiver_contact['locality'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.locality')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="receiver_contact_email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="receiver_contact_email" name="receiver_contact[email]"
               placeholder="info@example.nl"
               value="{{ old('receiver_contact.email') ?? ($receiver_contact['email'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('receiver_contact.email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Phone -->
    <div>
        <label for="receiver_contact_phone" class="block text-sm font-medium text-gray-700">Phone</label>
        <input type="text" id="receiver_contact_phone" name="receiver_contact[phone]"
               placeholder="0612345678"
               value="{{ old('receiver_contact.phone') ?? ($receiver_contact['phone'] ?? '') }}"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('receiver_contact.phone')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="pt-5">
    <label for="is_same" class="block text-sm font-medium text-gray-700">
        <input type="hidden"  id="is_same_hidden" name="is-same" value="false">
        <input type="checkbox" id="is_same" value="true" {{ old('is-same', true) ? 'checked' : '' }} onchange="toggleSection()" class="mr-2">
        Billing address is the same as delivery address
    </label>
</div>

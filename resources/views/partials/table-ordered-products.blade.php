<table class="min-w-full table-auto border border-gray-200 rounded-xl shadow-sm">
    <thead class="bg-gray-100 text-gray-700">
    <tr>
        <th class="px-4 py-2 text-left">ID</th>
        <th class="px-4 py-2 text-left">Quantity</th>
        <th class="px-4 py-2 text-left">Name</th>
        <th class="px-4 py-2 text-left">Price Per Unit</th>
        <th class="px-4 py-2 text-left">Total</th>
    </tr>
    </thead>
    <tbody class="text-gray-800">
    <?php foreach ($products as $index => $item): ?>
    <tr class="border-t">
        <td class="px-4 py-2">
                <?= $item['id'] ?>
            <input type="hidden" name="shipment_products[<?= $index ?>][id]" value="<?= $item['id'] ?>">
        </td>
        <td class="px-4 py-2">
                <?= $item['amount'] ?>
            <input type="hidden" name="shipment_products[<?= $index ?>][amount]" value="<?= $item['amount'] ?>">
        </td>
        <td class="px-4 py-2">
                <?= htmlspecialchars($item['name']) ?>
            <input type="hidden" name="shipment_products[<?= $index ?>][name]" value="<?= htmlspecialchars($item['name']) ?>">
        </td>
        <td class="px-4 py-2">
                <?= number_format($item['price_per_unit'], 2, ',', '.') ?>
            <input type="hidden" name="shipment_products[<?= $index ?>][price_per_unit]" value="<?= $item['price_per_unit'] ?>">
        </td>
        <td class="px-4 py-2">
                <?= number_format($item['total'], 2, ',', '.') ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

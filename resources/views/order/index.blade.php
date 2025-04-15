@extends('layouts.app')
@section('title', 'Overview orders')

@section('content')
    <div class="max-w-4xl mx-auto p-6 space-y-8">
        <table class="min-w-full table-auto border border-gray-200 rounded-xl shadow-sm">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Customer</th>
                <th class="px-4 py-2 text-left">Shipment ID</th>
                <th class="px-4 py-2 text-left">Created at</th>
                <th class="px-4 py-2 text-left">Updated at</th>
            </tr>
            </thead>
            <tbody class="text-gray-800">
            @foreach($orders as $order)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ $order->receiverContact?->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->shipment_id ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2">{{ $order->updated_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('order.edit', $order->id) }}"
                           class="inline-block text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection

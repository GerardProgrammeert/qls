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
                <th class="px-4 py-2 text-left">Edit</th>
                <th class="px-4 py-2 text-left">Download</th>
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
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('order.edit', $order->id) }}"
                           class="inline-flex items-center text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 010 2.828l-10 10A2 2 0 016 16H4a1 1 0 01-1-1v-2a2 2 0 01.586-1.414l10-10a2 2 0 012.828 0z" />
                            </svg>
                            Edit
                        </a>
                    </td>
                    <td>
                        @if($order->shipment_id)
                            <a target="_blank" href="{{ route('order.download', $order->id) }}"
                               class="inline-flex items-center text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V3zm6 4a1 1 0 112 0v4.586l1.293-1.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.414L9 11.586V7z" clip-rule="evenodd" />
                                </svg>
                                Download
                            </a>
                        @endif
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

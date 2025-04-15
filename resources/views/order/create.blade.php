@extends('layouts.app')
@section('title', 'Create Order')
@section('content')
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div class="max-w-4xl mx-auto p-6 space-y-8">
        <div class="overflow-x-auto p-4">
            <div class="overflow-x-auto p-4">
                @include('partials.table-ordered-products')
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Billing Address</h2>
                @include('partials.form-receiver-contact')
            </div>

            <div id="receiverSection" class="bg-white shadow-md rounded-lg p-6 hidden" >
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Delivery Address</h2>
                @include('partials.form-delivery-contact')
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Shipment Options</h2>
                @include('partials.form-shipment-options')
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 p-4 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="card-footer text-left">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg text-xl transition-all">Register QLS SHIPMENT</button>
        </div>
    </div>
</form>
@endsection
@include('partials.checkbox-toggle-script')

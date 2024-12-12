<form action="{{ route('stocks.addDebit') }}" method="POST" class="mt-6">
    @csrf
    <input type="hidden" name="product_id" value="{{ $stock[0]['product_id'] }}" />

    <div class="mb-4">
        <label for="debit" class="block text-sm font-medium text-gray-700">
            {{ __('messages.debit_quantity') }}
        </label>
        <input type="number" name="debit" id="debit" class="form-input mt-1 block w-full" step="0.01"
            required />
    </div>

    <div class="mb-4">
        <label for="warehouse_id" class="block text-sm font-medium text-gray-700">
            {{ __('messages.warehouse') }}
        </label>
        <select name="warehouse_id" id="warehouse_id" class="form-select mt-1 block w-full">
            @foreach ($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="measurement_unit_id" class="block text-sm font-medium text-gray-700">
            {{ __('messages.measurement_unit') }}
        </label>
        <select name="measurement_unit_id" id="measurement_unit_id" class="form-select mt-1 block w-full">
            @foreach ($measurementUnits as $unit)
                <option value="{{ $unit->id }}">{{ $unit->abbreviation }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __('messages.add_debit') }}
    </button>
</form>

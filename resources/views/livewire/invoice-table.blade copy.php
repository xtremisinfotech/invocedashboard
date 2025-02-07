<div class="p-4 bg-white shadow rounded-lg">
    <div class="flex space-x-4 mb-4">
        <button wire:click="$set('filter', 'all')" class="px-4 py-2 bg-gray-200 rounded">All</button>
        <button wire:click="$set('filter', 'draft')" class="px-4 py-2 bg-blue-200 rounded">Draft</button>
        <button wire:click="$set('filter', 'outstanding')" class="px-4 py-2 bg-yellow-200 rounded">Outstanding</button>
        <button wire:click="$set('filter', 'paid')" class="px-4 py-2 bg-green-200 rounded">Paid</button>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Invoice Number</th>
                <th class="px-4 py-2">Customer Email</th>
                <th class="px-4 py-2">Due</th>
                <th class="px-4 py-2">Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr class="border-b">
                    <td class="px-4 py-2 text-right">{{ number_format($invoice->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $invoice->invoice_number }}</td>
                    <td class="px-4 py-2">{{ $invoice->customer_email }}</td>
                    <td class="px-4 py-2">
                        <span
                            class="px-2 py-1 rounded">
                            -
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>

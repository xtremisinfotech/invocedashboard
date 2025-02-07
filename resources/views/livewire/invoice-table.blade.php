<div class="container w-4/5 mx-auto">

    <div class="p-4 flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Invoices</h2>
        <div class="flex items-center space-x-2">
            <button class="bg-white hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded border border-gray-300">
                ▼ Filter
            </button>
            <button wire:click="export" class="bg-white hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded border border-gray-300">
                ▼ Export
            </button>
            <button class="bg-primary hover:bg-purple-800 text-white font-bold py-2 px-4 rounded">+ Create
                invoice</button>
        </div>
    </div>

    <div class="flex space-x-4 mb-4 border-b-2 border-gray-200">
        <button wire:click="$set('filter', 'all')" class="px-4 py-2 font-bold {{ $filter == 'all' ? 'border-b-2 border-primary text-gray-800' : 'text-gray-500 hover:text-primary' }}">All invoices</button>
        <button wire:click="$set('filter', 'draft')" class="px-4 py-2 font-bold {{ $filter == 'draft' ? 'border-b-2 border-primary text-gray-800' : 'text-gray-500 hover:text-primary' }}">Draft</button>
        <button wire:click="$set('filter', 'outstanding')" class="px-4 py-2 font-bold {{ $filter == 'outstanding' ? 'border-b-2 border-primary text-gray-800' : 'text-gray-500 hover:text-primary' }}">Outstanding</button>
        <button wire:click="$set('filter', 'due')" class="px-4 py-2 font-bold {{ $filter == 'due' ? 'border-b-2 border-primary text-gray-800' : 'text-gray-500 hover:text-primary' }}">Past due</button>
        <button wire:click="$set('filter', 'paid')" class="px-4 py-2 font-bold {{ $filter == 'paid' ? 'border-b-2 border-primary text-gray-800' : 'text-gray-500 hover:text-primary' }}">Paid</button>
    </div>

    <table class="table-auto w-full">
        <thead>
            <tr class="">
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase">Amount</th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase"></th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase"></th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase">Invoice Number</th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase">Customer</th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase">Due</th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase">Created</th>
                <th class="border-b-2 border-gray-200 p-2 text-left uppercase"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border-b-2 border-gray-200 w-10 text-right">${{ number_format($invoice->amount, 2) }}</td>
                    <td class="p-2 border-b-2 border-gray-200 w-[10px]">USD</td>
                    <td class="p-2 border-b-2 border-gray-200 w-[10px]">
                        @switch($invoice->status)
                            @case('paid')
                                {{-- PAID --}}
                                <div class="bg-green-200 px-2 py-1 rounded text-sm w-[45px]">
                                    <span class="text-green-700 font-bold">Paid</span>
                                </div>
                                @break
                                
                            @case('draft')
                                {{-- DRAFT --}}
                                <div class="bg-gray-200 px-2 py-1 rounded text-sm w-[50px]">
                                    <span class="text-gray-700 font-bold">Draft</span>
                                </div>
                                @break

                            @case('outstanding')
                                {{-- OUT STANDING --}}
                                <div class="bg-orange-200 px-2 py-1 rounded text-sm text-justify w-[105px]">
                                    <span class="text-orange-700 font-bold">Out Standing</span>
                                </div>
                                @break

                            @case('due')
                                {{-- Past Due --}}
                                <div class="bg-red-200 px-2 py-1 rounded text-sm text-justify w-[75px]">
                                    <span class="text-red-700 font-bold">Past Due</span>
                                </div>
                                @break
                        
                            @default
                                {{-- PAID --}}
                                <div class="bg-green-200 px-2 py-1 rounded text-sm">
                                    <span class="text-green-700 font-bold">Paid</span>
                                </div>
                                @break
                        @endswitch
                        
                    </td>
                    <td class="p-2 border-b-2 border-gray-200 w-[11%] uppercase">{{ $invoice->invoice_number }}</td>
                    <td class="p-2 border-b-2 border-gray-200">{{ $invoice->customer_email }}</td>
                    <td class="p-2 border-b-2 border-gray-200 w-[10px] text-center">-</td>
                    <td class="p-2 border-b-2 border-gray-200 w-[10%]">{{ date('M j, g:i A', strtotime($invoice->created_at)) }}</td>
                    <td class="p-2 border-b-2 border-gray-200 w-[30px] relative">
                        <button wire:click="toggleDropdown({{ $invoice->id }})" class="focus:outline-none z-1">...</button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-2xl z-[999] {{ $dropdownActive && $selectedItem == $invoice->id ? '' : 'hidden' }}">
                            <span href="#" class="block px-4 py-1 text-sm text-gray-700 uppercase">Actions</span>
                            <a href="#" class="block px-4 py-2 text-sm font-bold text-primary hover:bg-gray-100">Download
                                PDF</a>
                            <a href="#" class="block px-4 py-2 text-sm font-bold text-primary hover:bg-gray-100">Duplicate
                                invoice</a>
                            <a href="#" class="block px-4 py-2 text-sm font-bold text-red-700 hover:bg-gray-100">Delete
                                draft</a>
                            <hr class="my-1">
                            <span href="#" class="block px-4 py-1 text-sm text-gray-700 uppercase">Connections</span>
                            <a href="#" class="block px-4 py-2 text-sm font-bold text-primary hover:bg-gray-100">View customer →</a>
                        </div>
                    </td>
                </tr>
            @empty
            <tr class="hover:bg-gray-50">
                <td colspan="8" class="p-2 border-b-2 border-gray-200 w-10 text-center">No Invoices</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $invoices->links('pagination::tailwind') }}
</div>

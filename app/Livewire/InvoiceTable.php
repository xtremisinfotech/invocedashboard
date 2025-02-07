<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InvoiceTable extends Component
{
    use WithPagination;

    public string $filter = 'all';

    public $selectedItem = null;

    public bool $dropdownActive  = false;

    protected $queryString = ['filter'];

    // Toggle the dropdown
    public function toggleDropdown($id)
    {
        if ($this->selectedItem == $id) { // check if the dropdown is already opened for the record
            $this->dropdownActive = false;
            $this->selectedItem = null;
        } else {
            $this->dropdownActive = true;
            $this->selectedItem = $id;
        }
    }

    // Export the current filtered data
    public function export()
    {
        return Excel::download(new InvoicesExport($this->filter), 'invoices.csv');
    }

    public function render()
    {
        $query = Invoice::query();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        return view('livewire.invoice-table', [
            'invoices' => $query->paginate(10)
        ]);
    }
}

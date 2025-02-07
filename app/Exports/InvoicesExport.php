<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoicesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public string $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = Invoice::query();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        return $query->get(['invoice_number', 'customer_email', 'amount', 'status', 'created_at']);
    }

    public function headings(): array
    {
        return ["Invoice Number", "Customer Email", "Amount", "Status", "Created At"];
    }
}

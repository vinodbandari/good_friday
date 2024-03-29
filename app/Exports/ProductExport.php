<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromView
{
 public function view(): View
 {
   return view('customer.export', [
      'products' => Product::all()
   ]);
 }
}
<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function invoice(Order $order)
    {
        $blade_file = 'print.kitchen';
        if($order->status == 'Complete'){
            $blade_file = 'print.invoice';
        }
        $pdf = PDF::loadView($blade_file, compact('order'))->setPaper([0,0,567.00,183.80], 'landscape');
        return $pdf->stream('Invoice-' . $order->serial_number . ' Date time-' . date('d-m-Y- h-i-s') . '.pdf');
    }
   
   
    public function daily_report($date)
    {
        $pdf = PDF::loadView('print.daily-report', [
            'orders' => Order::whereDate('created_at', Carbon::parse($date))->where('status', 'Complete')->get(),
            'expeses' => Expense::whereDate('created_at', Carbon::parse($date))->get(),
            'purchases' => Purchase::whereDate('created_at', Carbon::parse($date))->get(),
            'file_name' => 'Daily Report of '.Carbon::parse($date)->format('d M Y'),
        ])->setPaper('A4');
        return $pdf->stream('Daily report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}

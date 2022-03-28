<?php

namespace App\Http\Controllers;

use App\Models\InwardEntry;
use App\Models\InwardEntryItem;
use App\Models\OutwardEntryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportController extends Controller
{
     /**
     * Show inward entry page
     *
     * @return mixed
     */
    public function showInwardEntryReport()
    {
        
        $inward_entry = DB::table('inward_entries as ie')
        ->leftJoin('inward_entry_items as iei', 'iei.inward_entry_id', '=', 'ie.id')
        ->select([
            'ie.id',
            'ie.date_of_inbound',
            'ie.import_invoice_number',
            'ie.boe_number',
            'ie.boe_number',
            'ie.supplier',
            'ie.location',
            'ie.container_number',
            DB::raw("COUNT(iei.id) as total_items"),
        ])
        ->groupBy('ie.id')
        ->get();
        return Inertia::render('Reports/InwardEntryReport', [
            'inward-entry' => $inward_entry,
        ]);
    }
     /**
     * Show outward entry page
     *
     * @return mixed
     */
    public function showOutwardEntryReport()
    {
        
        $outward_entry = DB::table('outward_entries as oe')
        ->leftJoin('outward_entry_items as oei', 'oei.outward_entry_id', '=', 'oe.id')
        ->select([
            'oe.id',
            'oe.dispatch_date_time',
            'oe.invoice_number',
            'oe.ship_to_party',
            'oe.bill_to_party',
            'oe.vehicle_number',
            'oe.destination_code',
            'oe.lr_number',
            DB::raw("COUNT(oei.id) as total_items"),
        ])
        ->groupBy('oe.id')
        ->get();
        return Inertia::render('Reports/OutwardEntryReport', [
            'outward-entry' => $outward_entry,
        ]);
    }

     /**
     * Show inward items page
     *
     * @return mixed
     */
    public function showInwardEntryItemsReport(Request $request)
    {
        $inward_entry_items = InwardEntryItem::orderBy('id')->where('inward_entry_id', '=', $request->id)->get();
        return Inertia::render('Reports/InwardEntryItemsReport', [
            'inward-entry-items' => $inward_entry_items,
        ]);
    }
     /**
     * Show outward items page
     *
     * @return mixed
     */
    public function showOutwardEntryItemsReport(Request $request)
    {
        $outward_entry_items = OutwardEntryItem::orderBy('id')->where('outward_entry_id', '=', $request->id)->get();
        return Inertia::render('Reports/OutwardEntryItemsReport', [
            'outward-entry-items' => $outward_entry_items,
        ]);
    }
    
}

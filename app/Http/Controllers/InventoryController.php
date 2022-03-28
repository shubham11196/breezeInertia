<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\InwardEntry;
use App\Models\InwardEntryItem;
use App\Models\OutwardEntry;
use App\Models\OutwardEntryItem;
use App\Models\Products;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Show inward entry page
     *
     * @return mixed
     */
    public function showInwardEntry()
    {
        $supplier_list = Supplier::orderBy('id')->get();
        return Inertia::render('Inventory/InwardEntry', [
            'supplier-list' => $supplier_list,
        ]);
    }

    /**
     * Show outward entry page
     *
     * @return mixed
     */
    public function showOutwardEntry()
    {
        $dealer_list = Dealer::orderBy('id')->get();
        return Inertia::render('Inventory/OutwardEntry', [
            'dealer-list' => $dealer_list,
        ]);
    }

    /**
     * Get product by sku for inward entry item
     *
     * @return mixed
     */
    public function productBySKU(Request $request)
    {
        $product = Products::where('sku', $request->search)->first();
        if (0 === Products::count()) {
            $last_grn_number = 100000;
        } else {
            $last_grn_number = InwardEntryItem::latest()->limit(1)->value('grn_number');
        }

        return response()->json([
            'product' => $product,
            'last_grn_number' => $last_grn_number,
        ]);
    }

    /**
     * Get product by frame number for outward entry item
     * @return mixed
     */
    public function getProductByFrameNumber(Request $request)
    {
        $inward_entry_item = InwardEntryItem::with('inwardEntry')->where('frame_number', $request->search)->first();

        return response()->json([
            'inward_entry_item' => $inward_entry_item,
        ]);
    }

    /**
     * Save inward entry and related items
     *
     * @param Request $request
     * @return mixed
     */
    public function saveInwardEntry(Request $request)
    {

        $request->validate([
            'date_of_inbound' => 'required',
            'import_invoice_number' => 'nullable',
            'container_number' => 'nullable',
            'boe_number' => 'nullable',
            'location' => 'required',
            'supplier' => 'required',
            'items.*.upc_or_sku' => 'required | max:255',
            'items.*.frame_number' => 'nullable',
            'items.*.short_name' => 'nullable',
            'items.*.model' => 'nullable',
            'items.*.color' => 'nullable',
            'items.*.size' => 'nullable',
            'items.*.description' => 'nullable',
            'items.*.description_on_box' => 'nullable',
            'items.*.marin_code' => 'nullable',
            'items.*.color_of_barcode' => 'nullable',
            'items.*.type' => 'nullable',
            'items.*.insera_code' => 'nullable',
            'items.*.fork' => 'nullable',
            'items.*.grn_number' => 'required',
        ]);
        $inward_entry = InwardEntry::create([
            'date_of_inbound' => $request->date_of_inbound,
            'import_invoice_number' => $request->import_invoice_number,
            'container_number' => $request->container_number,
            'boe_number' => $request->boe_number,
            'supplier' => $request->supplier,
            'location' => $request->location,
        ]);

        foreach ($request->items as $item) {
            InwardEntryItem::create([
                'inward_entry_id' => $inward_entry->id,
                'upc_or_sku' => $item['upc_or_sku'],
                'frame_number' => $item['frame_number'],
                'grn_number' => $item['grn_number'],
                'short_name' => $item['short_name'],
                'description' => $item['description'],
                'description_on_box' => $item['description_on_box'],
                'model' => $item['model'],
                'color' => $item['color'],
                'size' => $item['size'],
                'marin_code' => $item['marin_code'],
                'color_of_barcode' => $item['color_of_barcode'],
                'type' => $item['type'],
                'insera_code' => $item['insera_code'],
                'fork' => $item['fork'],
            ]);
        }

        return response([], 204);
    }

    /**
     * Save outward entry and related items
     *
     * @param Request $request
     * @return mixed
     */
    public function saveOutwardEntry(Request $request)
    {
        $request->validate([
            'dispatch_date_time' => 'required',
            'invoice_number' => 'required',
            'dealer_name' => 'required',
            'ship_to_party' => 'required',
            'bill_to_party' => 'required',
            'vehicle_number' => 'required',
            'destination_code' => 'required',
            'lr_number' => 'required',
            'items.*.frame_number' => 'nullable',
            'items.*.upc_or_sku' => 'required',
            'items.*.short_name' => 'nullable',
            'items.*.boe_number' => 'nullable',
            'items.*.model' => 'nullable',
            'items.*.color' => 'nullable',
            'items.*.size' => 'nullable',
            'items.*.description' => 'nullable',
            'items.*.description_on_box' => 'nullable',
            'items.*.marin_code' => 'nullable',
            'items.*.color_of_barcode' => 'nullable',
            'items.*.type' => 'nullable',
            'items.*.insera_code' => 'nullable',
            'items.*.fork' => 'nullable',
            'items.*.grn_number' => 'required',
        ]);
        $outward_entry = OutwardEntry::create([
            'dispatch_date_time' => $request->dispatch_date_time,
            'invoice_number' => $request->invoice_number,
            'dealer_name' => $request->dealer_name,
            'ship_to_party' => $request->ship_to_party,
            'bill_to_party' => $request->bill_to_party,
            'vehicle_number' => $request->vehicle_number,
            'destination_code' => $request->destination_code,
            'lr_number' => $request->lr_number,
        ]);

        foreach ($request->items as $item) {
            OutwardEntryItem::create([
                'outward_entry_id' => $outward_entry->id,
                'frame_number' => $item['frame_number'],
                'upc_or_sku' => $item['upc_or_sku'],
                'grn_number' => $item['grn_number'],
                'short_name' => $item['short_name'],
                'boe_number' => $item['boe_number'],
                'model' => $item['model'],
                'color' => $item['color'],
                'size' => $item['size'],
                'marin_code' => $item['marin_code'],
                'color_of_barcode' => $item['color_of_barcode'],
                'type' => $item['type'],
                'insera_code' => $item['insera_code'],
                'fork' => $item['fork'],
                'description' => $item['description'],
                'description_on_box' => $item['description_on_box'],
            ]);
        }

        return response([], 204);
    }
}

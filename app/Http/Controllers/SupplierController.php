<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Show supplier page
     *
     */
    public function showAddSupplierPage()
    {
        $message = session()->get('success');
        return Inertia::render('Master/AddSupplier',[
            'message' => $message
        ]);
    }

    /**
     * Show supplier list page
     *
     */
    public function showManageSupplierPage()
    {
        $suppliers = Supplier::orderBy('id')->get();
        return Inertia::render('Master/ManageSupplier', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Edit  Supplier
     *
     * @param Supplier $supplier
     * @param Request $request
     */
    public function editSupplier(Supplier $supplier, Request $request)
    {
        return Inertia::render('Master/AddSupplier', ['supplier' => $supplier]);
    }

    /**
     * Delete supplier
     *
     * @param Supplier $supplier
     * @param Request $request
     */
    public function deleteSupplier(Supplier $supplier, Request $request)
    {
        $supplier->delete();
        return redirect('master/manage-supplier');
    }

    /**
     * Save new supplier
     *
     * @param Request $request
     */
    public function createOrUpdateSupplier(Request $request)
    {
        if ($request->edit && $request->id) {
            Supplier::where('id', $request->id)->update([
                'name' => $request->name,
                'country' => $request->country,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        } else {
            Supplier::create([
                'name' => $request->name,
                'country' => $request->country,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        }
        return redirect('master/add-supplier')->with("success", "Added Supplier");
    }

     /**
     * Get Dealer List
     *
     */
    public function getSuppliersList(Request $request)
    {
       
        $supplier = Supplier::orderBy('id')->get();
        if (!empty($request->searchBy)) {
            $supplier = Supplier::orderBy('id')->where('name', 'LIKE', '%' . $request->searchBy . '%')
            ->orderBy('id')->get();
        }
        return response()->json(['success' => [
            'supplier' => $supplier,
        ]]);
    }
}

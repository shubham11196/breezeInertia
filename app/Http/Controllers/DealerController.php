<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DealerController extends Controller
{
    /**
     * Show dealer page
     *
     */
    public function showAddDealerPage()
    {
        return Inertia::render('Master/AddDealer');
    }

    /**
     * Show dealer list page
     *
     */
    public function showManageDealerPage()
    {
        $dealers = Dealer::orderBy('id')->get();
        return Inertia::render('Master/ManageDealer', [
            'dealers' => $dealers
        ]);
    }

    /**
     * Edit  Dealer
     *
     * @param Dealer $dealer
     * @param Request $request
     */
    public function editDealer(Dealer $dealer, Request $request)
    {
        return Inertia::render('Master/AddDealer', ['dealer' => $dealer]);
    }

    /**
     * Delete dealer
     *
     * @param Dealer $dealer
     * @param Request $request
     */
    public function deleteDealer(Dealer $dealer, Request $request)
    {
        $dealer->delete();
        return redirect('master/manage-dealer');
    }

    /**
     * Save new dealer
     *
     * @param Request $request
     */
    public function createOrUpdateDealer(Request $request)
    {

        if ($request->edit && $request->id) {
            Dealer::where('id', $request->id)->update([
                'name' => $request->name,
                'location' => $request->location,
                'ship_to_party' => $request->ship_to_party,
                'bill_to_party' => $request->bill_to_party,
                'address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'phone' => $request->phone,
                'email' => $request->email,
                'gst_details' => $request->gst_details,
            ]);
        } else {
            Dealer::create([
                'name' => $request->name,
                'location' => $request->location,
                'ship_to_party' => $request->ship_to_party,
                'bill_to_party' => $request->bill_to_party,
                'address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'phone' => $request->phone,
                'email' => $request->email,
                'gst_details' => $request->gst_details,
            ]);
        }
        return redirect('master/add-dealer')->with("success", "Added Dealer");
    }

     /**
     * Show product list page
     *
     */
    public function getDealersList(Request $request)
    {
       
        $dealer = Dealer::orderBy('id')->get();
        if (!empty($request->searchBy)) {
            $dealer = Dealer::orderBy('id')->where('name', 'LIKE', '%' . $request->searchBy . '%')
            ->orderBy('id')->get();
        }
        return response()->json(['success' => [
            'dealer' => $dealer,
        ]]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\RepairCenterModel;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class RepairCenterController extends Controller
{
    // List View
    /**
     * Get list ewvi populated with repair centers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListView(Request $request)
    {
        $repairCenters = new RepairCenterModel();
        $repairCenters = $repairCenters->getRepairCenters(20, $request);

        return view('repair-center.list', ['repairCenters' => $repairCenters]);
    }

    /**
     * Delete a repair center on click of delete button.
     *
     * @param $id
     * @param $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRepairCenter(Request $request)
    {
    	  $name = $request->rc_name;
        $id = $request->rc_id;

        $deleteRepairCenter = new RepairCenterModel();
        $deleteRepairCenter->deleteRepairCenter($id);

        return redirect()->route('repair-center')->with('message', 'Repair Center ' . $name . ' with ID ' . $id . ' deleted.');
    }

    // Create View
    /**
     * Get create view form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateView()
    {
        return view('repair-center.create');
    }

    /**
     * Create a repair center in create view form.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createRepairCenter(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:40',
            'contact-name' => 'required|max:50',
            'phone'        => 'required|max:10',
            'email'        => 'required|email|max:50',
            'address'      => 'required|max:60',
            'city'         => 'required|max:30',
            'state'        => 'required|min:2|max:2',
            'zip'          => 'required|min:5|max:5'
        ]);

        $createRepairCenter = new RepairCenterModel();
        $createRepairCenter->createRepairCenter(
            $request->input('name'), $request->input('contact-name'),
            $request->input('phone'), $request->input('email'),
            $request->input('address'), $request->input('city'),
            $request->input('state'), $request->input('zip'),
            $request->input('preferred')
        );

        return redirect()->route('repair-center.create')
            ->with('message', $request->input('name') . ' added.');
    }

    // Edit View
    /**
     * Get edit view form and populate values by id.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditView($id)
    {
        $repairCenter = new RepairCenterModel();
        $repairCenter = $repairCenter->getRepairCenter($id);

        return view('repair-center.edit', ['repairCenter' => $repairCenter]);
    }

    /**
     * Edit a repair center in edit view form.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editRepairCenter(Request $request)
    {
        // Strip everything but numbers in phone input
        $request->phone = preg_replace("/[^0-9]/","", 'phone');

        $this->validate($request, [
            'name'         => 'required|max:40',
            'contact-name' => 'required|max:50',
            'phone'        => 'required|min:10|max:10',
            'email'        => 'required|email|max:50',
            'address'      => 'required|max:60',
            'city'         => 'required|max:30',
            'state'        => 'required|min:2|max:2',
            'zip'          => 'required|min:5|max:5',
            'id'           => 'required'
        ]);

        $editRepairCenter = new RepairCenterModel();
        $editRepairCenter->editRepairCenter(
            $request->input('name'), 
            $request->input('contact-name'),
            $request->input('phone'), 
            $request->input('email'),
            $request->input('address'), 
            $request->input('city'),
            $request->input('state'), 
            $request->input('zip'),
            $request->input('preferred'), 
            $request->input('id')
        );

        return redirect()->route('repair-center.edit', ['id' => $request->input('id')])
            ->with('message', $request->input('name') . ' edited.');
    }
}
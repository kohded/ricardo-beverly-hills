<?php

namespace App\Http\Controllers;

use App\Exceptions\IdDoesntExistException;
use Illuminate\Http\Request;
use App\Models\DamageCodeModel;

class DamageCodeController extends Controller
{
    // List View
    public function getListView(Request $request)
    {
        $damageCodeModel = new DamageCodeModel();
        $damageCodes = $damageCodeModel->getDamageCodes($request);

        return view('damage-code.list', ['damageCodes' => $damageCodes]);
    }

    public function deleteDamageCode(Request $request)
    {
    	  $name = $request->dc_name;
        $id = $request->dc_id;

        $deleteDamageCode = new DamageCodeModel();
        $deleteDamageCode->deleteDamageCode($id);

        return redirect()->route('damage-code')->with('message', 'Damage Code ' . $name . ' with ID ' . $id . ' deleted.');
    }

    public function getCreateView()
    {
        return view('damage-code.create');
    }


    public function createDamageCode(Request $request)
    {
        $this->validate($request, [
            'id'   => 'required',
            'part' => 'required|max:50'
        ]);

        $createDamageCode = new DamageCodeModel();
        $createDamageCode->createDamageCode(
            $request->input('id'), 
            $request->input('part')
        );

        return redirect()->route('damage-code.create')
            ->with('message', $request->input('part') . ' added.');
    }

    // Edit View
    public function getEditView($id)
    {
        $damageCode = new damageCodeModel();
        $damageCode = $damageCode->getDamageCode($id);

        if(count($damageCode) > 0) {
            return view('damage-code.edit', ['damageCode' => $damageCode]);
        } else {
            throw new IdDoesntExistException($id, 'Damage Code');
        }
    }

    public function editDamageCode(Request $request)
    {
        $this->validate($request, [
            'newId' => 'required',
            'part'  => 'required|max:50'
        ]);

        $editDamageCode = new DamageCodeModel();
        $editDamageCode->editDamageCode(
            $request->input('id'),
            $request->input('newId'), 
            $request->input('part')
        );

        return redirect()->route('damage-code.edit', ['id' => $request->input('id')])
            ->with('message', $request->input('part') . ' edited.');
    }

    public function setFilter($filterType, $filterOrder, Request $request){

        $request->session()->flash('filterTypeDC', $filterType);
        $request->session()->flash('filterOrder', $filterOrder);

        return $this->getListView($request);
    }
}

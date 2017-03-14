<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DamageCodeModel;

class DamageCodeController extends Controller
{
    // List View
    public function getListView(Request $request)
    {
        $damageCodeModel = new DamageCodeModel();
        $damageCodes = $damageCodeModel->getDamageCodes();

        return view('damage-code.list', ['damageCodes' => $damageCodes]);
    }

    public function deleteDamageCode($id, $part)
    {
        $deleteDamageCode = new DamageCodeModel();
        $deleteDamageCode->deleteDamageCode($id);

        return redirect()->route('damage-code')->with('message', $id . ' - ' . $part . ' deleted.');
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

        return view('damage-code.edit', ['damageCode' => $damageCode]);
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
}

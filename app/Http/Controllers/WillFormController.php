<?php

namespace App\Http\Controllers;

use App\Models\Will;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WillFormController extends Controller
{
    public function show()
    {
        return view('dashboard.willform.create');
    }

    public function store(Request $request)
    {
        Will::create([
            'user_id' => 1,
            'firstName' => $request->get('firstName'),
            'middleName' => $request->get('middleName'),
            'lastName' => $request->get('lastName'),
            'email' => $request->get('email'),
            'dob' => $request->get('dob'),
            'hasPartner' => $request->get('hasPartner'),
            'hasChildrenUnderEighteen' => $request->get('hasChildrenUnderEighteen'),
            'hasMirrorWill' => $request->get('hasMirrorWill'),
            'ownProperty' => $request->get('ownProperty'),
            'addressSummary' => $request->get('addressSummary'),
            'secondApplicant' => $request->get('secondApplicant'),
            'eachOtherExecutor' => $request->get('secondExecutor'),
            'executor' => $request->get('executor'),
            'reserveExecutor' => $request->get('reserveExecutor'),
            'giftOptions' => $request->get('giftDetails'),
            'giftMoney' => $request->get('giftMoney'),
            'giftCharity' => $request->get('giftCharity'),
            'giftBank' => $request->get('giftBank'),
            'giftProperty' => $request->get('giftProperty'),
            'giftPet' => $request->get('giftPet'),
            'businessAssignment' => $request->get('businessAssignment'),
            'residueDetails' => $request->get('residue'),
            'requestDetails' => $request->get('request'),
            'appointGuardian' => $request->get('appointGuardian'),
            'hasMoreThanOneChildren' => $request->get('hasMoreThanOneChildren'),
            'sameGuardianAllChildren' => $request->get('sameGuardianAllChildren'),
            'children' => $request->get('children'),
            'reserveGuardian' => $request->get('reserveGuardian')
        ]);
    }

    public function submissions(Request $request)
    {
        if ($request->ajax()) {
            $data = Will::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a>
<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                })->addColumn('willType',function ($row){
                    if($row->hasMirrorWill){
                        return 'Mirror Will';
                    }else{
                        return 'Single Will';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.willform.index');
    }
}

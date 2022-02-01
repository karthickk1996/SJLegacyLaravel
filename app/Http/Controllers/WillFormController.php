<?php

namespace App\Http\Controllers;

use App\Mail\WillCreated;
use App\Models\Form;
use App\Models\Payment;
use App\Models\Will;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;

class WillFormController extends Controller
{
    public function show(Request $request)
    {
        $stripeCustomer = $request->user()->createOrGetStripeCustomer();
        $setup_intent = $request->user()->createSetupIntent();
        return view('dashboard.willform.create', [
            'intent' => $setup_intent
        ]);
    }

    public function edit(Request $request, Will $will)
    {
        $setup_intent = $request->user()->createSetupIntent();
        return view('dashboard.willform.edit', [
            'data' => [
                'form1' => [
                    'firstName' => $will->firstName,
                    'middleName' => $will->middleName,
                    'lastName' => $will->lastName,
                    'email' => $will->email,
                    'dob' => Carbon::parse($will->dob)->toIso8601String(),
                ],
                'hasPartner' => $will->hasPartner,
                'hasChildrenUnderEighteen' => $will->hasChildrenUnderEighteen,
                'hasMirrorWill' => $will->hasMirrorWill,
                'ownProperty' => $will->ownProperty,
                'addressSummary' => $will->addressSummary,
                'secondApplicant' => $will->secondApplicant,
                'secondExecutor' => $will->eachOtherExecutor,
                'executor' => $will->executor,
                'reserveExecutor' => $will->reserveExecutor,
                'giftDetails' => $will->giftOptions,
                'giftMoney' => $will->giftMoney,
                'appointGuardian' => $will->appointGuardian,
                'hasMoreThanOneChildren' => $will->hasMoreThanOneChildren,
                'sameGuardianAllChildren' => $will->sameGuardianAllChildren,
                'children' => $will->children,
                'reserveGuardian' => $will->reserveGuardian,
                'giftCharity' => $will->giftCharity,
                'giftBank' => $will->giftBank,
                'giftPet' => $will->giftPet,
                'businessAssignment' => $will->businessAssignment,
                'residue' => $will->residueDetails,
                'request' => $will->requestDetails,
                'giftProperty' => $will->giftProperty,
            ],
            'intent' => $setup_intent,
            'id' => $will->id
        ]);
    }

    public function store(Request $request)
    {
        try {
            $will = Will::create([
                'user_id' => $request->user()->id,
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
                'giftOptions' => $request->get('giftOptions'),
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
                'reserveGuardian' => $request->get('reserveGuardian'),
                'status' => Will::DRAFT,
            ]);
            return response()->json([
                'success' => true,
                'will' => $will,
                'message' => 'Will saved successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function makePayment(Request $request, Will $will)
    {
        $user = $request->user();
        $paymentMethod = $request->get('setupIntent')['payment_method'];
        $user->updateDefaultPaymentMethod($paymentMethod);
        try {
            if ($will->hasMirrorWill) {
                $stripeCharge = $request->user()->charge(
                    1500, $request->get('setupIntent')['payment_method']
                );
            } else {
                $stripeCharge = $request->user()->charge(
                    1000, $request->get('setupIntent')['payment_method']
                );
            }

            $payment = Payment::create([
                'payment_id' => $stripeCharge->id,
                'customer' => $stripeCharge->customer,
                'user_id' => $user->id,
                'amount' => $stripeCharge->amount,
                'currency' => $stripeCharge->currency,
                'status' => $stripeCharge->status
            ]);

            $will->update([
                'payment_id' => $payment->id,
                'status' => Will::COMPLETE,
            ]);

            try {
                Mail::to($request->user()->email)->send(new WillCreated($will));
            } catch (\Exception $exception) {
                //
            }
            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function submissions(Request $request)
    {
        if ($request->user()->roles[0]->name != 'admin')
            $data = $request->user()->wills()->latest()->get();
        else
            $data = Will::latest()->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('willform.edit', ['will' => $row->id]) . '" class="edit btn btn-success btn-sm">Edit</a>
<a href="javascript:void(0)" class="edit btn btn-info btn-sm" data-toggle="modal" data-target="#will-' . $row['id'] . '">View</a>
<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteWill(' . $row['id'] . ')">Delete</a>';
                })->addColumn('willType', function ($row) {
                    if ($row->hasMirrorWill) {
                        return 'Mirror Will';
                    } else {
                        return 'Single Will';
                    }
                })->addColumn('createdAt', function ($row) {
                    return $row->created_at->toDateTimeString();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.willform.index', [
            'data' => $data
        ]);
    }

    public function singleWillEdit()
    {
        $formContent = Form::where('form_type', 'single-will')->first();
        return view('dashboard.willform.templates.single-will-template', [
            'data' => $formContent
        ]);
    }

    public function mirrorWillEdit()
    {
        $formContent = Form::where('form_type', 'mirror-will')->first();
        return view('dashboard.willform.templates.mirror-will-template', [
            'data' => $formContent
        ]);
    }

    public function willFormUpdate(Request $request)
    {
        Form::updateOrCreate([
            'form_type' => $request->get('form')
        ], [
            'user_id' => 1,
            'content' => $request->get('content')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteWill(Request $request)
    {
        Will::where('id', $request->get('id'))->delete();
        session()->flash('success', 'Will deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'Will deleted successfully'
        ]);
    }

    public function updateWill(){

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentForm(Request $request)
    {
        $stripeCustomer = $request->user()->createOrGetStripeCustomer();
        $request->user()->createSetupIntent();
        return view('dashboard.payment.form', [
            'intent' => $request->user()->createSetupIntent()
        ]);
    }

    public function paymentFormSubmit(Request $request)
    {
        $user = $request->user();
        $package = $request->get('packageItem');
        $paymentMethod = $request->get('setupIntent')['payment_method'];
        $user->updateDefaultPaymentMethod($paymentMethod);
        try {
            if ($package === 'single') {
                $stripeCharge = $request->user()->charge(
                    100, $request->get('setupIntent')['payment_method']
                );

            } else {
                $stripeCharge = $request->user()->newSubscription(
                    'default', 'plan_H6HE6JChoJSNu0'
                )->create($request->get('setupIntent')['paymentMethodId'], [
                    'email' => $user->email
                ]);
            }
            return response()->json([
                'error' => false,
                $stripeCharge
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'exception' => $exception->getTrace(),
                'message' => $exception->getMessage(),
                'error' => true
            ]);
        }

    }
}

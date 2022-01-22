<template>
    <div>
        <div class="card-deck mb-3 text-center" v-show="showPackage">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Single</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$100 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button"
                            @click="choosePackage('single')"
                            class="btn btn-lg btn-block btn-outline-primary">Choose this
                    </button>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Subscription</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$10/month <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>20 users included</li>
                        <li>Priority email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button"
                            @click="choosePackage('subscription')"
                            class="btn btn-lg btn-block btn-primary">Choose this
                    </button>
                </div>
            </div>
        </div>
        <div v-show="!showPackage">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-info" @click="showPackage=true">Show Packages</button>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-6 ">
                    <h3>Make payment for {{ packageItem }} package</h3>
                    <div class="example example4">
                        <label>Card</label>
                        <div id="card-element"></div>
                        <button class="btn btn-primary mt-3" id="add-card-button"
                                :disabled="paymentProcessing"
                                v-on:click="submitPaymentMethod()">
                            Save Payment Method
                        </button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "PaymentComponent",
    props: ['payment'],
    data() {
        return {
            showPackage: true,
            name: "",
            packageItem: "single",
            addPaymentStatus: 0,
            addPaymentStatusError: '',
            stripeAPIToken: "",
            stripe: null,
            elements: '',
            card: '',
            paymentProcessing: false,
            cardElement: null,
        }
    },
    methods: {
        choosePackage(item) {
            this.packageItem = item
            this.showPackage = false;
        },
        async submitPaymentMethod() {
            this.paymentProcessing = true;
            const {setupIntent, error} = await this.stripe.confirmCardSetup(
                this.payment.client_secret, {
                    payment_method: {
                        card: this.cardElement
                    }
                }
            );

            if (error) {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Payment method invalid. Try Again !'
                })
                console.log(error);
            } else {
                this.$notify({
                    type: 'success',
                    title: 'Success',
                    text: 'Payment successful. Redirecting...'
                })
                await axios.post('/payment/form', {
                    setupIntent,
                    packageItem: this.packageItem
                })
            }
        }
    },
    async mounted() {
        this.stripe = Stripe('pk_test_XfguED28AQ3eXbkqDjDHSXOb00GHhcjRPs');

        const elements = this.stripe.elements({
            fonts: [
                {
                    cssSrc: "https://rsms.me/inter/inter.css"
                }
            ],
        });
        this.cardElement = elements.create("card", {
            hidePostalCode: true,
            style: {
                base: {
                    color: "#32325D",
                    fontWeight: 500,
                    fontFamily: "Inter, Open Sans, Segoe UI, sans-serif",
                    fontSize: "16px",
                    fontSmoothing: "antialiased",

                    "::placeholder": {
                        color: "#CFD7DF"
                    }
                },
                invalid: {
                    color: "#E25950"
                }
            }
        });
        this.cardElement.mount('#card-element');
    },
}
</script>

<style>
.example.example4 {
    background-color: #f6f9fc;
    padding: 20px;
    border-radius: 5px;
}

.example.example4 * {
    font-family: Inter, Open Sans, Segoe UI, sans-serif;
    font-size: 16px;
    font-weight: 500;
}

.example.example4 form {
    max-width: 496px !important;
    padding: 0 15px;
}

.example.example4 form > * + * {
    margin-top: 20px;
}

.example.example4 .container {
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    border-radius: 4px;
    padding: 3px;
}

.example.example4 fieldset {
    border-style: none;
    padding: 5px;
    margin-left: -5px;
    margin-right: -5px;
    background: rgba(18, 91, 152, 0.05);
    border-radius: 8px;
}

.example.example4 fieldset legend {
    float: left;
    width: 100%;
    text-align: center;
    font-size: 13px;
    color: #8898aa;
    padding: 3px 10px 7px;
}

.example.example4 .card-only {
    display: block;
}

.example.example4 .payment-request-available {
    display: none;
}

.example.example4 fieldset legend + * {
    clear: both;
}

.example.example4 input, .example.example4 button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: none;
    border-style: none;
    color: #fff;
}

.example.example4 input:-webkit-autofill {
    transition: background-color 100000000s;
    -webkit-animation: 1ms void-animation-out;
}

.example.example4 #example4-card {
    padding: 10px;
    margin-bottom: 2px;
}

.example.example4 input {
    -webkit-animation: 1ms void-animation-out;
}

.example.example4 input::-webkit-input-placeholder {
    color: #9bacc8;
}

.example.example4 input::-moz-placeholder {
    color: #9bacc8;
}

.example.example4 input:-ms-input-placeholder {
    color: #9bacc8;
}

.example.example4 button {
    display: block;
    width: 100%;
    height: 37px;
    background-color: #d782d9;
    border-radius: 2px;
    color: #fff;
    cursor: pointer;
}

.example.example4 button:active {
    background-color: #b76ac4;
}

.example.example4 .error svg .base {
    fill: #e25950;
}

.example.example4 .error svg .glyph {
    fill: #f6f9fc;
}

.example.example4 .error .message {
    color: #e25950;
}

.example.example4 .success .icon .border {
    stroke: #ffc7ee;
}

.example.example4 .success .icon .checkmark {
    stroke: #d782d9;
}

.example.example4 .success .title {
    color: #32325d;
}

.example.example4 .success .message {
    color: #8898aa;
}

.example.example4 .success .reset path {
    fill: #d782d9;
}
</style>

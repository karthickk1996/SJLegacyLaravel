<template>
    <div class="card card-accent-success">
        <div class="card-header h3">
            <strong>Make Payment</strong>
        </div>
        <div class="card-body text-center">
            <h1 class="card-title pricing-card-title">
                <span v-if="mirrorWill">Mirror</span> <span v-else>Single</span> will payment
            </h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>Email support</li>
                <li>Help center access</li>
            </ul>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 ">
                    <div class="example example4">
                        <label>Card</label>
                        <div id="card-element"></div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" @click.prevent="$emit('back')">
                    <i class="fa fa-arrow-left"></i>Go Back
                </button>
                <button class="btn btn-lg btn-success" type="button" disabled v-if="paymentProcessing">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Please wait
                </button>
                <button class="btn btn-lg btn-success" v-else
                        id="request_next"
                        @click.prevent="submitFinalForm">
                    Pay <span v-if="mirrorWill">$ 15</span> <span v-else>$ 10</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "WillPayment",
    props: ['mirrorWill', 'payment'],
    data() {
        return {
            paymentProcessing: false,
            cardElement: null,
        }
    },
    methods: {
        async submitFinalForm() {
            this.paymentProcessing = true;
            const {setupIntent, error} = await this.stripe.confirmCardSetup(
                this.payment.client_secret, {
                    payment_method: {
                        card: this.cardElement
                    }
                }
            );

            if (error) {
                if (error.code === "incomplete_number")
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: error.message
                    })
                console.log(error);
                this.paymentProcessing = false;
            } else {
                this.$notify({
                    type: 'success',
                    title: 'Success',
                    text: 'Payment successful.'
                })

                this.$emit('confirm', {
                    setupIntent
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

<style scoped>

</style>

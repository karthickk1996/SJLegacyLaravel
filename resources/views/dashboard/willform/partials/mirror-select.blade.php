<div class="card card-accent-primary hide" id="partner" v-if="step===2">
    <div class="card-header h3"><strong>Mirror Will</strong></div>
    <form id="partner_form">
        <div class="card-body">
            <section class="d-flex align-items-center row py-2" id="partner_body">
                <h1 class="mb-2 d-inline col-9">Do you have a Partner?</h1>
                <div class="col-2">
                    <toggle-button v-model="hasPartner" :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
                </div>
                <small class="text-wrap col-9 h5">
                    CLick <span class="text-success">"Yes"</span> if you are married, engaged or living with a partner
                </small>
            </section>
            <section class="hide" id="mirror_body" v-if="hasPartner">
                <section class="d-flex align-items-center row py-3 border-top" id="mirror_body">
                    <h1 class="mb-2 d-inline col-9">Would you like to have a mirror will?</h1>
                    <div class="col-2">
                        <toggle-button v-model="hasMirrorWill"
                                       :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
                    </div>
                    <small class="text-wrap col-9 h5">
                        CLick <span class="text-success">"Yes"</span> if you want mirror will
                    </small>
                </section>
            </section>
            <section class="d-flex align-items-center row py-3 border-top">
                <h1 class="mb-2 d-inline col-9">Do you have any children under 18?</h1>
                <div class="col-2">
                    <toggle-button v-model="hasChildrenUnderEighteen"
                                   :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
                </div>
                <small class="text-wrap col-9 h5">
                    CLick <span class="text-success">"Yes"</span> if you have children under 18
                </small>
            </section>
            <section class="d-flex align-items-center row py-3 border-top">
                <h1 class="mb-2 d-inline col-9">Do you own any property or land?</h1>
                <div class="col-2">
                    <toggle-button v-model="ownProperty" :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
                </div>
                <small class="text-wrap col-9 h5">
                    CLick <span class="text-success">"Yes"</span> if you own any property or land
                </small>
            </section>

        </div>
        <div class="card-footer">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary"
                        @click="step=1"
                        id="partner_back">
                    <i class="fa fa-arrow-left"></i> Go
                    Back
                </button>
                <button class="btn btn-lg btn-success" id="partner_next"
                        @click.prevent="submitForm(2)"
                        type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

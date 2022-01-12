<div class="card card-accent-success" v-if="step==='gift_charity'">
    <div class="card-header h3"><strong>Gift to charity</strong></div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 my-3">
                <label class="form-col-form-label h4" for="charity_name">Charity Name</label>
                <input v-model.trim="$v.giftCharity.name.$model"
                       :class="$v.giftCharity.name.$anyError ? 'is-invalid':''"
                       @blur="$v.giftCharity.name.$touch"
                       class="form-control form-control-lg">
                <small>Please visit this link to get details <a
                        href="https://register-of-charities.charitycommission.gov.uk/charity-search" target="_blank">https://register-of-charities.charitycommission.gov.uk/charity-search</a></small>
            </div>
            <div class="col-sm-12 my-3">
                <label class="form-col-form-label h4" for="charity_reference">Charity Reference</label>
                <input v-model.trim="$v.giftCharity.reference.$model"
                       :class="$v.giftCharity.reference.$anyError ? 'is-invalid':''"
                       @blur="$v.giftCharity.reference.$touch" class="form-control form-control-lg">
            </div>
            <div class="col-sm-12 my-3">
                <label class="form-col-form-label h4" for="charity_amount">Charity Amount</label>
                <input v-model.trim="$v.giftCharity.money.$model"
                       :class="$v.giftCharity.money.$anyError ? 'is-invalid':''"
                       @blur="$v.giftCharity.money.$touch" class="form-control form-control-lg">
            </div>
        </div>
    </div>
    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary"
                    @click.prevent="step='gift_money'">
                <i class="fa fa-arrow-left"></i>
                Go Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('gift_charity')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

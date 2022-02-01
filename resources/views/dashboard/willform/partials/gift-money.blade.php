<div class="card card-accent-success" v-if="step==='gift_money'">
    <div class="card-header h3"><strong>Gift of money</strong></div>
    <div class="card-body" v-for="(money,index) in $v.giftMoney.$each.$iter">
        <div class="row mt-3">
            <div class="col-sm-12">
                <label class="form-col-form-label h4" for="money_data">Money details</label>
                <input name="gift_data" id="gift_data"
                       v-model.trim="money.moneyDetails.$model"
                       :class="money.moneyDetails.$anyError ? 'is-invalid':''"
                       @blur="money.moneyDetails.$touch"
                       class="form-control form-control-lg">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_first_name">First Name (required)</label>
                <input class="form-control form-control-lg"
                       v-model.trim="money.firstName.$model"
                       :class="money.firstName.$anyError ? 'is-invalid':''"
                       @blur="money.firstName.$touch"
                >
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_middle_name">Middle Name <br> </label>
                <input v-model.trim="money.middleName.$model"
                       :class="money.middleName.$anyError ? 'is-invalid':''"
                       @blur="money.middleName.$touch"
                       class="form-control form-control-lg">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_last_name">Last Name (required)</label>
                <input v-model.trim="money.lastName.$model"
                       :class="money.lastName.$anyError ? 'is-invalid':''"
                       @blur="money.lastName.$touch"
                       class="form-control form-control-lg">
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_relation">
                    <span>@{{ money.firstName.$model ? money.firstName.$model : 'He/She' }}'s</span> is my
                    (required)</label>
                <select class="form-control form-control-lg" id="gift_relation"
                        v-model.trim="money.relation.$model"
                        :class="money.relation.$anyError ? 'is-invalid':''"
                        @blur="money.relation.$touch">
                    @include('dashboard.willform.partials.combo-options')
                </select>
                <div class="invalid-feedback" v-if="money.relation.$anyError">Please choose an option</div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="gift_exec_relation">
                    <span>@{{ money.firstName.$model ? money.firstName.$model : 'He/She' }} is</span>
                    @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model.trim="money.secondApplicantRelation.$model"
                        :class="money.secondApplicantRelation.$anyError ? 'is-invalid':''"
                        @blur="money.secondApplicantRelation.$touch">
                    @include('dashboard.willform.partials.combo-options')
                </select>
                <div class="invalid-feedback" v-if="money.secondApplicantRelation.$anyError">Please choose an
                    option
                </div>
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased">Up on first exec predeceased
                    (required)</label>
                <select class="form-control form-control-lg" v-model="money.predeceased.$model">
                    @include('dashboard.willform.partials.gifting-details')
                </select>
            </div>
        </div>
        <section class="row" v-if="money.predeceased.$model === 'Assign to named beneficiary'">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_first" id="gift_predeceased_first"
                       v-model.trim="money.beneficiary.firstName.$model"
                       :class="money.beneficiary.firstName.$anyError ? 'is-invalid':''"
                       @blur="money.beneficiary.firstName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_middle">Middle Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_middle"
                       id="gift_predeceased_middle"
                       v-model.trim="money.beneficiary.middleName.$model"
                       :class="money.beneficiary.middleName.$anyError ? 'is-invalid':''"
                       @blur="money.beneficiary.middleName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_last"
                       id="gift_predeceased_last"
                       v-model.trim="money.beneficiary.lastName.$model"
                       :class="money.beneficiary.lastName.$anyError ? 'is-invalid':''"
                       @blur="money.beneficiary.lastName.$touch"
                       class="form-control form-control-lg"></div>
        </section>
        <div class="row my-3">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddGiftMoney"><i
                            class="fa fa-plus-circle"></i>
                        Add
                    </button>
                    <div v-if="index > 0">
                        <button class="btn btn-lg btn-danger" v-if="giftMoney.length > 1"
                                @click.prevent="removeGiftMoney(index)">
                            <i class="fa fa-minus-circle"></i>
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click.prevent="step='gift_options'">
                <i class="fa fa-arrow-left"></i>
                Go Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('gift_money')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

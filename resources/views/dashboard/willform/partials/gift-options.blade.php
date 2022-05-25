<div class="card card-accent-success"
     v-if="step === 'gift_options'"
>
    <div class="card-header h3">
        <strong>Gift of specific items </strong>
        <a class="card-header-action" href="#">
            <small
                class="text-muted" data-toggle="tooltip" data-placement="right" data-html="true" title=""
                data-original-title="<strong>Help Text : </strong> A gift can be:<br><ul><li>a <strong>one-off item</strong> e.g. wedding ring, a watch or piece of art.</li><li><strong>a collection of items</strong> e.g. Record collection, jewellery collection.</li><li><strong>a vehicle,</strong> car, motorbike, boat.</ul><p>Leave blank and select next if you have no specific items to gift</p>">?</small></a>
    </div>
    <div class="card-body" v-for="(gift,index) in $v.giftDetails.$each.$iter">
        <input type="hidden" v-model="gift.beneficiary.id.$model = index">
        <div class="row mt-3">
            <div class="col-sm-12">
                <label class="form-col-form-label h4" for="gift_data">I would like to gift my</label>
                <input name="gift_data" id="gift_data"
                       v-model.trim="gift.giftTo.$model"
                       :class="gift.giftTo.$anyError ? 'is-invalid':''"
                       @blur="gift.giftTo.$touch"
                       class="form-control form-control-lg">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_first_name">First Name (required)</label>
                <input name="gift_first_name" id="gift_first_name" class="form-control form-control-lg"
                       v-model.trim="gift.firstName.$model"
                       :class="gift.firstName.$anyError ? 'is-invalid':''"
                       @blur="gift.firstName.$touch"
                >
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_middle_name">Middle Name <br> </label>
                <input name="gift_middle_name" id="gift_middle_name"
                       v-model.trim="gift.middleName.$model"
                       :class="gift.middleName.$anyError ? 'is-invalid':''"
                       @blur="gift.middleName.$touch"
                       class="form-control form-control-lg">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_last_name">Last Name (required)</label>
                <input name="gift_last_name" id="gift_last_name"
                       v-model.trim="gift.lastName.$model"
                       :class="gift.lastName.$anyError ? 'is-invalid':''"
                       @blur="gift.lastName.$touch"
                       class="form-control form-control-lg">
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_relation">
                    <span>@{{ gift.firstName.$model ? gift.firstName.$model : 'He/She' }}'s</span> is my
                    (required)</label>
                <relationship-selector
                        @blur="gift.relation.$touch"
                        v-model.trim="gift.relation.$model"
                        :class="gift.relation.$anyError ? 'is-invalid':''"></relationship-selector>
                <div class="invalid-feedback" v-if="gift.relation.$anyError">Please choose an option</div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-6" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="gift_exec_relation"><span>@{{ gift.firstName.$model ? gift.firstName.$model : 'He/She' }} is</span>
                    @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                    (required)</label>
                <relationship-selector
                        @blur="gift.secondApplicantRelation.$touch"
                        v-model.trim="gift.secondApplicantRelation.$model"
                        :class="gift.secondApplicantRelation.$anyError ? 'is-invalid':''"></relationship-selector>
            </div>
            <div class="invalid-feedback" v-if="gift.secondApplicantRelation.$anyError">Please choose an
                option
            </div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased">Up on first exec predeceased
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model="gift.predeceased.$model"
                        :class="gift.predeceased.$anyError ? 'is-invalid':''"
                        @change="touchValidation(gift)"
                        @blur="gift.beneficiary.$touch">
                    @include('dashboard.willform.partials.gifting-details')
                </select>
                <div class="invalid-feedback" v-if="gift.predeceased.$anyError">Please choose an
                    option
                </div>
            </div>
        </div>
        <section class="row" v-if="gift.predeceased.$model === 'Assign to named beneficiary'">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_first" id="gift_predeceased_first"
                       v-model.trim="gift.beneficiary.firstName.$model"
                       :class="gift.beneficiary.firstName.$anyError ? 'is-invalid':''"
                       @blur="gift.beneficiary.firstName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_middle">Middle Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_middle"
                       id="gift_predeceased_middle"
                       v-model.trim="gift.beneficiary.middleName.$model"
                       :class="gift.beneficiary.middleName.$anyError ? 'is-invalid':''"
                       @blur="gift.beneficiary.middleName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_last"
                       id="gift_predeceased_last"
                       v-model.trim="gift.beneficiary.lastName.$model"
                       :class="gift.beneficiary.lastName.$anyError ? 'is-invalid':''"
                       @blur="gift.beneficiary.lastName.$touch"
                       class="form-control form-control-lg"></div>
        </section>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddGiftDetails"><i
                            class="fa fa-plus-circle"></i>
                        Add
                    </button>
                    <div v-if="index > 0">
                        <button class="btn btn-lg btn-danger" v-if="giftDetails.length > 1"
                                @click.prevent="removeGiftDetails(index)">
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
            <button class="btn btn-lg btn-primary"
                    @click.prevent="backFromGift()">
                <i class="fa fa-arrow-left"></i>
                Go Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('gift_options')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

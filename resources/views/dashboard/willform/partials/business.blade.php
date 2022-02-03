<div class="card card-accent-success"
     v-if="step==='business_assignment'"
>
    <div class="card-header h3"><strong>Business Assignment</strong></div>
    <div class="card-body" v-for="(business,i) in $v.businessAssignment.$each.$iter">
        <div class="row mt-3">
            <div class="col-sm-12">
                <label class="form-col-form-label h4" for="business_data">Business details</label>
                <input class="form-control form-control-lg"
                       v-model.trim="business.business.$model"
                       :class="business.business.$anyError ? 'is-invalid':''"
                       @blur="business.business.$touch"
                >
            </div>
        </div>
        <div class="row my-3 border-top person_body">
            <div class="col-sm-12">
                <section v-for="(bank,index) in business.persons.$each.$iter">
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <label class="form-col-form-label h4" for="business_first_name">First Name (required)</label>
                            <input type="text" name="bank_first_name"
                                   v-model.trim="bank.firstName.$model"
                                   :class="bank.firstName.$anyError ? 'is-invalid':''"
                                   @blur="bank.firstName.$touch"
                                   class="form-control form-control-lg inner"/>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label class="form-col-form-label h4" for="business_middle_name">Middle Name <br> </label>
                            <input type="text" name="bank_middle_name"
                                   v-model.trim="bank.middleName.$model"
                                   :class="bank.middleName.$anyError ? 'is-invalid':''"
                                   @blur="bank.middleName.$touch"
                                   class="form-control form-control-lg inner"/>
                        </div>

                        <div class="col-sm-6 mt-3">
                            <label class="form-col-form-label h4" for="business_last_name">Last Name (required)</label>
                            <input type="text"
                                   v-model.trim="bank.lastName.$model"
                                   :class="bank.lastName.$anyError ? 'is-invalid':''"
                                   @blur="bank.lastName.$touch"
                                   class="form-control form-control-lg inner"/>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label class="form-col-form-label h4" for="business_relation">
                                <span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }}'s</span> is my
                                (required)</label>
                            <select class="form-control form-control-lg"
                                    v-model.trim="bank.relation.$model"
                                    :class="bank.relation.$anyError ? 'is-invalid':''"
                                    @blur="bank.relation.$touch">
                                @include('dashboard.willform.partials.combo-options')
                            </select>
                        </div>
                        <div class="col-sm-6 mt-3" v-if="hasMirrorWill">
                            <label class="form-col-form-label h4" for="business_exec_relation">
                                <span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }} is</span>
                                @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                                (required)</label>
                            <select class="form-control form-control-lg"
                                    v-model.trim="bank.secondApplicantRelation.$model"
                                    :class="bank.secondApplicantRelation.$anyError ? 'is-invalid':''"
                                    @blur="bank.secondApplicantRelation.$touch"
                            >
                                @include('dashboard.willform.partials.combo-options')
                            </select>
                        </div>
                        <div class="col-sm-6 my-3">
                            <label class="form-col-form-label h4" for="property_share_fraction">Share fraction
                                (required)</label>
                            <select class="form-control form-control-lg" v-if="index > 0">
                                <option value="share"
                                        :selected="businessAssignment[i].persons[0].shareType === 'share'"
                                        :disabled="businessAssignment[i].persons[0].shareType !== 'share'">Share
                                </option>
                                <option value="fraction"
                                        :selected="businessAssignment[i].persons[0].shareType === 'fraction'"
                                        :disabled="businessAssignment[i].persons[0].shareType !== 'fraction'"
                                >Fraction
                                </option>
                            </select>
                            <select class="form-control form-control-lg" v-else
                                    v-model.trim="bank.shareType.$model"
                            >
                                <option value="share">Share</option>
                                <option value="fraction">Fraction</option>
                            </select>
                        </div>
                        <div class="col-sm-6 my-3">
                            <label class="form-col-form-label h4" for="property_share">Share/Fraction (required)</label>
                            <input v-model.trim="bank.share.$model"
                                   type="number"
                                   :class="bank.share.$anyError ? 'is-invalid':''"
                                   @blur="bank.share.$touch"
                                   class="form-control form-control-lg">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_predeceased">Up on
                                first
                                exec
                                predeceased (required) </label>
                            <select class="form-control form-control-lg inner select2"
                                    v-model.trim="bank.predeceased.$model"
                                    :class="bank.predeceased.$anyError ? 'is-invalid':''"
                                    @blur="bank.predeceased.$touch"
                                    name="bank_predeceased">
                                @include('dashboard.willform.partials.gifting-details')
                            </select>
                        </div>
                    </div>
                    <div class="row" v-if="bank.predeceased.$model === 'Assign to named beneficiary'">
                        <div class="col-sm-6">
                            <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                                named beneficiary (required)</label>
                            <input name="gift_predeceased_first" id="gift_predeceased_first"
                                   v-model.trim="bank.beneficiary.firstName.$model"
                                   :class="bank.beneficiary.firstName.$anyError ? 'is-invalid':''"
                                   @blur="bank.beneficiary.firstName.$touch"
                                   class="form-control form-control-lg"></div>
                        <div class="col-sm-6">
                            <label class="form-col-form-label h4" for="gift_predeceased_middle">Middle
                                Name of
                                named beneficiary (required)</label>
                            <input name="gift_predeceased_middle"
                                   id="gift_predeceased_middle"
                                   v-model.trim="bank.beneficiary.middleName.$model"
                                   :class="bank.beneficiary.middleName.$anyError ? 'is-invalid':''"
                                   @blur="bank.beneficiary.middleName.$touch"
                                   class="form-control form-control-lg"></div>
                        <div class="col-sm-6">
                            <label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                                named beneficiary (required)</label>
                            <input name="gift_predeceased_last"
                                   id="gift_predeceased_last"
                                   v-model.trim="bank.beneficiary.lastName.$model"
                                   :class="bank.beneficiary.lastName.$anyError ? 'is-invalid':''"
                                   @blur="bank.beneficiary.lastName.$touch"
                                   class="form-control form-control-lg"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" v-if="index > 0"
                                        @click.prevent="removeBusinessPerson(i,index)"
                                        class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                                    Remove Person
                                </button>
                                <button type="button" data-repeater-create
                                        @click.prevent="addBusinessPerson(i)"
                                        class="ml-5 btn btn-sm btn-success inner"><i
                                        class="fa fa-plus-circle"></i>
                                    Add Person
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row col">
                        <div style="{width: 100%;margin-top: 0.25rem;font-size: 80%;color: #e55353;}"
                             v-if="business.finalShare.$anyError"> Overall share values should be equal to @{{
                            maxPropertyShare(business.$model) }} current is @{{ business.finalShare.$model }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" v-if="i > 0"
                            @click.prevent="removeBusinessAssignment(i)"
                            class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                        Remove
                        Business
                    </button>
                    <button type="button" data-repeater-create
                            @click.prevent="addBusinessAssignment(i)"
                            class="ml-5 btn btn-sm btn-success inner"><i
                            class="fa fa-plus-circle"></i>
                        Add Business
                    </button>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='gift_pet'"
                    type="button"
                    id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('business_assignment')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

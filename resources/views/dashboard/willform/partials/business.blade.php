<div class="card card-accent-success" v-if="step==='business_assignment'">
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
            <div class="col-sm-6 mt-3">
                <label class="form-col-form-label h4" for="business_first_name">First Name (required)</label>
                <input type="text" name="bank_first_name"
                       v-model.trim="business.firstName.$model"
                       :class="business.firstName.$anyError ? 'is-invalid':''"
                       @blur="business.firstName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>
            <div class="col-sm-6 mt-3">
                <label class="form-col-form-label h4" for="business_middle_name">Middle Name <br> </label>
                <input type="text" name="bank_middle_name"
                       v-model.trim="business.middleName.$model"
                       :class="business.middleName.$anyError ? 'is-invalid':''"
                       @blur="business.middleName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>

            <div class="col-sm-6 mt-3">
                <label class="form-col-form-label h4" for="business_last_name">Last Name (required)</label>
                <input type="text"
                       v-model.trim="business.lastName.$model"
                       :class="business.lastName.$anyError ? 'is-invalid':''"
                       @blur="business.lastName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>
            <div class="col-sm-6 mt-3">
                <label class="form-col-form-label h4" for="business_relation">
                    <span>He/She</span> is my
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model.trim="business.relation.$model"
                        :class="business.relation.$anyError ? 'is-invalid':''"
                        @blur="business.relation.$touch">
                    @include('dashboard.willform.partials.combo-options')
                </select>
            </div>
            <div class="col-sm-6 mt-3">
                <label class="form-col-form-label h4" for="business_exec_relation"><span>He/She</span> is <span
                        class="second_applicant">@{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}</span>'s
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model.trim="business.secondApplicantRelation.$model"
                        :class="business.secondApplicantRelation.$anyError ? 'is-invalid':''"
                        @blur="business.secondApplicantRelation.$touch"
                >
                    @include('dashboard.willform.partials.combo-options')
                </select>
            </div>
            <div class="col-sm-12">
                <div class="row" v-for="(bank,index) in business.persons.$each.$iter">
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner">First Name (required)</label>
                        <input type="text" name="bank_first_name"
                               v-model.trim="bank.firstName.$model"
                               :class="bank.firstName.$anyError ? 'is-invalid':''"
                               @blur="bank.firstName.$touch"
                               class="form-control form-control-lg inner"/>
                    </div>
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_middle_name">
                            Middle Name (required)</label>
                        <input type="text" name="bank_middle_name"
                               v-model.trim="bank.middleName.$model"
                               :class="bank.middleName.$anyError ? 'is-invalid':''"
                               @blur="bank.middleName.$touch"
                               class="form-control form-control-lg inner"/>
                    </div>
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_last_name">Last Name
                            (required)</label>
                        <input type="text" name="bank_last_name"
                               v-model.trim="bank.lastName.$model"
                               :class="bank.lastName.$anyError ? 'is-invalid':''"
                               @blur="bank.lastName.$touch"
                               class="form-control form-control-lg inner"/>
                    </div>
                    <div class="col-sm-6 my-3">
                        <label class="form-col-form-label h4" for="property_share_fraction">Share fraction
                            (required)</label>
                        <select class="form-control form-control-lg" v-if="index > 0">
                            <option value="share"
                                    :selected="businessAssignment[i].persons[0].shareType === 'share'"
                                    :disabled="businessAssignment[i].persons[0].shareType !== 'share'">Share</option>
                            <option value="fraction"
                                    :selected="businessAssignment[i].persons[0].shareType === 'fraction'"
                                    :disabled="businessAssignment[i].persons[0].shareType !== 'fraction'"
                            >Fraction</option>
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
                        <input  v-model.trim="bank.share.$model"
                                type="number"
                                :class="bank.share.$anyError ? 'is-invalid':''"
                                @blur="bank.share.$touch"
                                class="form-control form-control-lg">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-sm-6 my-3">
                        <label class="form-col-form-label h4" for="property_relation">He/She is
                            my</label>
                        <select class="form-control form-control-lg"
                                v-model.trim="bank.relation.$model"
                                :class="bank.relation.$anyError ? 'is-invalid':''"
                                @blur="bank.relation.$touch">
                            @include('dashboard.willform.partials.combo-options')
                        </select>
                    </div>
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
                         v-if="business.finalShare.$anyError"> Overall share values should be equal to @{{ maxPropertyShare(business.$model) }} current is @{{ business.finalShare.$model }}
                    </div>
                </div>
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
                            @click.prevent="addBusinessAssignment"
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

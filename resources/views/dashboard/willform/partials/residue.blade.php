<div class="card card-accent-success" v-if="step==='residue'">
    <div class="card-header h3"><strong>Distribution of residue</strong></div>
    <div class="card-body" v-for="(res,i) in $v.residue.$each.$iter">
        <div class="row">
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="residue_first_name">First Name (required)</label>
                <input class="form-control form-control-lg" name="first_name_second"
                       v-model.trim="res.firstName.$model"
                       :class="res.firstName.$anyError ? 'is-invalid':''"
                       @blur="res.firstName.$touch"
                       type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="res.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="residue_middle_name">Middle Name <br> </label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="res.middleName.$model"
                       :class="res.middleName.$anyError ? 'is-invalid':''"
                       @blur="res.middleName.$touch"
                       type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="res.middleName.$anyError">Please provide a valid
                    middle name.
                </div>
            </div>

            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="residue_last_name">Last Name (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="res.lastName.$model"
                       :class="res.lastName.$anyError ? 'is-invalid':''"
                       @blur="res.lastName.$touch"
                       placeholder="Last Name" required
                />
                <div class="invalid-feedback" v-if="res.lastName.$anyError">Please provide last
                    name.
                </div>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="residue_relation"><span>@{{ res.firstName.$model ? res.firstName.$model : 'He/She' }}</span>
                    is my
                    (required)</label>
                <relationship-selector
                        @blur="res.relation.$touch"
                        v-model.trim="res.relation.$model"
                        :class="res.relation.$anyError ? 'is-invalid':''"></relationship-selector>
            </div>

            <div class="col-sm-6 my-3" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="residue_exec_relation"><span>@{{ res.firstName.$model ? res.firstName.$model : 'He/She' }}</span>
                    is <span
                        class="second_applicant"> @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}</span>'s
                    (required)</label>
                <relationship-selector
                        @blur="res.secondApplicantRelation.$touch"
                        v-model.trim="res.secondApplicantRelation.$model"
                        :class="res.secondApplicantRelation.$anyError ? 'is-invalid':''"></relationship-selector>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="property_share_fraction">Share fraction
                    (required)</label>
                <select class="form-control form-control-lg" v-if="i > 0"
                >
                    <option value="share"
                            :selected="res.shareType.$model === 'share'"
                            :disabled="res.shareType.$model !== 'share'">Share
                    </option>
                    <option value="fraction"
                            :selected="res.shareType.$model === 'fraction'"
                            :disabled="res.shareType.$model !== 'fraction'"
                    >Fraction
                    </option>
                </select>
                <select class="form-control form-control-lg" v-else
                        v-model.trim="res.shareType.$model"
                >
                    <option value="share">Share</option>
                    <option value="fraction">Fraction</option>
                </select>

            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="property_share">Share/Fraction (required)</label>
                <input v-model.trim="res.share.$model"
                       type="number"
                       :class="res.share.$anyError ? 'is-invalid':''"
                       @blur="res.share.$touch"
                       class="form-control form-control-lg">
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="residue_predeceased">Up on first exec predeceased
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model.trim="res.predeceased.$model">
                    @include('dashboard.willform.partials.gifting-details')
                </select>
            </div>
        </div>
        <section class="row" v-if="res.predeceased.$model === 'Assign to named beneficiary'">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_first" id="gift_predeceased_first"
                       v-model.trim="res.beneficiary.firstName.$model"
                       :class="res.beneficiary.firstName.$anyError ? 'is-invalid':''"
                       @blur="res.beneficiary.firstName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_middle">Middle Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_middle"
                       id="gift_predeceased_middle"
                       v-model.trim="res.beneficiary.middleName.$model"
                       :class="res.beneficiary.middleName.$anyError ? 'is-invalid':''"
                       @blur="res.beneficiary.middleName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_last"
                       id="gift_predeceased_last"
                       v-model.trim="res.beneficiary.lastName.$model"
                       :class="res.beneficiary.lastName.$anyError ? 'is-invalid':''"
                       @blur="res.beneficiary.lastName.$touch"
                       class="form-control form-control-lg"></div>
        </section>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" v-if="i > 0"
                            @click.prevent="removeResidue(i)"
                            class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                        Remove
                    </button>
                    <button type="button" data-repeater-create
                            @click.prevent="addResidue"
                            class="ml-5 btn btn-sm btn-success inner"><i
                            class="fa fa-plus-circle"></i>
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row col">
            <div style="{width: 100%;margin-top: 0.25rem;font-size: 80%;color: #e55353;}"
                 v-if="finalResidueShare && (maxResidueShare != finalResidueShare)"> Overall share values should be
                equal to @{{ maxResidueShare }} current is @{{ finalResidueShare }}
            </div>
        </div>
    </div>

    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='business_assignment'"
                    type="button"
                    id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('residue')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

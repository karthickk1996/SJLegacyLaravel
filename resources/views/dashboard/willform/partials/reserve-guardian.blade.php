<div class="card card-accent-success" v-if="step==='reserve_guardian'">
    <div class="card-header h3">
        <strong>Reserve guardian Details</strong></div>
    <div class="card-body" v-for="(guardian,index) in $v.reserveGuardian.$each.$iter">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="first_name_second">First Name
                    (required)</label>
                <input class="form-control form-control-lg" name="first_name_second"
                       v-model.trim="guardian.firstName.$model"
                       :class="guardian.firstName.$anyError ? 'is-invalid':''"
                       @blur="guardian.firstName.$touch"
                       type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="guardian.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="middle_name_second">Middle Name
                    (optional)</label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="guardian.middleName.$model"
                       :class="guardian.middleName.$anyError ? 'is-invalid':''"
                       @blur="guardian.middleName.$touch"
                       type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="guardian.middleName.$anyError">Please provide a valid
                    middle name.
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-start">
                <label class="form-col-form-label h4" for="last_name_second">Last Name
                    (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="guardian.lastName.$model"
                       :class="guardian.lastName.$anyError ? 'is-invalid':''"
                       @blur="guardian.lastName.$touch"
                       placeholder="Last Name" required
                />
                <div class="invalid-feedback" v-if="guardian.lastName.$anyError">Please provide last
                    name.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ reserveGuardian[index].firstName ? reserveGuardian[index].firstName : 'Second Applicant' }}</span>
                    is my</label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="guardian.relation.$model"
                        :class="guardian.relation.$anyError ? 'is-invalid':''"
                        @blur="guardian.relation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="guardian.relation.$anyError">Please choose an option
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">Reserve guardian is @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s</span>
                </label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="guardian.secondApplicantRelation.$model"
                        :class="guardian.secondApplicantRelation.$anyError ? 'is-invalid':''"
                        @blur="guardian.secondApplicantRelation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="guardian.secondApplicantRelation.$anyError">Please choose an option
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="email_second">What is <span
                        class="second_applicant">@{{ reserveGuardian[index].firstName ? reserveGuardian[index].firstName : 'Second Applicant' }}
                        </span>'s email? (required)</label>
                <input class="form-control form-control-lg"
                       v-model.trim="guardian.email.$model"
                       :class="guardian.email.$anyError ? 'is-invalid':''"
                       @blur="guardian.email.$touch"
                       type="email" placeholder="Email" required/>
                <div class="invalid-feedback" v-if="guardian.relation.$anyError">Please provide a valid
                    email.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="dob_second">What is <span
                        class="second_applicants_names"></span>
                    @{{ reserveGuardian[index].firstName ? reserveGuardian[index].firstName : 'Second Applicant' }}'s
                    date of
                    birth? (required)</label>
                <input class="form-control form-control-lg datepicker" id="dob_second" name="dob_second"
                       placeholder=" dd/mm/yyyy" required data-parsley-minimumage="18"
                       v-model.trim="guardian.dob.$model"
                       :class="guardian.dob.$anyError ? 'is-invalid':''"
                       @blur="guardian.dob.$touch"
                />
                <div class="invalid-feedback" v-if="guardian.dob.$anyError">Please provide a valid date of
                    birth
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="address_line1_second" class="h4">Address Line 1</label>
                <input class="form-control form-control-lg"
                       v-model.trim="guardian.line1.$model"
                       @blur="guardian.line1.$touch"
                       :class="guardian.line1.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 1" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="guardian.line1.$anyError">This value is required.
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="address_line2_second" class="h4">Address Line 2</label>
                <input class="form-control form-control-lg"
                       v-model.trim="guardian.line2.$model"
                       @blur="guardian.line2.$touch"
                       :class="guardian.line2.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 2"/>
                <div class="invalid-feedback" v-if="guardian.line2.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="city_second" class="h4">City/Town</label>
                <input class="form-control form-control-lg"
                       v-model.trim="guardian.city.$model"
                       @blur="guardian.city.$touch"
                       :class="guardian.city.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="guardian.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="county_second" class="h4">County</label>
                <input class="form-control form-control-lg"
                       v-model.trim="guardian.county.$model"
                       @blur="guardian.county.$touch"
                       :class="guardian.county.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter county name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="guardian.county.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="country_second" class="h4 d-block">Country</label>
                <select name="country_second" id="country_second" class="form-control form-control-lg" required
                        v-model.trim="guardian.county.$model"
                        @blur="guardian.county.$touch"
                        :class="guardian.county.$anyError ? 'is-invalid':''"
                        data-parsley-trigger="change">
                    <option value="United_Kingdom" selected>United Kingdom</option>
                    <option value="England">England</option>
                    <option value="Wales">Wales</option>
                </select>
                <div class="invalid-feedback" v-if="guardian.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="postal_code_second" class="h4">Postal Code</label>
                <input class="form-control form-control-lg" id="postal_code_second"
                       v-model.trim="guardian.postal.$model"
                       @blur="guardian.postal.$touch"
                       :class="guardian.postal.$anyError ? 'is-invalid':''"
                       name="postal_code_second"
                       type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="!guardian.postal.required">This value is required.
                </div>
                <div class="invalid-feedback" v-if="!guardian.postal.postal">This value is invalid.</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddReserveGuardian"><i
                            class="fa fa-plus-circle"></i>
                        Add Reserve guardian
                    </button>
                    <div v-if="index > 0">
                        <button class="btn btn-lg btn-danger" v-if="reserveGuardian.length > 1"
                                @click.prevent="removeReserveGuardian(index)">
                            <i class="fa fa-minus-circle"></i>
                            Remove Reserve guardian
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row-->
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='guardian'" id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('reserve_guardian')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

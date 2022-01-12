<div class="card card-accent-success hide" v-if="step==='second_applicant'">
    <div class="card-header h3"><strong>Second Applicant Details</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="first_name_second">First Name
                    (required)</label>
                <input class="form-control form-control-lg" name="first_name_second"
                       v-model.trim="$v.secondApplicant.firstName.$model"
                       :class="$v.secondApplicant.firstName.$anyError ? 'is-invalid':''"
                       @blur="$v.secondApplicant.firstName.$touch"
                       type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="$v.form1.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="middle_name_second">Middle Name
                    (optional)</label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="$v.secondApplicant.middleName.$model"
                       :class="$v.secondApplicant.middleName.$anyError ? 'is-invalid':''"
                       @blur="$v.secondApplicant.middleName.$touch"
                       type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="$v.secondApplicant.middleName.$anyError">Please provide a valid
                    middle name.
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-start">
                <label class="form-col-form-label h4" for="last_name_second">Last Name
                    (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="$v.secondApplicant.lastName.$model"
                       :class="$v.secondApplicant.lastName.$anyError ? 'is-invalid':''"
                       @blur="$v.secondApplicant.lastName.$touch"
                       placeholder="Last Name" required
                />
                <div class="invalid-feedback" v-if="$v.secondApplicant.lastName.$anyError">Please provide last
                    name.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}</span>
                    is my</label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="$v.secondApplicant.relation.$model"
                        :class="$v.secondApplicant.relation.$anyError ? 'is-invalid':''"
                        @blur="$v.secondApplicant.relation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="$v.secondApplicant.relation.$anyError">Please choose an option
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="email_second">What is <span
                        class="second_applicant">@{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}</span>'s
                    email? (required)</label>
                <input class="form-control form-control-lg"
                       v-model.trim="$v.secondApplicant.email.$model"
                       :class="$v.secondApplicant.email.$anyError ? 'is-invalid':''"
                       @blur="$v.secondApplicant.email.$touch"
                       type="email" placeholder="Email" required/>
                <div class="invalid-feedback" v-if="$v.secondApplicant.relation.$anyError">Please provide a valid
                    email.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="dob_second">What is <span
                        class="second_applicants_names"></span>
                    @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s date of
                    birth? (required)</label>

                <date-picker v-model="$v.secondApplicant.dob.$model"
                             fomat="YYYY-MM-DD"
                             type="date"
                             placeholder="YYYY-MM-DD"
                             @blur="$v.secondApplicant.dob.$touch"
                             input-class="form-control form-control-lg"
                             :input-class="$v.secondApplicant.dob.$anyError ? 'form-control form-control-lg is-invalid':''"
                ></date-picker>
                <div class="invalid-feedback" v-if="$v.secondApplicant.dob.$anyError">Please provide a valid date of
                    birth
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="address_line1_second" class="h4">Address Line 1</label>
                <input class="form-control form-control-lg"
                       v-model.trim="$v.secondApplicant.line1.$model"
                       @blur="$v.secondApplicant.line1.$touch"
                       :class="$v.secondApplicant.line1.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 1" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="$v.secondApplicant.line1.$anyError">This value is required.
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="address_line2_second" class="h4">Address Line 2</label>
                <input class="form-control form-control-lg"
                       v-model.trim="$v.secondApplicant.line2.$model"
                       @blur="$v.secondApplicant.line2.$touch"
                       :class="$v.secondApplicant.line2.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 2"/>
                <div class="invalid-feedback" v-if="$v.secondApplicant.line2.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="city_second" class="h4">City/Town</label>
                <input class="form-control form-control-lg"
                       v-model.trim="$v.secondApplicant.city.$model"
                       @blur="$v.secondApplicant.city.$touch"
                       :class="$v.secondApplicant.city.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="$v.secondApplicant.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="county_second" class="h4">County</label>
                <input class="form-control form-control-lg"
                       v-model.trim="$v.secondApplicant.county.$model"
                       @blur="$v.secondApplicant.county.$touch"
                       :class="$v.secondApplicant.county.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter county name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="$v.secondApplicant.county.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="country_second" class="h4 d-block">Country</label>
                <select name="country_second" id="country_second" class="form-control form-control-lg" required
                        v-model.trim="$v.secondApplicant.country.$model"
                        @blur="$v.secondApplicant.country.$touch"
                        :class="$v.secondApplicant.country.$anyError ? 'is-invalid':''"
                        data-parsley-trigger="change">
                    <option value="United_Kingdom" selected>United Kingdom</option>
                    <option value="England">England</option>
                    <option value="Wales">Wales</option>
                </select>
                <div class="invalid-feedback" v-if="$v.secondApplicant.country.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="postal_code_second" class="h4">Postal Code</label>
                <input class="form-control form-control-lg" id="postal_code_second"
                       v-model.trim="$v.secondApplicant.postal.$model"
                       @blur="$v.secondApplicant.postal.$touch"
                       :class="$v.secondApplicant.postal.$anyError ? 'is-invalid':''"
                       name="postal_code_second"
                       type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="!$v.secondApplicant.postal.required">This value is required.
                </div>
                <div class="invalid-feedback" v-if="!$v.secondApplicant.postal.postal">This value is invalid.</div>
            </div>
        </div>
        <!-- /.row-->
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='address'"
                    id="address_back" type="button">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('second_applicant')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

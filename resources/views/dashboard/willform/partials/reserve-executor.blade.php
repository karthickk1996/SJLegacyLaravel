<div class="card card-accent-success">
    <div class="card-header h3">
        <strong>Reserve Executor Details</strong></div>
    <form id="second_applicant_form">
        <div class="card-body" v-for="(executor,index) in $v.reserveExecutor.$each.$iter">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="first_name_second">First Name
                        (required)</label>
                    <input class="form-control form-control-lg" name="first_name_second"
                           v-model.trim="executor.firstName.$model"
                           :class="executor.firstName.$anyError ? 'is-invalid':''"
                           @blur="executor.firstName.$touch"
                           type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="executor.firstName.$anyError">Please provide first name.</div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="middle_name_second">Middle Name
                        (optional)</label>
                    <input class="form-control form-control-lg" id="middle_name"
                           v-model.trim="executor.middleName.$model"
                           :class="executor.middleName.$anyError ? 'is-invalid':''"
                           @blur="executor.middleName.$touch"
                           type="text"
                           placeholder="Middle Name">
                    <div class="invalid-feedback" v-if="executor.middleName.$anyError">Please provide a valid
                        middle name.
                    </div>
                </div>
            </div>
            <div class="row d-flex">
                <div class="form-group col-sm-6 align-self-start">
                    <label class="form-col-form-label h4" for="last_name_second">Last Name
                        (required)</label>
                    <input class="form-control form-control-lg" id="last_name"
                           v-model.trim="executor.lastName.$model"
                           :class="executor.lastName.$anyError ? 'is-invalid':''"
                           @blur="executor.lastName.$touch"
                           placeholder="Last Name" required
                    />
                    <div class="invalid-feedback" v-if="executor.lastName.$anyError">Please provide last
                        name.
                    </div>
                </div>
                <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                    <label class="form-col-form-label h4" for="second_applicant_relation"><span
                            class="second_applicant">@{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Second Applicant' }}</span>
                        is my</label>
                    <select class="form-control form-control-lg" id="second_applicant_relation"
                            required
                            v-model.trim="executor.relation.$model"
                            :class="executor.relation.$anyError ? 'is-invalid':''"
                            @blur="executor.relation.$touch"
                    >
                        <option value="">Select an option below</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Civil Partner">Civil Partner</option>
                        <option value="Common Law Partner">Common Law Partner</option>
                    </select>
                    <div class="invalid-feedback" v-if="executor.relation.$anyError">Please choose an option
                    </div>
                </div>
                <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                    <label class="form-col-form-label h4" for="second_applicant_relation"><span
                            class="second_applicant">Reserve executor is @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s</span>
                    </label>
                    <select class="form-control form-control-lg" id="second_applicant_relation"
                            required
                            v-model.trim="executor.secondApplicantRelation.$model"
                            :class="executor.secondApplicantRelation.$anyError ? 'is-invalid':''"
                            @blur="executor.secondApplicantRelation.$touch"
                    >
                        <option value="">Select an option below</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Civil Partner">Civil Partner</option>
                        <option value="Common Law Partner">Common Law Partner</option>
                    </select>
                    <div class="invalid-feedback" v-if="executor.secondApplicantRelation.$anyError">Please choose an option
                    </div>
                </div>
            </div>
            <div class="row d-flex">
                <div class="form-group col-sm-6 align-self-end">
                    <label class="form-col-form-label h4" for="email_second">What is <span
                            class="second_applicant">@{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Second Applicant' }}
                        </span>'s email? (required)</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="executor.email.$model"
                           :class="executor.email.$anyError ? 'is-invalid':''"
                           @blur="executor.email.$touch"
                           type="email" placeholder="Email" required/>
                    <div class="invalid-feedback" v-if="executor.relation.$anyError">Please provide a valid
                        email.
                    </div>
                </div>
                <div class="form-group col-sm-6 align-self-end">
                    <label class="form-col-form-label h4" for="dob_second">What is <span
                            class="second_applicants_names"></span>
                        @{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Second Applicant' }}'s date of
                        birth? (required)</label>
                    <input class="form-control form-control-lg datepicker" id="dob_second" name="dob_second"
                           placeholder=" dd/mm/yyyy" required data-parsley-minimumage="18"
                           v-model.trim="executor.dob.$model"
                           :class="executor.dob.$anyError ? 'is-invalid':''"
                           @blur="executor.dob.$touch"
                    />
                    <div class="invalid-feedback" v-if="executor.dob.$anyError">Please provide a valid date of
                        birth
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="address_line1_second" class="h4">Address Line 1</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="executor.line1.$model"
                           @blur="executor.line1.$touch"
                           :class="executor.line1.$anyError ? 'is-invalid':''"
                           type="text" placeholder="Enter address line 1" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="executor.line1.$anyError">This value is required.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="address_line2_second" class="h4">Address Line 2</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="executor.line2.$model"
                           @blur="executor.line2.$touch"
                           :class="executor.line2.$anyError ? 'is-invalid':''"
                           type="text" placeholder="Enter address line 2"/>
                    <div class="invalid-feedback" v-if="executor.line2.$anyError">This value is required.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="city_second" class="h4">City/Town</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="executor.city.$model"
                           @blur="executor.city.$touch"
                           :class="executor.city.$anyError ? 'is-invalid':''"
                           type="text"
                           placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="executor.city.$anyError">This value is required.</div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="county_second" class="h4">County</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="executor.county.$model"
                           @blur="executor.county.$touch"
                           :class="executor.county.$anyError ? 'is-invalid':''"
                           type="text"
                           placeholder="Enter county name" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="executor.county.$anyError">This value is required.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="country_second" class="h4 d-block">Country</label>
                    <select name="country_second" id="country_second" class="form-control form-control-lg" required
                            v-model.trim="executor.county.$model"
                            @blur="executor.county.$touch"
                            :class="executor.county.$anyError ? 'is-invalid':''"
                            data-parsley-trigger="change">
                        <option value="United_Kingdom" selected>United Kingdom</option>
                        <option value="England">England</option>
                        <option value="Wales">Wales</option>
                    </select>
                    <div class="invalid-feedback" v-if="executor.city.$anyError">This value is required.</div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="postal_code_second" class="h4">Postal Code</label>
                    <input class="form-control form-control-lg" id="postal_code_second"
                           v-model.trim="executor.postal.$model"
                           @blur="executor.postal.$touch"
                           :class="executor.postal.$anyError ? 'is-invalid':''"
                           name="postal_code_second"
                           type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="!executor.postal.required">This value is required.
                    </div>
                    <div class="invalid-feedback" v-if="!executor.postal.postal">This value is invalid.</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group d-flex justify-content-between">
                        <button class="btn btn-lg btn-warning" @click.prevent="AddExecutor"><i class="fa fa-plus-circle"></i>
                            Add Reserve Executor
                        </button>
                        <div v-if="index > 0">
                            <button class="btn btn-lg btn-danger" v-if="reserveExecutor.length > 1" @click.prevent="removeExecutor(index)">
                                <i class="fa fa-minus-circle"></i>
                                Remove Reserve Executor
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row-->
        </div>
        <div class="card-footer">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" @click="step=3" id="address_back">
                    <i class="fa fa-arrow-left"></i> Go
                    Back
                </button>
                <button class="btn btn-lg btn-success"
                        @click.prevent="submitForm(6)"
                        id="address_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

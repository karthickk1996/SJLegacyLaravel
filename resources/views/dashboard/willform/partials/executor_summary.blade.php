<div class="card card-accent-success" v-if="step==='executor_summary'">
    <div class="card-header h3">
        <strong>Executor Details</strong></div>
    <div class="card-body" v-for="(exec,index) in $v.executor.$each.$iter">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="first_name_second">First Name
                    (required)</label>
                <input class="form-control form-control-lg" name="first_name_second"
                       v-model.trim="exec.firstName.$model"
                       :class="exec.firstName.$anyError ? 'is-invalid':''"
                       @blur="exec.firstName.$touch"
                       type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="exec.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="middle_name_second">Middle Name
                    (optional)</label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="exec.middleName.$model"
                       :class="exec.middleName.$anyError ? 'is-invalid':''"
                       @blur="exec.middleName.$touch"
                       type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="exec.middleName.$anyError">Please provide a valid
                    middle name.
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-start">
                <label class="form-col-form-label h4" for="last_name_second">Last Name
                    (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="exec.lastName.$model"
                       :class="exec.lastName.$anyError ? 'is-invalid':''"
                       @blur="exec.lastName.$touch"
                       placeholder="Last Name" required
                />
                <div class="invalid-feedback" v-if="exec.lastName.$anyError">Please provide last
                    name.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ executor[index].firstName ? executor[index].firstName : 'Executor' }}</span>
                    is my</label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="exec.relation.$model"
                        :class="exec.relation.$anyError ? 'is-invalid':''"
                        @blur="exec.relation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="exec.relation.$anyError">Please choose an option
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ executor[index].firstName ? executor[index].firstName : 'Executor' }} is @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s</span>
                </label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="exec.secondApplicantRelation.$model"
                        :class="exec.secondApplicantRelation.$anyError ? 'is-invalid':''"
                        @blur="exec.secondApplicantRelation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="exec.secondApplicantRelation.$anyError">Please choose an option
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="email_second">What is <span
                        class="second_applicant">@{{ executor[index].firstName ? executor[index].firstName : 'Executor' }}
                        </span>'s email? (required)</label>
                <input class="form-control form-control-lg"
                       v-model.trim="exec.email.$model"
                       :class="exec.email.$anyError ? 'is-invalid':''"
                       @blur="exec.email.$touch"
                       type="email" placeholder="Email" required/>
                <div class="invalid-feedback" v-if="exec.relation.$anyError">Please provide a valid
                    email.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="dob_second">What is <span
                        class="second_applicants_names"></span>
                    @{{ executor[index].firstName ? executor[index].firstName : 'Executor' }}'s date of
                    birth? (required)</label>
                <date-picker v-model="exec.dob.$model"
                             fomat="YYYY-MM-DD"
                             type="date"
                             placeholder="YYYY-MM-DD"
                             @blur="exec.dob.$touch"
                             input-class="form-control form-control-lg"
                             :input-class="exec.dob.$anyError ? 'form-control form-control-lg is-invalid':''"
                ></date-picker>
                <div class="invalid-feedback" v-if="exec.dob.$anyError">Please provide a valid date of
                    birth
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="address_line1_second" class="h4">Address Line 1</label>
                <input class="form-control form-control-lg"
                       v-model.trim="exec.line1.$model"
                       @blur="exec.line1.$touch"
                       :class="exec.line1.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 1" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="exec.line1.$anyError">This value is required.
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="address_line2_second" class="h4">Address Line 2</label>
                <input class="form-control form-control-lg"
                       v-model.trim="exec.line2.$model"
                       @blur="exec.line2.$touch"
                       :class="exec.line2.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 2"/>
                <div class="invalid-feedback" v-if="exec.line2.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="city_second" class="h4">City/Town</label>
                <input class="form-control form-control-lg"
                       v-model.trim="exec.city.$model"
                       @blur="exec.city.$touch"
                       :class="exec.city.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="exec.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="county_second" class="h4">County</label>
                <input class="form-control form-control-lg"
                       v-model.trim="exec.county.$model"
                       @blur="exec.county.$touch"
                       :class="exec.county.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter county name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="exec.county.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="country_second" class="h4 d-block">Country</label>
                <select name="country_second" id="country_second" class="form-control form-control-lg" required
                        v-model.trim="exec.country.$model"
                        @blur="exec.country.$touch"
                        :class="exec.country.$anyError ? 'is-invalid':''"
                        data-parsley-trigger="change">
                    <option value="United_Kingdom" selected>United Kingdom</option>
                    <option value="England">England</option>
                    <option value="Wales">Wales</option>
                </select>
                <div class="invalid-feedback" v-if="exec.country.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="postal_code_second" class="h4">Postal Code</label>
                <input class="form-control form-control-lg" id="postal_code_second"
                       v-model.trim="exec.postal.$model"
                       @blur="exec.postal.$touch"
                       :class="exec.postal.$anyError ? 'is-invalid':''"
                       name="postal_code_second"
                       type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="!exec.postal.required">This value is required.
                </div>
                <div class="invalid-feedback" v-if="!exec.postal.postal">This value is invalid.</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddExecutor"><i
                            class="fa fa-plus-circle"></i>
                        Add Executor
                    </button>
                    <div v-if="index > 0">
                        <button class="btn btn-lg btn-danger" v-if="executor.length > 1"
                                @click.prevent="removeExecutor(index)">
                            <i class="fa fa-minus-circle"></i>
                            Remove Executor
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row-->
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='address'"
                    type="button"
                    id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('executor_summary')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<div class="card card-accent-success" v-if="step==='reserve_executor_details'">
    <div class="card-header h3">
        <strong>Reserve Executor Details</strong>
    </div>
    <div class="card-body" v-for="(resExec,index) in $v.reserveExecutor.$each.$iter">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="first_name_second">First Name
                    (required)</label>
                <input class="form-control form-control-lg" name="first_name_second"
                       v-model.trim="resExec.firstName.$model"
                       :class="resExec.firstName.$anyError ? 'is-invalid':''"
                       @blur="resExec.firstName.$touch"
                       type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="resExec.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-col-form-label h4" for="middle_name_second">Middle Name
                    (optional)</label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="resExec.middleName.$model"
                       :class="resExec.middleName.$anyError ? 'is-invalid':''"
                       @blur="resExec.middleName.$touch"
                       type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="resExec.middleName.$anyError">Please provide a valid
                    middle name.
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-start">
                <label class="form-col-form-label h4" for="last_name_second">Last Name
                    (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="resExec.lastName.$model"
                       :class="resExec.lastName.$anyError ? 'is-invalid':''"
                       @blur="resExec.lastName.$touch"
                       placeholder="Last Name" required
                />
                <div class="invalid-feedback" v-if="resExec.lastName.$anyError">Please provide last
                    name.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror hide">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Reserve Executor' }}</span>
                    is my</label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        v-model.trim="resExec.relation.$model"
                        :class="resExec.relation.$anyError ? 'is-invalid':''"
                        @blur="resExec.relation.$touch"
                >
                    @include('dashboard.willform.partials.combo-options')
                </select>
                <div class="invalid-feedback" v-if="resExec.relation.$anyError">Please choose an option
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-start universal_mirror" v-if="hasMirrorWill">
                <label class="form-col-form-label h4" for="second_applicant_relation"><span
                        class="second_applicant">@{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Reserve Executor' }} is @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s</span>
                </label>
                <select class="form-control form-control-lg" id="second_applicant_relation"
                        required
                        v-model.trim="resExec.secondApplicantRelation.$model"
                        :class="resExec.secondApplicantRelation.$anyError ? 'is-invalid':''"
                        @blur="resExec.secondApplicantRelation.$touch"
                >
                    <option value="">Select an option below</option>
                    <option value="Spouse">Spouse</option>
                    <option value="Civil Partner">Civil Partner</option>
                    <option value="Common Law Partner">Common Law Partner</option>
                </select>
                <div class="invalid-feedback" v-if="resExec.secondApplicantRelation.$anyError">Please choose an
                    option
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="email_second">What is <span
                        class="second_applicant">@{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Reserve Executor' }}
                        </span>'s email? (required)</label>
                <input class="form-control form-control-lg"
                       v-model.trim="resExec.email.$model"
                       :class="resExec.email.$anyError ? 'is-invalid':''"
                       @blur="resExec.email.$touch"
                       type="email" placeholder="Email" required/>
                <div class="invalid-feedback" v-if="resExec.relation.$anyError">Please provide a valid
                    email.
                </div>
            </div>
            <div class="form-group col-sm-6 align-self-end">
                <label class="form-col-form-label h4" for="dob_second">What is <span
                        class="second_applicants_names"></span>
                    @{{ reserveExecutor[index].firstName ? reserveExecutor[index].firstName : 'Reserve Executor'
                    }}'s date of
                    birth? (required)</label>
                <date-picker v-model="resExec.dob.$model"
                             format="DD-MM-YYYY"
                             type="date"
                             placeholder="DD-MM-YYYY"
                             @blur="resExec.dob.$touch"
                             input-class="form-control form-control-lg"
                             :input-class="resExec.dob.$anyError ? 'form-control form-control-lg is-invalid':''"
                ></date-picker>
                <div class="invalid-feedback" v-if="resExec.dob.$anyError">Please provide a valid date of
                    birth
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="address_line1_second" class="h4">Address Line 1</label>
                <input class="form-control form-control-lg"
                       v-model.trim="resExec.line1.$model"
                       @blur="resExec.line1.$touch"
                       :class="resExec.line1.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 1" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="resExec.line1.$anyError">This value is required.
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="address_line2_second" class="h4">Address Line 2</label>
                <input class="form-control form-control-lg"
                       v-model.trim="resExec.line2.$model"
                       @blur="resExec.line2.$touch"
                       :class="resExec.line2.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter address line 2"/>
                <div class="invalid-feedback" v-if="resExec.line2.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="city_second" class="h4">City/Town</label>
                <input class="form-control form-control-lg"
                       v-model.trim="resExec.city.$model"
                       @blur="resExec.city.$touch"
                       :class="resExec.city.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="resExec.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="county_second" class="h4">County</label>
                <input class="form-control form-control-lg"
                       v-model.trim="resExec.county.$model"
                       @blur="resExec.county.$touch"
                       :class="resExec.county.$anyError ? 'is-invalid':''"
                       type="text"
                       placeholder="Enter county name" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="resExec.county.$anyError">This value is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="country_second" class="h4 d-block">Country</label>
                <select name="country_second" id="country_second" class="form-control form-control-lg" required
                        v-model.trim="resExec.country.$model"
                        @blur="resExec.country.$touch"
                        :class="resExec.country.$anyError ? 'is-invalid':''"
                        data-parsley-trigger="change">
                    <option value="United_Kingdom" selected>United Kingdom</option>
                    <option value="England">England</option>
                    <option value="Wales">Wales</option>
                </select>
                <div class="invalid-feedback" v-if="resExec.country.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="postal_code_second" class="h4">Postal Code</label>
                <input class="form-control form-control-lg" id="postal_code_second"
                       v-model.trim="resExec.postal.$model"
                       @blur="resExec.postal.$touch"
                       :class="resExec.postal.$anyError ? 'is-invalid':''"
                       name="postal_code_second"
                       type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="!resExec.postal.required">This value is required.
                </div>
                <div class="invalid-feedback" v-if="!resExec.postal.postal">This value is invalid.</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddReserveExecutor"><i
                            class="fa fa-plus-circle"></i>
                        Add Reserve Executor
                    </button>
                    <div v-if="index > 0">
                        <button class="btn btn-lg btn-danger" v-if="reserveExecutor.length > 1"
                                @click.prevent="RemoveReserveExecutor(index)">
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
            <button class="btn btn-lg btn-primary" @click.prevent="backToExecutor()"
                    type="button"
                    id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('reserve_executor_details')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

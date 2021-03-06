<div class="card card-accent-primary"
     v-if="step==='children_details'"
>
    <div class="card-header h3"><strong>Children Details</strong></div>
    <div class="card-body hide" v-if="hasMoreThanOneChildren">
        <div class="form-group">
            <div class="row">
                <h4 class="mb-2 d-inline col-9">Would you like to assign all children to the same guardian(s)?</h4>
                <toggle-button v-model="sameGuardianAllChildren"
                               :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>

            </div>
        </div>
    </div>

    <div class="card-body">
        <div v-for="(child,index) in $v.children.$each.$iter">
            <div class="row mt-3" v-if="!sameGuardianAllChildren">
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="first_name_child">First Name of Child <br>
                        (required)</label>
                    <input class="form-control form-control-lg" name="first_name_second"
                           v-model.trim="child.firstName.$model"
                           :class="child.firstName.$anyError ? 'is-invalid':''"
                           @blur="child.firstName.$touch"
                           type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="child.firstName.$anyError">Please provide first name.</div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="middle_name_child">Middle Name of Child<br>
                        (optional)</label>
                    <input class="form-control form-control-lg" id="middle_name"
                           v-model.trim="child.middleName.$model"
                           :class="child.middleName.$anyError ? 'is-invalid':''"
                           @blur="child.middleName.$touch"
                           type="text"
                           placeholder="Middle Name">
                    <div class="invalid-feedback" v-if="child.middleName.$anyError">Please provide a valid
                        middle name.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="last_name_second">Last Name
                        (required)</label>
                    <input class="form-control form-control-lg" id="last_name"
                           v-model.trim="child.lastName.$model"
                           :class="child.lastName.$anyError ? 'is-invalid':''"
                           @blur="child.lastName.$touch"
                           placeholder="Last Name" required
                    />
                    <div class="invalid-feedback" v-if="child.lastName.$anyError">Please provide last
                        name.
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="first_name_guardian">First Name of Guardian
                        (required)</label>
                    <input class="form-control form-control-lg" name="first_name_second"
                           v-model.trim="child.guardianFirstName.$model"
                           :class="child.guardianFirstName.$anyError ? 'is-invalid':''"
                           @blur="child.guardianFirstName.$touch"
                           type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="child.guardianFirstName.$anyError">Please provide first
                        name.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="middle_name_guardian">Middle Name of Guardian
                        (optional)</label>
                    <input class="form-control form-control-lg" id="middle_name"
                           v-model.trim="child.guardianMiddleName.$model"
                           :class="child.guardianMiddleName.$anyError ? 'is-invalid':''"
                           @blur="child.guardianMiddleName.$touch"
                           type="text"
                           placeholder="Middle Name">
                    <div class="invalid-feedback" v-if="child.guardianMiddleName.$anyError">Please provide a valid
                        middle name.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="last_name_guardian">Last Name of Guardian
                        (required)</label>
                    <input class="form-control form-control-lg" id="last_name"
                           v-model.trim="child.guardianLastName.$model"
                           :class="child.guardianLastName.$anyError ? 'is-invalid':''"
                           @blur="child.guardianLastName.$touch"
                           placeholder="Last Name" required
                    />
                    <div class="invalid-feedback" v-if="child.guardianLastName.$anyError">Please provide last
                        name.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="guardian_relation">@{{ children[index].GuardianFirstName ?
                        children[index].GuardianFirstName : 'He/She' }}
                        is my (required)</label>
                    <relationship-selector
                            @blur="child.relation.$touch"
                            v-model.trim="child.relation.$model"
                            :class="child.relation.$anyError ? 'is-invalid':''"></relationship-selector>
                    <div class="invalid-feedback" v-if="child.relation.$anyError">Please choose an option</div>
                </div>
                <div class="form-group col-sm-6" v-if="hasMirrorWill">
                    <label class="form-col-form-label h4" for="guardian_second_relation">
                        @{{ children[index].GuardianFirstName ? children[index].GuardianFirstName : 'He/She' }}
                        is
                        @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                        (required)</label>
                    <relationship-selector
                            @blur="child.secondApplicantRelation.$touch"
                            v-model.trim="child.secondApplicantRelation.$model"
                            :class="child.secondApplicantRelation.$anyError ? 'is-invalid':''"></relationship-selector>
                    <div class="invalid-feedback" v-if="child.secondApplicantRelation.$anyError">Please choose
                        an option
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="address_line1_guardian">Address Line 1
                        (required)</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="child.line1.$model"
                           @blur="child.line1.$touch"
                           :class="child.line1.$anyError ? 'is-invalid':''"
                           type="text" placeholder="Enter address line 1" required
                           data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="child.line1.$anyError">This value is required.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="address_line2_guardian">Address Line 2
                        (required)</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="child.line2.$model"
                           @blur="child.line2.$touch"
                           :class="child.line2.$anyError ? 'is-invalid':''"
                           type="text" placeholder="Enter address line 2"/>
                    <div class="invalid-feedback" v-if="child.line2.$anyError">This value is required.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="city_guardian">City/Town
                        (required)</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="child.city.$model"
                           @blur="child.city.$touch"
                           :class="child.city.$anyError ? 'is-invalid':''"
                           type="text"
                           placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="child.city.$anyError">This value is required.</div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-col-form-label h4" for="county_guardian">County
                        (required)</label>
                    <input class="form-control form-control-lg"
                           v-model.trim="child.county.$model"
                           @blur="child.county.$touch"
                           :class="child.county.$anyError ? 'is-invalid':''"
                           type="text"
                           placeholder="Enter county name" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="child.county.$anyError">This value is required.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="country_guardian" class="h4 d-block">Country</label>
                    <select name="country_second" id="country_second" class="form-control form-control-lg"
                            required
                            v-model.trim="child.country.$model"
                            @blur="child.country.$touch"
                            :class="child.country.$anyError ? 'is-invalid':''"
                            data-parsley-trigger="change">
                        <option value="United_Kingdom" selected>United Kingdom</option>
                        <option value="England">England</option>
                        <option value="Wales">Wales</option>
                    </select>
                    <div class="invalid-feedback" v-if="child.country.$anyError">This value is required.
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="postal_code_guardian" class="h4">Postal Code</label>
                    <input class="form-control form-control-lg" id="postal_code_second"
                           v-model.trim="child.postal.$model"
                           @blur="child.postal.$touch"
                           :class="child.postal.$anyError ? 'is-invalid':''"
                           name="postal_code_second"
                           type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                    <div class="invalid-feedback" v-if="!child.postal.required">This value is required.
                    </div>
                    <div class="invalid-feedback" v-if="!child.postal.postal">This value is invalid.
                    </div>
                </div>
            </div>
            <div class="row" v-if="hasMoreThanOneChildren">
                <div class="col">
                    <div class="form-group d-flex justify-content-between">
                        <button class="btn btn-lg btn-warning"
                                @click.prevent="AddJointGuardian">
                            <i class="fa fa-plus-circle"></i>
                            Add Joint Guardian
                        </button>
                        <div v-if="index > 0">
                            <button class="btn btn-lg btn-danger"
                                    v-if="children.length > 1"
                                    @click.prevent="removeJointGuardian(index)">
                                <i class="fa fa-minus-circle"></i>
                                Remove Joint Guardian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-lg btn-primary"
                @click="step='guardian'">
            <i class="fa fa-arrow-left"></i> Go
            Back
        </button>
        <button class="btn btn-lg btn-success"
                @click.prevent="submitForm('children_details')"
                id="address_next" type="submit">
            Next <i class="fa fa-arrow-right"></i></button>
    </div>
</div>

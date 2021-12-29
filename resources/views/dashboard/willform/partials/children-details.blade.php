<div class="card card-accent-primary hide" id="guardian_allocation">
    <div class="card-header h3"><strong>Children Details</strong></div>
    <form id="guardian_allocation_form">
        <div class="card-body hide" id="more_children">
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
                <div class="row mt-3 same_guardian" v-if="!sameGuardianAllChildren">
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
                               v-model.trim="child.GuardianFirstName.$model"
                               :class="child.GuardianFirstName.$anyError ? 'is-invalid':''"
                               @blur="child.GuardianFirstName.$touch"
                               type="text" placeholder="First Name" required data-parsley-trigger="change"/>
                        <div class="invalid-feedback" v-if="child.GuardianFirstName.$anyError">Please provide first
                            name.
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-col-form-label h4" for="middle_name_guardian">Middle Name of Guardian
                            (optional)</label>
                        <input class="form-control form-control-lg" id="middle_name"
                               v-model.trim="child.GuardianMiddleName.$model"
                               :class="child.GuardianMiddleName.$anyError ? 'is-invalid':''"
                               @blur="child.GuardianMiddleName.$touch"
                               type="text"
                               placeholder="Middle Name">
                        <div class="invalid-feedback" v-if="child.GuardianMiddleName.$anyError">Please provide a valid
                            middle name.
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-col-form-label h4" for="last_name_guardian">Last Name of Guardian
                            (required)</label>
                        <input class="form-control form-control-lg" id="last_name"
                               v-model.trim="child.GuardianLastName.$model"
                               :class="child.GuardianLastName.$anyError ? 'is-invalid':''"
                               @blur="child.GuardianLastName.$touch"
                               placeholder="Last Name" required
                        />
                        <div class="invalid-feedback" v-if="child.GuardianLastName.$anyError">Please provide last
                            name.
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-col-form-label h4" for="guardian_relation">@{{ children[index].firstName ?
                            children[index].firstName : 'He/She' }}
                            is my (required)</label>
                        <select class="form-control form-control-lg" id="guardian_relation" name="guardian_relation"
                                v-model.trim="child.relation.$model"
                                :class="child.relation.$anyError ? 'is-invalid':''"
                                @blur="child.relation.$touch"
                                data-my-validation="relation">
                            @include('dashboard.willform.partials.combo-options')
                        </select>
                        <div class="invalid-feedback" v-if="child.relation.$anyError">Please choose an option</div>
                        <div class="form-group col-sm-6 universal_mirror hide">
                            <label class="form-col-form-label h4" for="guardian_second_relation">
                                @{{ children[index].firstName ? children[index].firstName : 'He/She' }}
                                is
                                @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                                (required)</label>
                            <select class="form-control form-control-lg" id="guardian_second_relation"
                                    v-model.trim="child.secondApplicantRelation.$model"
                                    :class="child.secondApplicantRelation.$anyError ? 'is-invalid':''"
                                    @blur="child.secondApplicantRelation.$touch"
                                    name="guardian_second_relation" data-my-validation="relation">
                                @include('dashboard.willform.partials.combo-options')
                            </select>
                            <div class="invalid-feedback" v-if="child.secondApplicantRelation.$anyError">Please choose
                                an option
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form-col-form-label h4" for="address_line1_guardian">Address Line1
                                (required)</label>
                            <input class="form-control form-control-lg"
                                   v-model.trim="executor.line1.$model"
                                   @blur="executor.line1.$touch"
                                   :class="executor.line1.$anyError ? 'is-invalid':''"
                                   type="text" placeholder="Enter address line 1" required
                                   data-parsley-trigger="change"/>
                            <div class="invalid-feedback" v-if="executor.line1.$anyError">This value is required.
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form-col-form-label h4" for="address_line2_guardian">Address Line2
                                (required)</label>
                            <input class="form-control form-control-lg"
                                   v-model.trim="executor.line2.$model"
                                   @blur="executor.line2.$touch"
                                   :class="executor.line2.$anyError ? 'is-invalid':''"
                                   type="text" placeholder="Enter address line 2"/>
                            <div class="invalid-feedback" v-if="executor.line2.$anyError">This value is required.
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form-col-form-label h4" for="city_guardian">City/Town
                                (required)</label>
                            <input class="form-control form-control-lg"
                                   v-model.trim="executor.city.$model"
                                   @blur="executor.city.$touch"
                                   :class="executor.city.$anyError ? 'is-invalid':''"
                                   type="text"
                                   placeholder="Enter your city/town" required data-parsley-trigger="change"/>
                            <div class="invalid-feedback" v-if="executor.city.$anyError">This value is required.</div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form-col-form-label h4" for="county_guardian">County
                                (required)</label>
                            <input class="form-control form-control-lg"
                                   v-model.trim="executor.county.$model"
                                   @blur="executor.county.$touch"
                                   :class="executor.county.$anyError ? 'is-invalid':''"
                                   type="text"
                                   placeholder="Enter county name" required data-parsley-trigger="change"/>
                            <div class="invalid-feedback" v-if="executor.county.$anyError">This value is required.
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="country_guardian" class="h4 d-block">Country</label>
                                <select name="country_second" id="country_second" class="form-control form-control-lg"
                                        required
                                        v-model.trim="executor.county.$model"
                                        @blur="executor.county.$touch"
                                        :class="executor.county.$anyError ? 'is-invalid':''"
                                        data-parsley-trigger="change">
                                    <option value="United_Kingdom" selected>United Kingdom</option>
                                    <option value="England">England</option>
                                    <option value="Wales">Wales</option>
                                </select>
                                <div class="invalid-feedback" v-if="executor.city.$anyError">This value is required.
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="postal_code_guardian" class="h4">Postal Code</label>
                                <input class="form-control form-control-lg" id="postal_code_second"
                                       v-model.trim="executor.postal.$model"
                                       @blur="executor.postal.$touch"
                                       :class="executor.postal.$anyError ? 'is-invalid':''"
                                       name="postal_code_second"
                                       type="text" placeholder="Postal Code" required data-parsley-trigger="change"/>
                                <div class="invalid-feedback" v-if="!executor.postal.required">This value is required.
                                </div>
                                <div class="invalid-feedback" v-if="!executor.postal.postal">This value is invalid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                <div class="card-footer">
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
        </div>
    </form>
</div>

<div class="card card-accent-success"
     v-if="step==='gift_property'"
>
    <div class="card-header h3"><strong>Gift of property/land</strong>: Please enter the details of property below</div>
    <div class="card-body" v-for="(property,i) in $v.giftProperty.$each.$iter">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="property_name" class="h4">Property Name</label>
                <input class="form-control form-control-lg" type="text"
                       v-model.trim="property.name.$model"
                       :class="property.name.$anyError ? 'is-invalid':''"
                       @blur="property.name.$touch"
                       placeholder="Enter property name"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="address_line1_property" class="h4">Address Line 1</label>
                <input class="form-control form-control-lg"
                       v-model.trim="property.line1.$model"
                       :class="property.line1.$anyError ? 'is-invalid':''"
                       @blur="property.line1.$touch"
                       type="text" placeholder="Enter address line 1"
                       data-my-validation="address"/>
            </div>
            <div class="form-group col-sm-6">
                <label for="address_line2_property" class="h4">Address Line 2</label>
                <input class="form-control form-control-lg"
                       v-model.trim="property.line2.$model"
                       :class="property.line2.$anyError ? 'is-invalid':''"
                       @blur="property.line2.$touch"
                       type="text" placeholder="Enter address line 2">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="city_property" class="h4">City/Town</label>
                <input class="form-control form-control-lg" type="text"
                       v-model.trim="property.city.$model"
                       :class="property.city.$anyError ? 'is-invalid':''"
                       @blur="property.city.$touch"
                       placeholder="Enter your city/town"/>
            </div>
            <div class="form-group col-sm-6">
                <label for="county_property" class="h4">County</label>
                <input class="form-control form-control-lg"
                       v-model.trim="property.county.$model"
                       :class="property.county.$anyError ? 'is-invalid':''"
                       @blur="property.county.$touch"
                       name="county_property" type="text"
                       placeholder="Enter county name" data-my-validation="county"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="country_property" class="h4 d-block">Country</label>
                <select
                    v-model.trim="property.country.$model"
                    :class="property.country.$anyError ? 'is-invalid':''"
                    @blur="property.country.$touch"
                    class="form-control form-control-lg">
                    <option value="United Kingdom" selected>United Kingdom</option>
                    <option value="England">England</option>
                    <option value="Wales">Wales</option>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label for="postal_code_property" class="h4">Postal Code</label>
                <input class="form-control form-control-lg"
                       v-model.trim="property.postal.$model"
                       :class="property.postal.$anyError ? 'is-invalid':''"
                       @blur="property.postal.$touch"
                       type="text" placeholder="Postal Code" data-my-validation="postal_code"
                />
            </div>
        </div>
        <div class="row" v-for="(bank,index) in property.persons.$each.$iter">
            <input type="hidden" v-model="bank.id.$model = i">
            <input type="hidden" v-model="bank.beneficiary.id.$model = i">
            <input type="hidden" v-model="bank.beneficiary.personId.$model = index">
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
                            :selected="giftProperty[i].persons[0].shareType === 'share'"
                            :disabled="giftProperty[i].persons[0].shareType !== 'share'">Share
                    </option>
                    <option value="equal"
                            :selected="giftProperty[i].persons[0].shareType === 'equal'"
                            :disabled="giftProperty[i].persons[0].shareType !== 'equal'"
                    >Equally Split
                    </option>
                </select>
                <select class="form-control form-control-lg" v-else
                        v-model.trim="bank.shareType.$model"
                >
                    <option value="share">Share</option>
                    <option value="equal">Equally Split</option>
                </select>
            </div>
            <div class="col-sm-6 my-3" v-if="giftProperty[i].persons[0].shareType === 'share'">
                <label class="form-col-form-label h4" for="property_share">Share/Fraction (required)</label>
                <input type="number" v-model.trim="bank.share.$model"
                       :class="bank.share.$anyError ? 'is-invalid':''"
                       @blur="bank.share.$touch"
                       class="form-control form-control-lg">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group col-sm-6 my-3">
                <label class="form-col-form-label h4" for="property_relation">
                    <span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }} is</span>
                  </label>
                <relationship-selector
                        @blur="bank.relation.$touch"
                        v-model.trim="bank.relation.$model"
                        :class="bank.relation.$anyError ? 'is-invalid':''"></relationship-selector>
            </div>
            <div class="col-sm-6 inner" v-if="hasMirrorWill">
                <label class="form-col-form-label h4 mt-3 inner" for="bank_second_relation">
                    <span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }} is</span>
                    @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                    (required)
                </label>
                <relationship-selector
                        @blur="bank.secondApplicantRelation.$touch"
                        v-model.trim="bank.secondApplicantRelation.$model"
                        :class="bank.secondApplicantRelation.$anyError ? 'is-invalid':''"></relationship-selector>
            </div>
            <div class="form-group col-sm-6 my-3">
                <label class="form-col-form-label h4" for="property_predeceased">Upon first exec predeceased
                    (required) </label>
                <select class="form-control form-control-lg"
                        v-model.trim="bank.predeceased.$model"
                        :class="bank.predeceased.$anyError ? 'is-invalid':''"
                        @change="touchValidation(bank)"
                        @blur="bank.predeceased.$touch">
                    @include('dashboard.willform.partials.gifting-details')
                </select>
            </div>
            <div class="col-sm-12" v-if="bank.predeceased.$model === 'Assign to named beneficiary'">
                <div class="row">
                    <div class="col-sm-6 inner mt-3">
                        <label class="form-col-form-label h4"
                               for="money_predeceased_first">First Name (required)</label>
                        <input name="money_predeceased_first"
                               v-model.trim="bank.beneficiary.firstName.$model"
                               :class="bank.beneficiary.firstName.$anyError ? 'is-invalid':''"
                               @blur="bank.beneficiary.firstName.$touch"
                               class="form-control form-control-lg inner">
                    </div>
                    <div class="col-sm-6 inner mt-3">
                        <label class="form-col-form-label h4"
                               for="money_predeceased_middle">Middle Name (required)</label>
                        <input name="money_predeceased_middle"
                               v-model.trim="bank.beneficiary.middleName.$model"
                               :class="bank.beneficiary.middleName.$anyError ? 'is-invalid':''"
                               @blur="bank.beneficiary.middleName.$touch"
                               class="form-control form-control-lg inner">
                    </div>
                    <div class="col-sm-6 mt-3 inner">
                        <label class="form-col-form-label h4" for="money_predeceased_last">Last
                            Name (required)</label>
                        <input name="money_predeceased_last"
                               v-model.trim="bank.beneficiary.lastName.$model"
                               :class="bank.beneficiary.lastName.$anyError ? 'is-invalid':''"
                               @blur="bank.beneficiary.lastName.$touch"
                               class="form-control form-control-lg inner">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" v-if="index > 0"
                            @click.prevent="removePropertyPerson(i,index)"
                            class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                        Remove
                        Person
                    </button>
                    <button type="button" data-repeater-create
                            @click.prevent="addPropertyPerson(i)"
                            class="ml-5 btn btn-sm btn-success inner"><i
                            class="fa fa-plus-circle"></i>
                        Add Person
                    </button>
                </div>
            </div>
        </div>
        <div class="row col">
            <div class="row col" v-if="property.finalShare.$anyError">
                <div style="{width: 100%;margin-top: 0.25rem;font-size: 80%;color: #e55353;}"> Overall share values should be equal to @{{
                    maxPropertyShare(property.$model) }} current is @{{ countShare(property.$model.persons) }}
                </div>
            </div>
        </div>

        <div class="col-sm-12 text-center">
            <div class="d-flex justify-content-center mt-3">
                <button type="button" v-if="i > 0"
                        @click.prevent="removeBankProperty(i)"
                        class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                    Remove
                    Property
                </button>
                <button type="button" data-repeater-create
                        @click.prevent="addBankProperty"
                        class="ml-5 btn btn-sm btn-success inner"><i
                        class="fa fa-plus-circle"></i>
                    Add Property
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click="step='gift_bank'">
                <i class="fa fa-arrow-left"></i>
                Go Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('gift_property')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

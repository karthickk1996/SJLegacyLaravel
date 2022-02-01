<div class="card card-accent-success">
    <div class="card-header h3">Gift of bank account</div>
    <div data-repeater-list="outer-group" class="card-body outer" v-for="(account,i) in $v.giftBank.$each.$iter">
        <div class="outer">
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4 mt-3" for="bank_name">Bank Name</label>
                    <input type="text"
                           v-model.trim="account.bankName.$model"
                           :class="account.bankName.$anyError ? 'is-invalid':''"
                           @blur="account.bankName.$touch"
                           class="form-control form-control-lg outer"/>
                </div>
                <div class="col-sm-6 ">
                    <label class="form-col-form-label h4 mt-3" for="bank_account_reference">Bank Account
                        Reference</label>
                    <input type="text"
                           v-model.trim="account.bankReference.$model"
                           :class="account.bankReference.$anyError ? 'is-invalid':''"
                           @blur="account.bankReference.$touch"
                           class="form-control form-control-lg outer"/>
                </div>
            </div>
            <div v-for="(bank,index) in account.persons.$each.$iter">
                <div class="inner row mt-3">
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
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_relation"><span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }}</span>
                            is my
                            (required)
                        </label>
                        <select type="text" class="form-control form-control-lg inner select2"
                                v-model.trim="bank.relation.$model"
                                :class="bank.relation.$anyError ? 'is-invalid':''"
                                @blur="bank.relation.$touch"
                                name="bank_relation">
                            @include('dashboard.willform.partials.combo-options')
                        </select>
                    </div>
                    <div class="col-sm-6 inner" v-if="hasMirrorWill">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_second_relation">
                            He / She is
                            <span>@{{ bank.firstName.$model ? bank.firstName.$model : 'He/She' }} is</span>
                            @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                            (required)</label>
                        <select class="form-control form-control-lg inner select2"
                                v-model.trim="bank.secondApplicantRelation.$model"
                                :class="bank.secondApplicantRelation.$anyError ? 'is-invalid':''"
                                @blur="bank.secondApplicantRelation.$touch"
                                name="bank_second_relation">
                            @include('dashboard.willform.partials.combo-options')
                        </select>
                    </div>
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_predeceased">Up on
                            first
                            exec
                            predeceased (required) </label>
                        <select class="form-control form-control-lg inner select2"
                                v-model.trim="bank.predeceased.$model"
                                :class="bank.predeceased.$anyError ? 'is-invalid':''"
                                @blur="bank.predeceased.$touch"
                                name="bank_predeceased">
                            @include('dashboard.willform.partials.gifting-details')
                        </select>
                    </div>
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner"
                               for="bank_share_fraction">Share/
                            Fraction
                            (required) </label>
                        <select class="form-control form-control-lg inner bank_share_fraction"
                                :class="bank.shareType.$anyError ? 'is-invalid':''"
                                @blur="bank.shareType.$touch" v-if="index > 0">
                            <option value="share"
                                    :selected="giftBank[i].persons[0].shareType === 'share'"
                                    :disabled="giftBank[i].persons[0].shareType !== 'share'"
                            >Share
                            </option>
                            <option value="fraction"
                                    :selected="giftBank[i].persons[0].shareType === 'fraction'"
                                    :disabled="giftBank[i].persons[0].shareType !== 'fraction'"
                            >Fraction
                            </option>
                        </select>
                        <select class="form-control form-control-lg" v-else
                                v-model.trim="bank.shareType.$model">
                            <option value="share">Share</option>
                            <option value="fraction">Fraction</option>
                        </select>
                    </div>
                    <div class="col-sm-6 inner">
                        <label class="form-col-form-label h4 mt-3 inner" for="bank_share">Share in
                            Percentage / Fraction
                            (required)</label>
                        <input type="number" name="bank_share"
                               v-model.trim="bank.share.$model"
                               :class="bank.share.$anyError ? 'is-invalid':''"
                               @blur="bank.share.$touch"
                               @change="giftBank.maxShare = finalShare"
                               class="form-control form-control-lg inner"/>
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
                                    @click.prevent="removeBankPerson(i,index)"
                                    class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                                Remove
                                Person
                            </button>
                            <button type="button" data-repeater-create
                                    @click.prevent="addBankPerson(i,index)"
                                    class="ml-5 btn btn-sm btn-success inner"><i
                                    class="fa fa-plus-circle"></i>
                                Add Person
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" v-if="i > 0"
                            @click.prevent="removeBank(i)"
                            class="btn btn-sm btn-warning inner"><i class="fa fa-minus-circle"></i>
                        Remove
                        Bank
                    </button>
                    <button type="button" data-repeater-create
                            @click.prevent="addBank()"
                            class="ml-5 btn btn-sm btn-success inner"><i
                            class="fa fa-plus-circle"></i>
                        Add Bank
                    </button>
                </div>
            </div>

            {{--            <div class="row col">--}}
            {{--                <div style="{width: 100%;margin-top: 0.25rem;font-size: 80%;color: #e55353;}"--}}
            {{--                     v-if="account.maxShare.$anyError"> Overall share values should be equal to @{{ maxBankShare(account) }} current is @{{ account.maxShare.$model }}--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>

    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary"
                    @click.prevent="step='gift_charity'">
                <i class="fa fa-arrow-left"></i>
                Go Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('gift_bank')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>


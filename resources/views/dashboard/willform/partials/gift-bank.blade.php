<div class="card card-accent-success" v-if="gift_bank">
    <div class="card-header h3">Gift of bank account</div>
    <div data-repeater-list="outer-group" class="card-body outer">
        <div class="outer">
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4 mt-3" for="bank_name">Bank Name</label>
                    <input type="text"
                           v-model.trim="$v.giftBank.bankName.$model"
                           :class="$v.giftBank.bankName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftBank.bankName.$touch"
                           class="form-control form-control-lg outer"/>
                </div>
                <div class="col-sm-6 ">
                    <label class="form-col-form-label h4 mt-3" for="bank_account_reference">Bank Account
                        Reference</label>
                    <input type="text"
                           v-model.trim="$v.giftBank.bankReference.$model"
                           :class="$v.giftBank.bankReference.$anyError ? 'is-invalid':''"
                           @blur="$v.giftBank.bankReference.$touch"
                           class="form-control form-control-lg outer"/>
                </div>
            </div>
            <div class="inner-repeater" >
                <div data-repeater-list="inner-group" class="inner" v-for="(bank,index) in $v.giftBank.persons.$each.$iter">
                    <div data-repeater-item class="inner row mt-3">
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_first_name">First
                                Name
                                (required)</label>
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
                                   v-model.trim="bank.firstName.$model"
                                   :class="bank.firstName.$anyError ? 'is-invalid':''"
                                   @blur="bank.firstName.$touch"
                                   class="form-control form-control-lg inner"/>
                        </div>
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_last_name">Last Name
                                (required)</label>
                            <input type="text" name="bank_last_name"
                                   v-model.trim="bank.firstName.$model"
                                   :class="bank.firstName.$anyError ? 'is-invalid':''"
                                   @blur="bank.firstName.$touch"
                                   class="form-control form-control-lg inner"/>
                        </div>
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_relation">He / She is
                                my
                            </label>
                            <select type="text" class="form-control form-control-lg inner select2"
                                    v-model.trim="bank.firstName.$model"
                                    :class="bank.firstName.$anyError ? 'is-invalid':''"
                                    @blur="bank.firstName.$touch"
                                    name="bank_relation">
                                @include('dashboard.willform.partials.combo-options')
                            </select>
                        </div>
                        <div class="col-sm-6 inner" v-if="hasMirrorWill">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_second_relation">He /
                                She
                                is
                                <span class="second_applicant">Second Applicant</span>'s </label>
                            <select class="form-control form-control-lg inner select2"
                                    v-model.trim="bank.firstName.$model"
                                    :class="bank.firstName.$anyError ? 'is-invalid':''"
                                    @blur="bank.firstName.$touch"
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
                                    v-model.trim="bank.firstName.$model"
                                    :class="bank.firstName.$anyError ? 'is-invalid':''"
                                    @blur="bank.firstName.$touch"
                                    name="bank_predeceased">
                                @include('dashboard.willform.partials.gifting-details')
                            </select>
                        </div>
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner"
                                   for="bank_share_fraction">Share/
                                Fraction
                                (required) </label>
                            <select class="form-control form-control-lg inner bank_share_fraction select2"
                                    v-model.trim="bank.firstName.$model"
                                    :class="bank.firstName.$anyError ? 'is-invalid':''"
                                    @blur="bank.firstName.$touch"
                                    name="bank_share_fraction" type="number">
                                <option value="0">Share</option>
                                <option value="1">Fraction</option>
                            </select>
                        </div>
                        <div class="col-sm-6 inner">
                            <label class="form-col-form-label h4 mt-3 inner" for="bank_share">Share in
                                percentage
                                /
                                Fraction
                                (required)</label>
                            <input type="text" name="bank_share"
                                   v-model.trim="bank.firstName.$model"
                                   :class="bank.firstName.$anyError ? 'is-invalid':''"
                                   @blur="bank.firstName.$touch"
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
                                           v-model.trim="bank.beneficiary.firstName.$model"
                                           :class="bank.beneficiary.firstName.$anyError ? 'is-invalid':''"
                                           @blur="bank.beneficiary.firstName.$touch"
                                           class="form-control form-control-lg inner">
                                </div>
                                <div class="col-sm-6 mt-3 inner">
                                    <label class="form-col-form-label h4" for="money_predeceased_last">Last
                                        Name (required)</label>
                                    <input name="money_predeceased_last"
                                           v-model.trim="bank.beneficiary.firstName.$model"
                                           :class="bank.beneficiary.firstName.$anyError ? 'is-invalid':''"
                                           @blur="bank.beneficiary.firstName.$touch"
                                           class="form-control form-control-lg inner">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="button" v-if="index > 0"
                                    class="btn btn-sm btn-warning inner mt-3"><i class="fa fa-minus-circle"></i>
                                Remove
                                Person
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-center my-3">
                    <button type="button" data-repeater-create class=" btn btn-sm btn-success inner"><i
                            class="fa fa-plus-circle"></i>
                        Add Person
                    </button>
                </div>
            </div>
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


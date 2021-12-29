<style>
    .tooltip {
        text-align: left;
        width: 400px !important;
    }

    .tooltip ul li {
        text-align: left;
    }
</style>
<div class="card card-accent-success hide" id="gift">
    <div class="card-header h3">
        <strong>Gift of specific items </strong>
        <a class="card-header-action" href="#">
            <small
                class="text-muted" data-toggle="tooltip" data-placement="right" data-html="true" title=""
                data-original-title="<strong>Help Text : </strong> A gift can be:<br><ul><li>a <strong>one-off item</strong> e.g. wedding ring, a watch or piece of art.</li><li><strong>a collection of items</strong> e.g. Record collection, jewellery collection.</li><li><strong>a vehicle,</strong> car, motorbike, boat.</ul><p>Leave blank and select next if you have no specific items to gift</p>">?</small></a>
    </div>
    <form id="gift_form">
        <div class="card-body" id="gift_body">
            <div class="row mt-3">
                <div class="col-sm-12">
                    <label class="form-col-form-label h4" for="gift_data">I would like to gift my</label>
                    <input name="gift_data" id="gift_data"
                           v-model.trim="$v.giftDetails.giftTo.$model"
                           :class="$v.giftDetails.giftTo.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.giftTo.$touch"
                           class="form-control form-control-lg">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_first_name">First Name (required)</label>
                    <input name="gift_first_name" id="gift_first_name" class="form-control form-control-lg"
                           v-model.trim="$v.giftDetails.firstName.$model"
                           :class="$v.giftDetails.firstName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.firstName.$touch"
                    >
                </div>
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_middle_name">Middle Name <br> </label>
                    <input name="gift_middle_name" id="gift_middle_name"
                           v-model.trim="$v.giftDetails.middleName.$model"
                           :class="$v.giftDetails.middleName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.middleName.$touch"
                           class="form-control form-control-lg">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_last_name">Last Name (required)</label>
                    <input name="gift_last_name" id="gift_last_name"
                           v-model.trim="$v.giftDetails.lastName.$model"
                           :class="$v.giftDetails.lastName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.lastName.$touch"
                           class="form-control form-control-lg">
                </div>
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_relation">
                        <span>@{{ giftDetails.firstName ? giftDetails.firstName : 'He/She' }}'s</span> is my
                        (required)</label>
                    <select class="form-control form-control-lg" id="gift_relation"
                            v-model.trim="giftDetails.relation.$model"
                            :class="giftDetails.relation.$anyError ? 'is-invalid':''"
                            @blur="giftDetails.relation.$touch"
                            name="gift_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                    <div class="invalid-feedback" v-if="giftDetails.relation.$anyError">Please choose an option</div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-6 universal_mirror hide">
                    <label class="form-col-form-label h4" for="gift_exec_relation"><span>@{{ giftDetails.firstName ? giftDetails.firstName : 'He/She' }} is</span>
                        @{{ secondApplicant.firstName ? secondApplicant.firstName : 'Second Applicant' }}'s
                        (required)</label>
                    <select class="form-control form-control-lg"
                            v-model.trim="giftDetails.secondApplicantRelation.$model"
                            :class="giftDetails.secondApplicantRelation.$anyError ? 'is-invalid':''"
                            @blur="giftDetails.secondApplicantRelation.$touch"
                            id="gift_exec_relation" name="gift_exec_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>
                <div class="invalid-feedback" v-if="giftDetails.secondApplicantRelation.$anyError">Please choose an
                    option
                </div>
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_predeceased">Up on first exec predeceased
                        (required)</label>
                    <select class="form-control form-control-lg" id="gift_predeceased" name="gift_predeceased">
                        @include('dashboard.willform.partials.gifting-details')
                    </select>
                </div>
            </div>
            <section class="row" v-if="giftDetails.secondApplicantRelation === 'Assign to named beneficiary'">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                        named beneficiary (required)</label>
                    <input name="gift_predeceased_first" id="gift_predeceased_first"
                           v-model.trim="$v.giftDetails.beneficiary.firstName.$model"
                           :class="$v.giftDetails.beneficiary.firstName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.beneficiary.firstName.$touch"
                           class="form-control form-control-lg"></div>
                <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_middle">Middle Name of
                        named beneficiary (required)</label>
                    <input name="gift_predeceased_middle"
                           id="gift_predeceased_middle"
                           v-model.trim="$v.giftDetails.beneficiary.lastName.$model"
                           :class="$v.giftDetails.beneficiary.lastName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.beneficiary.lastName.$touch"
                           class="form-control form-control-lg"></div>
                <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                        named beneficiary (required)</label>
                    <input name="gift_predeceased_last"
                           id="gift_predeceased_last"
                           v-model.trim="$v.giftDetails.beneficiary.lastName.$model"
                           :class="$v.giftDetails.beneficiary.lastName.$anyError ? 'is-invalid':''"
                           @blur="$v.giftDetails.beneficiary.lastName.$touch"
                           class="form-control form-control-lg"></div>
            </section>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="gift_back"><i class="fa fa-arrow-left"></i>
                    Go
                    Back
                </button>
                <button class="btn btn-lg btn-warning" id="gift_add"><i class="fa fa-plus-circle"></i>
                    Add
                </button>
                <button class="btn btn-lg btn-danger" id="gift_minus"><i class="fa fa-minus-circle"></i>
                    Remove
                </button>
                <button class="btn btn-lg btn-success" id="gift_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

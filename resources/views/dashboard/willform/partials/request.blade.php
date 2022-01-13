<div class="card card-accent-success" v-if="step==='request'">
    <div class="card-header h3"><strong>Requests & Wishes</strong></div>
    <div class="card-body">
        <div class="row">
            <section class="col-sm-12 d-flex align-items-center py-2">
                <h4 class="mb-2 d-inline col-10">Do you wish to opt out of system
                    for organ donation?</h4>
                <toggle-button v-model="request.optOutOfOrganDonation"
                               :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
            </section>
        </div>
        <div class="row">
            <section class="universal_mirror hide">
                <section class="d-flex align-items-center py-2 universal_mirror hide">
                    <h4 class="mb-2 d-inline col-10">Does the <span class="second_applicant">second applicant</span>
                        wish
                        to opt out of
                        system for organ donation?</h4>
                    <toggle-button v-model="request.secondApplicantOptOutOfOrganDonation"
                                   :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
                </section>
            </section>
        </div>


        <div class="row my-3">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="burial"><br>Would you like a burial, cremation or
                    woodland burial?</label>
                <select class="form-control form-control-lg" id="burial" v-model="request.burialType">
                    @include('dashboard.willform.partials.burial-options')
                </select>
            </div>
            <div class="col-sm-6 universal_mirror hide">
                <label class="form-col-form-label h4" for="burial_second">Would <span
                        class="second_applicant">second applicant</span> like a burial,
                    cremation
                    or woodland burial?</label>
                <select class="form-control form-control-lg" v-model="request.secondApplicantBurialType">
                    @include('dashboard.willform.partials.burial-options')
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-12 d-flex align-items-center">
                <label class="form-col-form-label h4 col-10" for="funeral_plan">Do you have a funeral plan</label>
                <toggle-button v-model="request.funeralPlan"
                               :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
            </div>
            <div class="col-sm-12" v-if="request.funeralPlan">
                <label class="form-col-form-label h4" for="funeral_plan_details">My funeral plan is with</label>
                <input class="form-control form-control-lg" v-model="request.funeralPlanType"
                       type="text"/>
            </div>
        </div>
        <div class="row my-3 universal_mirror hide">
            <div class="col-sm-12 d-flex align-items-center">
                <label class="form-col-form-label h4 col-10" for="funeral_plan_second">Does the <span
                        class="second_applicant">second applicant</span>
                    have a funeral plan</label>
                <toggle-button v-model="request.secondApplicantFuneralPlan"
                               :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
            </div>
            <div class="col-sm-12" v-if="request.secondApplicantFuneralPlan">
                <label class="form-col-form-label h4" for="funeral_plan_second_details"><span
                        class="second_applicant">Second applicant</span>'s funeral
                    plan is
                    with</label>
                <input class="form-control form-control-lg" v-model="request.secondApplicantFuneralPlanType"
                       type="text"/>
            </div>
        </div>
    </div>
    <div class="card-footer ">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click.prevent="step='residue'"><i class="fa fa-arrow-left"></i>
                Go
                Back
            </button>

            <button class="btn btn-lg btn-success" id="request_next" @click.prevent="submitFinalForm">
                Submit My Will <i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
</div>

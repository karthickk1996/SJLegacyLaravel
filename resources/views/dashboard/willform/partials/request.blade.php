<div class="card card-accent-success hide" v-if="request">
    <div class="card-header h3"><strong>Requests & Wishes</strong></div>
    <form id="request_form">
        <div class="card-body">
            <div class="row">
                <section class="col-sm-12 d-flex align-items-center py-2">
                    <h4 class="mb-2 d-inline col-10">Do you wish to opt out of system
                        for organ donation?</h4>
                    <input type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-width="100"
                           data-height="80" data-onstyle="outline-success" data-offstyle="outline-danger" class="col-2"
                           id="organ_donation" name="organ_donation" />
                </section>
            </div>
            <div class="row">
                <section class="universal_mirror hide">
                    <section class="d-flex align-items-center py-2 universal_mirror hide">
                        <h4 class="mb-2 d-inline col-10">Does the <span class="second_applicant">second applicant</span>
                            wish
                            to opt out of
                            system for organ donation?</h4>
                        <input type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-width="100"
                               data-height="80" data-onstyle="outline-success" data-offstyle="outline-danger" class="col-2"
                               id="organ_donation_second" name="organ_donation_second" />
                    </section>
                </section>
            </div>



            <div class="row my-3">
                <div class="col-sm-6">
                    <label class="form-col-form-label h4" for="burial"><br>Would you like a burial, cremation or
                        woodland burial?</label>
                    <select class="form-control form-control-lg" id="burial" name="burial">
                        @include('dashboard.willform.partials.burial-options')
                    </select>
                </div>
                <div class="col-sm-6 universal_mirror hide">
                    <label class="form-col-form-label h4" for="burial_second">Would <span
                            class="second_applicant">second applicant</span> like a burial,
                        cremation
                        or woodland burial?</label>
                    <select class="form-control form-control-lg" id="burial_second" name="burial_second">
                        @include('dashboard.willform.partials.burial-options')
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-12 d-flex align-items-center">
                    <label class="form-col-form-label h4 col-10" for="funeral_plan">Do you have a funeral plan</label>
                    <input type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-width="100"
                           data-height="80" data-onstyle="outline-success" data-offstyle="outline-danger" class="col-2"
                           id="funeral_plan" name="funeral_plan" />
                </div>
                <div class="col-sm-12 hide" id="my_plan">
                    <label class="form-col-form-label h4" for="funeral_plan_details">My funeral plan is with</label>
                    <input class="form-control form-control-lg" id="funeral_plan_details" name="funeral_plan_details"
                           type="text" />
                </div>
            </div>
            <div class="row my-3 universal_mirror hide">
                <div class="col-sm-12 d-flex align-items-center">
                    <label class="form-col-form-label h4 col-10" for="funeral_plan_second">Does the <span
                            class="second_applicant">second applicant</span>
                        have a funeral plan</label>
                    <input type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-width="100"
                           data-height="80" data-onstyle="outline-success" data-offstyle="outline-danger" class="col-2"
                           id="funeral_plan_second" name="funeral_plan_second" />
                </div>
                <div class="col-sm-12 hide" id="second_plan">
                    <label class="form-col-form-label h4" for="funeral_plan_second_details"><span
                            class="second_applicant">Second applicant</span>'s funeral
                        plan is
                        with</label>
                    <input class="form-control form-control-lg" id="funeral_plan_second_details"
                           name="funeral_plan_second_details" type="text" />
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="request_back"><i class="fa fa-arrow-left"></i>
                    Go
                    Back</button>

                <button class="btn btn-lg btn-success" id="request_next" @click.prevent="submitFinalForm">
                    Submit My Will <i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</div>

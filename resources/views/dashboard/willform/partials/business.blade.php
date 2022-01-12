<div class="card card-accent-success hide" id="business">
    <div class="card-header h3"><strong>Business Assignment</strong></div>
    <form id="business_form">
        <div class="card-body" id="business_body">
            <div class="row mt-3">
                <div class="col-sm-12">
                    <label class="form-col-form-label h4" for="business_data">Business details</label>
                    <input name="business_data" id="business_data" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row my-3 border-top person_body">
                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_first_name">First Name (required)</label>
                    <input name="business_first_name" id="business_first_name" class="form-control form-control-lg"
                           onkeyup="checkName(this)">
                </div>
                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_middle_name">Middle Name <br> </label>
                    <input name="business_middle_name" id="business_middle_name" class="form-control form-control-lg">
                </div>

                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_last_name">Last Name (required)</label>
                    <input name="business_last_name" id="business_last_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_relation"><span>He/She</span> is my
                        (required)</label>
                    <select class="form-control form-control-lg" id="business_relation" name="business_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>

                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_exec_relation"><span>He/She</span> is <span
                            class="second_applicant">Second Applicant</span>'s
                        (required)</label>
                    <select class="form-control form-control-lg" id="business_exec_relation"
                            name="business_exec_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>
                <div class="col-sm-6 mt-3">
                    <label class="form-col-form-label h4" for="business_predeceased">Up on first exec predeceased
                        (required)</label>
                    <select class="form-control form-control-lg" id="business_predeceased" name="business_predeceased">
                        @include('dashboard.willform.partials.gift-options')
                    </select>
                </div>
                <div class="col-sm-12">
                    <section class="row">
                        <div class="col-sm-6 my-3">
                            <label class="form-col-form-label h4" for="property_share_fraction">Share/Fraction
                                (required)</label>
                            <select class="form-control form-control-lg" id="business_share_fraction"
                                    name="business_share_fraction"
                                    onchange="myShareChange(this, 'business_share', 'business_share_fraction')">
                                <option value="0">Share</option>
                                <option value="1">Fraction</option>
                            </select>
                        </div>
                        <section class="col-6 my-3">
                            <label class="form-col-form-label h4" for="business_share">The share I wish to give him/her
                                is
                                (required)</label>
                            <input class="form-control form-control-lg" id="business_share" name="business_share"
                                   onchange="myShare(this, 'business_share', 'business_share_fraction')">
                            <div class="invalid-feedback"></div>
                        </section>
                    </section>
                </div>
            </div>

        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="business_back"><i class="fa fa-arrow-left"></i>
                    Go
                    Back</button>
                <button class="btn btn-lg btn-warning" id="business_add"><i class="fa fa-plus-circle"></i>
                    Add Business</button>
                <button class="btn btn-lg btn-danger" id="business_minus"><i class="fa fa-minus-circle"></i>
                    Remove</button>
                <button class="btn btn-lg btn-success" id="business_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

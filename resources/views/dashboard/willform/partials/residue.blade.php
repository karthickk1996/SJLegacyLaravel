<div class="card card-accent-success hide" v-if="residue">
    <div class="card-header h3"><strong>Distribution of residue</strong></div>
    <form id="residue_form">
        <div class="card-body" id="residue_body">
            <div class="row">
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_first_name">First Name (required)</label>
                    <input name="residue_first_name" id="residue_first_name" class="form-control form-control-lg"
                           onkeyup="checkName(this)">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_middle_name">Middle Name <br> </label>
                    <input name="residue_middle_name" id="residue_middle_name" class="form-control form-control-lg">
                </div>

                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_last_name">Last Name (required)</label>
                    <input name="residue_last_name" id="residue_last_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_relation"><span>He/She</span> is my
                        (required)</label>
                    <select class="form-control form-control-lg" id="residue_relation" name="residue_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>

                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_exec_relation"><span>He/She</span> is <span
                            class="second_applicant">Second Applicant</span>'s
                        (required)</label>
                    <select class="form-control form-control-lg" id="residue_exec_relation"
                            name="residue_exec_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="residue_predeceased">Up on first exec predeceased
                        (required)</label>
                    <select class="form-control form-control-lg" id="residue_predeceased" name="residue_predeceased">
                        @include('dashboard.willform.partials.gift-options')
                    </select>
                </div>
                <div class="col-sm-12 my-3">
                    <section class="row">
                        <div class="col-sm-6">
                            <label class="form-col-form-label h4" for="residue_share_fraction">The share I wish to give
                                him/her is
                                (required)</label>
                            <select class="form-control form-control-lg" id="residue_share_fraction"
                                    name="residue_share_fraction"
                                    onchange="myShareChange(this, 'residue_share', 'residue_share_fraction')">
                                <option value="0">Share</option>
                                <option value="1">Fraction</option>
                            </select>
                        </div>
                        <section class="col-6">
                            <label class="form-col-form-label h4" for="residue_share">The share I wish to give him/her
                                is
                                (required)</label>
                            <input class="form-control form-control-lg" id="residue_share" name="residue_share"
                                   onkeyup="myShare(this, 'residue_share', 'residue_share_fraction')" />
                            <div class="invalid-feedback"></div>
                        </section>
                    </section>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="residue_back"><i class="fa fa-arrow-left"></i>
                    Go
                    Back</button>
                <button class="btn btn-lg btn-warning" id="residue_add"><i class="fa fa-plus-circle"></i>
                    Add</button>
                <button class="btn btn-lg btn-danger" id="residue_minus"><i class="fa fa-minus-circle"></i>
                    Remove</button>
                <button class="btn btn-lg btn-success" id="residue_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

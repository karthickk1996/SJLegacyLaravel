<div class="card card-accent-success hide" id="pet">
    <div class="card-header h3"><strong>Gift of pet</strong></div>
    <form id="pet_form">
        <div class="card-body" id="pet_body">
            <div class="row my-3">
                <div class="col-sm-12">
                    <label class="form-col-form-label h4" for="pet_data">Details of pet</label>
                    <input name="pet_data" id="pet_data" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="pet_first_name">First Name (required)</label>
                    <input name="pet_first_name" id="pet_first_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="pet_middle_name">Middle Name</label>
                    <input name="pet_middle_name" id="pet_middle_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="pet_last_name">Last Name (required)</label>
                    <input name="pet_last_name" id="pet_last_name" class="form-control form-control-lg">
                </div>

                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="pet_predeceased">Up on first exec predeceased
                        (required)</label>
                    <select class="form-control form-control-lg" id="pet_predeceased" name="pet_predeceased"
                            onchange="pet_named_benefactor(this)">
                        @include('dashboard.willform.partials.gift-options')
                    </select>
                </div>
            </div>
            <div class="row" id="pet_named_beneficiary">

            </div>


        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="gift_back">
                    <i class="fa fa-arrow-left"></i>
                    Go Back
                </button>
                <button class="btn btn-lg btn-success"
                        @click.prevent="submitForm('gift_pet')"
                        id="address_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

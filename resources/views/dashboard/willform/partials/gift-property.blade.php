<div class="card card-accent-success" v-if="step==='gift_property'">
    <div class="card-header h3"><strong>Gift of property/land</strong>: Please enter the details of property below</div>
    <form id="property_form">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="property_name" class="h4">Property Name</label>
                    <input class="form-control form-control-lg" type="text"
                           placeholder="Enter property name" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="address_line1_property" class="h4">Address Line 1</label>
                    <input class="form-control form-control-lg" id="address_line1_property"
                           name="address_line1_property" type="text" placeholder="Enter address line 1"
                           data-my-validation="address" />
                </div>
                <div class="form-group col-sm-6">
                    <label for="address_line2_property" class="h4">Address Line 2</label>
                    <input class="form-control form-control-lg" id="address_line2_property"
                           name="address_line2_property" type="text" placeholder="Enter address line 2">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="city_property" class="h4">City/Town</label>
                    <input class="form-control form-control-lg" id="city_property" name="city_property" type="text"
                           placeholder="Enter your city/town" data-my-validation="city"/>
                </div>
                <div class="form-group col-sm-6">
                    <label for="county_property" class="h4">County</label>
                    <input class="form-control form-control-lg" id="county_property" name="county_property" type="text"
                           placeholder="Enter county name" data-my-validation="county" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="country_property" class="h4 d-block">Country</label>
                    <select name="country_property" id="country_property" class="form-control form-control-lg">
                        <option value="United Kingdom" selected>United Kingdom</option>
                        <option value="England">England</option>
                        <option value="Wales">Wales</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="postal_code_property" class="h4">Postal Code</label>
                    <input class="form-control form-control-lg" id="postal_code_property" name="postal_code_property"
                           type="text" placeholder="Postal Code" data-my-validation="postal_code"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_first_name">First Name (required)</label>
                    <input name="property_first_name" id="property_first_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_middle_name">Middle Name</label>
                    <input name="property_middle_name" id="property_middle_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_last_name">Last Name (required)</label>
                    <input name="property_last_name" id="property_last_name" class="form-control form-control-lg">
                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_share_fraction">Share fraction
                        (required)</label>
                    <select class="form-control form-control-lg" id="property_share_fraction"
                            name="property_share_fraction">
                        <option value="0">Share</option>
                        <option value="1">Fraction</option>
                    </select>

                </div>
                <div class="col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_share">Share/Fraction (required)</label>
                    <input name="property_share" id="property_share" class="form-control form-control-lg">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_relation">He/She is
                        my</label>
                    <select class="form-control form-control-lg" id="property_relation" name="property_relation">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>
                <div class="form-group col-sm-6 my-3">
                    <label class="form-col-form-label h4" for="property_predeceased">upon his death will be given
                        to</label>
                    <select class="form-control form-control-lg" id="property_predeceased" name="property_predeceased">
                        @include('dashboard.willform.partials.combo-options')
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="gift_back">
                    <i class="fa fa-arrow-left"></i>
                    Go Back
                </button>
                <button class="btn btn-lg btn-success"
                        @click.prevent="submitForm('gift_property')"
                        id="address_next" type="submit">
                    Next <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </form>
</div>

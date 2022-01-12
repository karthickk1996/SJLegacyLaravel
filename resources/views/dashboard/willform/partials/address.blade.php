<div class="card card-accent-success hide" v-if="step==='address'">
    <div class="card-header h3">
        <strong>What is your address?</strong></div>
    <div class="card-body">
        <div class="form-group">
            <label for="address_line1" class="h4">Address Line 1</label>
            <input class="form-control form-control-lg"
                   v-model.trim="$v.addressSummary.line1.$model"
                   @blur="$v.addressSummary.line1.$touch"
                   :class="$v.addressSummary.line1.$anyError ? 'is-invalid':''"
                   name="address_line1" type="text" required
                   placeholder="Enter address line 1"/>
            <div class="invalid-feedback" v-if="$v.addressSummary.line1.$anyError">This value is required.</div>
        </div>
        <div class="form-group">
            <label for="address_line2" class="h4">Address Line 2</label>
            <input class="form-control form-control-lg" name="address_line2" type="text"
                   v-model.trim="$v.addressSummary.line2.$model"
                   @blur="$v.addressSummary.line2.$touch"
                   :class="$v.addressSummary.line2.$anyError ? 'is-invalid':''"
                   placeholder="Enter address line 2"/>
            <div class="invalid-feedback" v-if="$v.addressSummary.line2.$anyError">This value is required.</div>
        </div>
        <div class="form-group">
            <label for="city" class="h4">City/Town</label>
            <input class="form-control form-control-lg" id="city"
                   v-model.trim="$v.addressSummary.city.$model"
                   @blur="$v.addressSummary.city.$touch"
                   :class="$v.addressSummary.city.$anyError ? 'is-invalid':''"
                   type="text" placeholder="Enter your County"
                   name="city" required data-parsley-trigger="change"/>
            <div class="invalid-feedback" v-if="$v.addressSummary.city.$anyError">This value is required.</div>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <label for="county" class="h4">County</label>
                <input class="form-control form-control-lg" id="county"
                       v-model.trim="$v.addressSummary.county.$model"
                       @blur="$v.addressSummary.county.$touch"
                       :class="$v.addressSummary.county.$anyError ? 'is-invalid':''"
                       type="text" placeholder="Enter County"
                       name="county" required data-parsley-trigger="change"/>
                <div class="invalid-feedback" v-if="$v.addressSummary.city.$anyError">This value is required.</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="postal_code" class="h4">Postal Code</label>
                <input class="form-control form-control-lg"
                       id="postal_code" type="text" placeholder="Postal Code"
                       v-model.trim="$v.addressSummary.postal.$model"
                       @blur="$v.addressSummary.postal.$touch"
                       :class="$v.addressSummary.postal.$anyError ? 'is-invalid':''"
                       name="postal_code" required data-parsley-trigger="change"
                       data-parsley-pattern="/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/"/>
                <div class="invalid-feedback" v-if="!$v.addressSummary.postal.required">This value is required.</div>
                <div class="invalid-feedback" v-if="!$v.addressSummary.postal.postal">This value is invalid.</div>
            </div>
        </div>
        <!-- /.row-->
        <div class="form-group">
            <label for="country" class="h4 d-block">Country</label>
            <select name="country" id="country"
                    v-model.trim="$v.addressSummary.country.$model"
                    @blur="$v.addressSummary.country.$touch"
                    :class="$v.addressSummary.country.$anyError ? 'is-invalid':''"
                    class="form-control form-control-lg" required data-parsley-trigger="change">
                <option value="United_Kingdom" selected>United Kingdom</option>
                <option value="England">England</option>
                <option value="Wales">Wales</option>
            </select>
            <div class="invalid-feedback" v-if="$v.addressSummary.country.$anyError">This value is required.</div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary"
                    type="button"
                    @click="step='mirror_select'" id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('address')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

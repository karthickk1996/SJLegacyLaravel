<div class="card card-accent-success" id="input_name" v-if="step===1">
    <div class="card-header h3"><strong>Input Name</strong></div>
    <form id="input_name_form">
        <div class="card-body">
            <div class="form-group">
                <label class="form-col-form-label h4" for="first_name">First Name
                    (required)</label>
                <input class="form-control form-control-lg" id="first_name" name="first_name" type="text"
                       placeholder="First Name" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-minlength="3"
                       v-model.trim="$v.form1.firstName.$model"
                       :class="$v.form1.firstName.$anyError ? 'is-invalid':''"
                       @blur="$v.form1.firstName.$touch"
                />
                <div class="invalid-feedback" v-if="$v.form1.firstName.$anyError">Please provide first name.</div>
            </div>
            <div class="form-group">
                <label class="form-col-form-label h4" for="middle_name">Middle Name
                    (optional)</label>
                <input class="form-control form-control-lg" id="middle_name"
                       v-model.trim="$v.form1.middleName.$model"
                       :class="$v.form1.middleName.$anyError ? 'is-invalid':''"
                       @blur="$v.form1.middleName.$touch"
                       name="middle_name" type="text"
                       placeholder="Middle Name">
                <div class="invalid-feedback" v-if="$v.form1.middleName.$anyError">Please provide a valid middle name.
                </div>
            </div>
            <div class="form-group">
                <label class="form-col-form-label h4" for="last_name">Last Name
                    (required)</label>
                <input class="form-control form-control-lg" id="last_name"
                       v-model.trim="$v.form1.lastName.$model"
                       :class="$v.form1.lastName.$anyError ? 'is-invalid':''"
                       name="last_name" type="text"
                       @blur="$v.form1.lastName.$touch"
                       placeholder="Last Name" required data-parsley-minlength="3" data-parsley-pattern="^[a-zA-Z ]+$"
                       data-parsley-trigger="keyup"/>
                <div class="invalid-feedback" v-if="$v.form1.lastName.$anyError">Please provide last name.</div>
            </div>
            <div class="form-group">
                <label class="form-col-form-label h4" for="email">What is your email? (required)</label>
                <input class="form-control form-control-lg"
                       id="email" name="email"
                       v-model.trim="$v.form1.email.$model"
                       type="email" placeholder="Email"
                       @blur="$v.form1.email.$touch"
                       :class="$v.form1.email.$anyError ? 'is-invalid':''"
                       required data-parsley-type="email" data-parsley-trigger="keyup"/>
                <div class="invalid-feedback" v-if="$v.form1.email.$anyError">Please provide a valid email.</div>
            </div>
            <div class="form-group">
                <label class="form-col-form-label h4" for="dob">Date of Birth (required)</label>
                <input class="datepicker form-control form-control-lg" id="dob"
                       name="dob"
                       type="date"
                       data-parsley-minimumage="18"
                       v-model.trim="$v.form1.dob.$model"
                       @blur="$v.form1.dob.$touch"
                       :class="$v.form1.dob.$anyError ? 'is-invalid':''"
                       required>
                <div class="invalid-feedback" v-if="$v.form1.dob.$anyError">Please provide a valid date of birth</div>
            </div>

        </div>
        <div class="card-footer ">
            <div class="form-group text-right">
                <button class="btn btn-lg btn-success" id="input_name_submit" type="submit"
                        @click.prevent="submitForm(1)">
                    Next <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
    </form>
</div>

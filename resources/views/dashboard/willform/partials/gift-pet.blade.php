<div class="card card-accent-success" v-if="step==='gift_pet'">
    <div class="card-header h3"><strong>Gift of pet</strong></div>
    <div class="card-body" v-for="(pet,i) in $v.giftPet.$each.$iter">
        <div class="row my-3">
            <div class="col-sm-12">
                <label class="form-col-form-label h4" for="pet_data">Details of pet</label>
                <input  v-model.trim="pet.petDetails.$model"
                        :class="pet.petDetails.$anyError ? 'is-invalid':''"
                        @blur="pet.petDetails.$touch" class="form-control form-control-lg">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="pet_first_name">First Name (required)</label>
                <input type="text" name="bank_first_name"
                       v-model.trim="pet.firstName.$model"
                       :class="pet.firstName.$anyError ? 'is-invalid':''"
                       @blur="pet.firstName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="pet_middle_name">Middle Name</label>
                <input type="text" name="bank_middle_name"
                       v-model.trim="pet.middleName.$model"
                       :class="pet.middleName.$anyError ? 'is-invalid':''"
                       @blur="pet.middleName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>
            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="pet_last_name">Last Name (required)</label>
                <input type="text"
                       v-model.trim="pet.lastName.$model"
                       :class="pet.lastName.$anyError ? 'is-invalid':''"
                       @blur="pet.lastName.$touch"
                       class="form-control form-control-lg inner"/>
            </div>

            <div class="col-sm-6 my-3">
                <label class="form-col-form-label h4" for="pet_predeceased">Up on first exec predeceased
                    (required)</label>
                <select class="form-control form-control-lg"
                        v-model="pet.predeceased.$model"
                >
                    @include('dashboard.willform.partials.gifting-details')
                </select>
            </div>
        </div>
        <section class="row" v-if="pet.predeceased.$model === 'Assign to named beneficiary'">
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_first">First Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_first" id="gift_predeceased_first"
                       v-model.trim="pet.beneficiary.firstName.$model"
                       :class="pet.beneficiary.firstName.$anyError ? 'is-invalid':''"
                       @blur="pet.beneficiary.firstName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6"><label class="form-col-form-label h4" for="gift_predeceased_middle">Middle Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_middle"
                       id="gift_predeceased_middle"
                       v-model.trim="pet.beneficiary.middleName.$model"
                       :class="pet.beneficiary.middleName.$anyError ? 'is-invalid':''"
                       @blur="pet.beneficiary.middleName.$touch"
                       class="form-control form-control-lg"></div>
            <div class="col-sm-6">
                <label class="form-col-form-label h4" for="gift_predeceased_last">Last Name of
                    named beneficiary (required)</label>
                <input name="gift_predeceased_last"
                       id="gift_predeceased_last"
                       v-model.trim="pet.beneficiary.lastName.$model"
                       :class="pet.beneficiary.lastName.$anyError ? 'is-invalid':''"
                       @blur="pet.beneficiary.lastName.$touch"
                       class="form-control form-control-lg"></div>
        </section>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-lg btn-warning" @click.prevent="AddGiftPet"><i class="fa fa-plus-circle"></i>
                        Add Pet
                    </button>
                    <div v-if="i > 0">
                        <button class="btn btn-lg btn-danger" v-if="giftPet.length > 1" @click.prevent="removeGiftPet(i)">
                            <i class="fa fa-minus-circle"></i>
                            Remove Pet
                        </button>
                    </div>
                </div>
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
                    @click.prevent="submitForm('gift_pet')"
                    id="address_next" type="submit">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

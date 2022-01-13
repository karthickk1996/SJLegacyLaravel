<div class="card card-accent-primary hide" v-if="step==='guardian'">
    <div class="card-header h3"><strong>Guardian</strong></div>
    <div class="card-body">
        <section class="d-flex align-items-center row py-2" id="guardian_body">
            <h4 class="mb-2 d-inline col-9">Do you wish to appoint a guardian for any children under 18?</h4>
            <toggle-button v-model="appointGuardian" :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>

        </section>
        <section v-if="appointGuardian">
            <section class="d-flex align-items-center row py-3 border-top" id="count_body">
                <h4 class="mb-2 d-inline col-9">Do you have more than one child?</h4>
                <toggle-button v-model="hasMoreThanOneChildren"
                               :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
            </section>
        </section>
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary"
                    type="button"
                    @click.prevent="step='reserve_executor_details'">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    type="button"
                    @click.prevent="submitForm('guardian')">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<div class="card card-accent-primary" id="second_executor" v-if="step==='executor_details'">
    <div class="card-header h3"><strong>Executor</strong></div>
    <div class="card-body">
        <section class="d-flex align-items-center row py-2" id="partner_body">
            <h4 class="mb-2 d-inline col-9">Would you like <span class="font-weight-bold">@{{ form1.firstName }} @{{ form1.middleName }} @{{ form1.lastName }}</span>
                and
                <span class="font-weight-bold">@{{ secondApplicant.firstName }} @{{ secondApplicant.middleName }} @{{ secondApplicant.lastName }}</span>
                to be listed as the executors of
                each
                other's
                will?
            </h4>
            <toggle-button v-model="secondExecutor" :labels="{checked: 'Yes', unchecked: 'No'}"></toggle-button>
        </section>
    </div>
    <div class="card-footer">
        <div class="form-group d-flex justify-content-between">
            <button class="btn btn-lg btn-primary" @click.prevent="backFromExecutor()"
                    type="button"
                    id="address_back">
                <i class="fa fa-arrow-left"></i> Go
                Back
            </button>
            <button class="btn btn-lg btn-success"
                    @click.prevent="submitForm('executor_details')"
                    id="address_next" type="button">
                Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>

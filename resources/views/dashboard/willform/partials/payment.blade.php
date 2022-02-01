<will-payment
    :mirror-will="hasMirrorWill"
    @back="step='request'"
    @confirm="submitFinalForm"
    :payment="{{json_encode($intent)}}"
    v-if="step==='payment'"
    ></will-payment>

<script>
const {required, alpha, minLength, email, helpers} = require('vuelidate/lib/validators')
const postal = helpers.regex('required', /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/)

export default {
    name: "WillFormComponent",
    data() {
        return {
            step: 1,
            form1: {
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
            },
            hasPartner: false,
            hasChildrenUnderEighteen: false,
            hasMirrorWill: false,
            ownProperty: false,
            addressSummary: {
                line1: "",
                line2: "",
                city: "",
                county: "",
                country: "",
                postal: "",
            },
            secondApplicant: {
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: ""
            },
            secondExecutor: false,
            executor: {
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
            },
            reserve: {
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
            },
            giftDetails: {
                giftTo: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation:"",
                predeceased: "",
                beneficiary:{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            },
            reserveExecutor: [{
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: ""
            }],
            appointGuardian: false,
            hasMoreThanOneChildren: false,
            sameGuardianAllChildren: false,
            children: [{
                guardianFirstName: "",
                guardianMiddleName: "",
                guardianLastName: "",
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: ""
            }],
            reserveGuardian:[{
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: ""
            }],
        }
    },
    validations: {
        form1: {
            firstName: {
                required,
                alpha,
                minLength: minLength(4),
            },
            middleName: {
                alpha,
                minLength: minLength(4),
            },
            lastName: {
                alpha,
                minLength: minLength(4),
            },
            email: {
                required,
                email
            },
            dob: {
                required,
            },
        },
        addressSummary: {
            line1: {
                required
            },
            line2: {
                required
            },
            city: {
                required
            },
            county: {
                required
            },
            country: {
                required
            },
            postal: {
                required,
                postal
            }
        },
        secondApplicant: {
            firstName: {
                required,
                alpha,
                minLength: minLength(4),
            },
            middleName: {
                alpha,
                minLength: minLength(4),
            },
            lastName: {
                alpha,
                minLength: minLength(4),
            },
            email: {
                required,
                email
            },
            dob: {
                required,
            },
            relation: {
                required
            },
            line1: {
                required
            },
            line2: {
                required
            },
            city: {
                required
            },
            county: {
                required
            },
            country: {
                required
            },
            postal: {
                required,
                postal
            },
        },
        reserveExecutor: {
            required,
            $each: {
                firstName: {
                    required,
                    alpha,
                    minLength: minLength(4),
                },
                middleName: {
                    alpha,
                    minLength: minLength(4),
                },
                lastName: {
                    alpha,
                    minLength: minLength(4),
                },
                email: {
                    required,
                    email
                },
                dob: {
                    required,
                },
                relation: {
                    required
                },
                line1: {
                    required
                },
                line2: {
                    required
                },
                city: {
                    required
                },
                county: {
                    required
                },
                country: {
                    required
                },
                postal: {
                    required,
                    postal
                },
                secondApplicantRelation: {
                    required
                }
            }
        },
        reserveGuardian: {
            required,
            $each: {
                firstName: {
                    required,
                    alpha,
                    minLength: minLength(4),
                },
                middleName: {
                    alpha,
                    minLength: minLength(4),
                },
                lastName: {
                    alpha,
                    minLength: minLength(4),
                },
                email: {
                    required,
                    email
                },
                dob: {
                    required,
                },
                relation: {
                    required
                },
                line1: {
                    required
                },
                line2: {
                    required
                },
                city: {
                    required
                },
                county: {
                    required
                },
                country: {
                    required
                },
                postal: {
                    required,
                    postal
                },
                secondApplicantRelation: {
                    required
                }
            }
        },
        children: {
            required,
            $each: function () {
                if (!this.sameGuardianAllChildren) {
                    return {
                        firstName: {
                            required,
                            alpha,
                            minLength: minLength(4),
                        },
                        GuardianFirstName: {
                            required,
                            alpha,
                            minLength: minLength(4),
                        },
                        middleName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        GuardianMiddleName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        lastName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        GuardianLastName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        email: {
                            required,
                            email
                        },
                        dob: {
                            required,
                        },
                        relation: {
                            required
                        },
                        line1: {
                            required
                        },
                        line2: {
                            required
                        },
                        city: {
                            required
                        },
                        county: {
                            required
                        },
                        country: {
                            required
                        },
                        postal: {
                            required,
                            postal
                        },
                        secondApplicantRelation: {
                            required
                        }
                    }
                } else {
                    return {
                        GuardianFirstName: {
                            required,
                            alpha,
                            minLength: minLength(4),
                        },
                        GuardianMiddleName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        GuardianLastName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        email: {
                            required,
                            email
                        },
                        dob: {
                            required,
                        },
                        relation: {
                            required
                        },
                        line1: {
                            required
                        },
                        line2: {
                            required
                        },
                        city: {
                            required
                        },
                        county: {
                            required
                        },
                        country: {
                            required
                        },
                        postal: {
                            required,
                            postal
                        },
                        secondApplicantRelation: {
                            required
                        }
                    }
                }
            }
        },

    },
    methods: {
        AddExecutor() {
            this.reserveExecutor.push({
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: "",
            })
        },
        removeExecutor(index) {
            this.reserveExecutor.splice(index, 1)
        },
        AddReserveGuardian() {
            this.reserveExecutor.push({
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: "",
            })
        },
        removeReserveGuardian(index) {
            this.reserveExecutor.splice(index, 1)
        },
        AddJointGuardian() {
            this.children.push({
                guardianFirstName: "",
                guardianMiddleName: "",
                guardianLastName: "",
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "",
                postal: "",
                county: "",
                secondApplicantRelation: ""
            })
        },
        removeJointGuardian(index) {
            this.children.splice(index, 1)
        },
        submitForm(form) {
            if (form === 1) {
                this.$v.form1.$touch();
                if (this.$v.form1.$invalid) {
                    console.log('invalid entry')
                } else {
                    this.step = 2
                }
            } else if (form === 2) {
                this.step = 3
            } else if (form === 3) {
                this.$v.addressSummary.$touch();
                if (this.$v.addressSummary.$invalid) {
                    console.log('invalid entry')
                } else {
                    this.step = 4
                }
            } else if (form === 4) {
                this.$v.secondApplicant.$touch();
                if (this.$v.secondApplicant.$invalid) {
                    console.log('invalid entry')
                } else {
                    this.step = 5
                }
            } else if (form === 5) {
                this.step = 6
            }
        }
    }
}
</script>

<style scoped>

</style>

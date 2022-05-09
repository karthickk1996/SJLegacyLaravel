<script>
import {requiredIf} from "vuelidate/lib/validators";

const {required, alpha, minLength, email, helpers, maxValue, sameAs, numeric} = require('vuelidate/lib/validators')
const postal = helpers.regex('required', /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/)
const ageValidation = (dateString) => {
    const today = new Date();
    const birthDate = new Date(Date.parse(dateString));
    console.log(birthDate,dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age > 18;
}

const maxValueProperty = (value, nested) => {
    if (nested.shareType === 'share') {
        return value <= 100
    } else {
        return value <= 1
    }
}

const maxFinalValue = (value, nested) => {
    if (nested.persons[0].shareType === 'share') {
        var l = 0;
        nested.persons.forEach(person => {
            l = l + person.share
        })
        return l == 100
    } else {
        var l = 0.0;
        nested.persons.forEach(person => {
            l = l + person.share
        })
        return l == 1
    }
}

import axios from 'axios';

export default {
    name: "EditWill",
    props: ['data', 'id', 'activeStep'],
    data() {
        return {
            step: this.activeStep === "1" ? 1 : this.activeStep,
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
                country: "United_Kingdom",
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
                country: "United_Kingdom",
                postal: "",
                county: ""
            },
            secondExecutor: false,
            executor: [{
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "United_Kingdom",
                county: "",
                postal: "",
                secondApplicantRelation: "",
            }],
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
                country: "United_Kingdom",
                postal: "",
                county: "",
                secondApplicantRelation: ""
            }],
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
            giftDetails: [{
                giftTo: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            }],
            giftMoney: [{
                moneyDetails: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
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
            reserveGuardian: [{
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
            giftCharity: {
                name: "",
                reference: "",
                money: ""
            },
            giftBank: [{
                bankName: "",
                bankReference: "",
                maxShare: "",
                persons: [{
                    parent: 0,
                    index: 0,
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "share",
                    share: 0,
                    beneficiary: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                    }
                }]
            }],
            giftPet: [{
                petDetails: "",
                firstName: "",
                middleName: "",
                lastName: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                },
            }],
            businessAssignment: [{
                business: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                finalShare: "",
                parent: 0,
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    shareType: "share",
                    share: 0,
                    predeceased: "",
                    beneficiary: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                    }
                }]
            }],
            residue: [{
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                shareType: "share",
                share: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            }],
            request: {
                optOutOfOrganDonation: false,
                secondApplicantOptOutOfOrganDonation: false,
                burialType: false,
                secondApplicantBurialType: false,
                funeralPlan: false,
                funeralPlanType: "",
                secondApplicantFuneralPlan: false,
                secondApplicantFuneralPlanType: ""
            },
            giftProperty: [{
                name: "",
                line1: "",
                line2: "",
                city: "",
                county: "",
                country: "United Kingdom",
                postal: "",
                finalShare: "",
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "share",
                    share: 0,
                    beneficiary: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                    }
                }]
            }],
        }
    },
    computed: {
        maxBankShare() {
            return value => {
                if (value.$model.persons[0].shareType === 'share') {
                    return 100
                } else
                    return 1
            }
        },
        bankShareValue() {
            return (value, nested) => {
                if (nested.parent) {
                    let share = this.giftBank[nested.parent].persons[0].shareType;
                    if (share === 'share') {
                        var v = 0;
                        this.giftBank[nested.parent].persons.forEach(person => {
                            v = v + parseInt(person.share);
                        })
                        return v === 100;
                    } else {
                        var v = 0.0;
                        this.giftBank[nested.parent].persons.forEach(person => {
                            v = v + parseFloat(person.share);
                        })
                        return v === 1;
                    }
                } else {
                    return true;
                }
            }
        },
        giftMaxBankShare() {
            return (value, nested) => {
                let share = this.giftBank[nested.parent].persons[0].shareType;
                if (share === 'share') {
                    var v = 0;
                    this.giftBank[nested.parent].persons.forEach(person => {
                        v = v + parseInt(person.share);
                    })
                    return v <= 100;
                } else {
                    var v = 0.0;
                    this.giftBank[nested.parent].persons.forEach(person => {
                        v = v + parseFloat(person.share);
                    })
                    return v <= 1;
                }
            }
        },
        finalShare() {
            return value => {
                if (value.persons[0].shareType === 'share') {
                    var v = 0;
                    this.giftBank.persons.forEach(value => {
                        let base = value.share;
                        if (base) {
                            v = v + parseInt(value.share)
                        }
                    })
                } else {
                    var v = 0.0;
                    value.persons.forEach(value => {
                        let base = value.share;
                        if (base) {
                            v = v + parseFloat(value.share)
                        }
                    })
                }
                return v;
            }
        },
        finalPropertyShare() {
            var r = false;
            this.giftProperty.forEach((property, i) => {
                if (property.persons[0].shareType === 'share') {
                    r = property.finalShare !== 100;
                } else {
                    r = property.finalShare !== 1;
                }
            })

            return r;
        },
        finalBusinessShare() {
            this.businessAssignment.forEach((business, i) => {
                if (business.persons[0].shareType === 'share') {
                    var v = 0;
                    business.persons.forEach(person => {
                        let base = person.share;
                        if (base) {
                            v = v + parseInt(person.share)
                        }
                    })
                    this.businessAssignment[i].finalShare = v;
                } else {
                    var v = 0.0;
                    business.persons.forEach(value => {
                        let base = value.share;
                        if (base) {
                            v = v + parseFloat(value.share)
                        }
                    })
                    this.businessAssignment[i].finalShare = v;
                }
            })

            return true;
        },
        maxResidueShare() {
            if (this.residue[0].shareType === 'share') {
                return 100
            } else
                return 1
        },
        finalResidueShare() {
            if (this.residue[0].shareType === 'share') {
                var v = 0;
                this.residue.forEach(person => {
                    let base = person.share;
                    if (base) {
                        v = v + parseInt(person.share)
                    }
                })
                return v;
            } else {
                var v = 0.0;
                this.residue.forEach(value => {
                    let base = value.share;
                    if (base) {
                        v = v + parseFloat(value.share)
                    }
                })
                return v;
            }
        }
    },
    validations() {
        return {
            form1: {
                firstName: {
                    required,
                    minLength: minLength(2),
                },
                middleName: {
                    minLength: minLength(2),
                },
                lastName: {
                    minLength: minLength(2),
                },
                email: {
                    required,
                    email
                },
                dob: {
                    required,
                    ageValidation
                },
            },
            addressSummary: {
                line1: {
                    required
                },
                line2: {},
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
                    minLength: minLength(2),
                },
                middleName: {
                    minLength: minLength(2),
                },
                lastName: {
                    minLength: minLength(2),
                },
                email: {
                    required,
                    email
                },
                dob: {
                    required,
                    ageValidation
                },
                relation: {
                    required
                },
                line1: {
                    required
                },
                line2: {},
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
            executor: {
                required,
                $each: {
                    firstName: {
                        required,
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        required,
                        minLength: minLength(2),
                    },
                    email: {
                        required,
                        email
                    },
                    dob: {
                        required,
                        ageValidation
                    },
                    relation: {
                        required
                    },
                    line1: {
                        required
                    },
                    line2: {},
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
                        required: requiredIf(function () {
                            return this.hasMirrorWill
                        })
                    }
                }
            },
            reserveExecutor: {
                required,
                $each: {
                    firstName: {
                        required,
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        required,
                        minLength: minLength(2),
                    },
                    email: {
                        required,
                        email
                    },
                    dob: {
                        required,
                        ageValidation
                    },
                    relation: {
                        required
                    },
                    line1: {
                        required
                    },
                    line2: {},
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
                        required: requiredIf(function () {
                            return this.hasMirrorWill
                        })
                    }
                }
            },
            reserveGuardian: {
                required,
                $each: {
                    firstName: {
                        required,
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        minLength: minLength(2),
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
                    line2: {},
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
                        required: requiredIf(function () {
                            return this.hasMirrorWill
                        })
                    }
                }
            },
            children: {
                required,
                $each: {
                    firstName: {
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        minLength: minLength(2),
                    },
                    GuardianFirstName: {
                        minLength: minLength(2),
                    },
                    GuardianMiddleName: {
                        minLength: minLength(2),
                    },
                    GuardianLastName: {
                        minLength: minLength(2),
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
                    line2: {},
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
                        required: requiredIf(function () {
                            return this.hasMirrorWill
                        })
                    }
                }
            },
            giftDetails: {
                required,
                $each: {
                    giftTo: {
                        minLength: minLength(2),
                    },
                    firstName: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.giftTo
                        }),
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.giftTo
                        }),
                        minLength: minLength(2),
                    },
                    relation: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.giftTo
                        }),
                    },
                    secondApplicantRelation: {
                        required: requiredIf(function (nestedModel) {
                            return this.hasMirrorWill && nestedModel.giftTo
                        })
                    },
                    predeceased: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.giftTo
                        }),
                    },
                    beneficiary: {
                        required,
                        firstName: {
                            minLength: minLength(2),
                        },
                        middleName: {
                            minLength: minLength(2),
                        },
                        lastName: {
                            minLength: minLength(2),
                        }
                    }
                },

            },
            giftMoney: {
                $each: {
                    moneyDetails: {},
                    firstName: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.moneyDetails
                        }),
                        minLength: minLength(2),
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.moneyDetails
                        }),
                        minLength: minLength(2),
                    },
                    relation: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.moneyDetails
                        }),
                        minLength: minLength(2),
                    },
                    secondApplicantRelation: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.moneyDetails && this.hasMirrorWill
                        })
                    },
                    predeceased: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.moneyDetails
                        }),
                        minLength: minLength(2),
                    },
                    beneficiary: {
                        required,
                        id: {},
                        firstName: {
                            required: requiredIf(function (nestedModel) {
                                return this.$v.giftMoney.$each[nestedModel.id]?.$model.moneyDetails && this.$v.giftMoney.$each[nestedModel.id]?.$model.predeceased === 'Assign to named beneficiary'
                            }),
                            minLength: minLength(2),
                        },
                        middleName: {
                            minLength: minLength(2),
                        },
                        lastName: {
                            required: requiredIf(function (nestedModel) {
                                return this.$v.giftMoney.$each[nestedModel.id]?.$model.moneyDetails && this.$v.giftMoney.$each[nestedModel.id]?.$model.predeceased === 'Assign to named beneficiary'
                            }),
                            minLength: minLength(2),
                        }
                    }
                }
            },
            giftCharity: {
                name: {
                    minLength: minLength(2),
                },
                reference: {
                    minLength: minLength(2),
                    required: requiredIf(function (nestedModel) {
                        return nestedModel.name
                    }),
                },
                money: {
                    numeric,
                    required: requiredIf(function (nestedModel) {
                        return nestedModel.name
                    }),
                },
            },
            giftBank: {
                $each: {
                    bankName: {},
                    bankReference: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.bankName
                        }),
                    },
                    maxShare: {},
                    persons: {
                        required,
                        $each: {
                            firstName: {},
                            middleName: {
                                minLength: minLength(2),
                            },
                            lastName: {
                                minLength: minLength(2),
                            },
                            relation: {},
                            secondApplicantRelation: {},
                            predeceased: {},
                            shareType: {},
                            maxShare: {},
                            share: {
                                checkMax: this.giftMaxBankShare
                            },
                            beneficiary: {
                                firstName: {
                                    minLength: minLength(2),
                                },
                                middleName: {
                                    minLength: minLength(2),
                                },
                                lastName: {
                                    minLength: minLength(2),
                                }
                            }

                        }
                    }
                },
            },
            giftProperty: {
                $each: {
                    name: {},
                    line1: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.name
                        }),
                    },
                    line2: {},
                    city: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.name
                        }),
                    },
                    county: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.name
                        }),
                    },
                    country: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.name
                        }),
                    },
                    postal: {
                        required: requiredIf(function (nestedModel) {
                            return nestedModel.name
                        }),
                        postal
                    },
                    finalShare: {},
                    persons: {
                        $each: {
                            firstName: {required},
                            middleName: {
                                minLength: minLength(2),
                            },
                            lastName: {
                                minLength: minLength(2),
                            },
                            relation: {
                                required
                            },
                            secondApplicantRelation: {
                                required: requiredIf(function () {
                                    return this.hasMirrorWill
                                })
                            },
                            predeceased: {
                                required
                            },
                            shareType: {
                                required
                            },
                            share: {
                                maxValueProperty
                            },
                            beneficiary: {
                                required,
                                firstName: {
                                    minLength: minLength(2),
                                },
                                middleName: {
                                    minLength: minLength(2),
                                },
                                lastName: {
                                    minLength: minLength(2),
                                }
                            }

                        }
                    }
                }
            },
            giftPet: {
                required,
                $each: {
                    petDetails: {},
                    firstName: {
                        required
                    },
                    middleName: {
                        minLength: minLength(2),
                    },
                    lastName: {
                        minLength: minLength(2),
                        required:requiredIf(function (nestedModel) {
                            return nestedModel.petDetails
                        }),
                    },
                    predeceased: {
                        required:requiredIf(function (nestedModel) {
                            return nestedModel.petDetails
                        })
                    },
                    beneficiary: {
                        required:requiredIf(function (nestedModel) {
                            return nestedModel.petDetails && nestedModel.predeceased === 'Assign to named beneficiary'
                        }),
                        firstName: {
                        },
                        middleName: {
                            minLength: minLength(2),
                        },
                        lastName: {
                        }
                    }
                }
            },
            businessAssignment: {
                $each: {
                    business: {},
                    finalShare: {
                        maxFinalValue
                    },
                    persons: {
                        $each: {
                            firstName: {},
                            middleName: {
                                minLength: minLength(2),
                            },
                            lastName: {
                                minLength: minLength(2),
                            },
                            relation: {
                                required
                            },
                            secondApplicantRelation: {},
                            shareType: {
                                required
                            },
                            share: {
                                maxValueProperty
                            },
                            predeceased: {
                                required
                            },
                            beneficiary: {
                                required,
                                firstName: {
                                    minLength: minLength(2),
                                },
                                middleName: {
                                    minLength: minLength(2),
                                },
                                lastName: {
                                    minLength: minLength(2),
                                }
                            }
                        }
                    }
                }
            },
            residue: {
                $each: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: {
                        required: requiredIf(function () {
                            return this.hasMirrorWill
                        })
                    },
                    predeceased: "",
                    shareType: "",
                    share: "",
                    beneficiary: {
                        firstName: {
                            minLength: minLength(2),
                        },
                        middleName: {
                            minLength: minLength(2),
                        },
                        lastName: {
                            minLength: minLength(2),
                        }
                    }
                }
            }
        }
    },
    methods: {
        notifyError() {
            return this.$notify({
                type: 'error',
                title: 'Invalid Data',
                text: 'Please check all the fields'
            })
        },
        notifyUpdate() {
            return this.$notify({
                type: 'success',
                title: 'Form Updated'
            })
        },
        backFromExecutor() {
            if (this.hasMirrorWill) {
                this.step = 'second_applicant';
            } else {
                this.step = 'address';
            }
        },
        maxPropertyShare(property) {
            if (property.persons[0].shareType === 'share') {
                return 100
            } else {
                return 1
            }
        },
        AddExecutor() {
            this.executor.push({
                firstName: "",
                middleName: "",
                lastName: "",
                email: "",
                dob: "",
                relation: "",
                line1: "",
                line2: "",
                city: "",
                country: "United_Kingdom",
                county: "",
                postal: "",
                secondApplicantRelation: "",
            })
        },
        backToExecutor() {
            if (this.secondExecutor) {
                this.step = 'executor_details';
            } else {
                this.step = 'executor_summary';
            }
        },
        AddReserveExecutor() {
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
        RemoveReserveExecutor(index) {
            this.reserveExecutor.splice(index, 1)
        },
        removeExecutor(index) {
            this.executor.splice(index, 1)
        },
        AddReserveGuardian() {
            this.reserveGuardian.push({
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
            this.reserveGuardian.splice(index, 1)
        },
        removeBankPerson(main, index) {
            this.giftBank[main].persons.splice(index, 1)
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
        backFromGift() {
            if (this.appointGuardian) {
                this.step = 'children_details';
            } else {
                this.step = "reserve_executor_details";
            }
        },
        AddGiftDetails() {
            this.giftDetails.push({
                giftTo: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            })
        },
        removeGiftDetails(index) {
            this.giftDetails.splice(index, 1)
        },
        AddGiftMoney() {
            this.giftMoney.push({
                moneyDetails: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            })
        },
        removeGiftMoney(index) {
            this.giftMoney.splice(index, 1)
        },
        addBankPerson(i, index) {
            this.giftBank[i].persons.push({
                parent: i,
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                shareType: "share",
                share: "",
                index: index + 1,
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            })
        },
        addBank() {
            this.giftBank.push({
                bankName: "",
                bankReference: "",
                maxShare: "",
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "share",
                    share: 0,
                    beneficiary: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                    }
                }]
            })
        },
        removeBank(i) {
            this.giftBank.splice(i, 1)
        },
        submitForm(form) {
            switch (form) {
                case 1:
                    this.$v.form1.$touch();
                    if (this.$v.form1.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'mirror_select'
                    }
                    return;
                case 'mirror_select':
                    this.step = 'address'
                    return;
                case 'address':
                    this.$v.addressSummary.$touch();
                    if (this.$v.addressSummary.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        if (this.hasMirrorWill) {
                            this.step = 'second_applicant';
                        } else {
                            this.step = 'executor_summary'
                        }
                    }
                    return;
                case 'second_applicant':
                    this.$v.secondApplicant.$touch();
                    if (this.$v.secondApplicant.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'executor_details'
                    }
                    return;
                case 'executor_details':
                    if (this.secondExecutor) {
                        this.step = 'reserve_executor_details';
                    } else {
                        this.step = 'executor_summary';
                    }
                    return;
                case 'executor_summary':
                    this.$v.executor.$touch()
                    if (this.$v.executor.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'reserve_executor_details';
                    }
                    return;
                case 'reserve_executor_details':
                    this.$v.reserveExecutor.$touch();
                    if (this.$v.reserveExecutor.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        if (this.hasChildrenUnderEighteen) {
                            this.step = 'guardian';
                        } else {
                            this.step = 'gift_options';
                        }
                    }
                    return;
                case 'guardian':
                    this.step = this.appointGuardian ? 'children_details' : 'gift_options'
                    return;
                case 'children_details':
                    this.step = 'reserve_guardian';
                    return;
                case 'reserve_guardian':
                    this.step = 'gift_options'
                    return;
                case 'gift_options':
                    this.$v.giftDetails.$touch();
                    if (this.$v.giftDetails.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'gift_money';
                    }
                    return;
                case 'gift_money':
                    this.$v.giftMoney.$touch();
                    if (this.$v.giftMoney.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'gift_charity';
                    }
                    return;
                case 'gift_bank':
                    this.giftBank.maxShare = this.finalShare;
                    this.$v.giftBank.$touch();
                    if (this.$v.giftBank.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'gift_property'
                    }
                    return;
                case 'gift_charity':
                    this.$v.giftCharity.$touch();
                    if (this.$v.giftCharity.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'gift_bank'
                    }
                    return;
                case 'gift_property':
                    this.$v.giftProperty.$touch();
                    if (this.$v.giftProperty.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'gift_pet'
                    }
                    return;
                case 'gift_pet':
                    this.$v.giftBank.$touch();
                    if (this.$v.giftProperty.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'business_assignment';
                    }
                    return;
                case 'business_assignment':
                    this.$v.businessAssignment.$touch();
                    if (this.$v.businessAssignment.$invalid) {
                        this.notifyError()
                    } else {
                        this.saveWillForm()
                        this.notifyUpdate()
                        this.step = 'residue';
                    }
                    return;
                case 'residue':
                    this.$v.residue.$touch();
                    if (this.$v.residue.$invalid) {
                        this.notifyError()
                    } else {
                        if (this.finalResidueShare && (this.maxResidueShare != this.finalResidueShare)) {
                            this.notifyError()
                        } else {
                            this.saveWillForm()
                            this.notifyUpdate()
                            this.step = 'request';
                        }
                    }
                    return;
                case 'request':
                    this.saveWillForm();
                    return;
            }
        },
        addBankProperty() {
            this.giftProperty.push({
                name: "",
                line1: "",
                line2: "",
                city: "",
                county: "",
                country: "",
                postal: "",
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "share",
                    share: 0,
                    beneficiary: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                    }
                }]
            })
        },
        addPropertyPerson(index) {
            let shareType = this.giftProperty[index].persons[0].shareType
            this.giftProperty[index].persons.push({
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                shareType: shareType,
                share: 0,
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                }
            })
        },
        removePropertyPerson(main, index) {
            this.giftProperty[main].persons.splice(index, 1)
        },
        removeBankProperty(index) {
            this.giftProperty.splice(index, 1)
        },
        saveWillForm() {
            const data = {
                firstName: this.form1.firstName,
                lastName: this.form1.lastName,
                middleName: this.form1.middleName,
                email: this.form1.email,
                dob: this.form1.dob,
                hasPartner: this.hasPartner,
                hasChildrenUnderEighteen: this.hasChildrenUnderEighteen,
                hasMirrorWill: this.hasMirrorWill,
                ownProperty: this.ownProperty,
                addressSummary: this.addressSummary,
                secondApplicant: this.secondApplicant,
                secondExecutor: this.secondExecutor,
                executor: this.executor,
                reserveExecutor: this.reserveExecutor,
                reserve: this.reserve,
                giftDetails: this.giftDetails,
                giftMoney: this.giftMoney,
                appointGuardian: this.appointGuardian,
                hasMoreThanOneChildren: this.hasMoreThanOneChildren,
                sameGuardianAllChildren: this.sameGuardianAllChildren,
                children: this.children,
                reserveGuardian: this.reserveGuardian,
                giftCharity: this.giftCharity,
                giftBank: this.giftBank,
                giftPet: this.giftPet,
                businessAssignment: this.businessAssignment,
                residue: this.residue,
                request: this.request,
                giftProperty: this.giftProperty,
                step: this.step
            }
            axios({
                method: this.id ? 'put' : 'post',
                url: this.id ? `/willform/${this.id}` : '/willform',
                data: data
            }).then(response => {
                if (response.data.success) {
                    this.$notify({
                        type: 'success',
                        title: 'Update',
                        text: response.data.message
                    })
                    if (response.data.status === 'pending_payment') {
                        this.step = 'payment';
                    }
                } else {
                    console.log(response.data);
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: 'Error in the form'
                    })
                }
            }).catch(() => this.$notify({
                type: 'error',
                title: 'Error',
                text: 'Error in the form submissions'
            }))
        },
        submitFinalForm(args) {
            axios.post(`/willform/${this.id}/payment`, {
                setupIntent: args.setupIntent,
            }).then(response => {
                if (response.data.success) {
                    this.$notify({
                        type: 'success',
                        title: 'Update',
                        text: 'Payment was successfully'
                    })
                    setTimeout(function () {
                        window.location.href = '/will/submissions'
                    }, 3000);
                } else {
                    console.log(response.data)
                    this.$notify({
                        type: 'error',
                        title: 'Error',
                        text: 'Error in payment'
                    })
                }
            }).catch(err => {
                this.$notify({
                    type: 'error',
                    title: 'Error',
                    text: 'Error in the form submissions'
                })
            })
        },
        removeBusinessPerson(main, index) {
            this.businessAssignment[main].persons.splice(index, 1)
        },
        addBusinessPerson(index) {
            this.businessAssignment[index].persons.push({
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                shareType: "share",
                share: 0,
            })
        },
        AddGiftPet() {
            this.giftPet.push({
                pet: "",
                firstName: "",
                middleName: "",
                lastName: "",
                predeceased: "",
                beneficiary: {
                    firstName: "",
                    middleName: "",
                    lastName: "",
                },
            })
        },
        removeGiftPet(index) {
            this.giftPet.splice(index, 1)
        },
        removeBusinessAssignment(index) {
            this.businessAssignment.splice(index, 1)
        },
        addBusinessAssignment(index) {
            this.businessAssignment.push({
                business: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                parent: index + 1,
                secondApplicantRelation: "",
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "share",
                    share: 0,
                }]
            })
        },
        addResidue() {
            this.residue.push({
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
                secondApplicantRelation: "",
                predeceased: "",
                shareType: "",
                share: "",
            })
        },
        removeResidue(i) {
            this.residue.splice(i, 1)
        },
        updateData(){
            this.form1 = this.data.form1
            if(this.step === 1)return;
            this.hasMirrorWill = this.data.hasMirrorWill
            this.hasPartner = this.data.hasPartner
            this.hasChildrenUnderEighteen = this.data.hasChildrenUnderEighteen
            this.addressSummary = this.data.addressSummary
            this.ownProperty = this.data.ownProperty
            if(this.step === 'address')return;
            this.secondApplicant = this.data.secondApplicant
            if(this.step === 'second_applicant')return;
            this.secondExecutor = this.data.secondExecutor
            if(this.step === 'executor_details')return;
            this.executor = this.data.executor
            if(this.step === 'executor_summary')return;
            this.reserveExecutor = this.data.reserveExecutor
            if(this.step === "reserve_executor_details")return;
            this.giftDetails = this.data.giftDetails
            if(this.step === "gift_options")return;
            this.giftMoney = this.data.giftMoney
            if(this.step === "gift_money")return;
            this.giftCharity = this.data.giftCharity
            if(this.step === "gift_charity")return;
            this.giftBank = this.data.giftBank
            if(this.step === "gift_bank")return;
            this.giftProperty = this.data.giftProperty
            if(this.step === "gift_property")return;
            this.giftPet = this.data.giftPet
            if(this.step === "gift_pet")return;
            this.businessAssignment = this.data.businessAssignment
            if(this.step === "business_assignment")return;
            this.residue = this.data.residue
            if(this.step === "residue")return;
            this.request = this.data.request
            if(this.step === "request")return;
            this.appointGuardian = this.data.appointGuardian
            this.hasMoreThanOneChildren = this.data.hasMoreThanOneChildren
            this.sameGuardianAllChildren = this.data.sameGuardianAllChildren
            this.children = this.data.children
            this.reserveGuardian = this.data.reserveGuardian
        }
    },
    watch: {
        giftProperty: {
            handler() {
                this.giftProperty.forEach((property, main) => {
                    property.persons.forEach((person, index) => {
                        if (index > 0) {
                            this.giftProperty[main].persons[index].shareType = this.giftProperty[main].persons[0].shareType;
                        }
                    })

                    if (this.giftProperty[main].persons[0].shareType === 'share') {
                        var share = 0;
                        property.persons.forEach((person, index) => {
                            share = share + parseInt(person.share);
                        })
                        this.giftProperty[main].finalShare = share;
                    } else {
                        var share = 0.0;
                        property.persons.forEach((person, index) => {
                            share = share + parseFloat(person.share);
                        })
                        this.giftProperty[main].finalShare = share;
                    }
                })
            },
            deep: true
        }
    },
    mounted() {
        this.updateData()
    }
}
</script>

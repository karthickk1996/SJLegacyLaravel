<script>
import {alphaNum, requiredIf, decimal, maxLength} from "vuelidate/lib/validators";

const {required, alpha, minLength, email, helpers, maxValue, sameAs} = require('vuelidate/lib/validators')
const postal = helpers.regex('required', /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/)
const ageValidation = (dateString) => {
    const today = new Date();
    const birthDate = new Date(dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age > 18;
}

const beniRequirement = (value, nested) => {
    console.log(value, nested);
    return true;
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
            giftBank: {
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
            },
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
                persons: [{
                    firstName: "",
                    middleName: "",
                    lastName: "",
                    relation: "",
                    secondApplicantRelation: "",
                    shareType: "share",
                    share: 0,
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
                }]
            }],
        }
    },
    computed: {
        maxBankShare() {
            if (this.giftBank.persons[0].shareType === 'share') {
                return 100
            } else
                return 1
        },
        finalShare() {
            if (this.giftBank.persons[0].shareType === 'share') {
                var v = 0;
                this.giftBank.persons.forEach(value => {
                    let base = value.share;
                    if (base) {
                        v = v + parseInt(value.share)
                    }
                })
            } else {
                var v = 0.0;
                this.giftBank.persons.forEach(value => {
                    let base = value.share;
                    if (base) {
                        v = v + parseFloat(value.share)
                    }
                })
            }
            return v;
        },
        finalPropertyShare() {
            this.giftProperty.forEach((property, i) => {
                if (property.persons[0].shareType === 'share') {
                    var v = 0;
                    property.persons.forEach(person => {
                        let base = person.share;
                        if (base) {
                            v = v + parseInt(person.share)
                        }
                    })
                    this.giftProperty[i].finalShare = v;
                } else {
                    var v = 0.0;
                    property.persons.forEach(value => {
                        let base = value.share;
                        if (base) {
                            v = v + parseFloat(value.share)
                        }
                    })
                    this.giftProperty[i].finalShare = v;
                }
            })

            return true;
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
                    ageValidation
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
                    ageValidation
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
            executor: {
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
                        ageValidation
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
                        ageValidation
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
            giftDetails: {
                required,
                $each: {
                    giftTo: {
                        required
                    },
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
                    relation: {
                        required
                    },
                    secondApplicantRelation: {
                        required
                    },
                    predeceased: {
                        required
                    },
                    beneficiary: {
                        required,
                        firstName: {
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
                        }
                    }
                },

            },
            giftMoney: {
                $each: {
                    moneyDetails: {required},
                    firstName: {required},
                    middleName: {
                        alpha,
                        minLength: minLength(4),
                    },
                    lastName: {
                        alpha,
                        minLength: minLength(4),
                    },
                    relation: {
                        required
                    },
                    secondApplicantRelation: {},
                    predeceased: {
                        required
                    },
                    beneficiary: {
                        required,
                        firstName: {
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
                        }
                    }
                }
            },
            giftCharity: {
                name: {
                    alphaNum
                },
                reference: {
                    alphaNum
                },
                money: {},
            },
            giftBank: {
                bankName: {},
                bankReference: {},
                maxShare: {
                    sameAsmaxBankSharesameAs: sameAs(() => {
                        return this.maxBankShare
                    })
                },
                persons: {
                    $each: {
                        firstName: {alpha, required},
                        middleName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        lastName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        relation: {
                            required
                        },
                        secondApplicantRelation: {},
                        predeceased: {
                            required
                        },
                        shareType: {
                            required
                        },
                        share: {
                            maxValue: maxValue(this.maxBankShare)
                        },
                        beneficiary: {
                            required,
                            firstName: {
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
                            }
                        }

                    }
                }
            },
            giftProperty: {
                $each: {
                    name: {},
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
                    finalShare: {
                        maxFinalValue
                    },
                    persons: {
                        $each: {
                            firstName: {alpha, required},
                            middleName: {
                                alpha,
                                minLength: minLength(4),
                            },
                            lastName: {
                                alpha,
                                minLength: minLength(4),
                            },
                            relation: {
                                required
                            },
                            secondApplicantRelation: {},
                            predeceased: {
                                required
                            },
                            shareType: {
                                required
                            },
                            share: {
                                maxValueProperty
                            }
                        }
                    }
                }
            },
            giftPet: {
                $each: {
                    petDetails: {},
                    firstName: {required},
                    middleName: {
                        alpha,
                        minLength: minLength(4),
                    },
                    lastName: {
                        alpha,
                        minLength: minLength(4),
                    },
                    predeceased: {
                        required
                    },
                    beneficiary: {
                        required,
                        firstName: {
                            required: requiredIf((nested) => {
                                return this.giftMoney.predeceased === 'Assign to named beneficiary'
                            })
                        },
                        middleName: {
                            alpha,
                            minLength: minLength(4),
                        },
                        lastName: {
                            required: requiredIf((nested) => {
                                return this.giftMoney.predeceased === 'Assign to named beneficiary'
                            })
                        }
                    }
                }
            },
            businessAssignment: {
                $each: {
                    business: {},
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
                    relation: {
                        required
                    },
                    secondApplicantRelation: {
                        required
                    },
                    finalShare: {
                        maxFinalValue
                    },
                    persons: {
                        $each: {
                            firstName: {alpha, required},
                            middleName: {
                                alpha,
                                minLength: minLength(4),
                            },
                            lastName: {
                                alpha,
                                minLength: minLength(4),
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
                    secondApplicantRelation: "",
                    predeceased: "",
                    shareType: "",
                    share: "",
                    beneficiary: {
                        firstName: {
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
                        }
                    }
                }
            }
        }
    },
    methods: {
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
                this.step = 'reserve_executor_details';
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
        removeBankPerson(index) {
            this.giftBank.persons.splice(index, 1)
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
                this.step = 'guardian'
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
        addBankPerson() {
            this.giftBank.persons.push({
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
            })
        },
        submitForm(form) {
            if (form === 1) {
                this.$v.form1.$touch();
                if (this.$v.form1.$invalid) {
                    console.log('invalid entry')
                } else {
                    this.step = 'mirror_select'
                }
            } else if (form === 'mirror_select') {
                this.step = 'address'
            } else if (form === 'address') {
                this.$v.addressSummary.$touch();
                if (this.$v.addressSummary.$invalid) {
                    console.log('invalid entry')
                } else {
                    if (this.hasMirrorWill) {
                        this.step = 'second_applicant';
                    } else {
                        this.step = 'executor_summary'
                    }
                }
            } else if (form === 'second_applicant') {
                this.$v.secondApplicant.$touch();
                if (this.$v.secondApplicant.$invalid) {
                    console.log(this.$v.secondApplicant)
                } else {
                    this.step = 'executor_details'
                }
            } else if (form === 'executor_details') {
                if (this.secondExecutor) {
                    this.step = 'reserve_executor_details';
                } else {
                    this.step = 'executor_summary';
                }
            } else if (form === 'executor_summary') {
                this.$v.executor.$touch()
                if (this.$v.executor.$invalid) {
                    console.log('Invalid Details in executor form')
                } else {
                    this.step = 'reserve_executor_details';
                }
            } else if (form === 'reserve_executor_details') {
                this.$v.reserveExecutor.$touch();
                if (this.$v.reserveExecutor.$invalid) {
                    console.log('Invalid details in reserve executor form')
                } else {
                    if (this.hasChildrenUnderEighteen) {
                        this.step = 'guardian';
                    } else {
                        this.step = 'gift_options';
                    }
                }
            } else if (form === 'guardian') {
                if (this.appointGuardian) {
                    this.step = 'children_details';
                } else {
                    this.step = 'gift_options';
                }
            } else if (form === 'children_details') {
                //@todo complete children_details form data
            } else if (form === 'gift_options') {
                this.$v.giftDetails.$touch();
                if (this.$v.giftDetails.invalid) {
                    console.log('Error in gift details')
                } else
                    this.step = 'gift_money';
            } else if (form === 'gift_money') {
                this.$v.giftMoney.$touch();
                if (this.$v.giftMoney.invalid) {
                    console.log('Error in gift money')
                } else
                    this.step = 'gift_charity';
            } else if (form === 'gift_charity') {
                this.$v.giftCharity.$touch();
                if (this.$v.giftCharity.invalid) {
                    console.log('Error in gift charity')
                } else {
                    this.step = 'gift_bank'
                }
            } else if (form === 'gift_bank') {
                this.giftBank.maxShare = this.finalShare;
                this.$v.giftBank.$touch();
                if (this.$v.giftBank.$invalid) {
                    console.log('Error in gift bank')
                } else {
                    this.step = 'gift_property'
                }
            } else if (form === 'gift_property') {
                this.$v.giftProperty.$touch();
                if (this.$v.giftProperty.$invalid) {
                    console.log('Error in gift property')
                } else {
                    this.step = 'gift_pet'
                }
            } else if (form === 'gift_pet') {
                this.$v.giftBank.$touch();
                if (this.$v.giftProperty.$invalid) {
                    console.log('Error in gift bank')
                } else {
                    this.step = 'business_assignment';
                }
            } else if (form === 'business_assignment') {
                this.$v.businessAssignment.$touch();
                if (this.$v.businessAssignment.$invalid) {
                    console.log('Error in business assignment')
                } else {
                    this.step = 'residue';
                }
            } else if (form === 'residue') {
                this.$v.residue.$touch();
                if (this.$v.residue.$invalid) {
                    console.log('Error in residue')
                } else {
                    this.step = 'request';
                }
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
            })
        },
        removePropertyPerson(main, index) {
            this.giftProperty[main].persons.splice(index, 1)
        },
        removeBankProperty(index) {
            this.giftProperty.splice(index, 1)
        },
        submitFinalForm() {
            axios.post('willform', {
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
                giftProperty: this.giftProperty
            }).then(response => {

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
        addBusinessAssignment() {
            this.businessAssignment.push({
                business: "",
                firstName: "",
                middleName: "",
                lastName: "",
                relation: "",
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
                })
            },
            deep: true
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <v-app app>
            <v-container>
                <v-row justify="center">
                    <v-col
                        v-for="n in 3"
                        :key="n"
                        cols="12"
                        sm="4"
                    >
                        <v-card
                            class="reg-form"
                            v-if="n === 2"
                        >
                            <template v-if="!registered">
                                <v-alert
                                    border="top"
                                    color="red lighten-2"
                                    v-for="error in validationErrors"
                                    :key="error[0]"
                                    dark
                                >
                                    {{ error[0] }}
                                </v-alert>
                                <v-card-text>
                                    <v-form
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                    >
                                        <span>Full name</span>
                                        <v-text-field
                                            flat
                                            solo
                                            rounded
                                            v-model="fullName"
                                            :rules="[v => !!v || 'Item is required']"
                                        >
                                        </v-text-field>
                                        <span>Country</span>
                                        <v-autocomplete
                                            v-model="countryId"
                                            :items="items"
                                            :search-input.sync="countrySearch"
                                            :loading="isCountryLoading"
                                            item-text="label"
                                            item-value="id"
                                            :rules="[v => !!v || 'Item is required']"
                                            rounded
                                            flat
                                            solo
                                        ></v-autocomplete>
                                        <span>Phone</span>
                                        <v-input
                                            class="phone-input v-text-field v-text-field--rounded"
                                            :rules="[v => !!v || 'Item is required']"
                                            rounded
                                            solo
                                            flat
                                        >
                                            <template v-slot:default>
                                                <input v-model="phoneNumber">
                                            </template>
                                        </v-input>
                                        <span>Email</span>
                                        <v-text-field
                                            rounded
                                            flat
                                            solo
                                            v-model="email"
                                            :rules="[v => !!v || 'Item is required']"
                                        >
                                        </v-text-field>
                                        <v-btn
                                            class="mr-4"
                                            type="button"
                                            :disabled="!valid"
                                            @click="register"
                                        >
                                            submit
                                        </v-btn>
                                    </v-form>

                                </v-card-text>
                            </template>
                            <div v-else>You are successfully registered</div>
                        </v-card>
                    </v-col>
                </v-row>

            </v-container>
        </v-app>
    </div>
</template>

<script>

export default {
    name: "RegistrationForm",
    data() {
        return {
            valid: false,
            fullName: '',
            countryId: '',
            email: '',
            phoneNumber: '',
            countrySearch: null,
            isCountryLoading: false,
            items: [],
            validationErrors: [],
            registered: false
        }
    },
    methods: {
        register() {
            axios.post('/api/create-user', {
                name: this.fullName,
                country_id: this.countryId,
                email: this.email,
                phone: this.phoneNumber
            })
                .then(res => {
                    this.registered = true
                })
                .catch(err => {
                   this.validationErrors = err.response.data.errors
                })
                .finally(() => {
                    this.isCountryLoading = false
                })
        },
    },
    computed: {
        selectedCountryCode() {
            let selected = ''
            if (this.countryId) {
                selected = this.items.filter((item) => item.id === this.countryId)[0].idd
            }
            return selected
        },
    },
    watch: {
        countrySearch(val) {
            if (this.items.length > 0) return

            if (this.isCountryLoading) return

            this.isCountryLoading = true

            axios.get('/api/countries')
                .then(res => {
                    const {count, items} = res.data
                    this.count = count
                    this.items = items
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(() => {
                    this.isCountryLoading = false
                })
        },
        selectedCountryCode(val) {
            let checkingValue = val + ' '
            if (!this.phoneNumber.startsWith(checkingValue)) {
                this.phoneNumber = checkingValue
            }
        },
        phoneNumber(val) {
            let checkingValue = this.selectedCountryCode + ' '
            if (!val.startsWith(checkingValue)) {
                this.phoneNumber = checkingValue
            } else {
                let format = /^(\d{2})(\d{3})(\d{2})(\d{2}).*/
                this.phoneNumber = val.replace(checkingValue, '')
                this.phoneNumber = this.phoneNumber.replace(format, '$1 $2-$3-$4')
                this.phoneNumber = checkingValue + this.phoneNumber
            }
        }
    },
}
</script>

<style scoped>
.reg-form {
    padding: 0px 50px;
}

::v-deep .v-input__slot {
    border: 1px solid;
    border-color: #9e9e9e !important;
}
::v-deep .phone-input .v-input__slot {
    border: 2px solid;
    border-color: #0f4df6 !important;
}
</style>

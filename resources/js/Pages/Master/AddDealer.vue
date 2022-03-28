<template>
    <Head :title="'Add Dealer'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Add Dealer</h1>
        </div>

        <form action="#" novalidate="novalidate" @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.name" placeholder="Name">
                                             <span v-if="v$.form_data.name.$error" class="text-danger">Name field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.location" placeholder="Location">
                                             <span v-if="v$.form_data.location.$error" class="text-danger">Location field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Ship To Party</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.ship_to_party" placeholder="Ship To Party">
                                            <span v-if="v$.form_data.ship_to_party.$error" class="text-danger">Ship To Party field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Bill To Party</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.bill_to_party" placeholder="Bill To Party">
                                            <span v-if="v$.form_data.bill_to_party.$error" class="text-danger">Bill To Party field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.city" placeholder="City">
                                            <span v-if="v$.form_data.city.$error" class="text-danger">City field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.state" placeholder="State">
                                             <span v-if="v$.form_data.state.$error" class="text-danger">State field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Zipcode</label>
                                            <input type="number" class="form-control" required="required" v-model="form_data.zipcode" placeholder="Zipcode">
                                            <span v-if="v$.form_data.zipcode.$error" class="text-danger">Zipcode field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control" required="required" v-model="form_data.phone" placeholder="Phone">
                                            <span v-if="v$.form_data.phone.$error" class="text-danger">Phone field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required="required" v-model="form_data.email" placeholder="Email">
                                            <span v-if="v$.form_data.email.$error" class="text-danger">Email field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">GST Details</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.gst_details" placeholder="GST Details">
                                            <span v-if="v$.form_data.gst_details.$error" class="text-danger">GST Details field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Street Address</label>
                                            <textarea type="text" class="form-control" required="required" v-model="form_data.street_address" placeholder="Street Address"></textarea>
                                            <span v-if="v$.form_data.street_address.$error" class="text-danger">Street Address field required</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 d-md-flex">
                    <div class="">
                        <button class="btn btn-primary pe-3" type="submit" @click="submitAddDealer">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal -->
    </div>
</template>
<script>
import { email, numeric, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'

export default {
    props: ['dealer'],
     	setup() {
		return {v$: useVuelidate()};
	},
       data(){
        return {
        form_data:{
			name: '',
            location: '',
            ship_to_party: '',
            bill_to_party: '',
            street_address: '',
            city: '',
            state: '',
            zipcode: '',
            phone: '',
            email: '',
            gst_details:'',
			},
          
        };
    },
      validations() {
    return {
        form_data : {
            name: { required },
            location: { required },
            ship_to_party: { required },
            bill_to_party: { required },
            street_address: { required },
            city: { required },
            state: { required },
            zipcode: { required, numeric },
            phone: { required, numeric },
            email: { required, email },
            gst_details: { required },
        }
    };
	},
    mounted(){
           if(this.dealer) {
            this.form_data.name = this.form_data.name ? this.form_data.name: this.dealer.name;
            this.form_data.location = this.form_data.location ? this.form_data.location:  this.dealer.location;
            this.form_data.ship_to_party = this.form_data.ship_to_party ? this.form_data.ship_to_party:  this.dealer.ship_to_party;
            this.form_data.bill_to_party = this.form_data.bill_to_party ? this.form_data.bill_to_party:  this.dealer.bill_to_party;
            this.form_data.street_address = this.form_data.street_address ? this.form_data.street_address:  this.dealer.address;
            this.form_data.city = this.form_data.city ? this.form_data.city:  this.dealer.city;
            this.form_data.state = this.form_data.state ? this.form_data.state:  this.dealer.state;
            this.form_data.zipcode = this.form_data.zipcode ? this.form_data.zipcode:  this.dealer.zipcode;
            this.form_data.phone = this.form_data.phone ? this.form_data.phone:  this.dealer.phone;
            this.form_data.email = this.form_data.email ? this.form_data.email:  this.dealer.email;
            this.form_data.gst_details = this.form_data.gst_details ? this.form_data.gst_details:  this.dealer.gst_details;
            }
    },
    methods: {
        async handleSubmit() {
            const result = await this.v$.$validate();
              if (result) {
            this.form_data.edit= this.dealer ? true : false,
            this.form_data.id= this.dealer ? this.dealer.id : 0,
            this.$axios.post('/api/master/create-or-update-dealer', this.form_data).then(() => {
                this.$swal(this.form_data.edit ? 'Dealer edited ' : 'Dealer added');
                this.v$.$reset();
                this.clearForm();
            });
        }

        },
          clearForm() {
			this.form_data = {
				name: '',
                location: '',
                ship_to_party: '',
                bill_to_party: '',
                street_address: '',
                city: '',
                state: '',
                zipcode: '',
                phone: '',
                email: '',
                gst_details:'',
			};
		},
    }
}

</script>

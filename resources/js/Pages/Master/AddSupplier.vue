<template>
    <Head :title="'Add Supplier'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Add Supplier</h1>
        </div>

        <form action="#" novalidate="novalidate" @submit.prevent="submitSupplier">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.name" placeholder="Name">
                                             <span v-if="v$.form_data.name.$error" class="text-danger">Name field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" required="required" v-model="form_data.country" placeholder="Country">
                                            <span v-if="v$.form_data.country.$error" class="text-danger">Country field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control" required="required" v-model="form_data.phone" placeholder="Phone">
                                            <span v-if="v$.form_data.phone.$error" class="text-danger">Phone field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required="required" v-model="form_data.email" placeholder="Email">
                                            <span v-if="v$.form_data.email.$error" class="text-danger">Email field required</span>
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
                        <button class="btn btn-primary pe-3" type="submit" >Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { email, numeric, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'

export default {
    props: ['supplier'],
   	setup() {
		return {v$: useVuelidate()};
	},
    data(){
        return {
        form_data:{
			name: '',
            country: '',
            phone: '',
            email: '',
			},
          
        };
    },
   mounted() {
            if(this.supplier) {
            this.form_data.name = this.form_data.name ? this.form_data.name: this.supplier.name;
            this.form_data.country = this.form_data.country ? this.form_data.name:  this.supplier.country;
            this.form_data.phone = this.form_data.phone ? this.form_data.name:  this.supplier.phone;
            this.form_data.email = this.form_data.email ? this.form_data.email:  this.supplier.email;
            }
           
   },
    validations() {
    return {
        form_data : {
        name: {required},
        country: {required},
        phone: {required, numeric},
        email: {required, email},
        }
    };
	},
    methods: {
        async submitSupplier() {
            const result = await this.v$.$validate();
         if (result) {
            this.form_data.edit= this.supplier ? true : false,
            this.form_data.id= this.supplier ? this.supplier.id : 0,
            this.$axios.post('/api/master/create-or-update-supplier', this.form_data).then(() => {
                this.$swal(this.form_data.edit ? 'Supplier edited ' : 'Supplier added');
                this.v$.$reset();
                this.clearForm();
            });
        }
        },
        clearForm() {
			this.form_data = {
				name: '',
                country: '',
                phone: '',
                email: '',
			};
		},
    }
}

</script>

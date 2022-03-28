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
                                            <input type="text" class="form-control" required="required" v-model="form.name" placeholder="Name">
                                             <span v-if="v$.name.$error" class="text-danger">Name field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" required="required" v-model="form.location" placeholder="Location">
                                             <span v-if="v$.location.$error" class="text-danger">Location field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Ship To Party</label>
                                            <input type="text" class="form-control" required="required" v-model="form.ship_to_party" placeholder="Ship To Party">
                                            <span v-if="v$.ship_to_party.$error" class="text-danger">Ship To Party field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Bill To Party</label>
                                            <input type="text" class="form-control" required="required" v-model="form.bill_to_party" placeholder="Bill To Party">
                                            <span v-if="v$.bill_to_party.$error" class="text-danger">Bill To Party field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" required="required" v-model="form.city" placeholder="City">
                                            <span v-if="v$.city.$error" class="text-danger">City field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" required="required" v-model="form.state" placeholder="State">
                                             <span v-if="v$.state.$error" class="text-danger">State field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Zipcode</label>
                                            <input type="number" class="form-control" required="required" v-model="form.zipcode" placeholder="Zipcode">
                                            <span v-if="v$.zipcode.$error" class="text-danger">Zipcode field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control" required="required" v-model="form.phone" placeholder="Phone">
                                            <span v-if="v$.phone.$error" class="text-danger">Phone field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required="required" v-model="form.email" placeholder="Email">
                                            <span v-if="v$.email.$error" class="text-danger">Email field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">GST Details</label>
                                            <input type="text" class="form-control" required="required" v-model="form.gst_details" placeholder="GST Details">
                                            <span v-if="v$.gst_details.$error" class="text-danger">GST Details field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Street Address</label>
                                            <textarea type="text" class="form-control" required="required" v-model="form.street_address" placeholder="Street Address"></textarea>
                                            <span v-if="v$.street_address.$error" class="text-danger">Street Address field required</span>
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
<div class="modal fade" id="myModal"  tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center" >
       <h3 class="text-success mt-2 mb-2">{{ $attrs.flash.success}}</h3>
       <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>
</template>
<script>
import { email, numeric, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: ['dealer'],
    setup (props) {
        const form = useForm({
            name: props.dealer ? props.dealer.name : '',
            location: props.dealer ? props.dealer.location : '',
            ship_to_party: props.dealer ? props.dealer.ship_to_party : '',
            bill_to_party: props.dealer ? props.dealer.bill_to_party : '',
            street_address: props.dealer ? props.dealer.address : '',
            city: props.dealer ? props.dealer.city : '',
            state: props.dealer ? props.dealer.state : '',
            zipcode: props.dealer ? props.dealer.zipcode : '',
            phone: props.dealer ? props.dealer.phone : '',
            email: props.dealer ? props.dealer.email : '',
            gst_details: props.dealer ? props.dealer.gst_details : '',
        });
        const rules = {
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

        const v$ = useVuelidate(rules, form) ;
        return { v$, form };
    },
    mounted(){
        this.showMessage();
    },
    methods: {
        showMessage(){
        if(this.$attrs.flash.success) {
             this.$bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')).show();
        }
        },
        async handleSubmit() {
            const result = await this.v$.$validate();
             if(result) {
                 this.form
                .transform((data) => ({
                    ...data,
                    edit: this.dealer ? true : false,
                    id: this.dealer ? this.dealer.id : 0
                })).post('/api/master/create-or-update-dealer', {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () =>  this.form.reset()
                });
            }
        }
    }
}

</script>

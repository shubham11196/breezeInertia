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
                                            <input type="text" class="form-control" required="required" v-model="form.name" placeholder="Name">
                                             <span v-if="v$.name.$error" class="text-danger">Name field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" required="required" v-model="form.country" placeholder="Country">
                                            <span v-if="v$.country.$error" class="text-danger">Country field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control" required="required" v-model="form.phone" placeholder="Phone">
                                            <span v-if="v$.phone.$error" class="text-danger">Phone field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required="required" v-model="form.email" placeholder="Email">
                                            <span v-if="v$.email.$error" class="text-danger">Email field required</span>
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
        <div class="modal fade" id="myModal"  tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center" >
       <h3 class="text-success mt-2 mb-2">{{ $attrs.message}}</h3> 
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
    props: ['supplier'],
    setup (props) {
        const form = useForm({
            name: props.supplier ? props.supplier.name : '',
            country: props.supplier ? props.supplier.country : '',
            phone: props.supplier ? props.supplier.phone : '',
            email: props.supplier ? props.supplier.email : '',
        });
        const rules = {
            name: { required },
            country: { required },
            phone: { required, numeric },
            email: { required, email },
        }

        const v$ = useVuelidate(rules, form) ;
        return { v$, form };
    },
    mounted(){
        this.showMessage();
    },
    methods: {
        showMessage(){
        if(this.$attrs.message) {
             this.$bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')).show();
        }
        },
        async submitSupplier() {
            const result = await this.v$.$validate();
            if(result) {
                this.form
                .transform((data) => ({
                    ...data,
                    edit: this.supplier ? true : false,
                    id: this.supplier ? this.supplier.id : 0
                })).post('/api/master/create-or-update-supplier', {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () =>  this.form.reset()
                });
            }
        }
    }
}

</script>

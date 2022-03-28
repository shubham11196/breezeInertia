<template>
    <Head :title="'Add Product'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Add Product</h1>
        </div>
         <form action="#" novalidate="novalidate" @submit.prevent="handleAddProduct">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">UPC/SKU</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.sku.$error}"  v-model="form.sku" placeholder="UPC/SKU">
                                             <span v-if="v$.sku.$error" class="text-danger">SKU field </span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Short Name</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.short_name.$error}" v-model="form.short_name" placeholder="Short Name">
                                            <span v-if="v$.short_name.$error" class="text-danger">Name field </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Marin Code</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.marin_code.$error}" v-model="form.marin_code" placeholder="Marin Code">
                                            <span v-if="v$.marin_code.$error" class="text-danger">Marin Code field </span>
                                        </div>
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Model No</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.model.$error}" v-model="form.model" placeholder="Model">
                                            <span v-if="v$.model.$error" class="text-danger">Model field </span>
                                        </div>
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Color of Barcode</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.barcode_color.$error}" v-model="form.barcode_color" placeholder="Color of Barcode">
                                            <span v-if="v$.barcode_color.$error" class="text-danger">Color of Barcode field </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Color</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form.color" placeholder="Color">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Size</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.size.$error}" v-model="form.size" placeholder="Size">
                                             <span v-if="v$.size.$error" class="text-danger">Size field </span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Type</label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.type.$error}" v-model="form.type" placeholder="Type">
                                            <span v-if="v$.type.$error" class="text-danger">Type field </span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Insera Code</label>
                                            <input type="text" :class="{'form-control': true }" v-model="form.insera_code" placeholder="Insera Code">
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Fork</label>
                                            <input type="text" :class="{'form-control': true }" v-model="form.fork" placeholder="Fork">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-md-6 mb-2 pe-2">
                                            <label class="form-label">Description</label>
                                            <textarea type="text" :class="{'form-control': true, 'has-error': v$.description.$error}" v-model="form.description" placeholder="Description"></textarea>
                                            <span v-if="v$.description.$error" class="text-danger">Description field </span>
                                        </div>
                                         <div class="col-md-6 mb-2 pe-2">
                                            <label class="form-label">Description on Box</label>
                                            <textarea type="text" :class="{'form-control': true }" v-model="form.description_on_box" placeholder="Description on Box"></textarea>
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
import { numeric, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: ['product'],
    setup (props) {
        const form = useForm({
            sku: props.product ? props.product.sku : '',
            short_name: props.product ? props.product.short_name : '',
            description: props.product ? props.product.description : '',
            description_on_box: props.product ? props.product.description_on_box : '',
            model: props.product ? props.product.model : '',
            color: props.product ? props.product.color : '',
            size: props.product ? props.product.size : '',
            marin_code: props.product ? props.product.marin_code : '',
            barcode_color: props.product ? props.product.barcode_color : '',
            type: props.product ? props.product.type : '',
            insera_code: props.product ? props.product.insera_code : '',
            fork: props.product ? props.product.fork : '',
        });
        const rules = {
            sku: { required },
            short_name: { required },
            description: { required },
            model: { required },
            size: { required },
            marin_code: { required },
            barcode_color: { required },
            type: { required },
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
        async handleAddProduct() {
            const result = await this.v$.$validate();
            if(result) {
                this.form
                .transform((data) => ({
                    ...data,
                    edit: this.product ? true : false,
                    id: this.product ? this.product.id : 0
                })).post('/api/master/create-or-update-product', {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () =>  this.form.reset()
                })
            }

        }
    }
}

</script>

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
                                            <label class="form-label">UPC/SKU<span class="text-danger">*</span></label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.form_data.sku.$error}"  v-model="form_data.sku" placeholder="UPC/SKU">
                                             <span v-if="v$.form_data.sku.$error" class="text-danger">SKU field </span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Short Name<span class="text-danger">*</span></label>
                                            <input type="text" :class="{'form-control': true, 'has-error': v$.form_data.short_name.$error}" v-model="form_data.short_name" placeholder="Short Name">
                                            <span v-if="v$.form_data.short_name.$error" class="text-danger">Name field </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Marin Code</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.marin_code" placeholder="Marin Code">
            
                                        </div>
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Model No</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.model" placeholder="Model">
                                
                                        </div>
                                        <div class="col-md-4 mb-2 pe-2">
                                            <label class="form-label">Color of Barcode</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.barcode_color" placeholder="Color of Barcode">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Color</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.color" placeholder="Color">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Size</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.size" placeholder="Size">
                                        
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Type</label>
                                            <input type="text" :class="{'form-control': true}" v-model="form_data.type" placeholder="Type">
                                           
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Insera Code</label>
                                            <input type="text" :class="{'form-control': true }" v-model="form_data.insera_code" placeholder="Insera Code">
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Fork</label>
                                            <input type="text" :class="{'form-control': true }" v-model="form_data.fork" placeholder="Fork">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-md-6 mb-2 pe-2">
                                            <label class="form-label">Description</label>
                                            <textarea type="text" :class="{'form-control': true}" v-model="form_data.description" placeholder="Description"></textarea>
                                            
                                        </div>
                                         <div class="col-md-6 mb-2 pe-2">
                                            <label class="form-label">Description on Box</label>
                                            <textarea type="text" :class="{'form-control': true }" v-model="form_data.description_on_box" placeholder="Description on Box"></textarea>
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
    </div>
</template>
<script>
import { numeric, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'


export default {
    props: ['product'],
    setup() {
		return {v$: useVuelidate()};
	},
    data(){
        return {
        form_data:{
		    sku: '',
            short_name: '',
            description: '',
            description_on_box: '',
            model:'',
            color: '',
            size: '',
            marin_code: '',
            barcode_color: '',
            type: '',
            insera_code: '',
            fork:'',
			},
          
        };
    },
    validations() {
    return {
        form_data : {
            sku: { required },
            short_name: { required },
        }
    };
	},
    mounted(){
         if(this.product) {
            this.form_data.sku = this.form_data.sku ? this.form_data.sku: this.product.sku;
            this.form_data.short_name = this.form_data.short_name ? this.form_data.short_name:  this.product.short_name;
            this.form_data.description = this.form_data.description ? this.form_data.description:  this.product.description;
            this.form_data.description_on_box = this.form_data.description_on_box ? this.form_data.description_on_box:  this.product.description_on_box;
            this.form_data.model = this.form_data.model ? this.form_data.model:  this.product.model;
            this.form_data.size = this.form_data.size ? this.form_data.size:  this.product.size;
            this.form_data.marin_code = this.form_data.marin_code ? this.form_data.marin_code:  this.product.marin_code;
            this.form_data.barcode_color = this.form_data.barcode_color ? this.form_data.barcode_color:  this.product.barcode_color;
            this.form_data.type = this.form_data.type ? this.form_data.type:  this.product.type;
            this.form_data.color = this.form_data.color ? this.form_data.color:  this.product.color;
            this.form_data.insera_code = this.form_data.insera_code ? this.form_data.insera_code:  this.product.insera_code;
            this.form_data.fork = this.form_data.fork ? this.form_data.fork:  this.product.fork;
            }
    },
    methods: {
        async handleAddProduct() {
            const result = await this.v$.$validate();
            if (result) {
            this.form_data.edit= this.product ? true : false,
            this.form_data.id= this.product ? this.product.id : 0,
            this.$axios.post('/api/master/create-or-update-product', this.form_data).then(() => {
                this.$swal(this.form_data.edit ? 'Product edited ' : 'Product added');
                this.v$.$reset();
                this.clearForm();
            });
        }
        },
        clearForm() {
			this.form_data = {
                sku: '',
                short_name: '',
                description: '',
                description_on_box: '',
                model:'',
                color: '',
                size: '',
                marin_code: '',
                barcode_color: '',
                type: '',
                insera_code: '',
                fork:'',
			};
		},
    }
}

</script>

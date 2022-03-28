<template>
<div class="accordion mb-3" :id="'accordionItems' + item.id">
     <div class="accordion-item">
         <h2 class="accordion-header" :id="'itemCount' + item.id">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapseItem' + item.id" aria-expanded="true" :aria-controls="'collapseItem' + item.id">
                #{{ item.id + 1 }} Item
             </button>
         </h2>
         <div :id="'collapseItem' + item.id" :class="['accordion-collapse collapse', showAccordion ? 'show' : '']" :aria-labelledby="'itemCount' + item.id" :data-bs-parent="'#accordionItems' + item.id">
             <div class="accordion-body">
                 <div class="">
                     <div class="row">
                         <div class="col-md-12 d-md-flex">
                             <div class="col-12 col-md-6 mb-2 pe-2">
                                 <label class="form-label">Frame Number</label>
                                 <input type="text" class="form-control" ref="frame_number" required v-model="itemData.frame_number" placeholder="Frame Number" @input="frameSearch">
                             </div>
                             <div class="col-12 col-md-6 mb-2 pe-2">
                                 <label class="form-label">UPC/SKU</label>
                                 <input type="text" class="form-control" required v-model="itemData.upc_or_sku" placeholder="UPC/SKU" @input="productSearch">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12 d-md-flex">
                             <div class="col-12 col-md-4 mb-2 pe-2">
                                 <label class="form-label">GRN Number</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.grn_number" placeholder="GRN Number">
                             </div>
                             <div class="col-12 col-md-4 mb-2 pe-2">
                                 <label class="form-label">Short Name</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.short_name" placeholder="Short Name">
                             </div>
                             <div class="col-12 col-md-4 mb-2 pe-2">
                                <label class="form-label">BOE Number</label>
                                <input type="text" class="form-control" disabled v-model="itemData.boe_number" placeholder="BOE Number">
                            </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12 d-md-flex">
                             <div class="col-md-4 mb-2 pe-2">
                                 <label class="form-label">Marin Code</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.marin_code" placeholder="Marin Code">
                             </div>
                             <div class="col-md-4 mb-2 pe-2">
                                 <label class="form-label">Model</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.model" placeholder="Model">
                             </div>
                              <div class="col-md-4 mb-2 pe-2">
                                 <label class="form-label">Color of Barcode</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.color_of_barcode" placeholder="Color of Barcode">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12 d-md-flex">
                             <div class="col-12 col-md-4 mb-2 pe-2">
                                 <label class="form-label">Color</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.color" placeholder="Color">
                             </div>
                             <div class="col-12 col-md-4 mb-2 pe-2">
                                 <label class="form-label">Size</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.size" placeholder="Size">
                             </div>
                               <div class="col-12 col-md-4 mb-2 pe-2">
                                 <label class="form-label">Type</label>
                                 <input type="text" class="form-control" disabled v-model="itemData.type" placeholder="Type">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12 d-md-flex">
                             <div class="col-md-6 mb-2 pe-2">
                                 <label class="form-label">Description</label>
                                 <textarea type="text" class="form-control" disabled v-model="itemData.description" placeholder="Description"></textarea>
                             </div>
                              <div class="col-md-6 mb-2 pe-2">
                                 <label class="form-label">Description on Box</label>
                                 <textarea type="text" class="form-control" disabled v-model="itemData.description_on_box" placeholder="Description on Box"></textarea>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                    <div class="col-12 col-md-12 d-md-flex">
                        <div class="mx-auto mt-2">
                            <button class="btn btn-primary pe-3" type="button" @click="saveItem">Save</button>
                        </div>
                    </div>
                </div>
             </div>
         </div>
     </div>
 </div>
</template>
<script>
export default {
    props: ['entries', 'item'],
    emits: ['item-added'],
    data() {
        return {
            itemData: {
                id: this.item.id,
                upc_or_sku: '',
                frame_number: '',
                grn_number: '',
                boe_number: '',
                short_name: '',
                description: '',
                description_on_box: '',
                model: '',
                color: '',
                size: '',
                marin_code: '',
                color_of_barcode: '',
                type: '',
                insera_code: '',
                fork: '',
            },
            showAccordion: true,
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.$.vnode.el.children[0].children[1].children[0].children[0].children[0].children[0].children[0].children[1].focus();
        })
    },
    methods: {
        saveItem() {
            this.showAccordion = false;
            this.$emit('item-added', this.itemData)
        },
        productSearch() {
			clearTimeout(this.debounce);
			this.debounce = setTimeout(() => {
				this.getProductBySKU();
			}, 1400);
		},
        getProductBySKU() {
            this.$axios.post('/api/product-by-sku', {
                search: this.itemData.upc_or_sku,
            }).then(resp => {
                let grn_number = resp.data.last_grn_number;
                grn_number = parseInt(grn_number) + 1;
                this.itemData.grn_number = grn_number;
                let product = resp.data.product;
                if (product) {
                    this.itemData.short_name = product.short_name;
                    this.itemData.description = product.description;
                    this.itemData.description_on_box = product.description_on_box;
                    this.itemData.model = product.model;
                    this.itemData.color = product.color;
                    this.itemData.size = product.size;
                    this.itemData.marin_code = product.marin_code;
                    this.itemData.color_of_barcode = product.barcode_color;
                    this.itemData.type = product.type;
                    this.itemData.insera_code = product.insera_code;
                    this.itemData.fork = product.fork;
                }
                this.$emit('sku-update', this.itemData)
            })
        },
        frameSearch() {
			clearTimeout(this.debounce);
			this.debounce = setTimeout(() => {
				this.getProductByFrameNumber();
			}, 600);
		},
        getProductByFrameNumber() {
            this.$axios.post('/api/product-by-frame-number', {
                search: this.itemData.frame_number,
            }).then(resp => {
                let item = resp.data.inward_entry_item;
                if (item) {
                    this.itemData.boe_number = item.inward_entry.boe_number;
                    this.itemData.upc_or_sku = item.upc_or_sku;
                    this.itemData.short_name = item.short_name;
                    this.itemData.grn_number = item.grn_number;
                    this.itemData.description = item.description;
                    this.itemData.description_on_box = item.description_on_box;
                    this.itemData.model = item.model;
                    this.itemData.color = item.color;
                    this.itemData.size = item.size;
                    this.itemData.marin_code = item.marin_code;
                    this.itemData.color_of_barcode = item.color_of_barcode;
                    this.itemData.type = item.type;
                    this.itemData.insera_code = item.insera_code;
                    this.itemData.fork = item.fork;

                    //Found product now hide accordion and add new item
                    this.showAccordion = false;
                    this.$emit('item-added', this.itemData)
                }
            })
        }
    }
}
</script>

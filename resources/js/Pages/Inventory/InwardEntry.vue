<template>
    <!-- <Head :title="'Inward Entry'"/> -->
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Inward Entry</h1>
        </div>

        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Logistics</h5>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Date of Inbound</label>
                                            <Datepicker
                                                :is24="false"
                                                format="dd-MM-yyyy"
                                                :placeholder="'Date of Inbound'"
                                                required="required"
                                                :month-change-on-scroll="false"
                                                auto-apply
                                                v-model="date_of_inbound"
                                            ></Datepicker>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Import Invoice Number</label>
                                            <input type="text" class="form-control" v-model="import_invoice_number" placeholder="Import Invoice Number">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Container Number</label>
                                            <input type="text" class="form-control" v-model="container_number" placeholder="Container Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">BOE Number</label>
                                            <input type="text" class="form-control" v-model="boe_number" placeholder="BOE Number">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Supplier</label>
                                            <select
                                                id="select-supplier"
                                                v-model="supplier"
                                                class="form-control"
                                                name="select-supplier"
                                                placeholder="Select a supplier"
                                                @change="setSupplier"
                                                >
                                                <option
                                                    v-for="(option,i) in supplierList"
                                                    :key="'supplier_'+i"
                                                    :value="option.name"
                                                >
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" required="required" v-model="location" placeholder="Location">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <template :key="key" v-for="(each, key) in inwardEntries">
                                <inward-entry-items
                                    :item="each"
                                    :entries="inwardEntries"
                                    @item-added="itemAdded"
                                    @sku-update="skuUpdate"
                                />
                            </template>
                             <div class="card-footer">
                                <div class="col-md-12 d-md-flex">
                                    <div class="col-12 col-md-12 mx-auto">
                                        <button
                                            class="btn btn-primary me-3 float-end"
                                            type="button"
                                            @click="addNewItem"
                                            > + Add Item
                                        </button>
                                        <button class="btn btn-danger me-3 float-end" type="button" v-if="inwardEntries.length" @click="removeNewItem">Remove Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 d-md-flex">
                        <div class="">
                            <button class="btn btn-primary pe-3" type="button" @click="submitInwardEntry">Submit</button>
                        </div>
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
import InwardEntryItems from './InwardEntryItems.vue';
export default {
    components: {
        InwardEntryItems,
    },
    // props: ['supplierList'],
    data() {
        return {
            inwardEntries: [],
            savedItems: [],
            date_of_inbound: '',
            import_invoice_number: '',
            container_number: '',
            boe_number: '',
            supplier: '',
            location: '',
        }
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
        addNewItem() {
            this.inwardEntries.push({
                id: this.inwardEntries.length,
            })
        },
        skuUpdate(data) {
            this.inwardEntries[data.id]['upc_or_sku'] = data.upc_or_sku;
            this.$forceUpdate();
        },
        removeNewItem() {
            this.inwardEntries.pop()
        },
        itemAdded(itemData) {
            let getItem = this.savedItems.filter(i => i.id === itemData.id);
            if(getItem.length) {
                this.savedItems.splice(this.savedItems.findIndex(i => i.id === itemData.id), 1);
            }
            this.savedItems.push(itemData);
            this.addNewItem();
        },
        submitInwardEntry() {
            if (this.savedItems.length < this.inwardEntries.length) {
                this.removeNewItem();
            }
            this.$inertia.post('/api/save-inward-entry', {
                date_of_inbound: this.$moment(this.date_of_inbound).format('DD-MM-YYYY'),
                import_invoice_number: this.import_invoice_number,
                container_number: this.container_number,
                boe_number: this.boe_number,
                supplier: this.supplier,
                location: this.location,
                items: this.savedItems,
            })
        },
        setSupplier() {
            this.location = this.supplierList.find(i => i.name === this.supplier).country;
        }
    }
}

</script>

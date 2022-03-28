<template>
    <Head :title="'Inward Entry'"/>
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
                                            <label class="form-label">Date of Inbound<span class="text-danger">*</span></label>
                                            <Datepicker
                                                :is24="false"
                                                format="dd-MM-yyyy"
                                                :placeholder="'Date of Inbound'"
                                                required="required"
                                                :month-change-on-scroll="false"
                                                auto-apply
                                                v-model="date_of_inbound"
                                            ></Datepicker>
                                            <span v-if="v$.date_of_inbound.$error" class="text-danger">Date of Inbound field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Import Invoice Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="import_invoice_number" placeholder="Import Invoice Number">
                                             <span v-if="v$.import_invoice_number.$error" class="text-danger">Import Invoice Number field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Container Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="container_number" placeholder="Container Number">
                                             <span v-if="v$.container_number.$error" class="text-danger">Container Number field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">BOE Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="boe_number" placeholder="BOE Number">
                                            <span v-if="v$.boe_number.$error" class="text-danger">BOE Number field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Supplier<span class="text-danger">*</span></label>
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
                                            <span v-if="v$.supplier.$error" class="text-danger">Supplier field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Location<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  v-model="location" placeholder="Location">
                                            <span v-if="v$.supplier.$error" class="text-danger">Location field required</span>
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
                            <template :key="each.id" v-for="(each) in inwardEntries">
                                <inward-entry-items
                                    :item="each"
                                    :entries="inwardEntries"
                                    @item-added="itemAdded"
                                    @sku-update="skuUpdate"
                                    @remove-item="removeNewItem(each.id)"
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
    </div>
</template>
<script>
import InwardEntryItems from './InwardEntryItems.vue';
import { email, numeric, required, helpers } from '@vuelidate/validators';
import { useVuelidate } from '@vuelidate/core';
export default {
    components: {
        InwardEntryItems,
    },
    props: ['supplierList'],
    setup() {
		return {v$: useVuelidate({ $scope: false })};
	},
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
    validations() {
        return {
            date_of_inbound: { required },
            import_invoice_number: { required },
            container_number: { required },
            boe_number: { required },
            supplier: { required },
            location: { required },
        };
	},
    methods: {
        addNewItem() {
            var increment = false;
            let array = this.inwardEntries.filter(node => {
                if(node.id === this.inwardEntries.length) {
                    increment = true;
                }
                return this.inwardEntries;
            });
            this.inwardEntries.push({
                id: increment ? array.length + 1 : array.length,
            })
        },
        skuUpdate(data) {
            this.inwardEntries[data.id]['upc_or_sku'] = data.upc_or_sku;
            this.$forceUpdate();
        },
        removeNewItem(id) {
            this.inwardEntries.splice(id, 1);
            this.$forceUpdate();
        },
        itemAdded(itemData) {
            let getItem = this.savedItems.filter(i => i.id === itemData.id);
            if(getItem.length) {
                this.savedItems.splice(this.savedItems.findIndex(i => i.id === itemData.id), 1);
            }
            this.savedItems.push(itemData);
            this.addNewItem();
        },
        resetData() {
            this.inwardEntries = [];
            this.date_of_inbound = '';
            this.import_invoice_number = '';
            this.container_number = '';
            this.boe_number = '';
            this.supplier = '';
            this.location = '';
            this.v$.$reset();
        },
        async submitInwardEntry() {
            const result = await this.v$.$validate();
            if(!result) {
                this.$swal({
                    title: 'Error',
                    text: "Required field can not be empty.",
                    customClass: 'swal-wide',
                });
                return ;
            }
            if (this.savedItems.length < this.inwardEntries.length) {
                this.removeNewItem();
            }
            if(result) {
                this.$axios.post('/api/save-inward-entry',{
                    date_of_inbound: this.$moment(this.date_of_inbound).format('DD-MM-YYYY'),
                    import_invoice_number: this.import_invoice_number,
                    container_number: this.container_number,
                    boe_number: this.boe_number,
                    supplier: this.supplier,
                    location: this.location,
                    items: this.savedItems,
                }).then(() => {
                    this.$swal('Inward entry added');
                    this.resetData();
                });
            }
        },
        setSupplier() {
            this.location = this.supplierList.find(i => i.name === this.supplier).country;
        }
    }
}

</script>

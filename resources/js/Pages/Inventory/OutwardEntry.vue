<template>
    <Head :title="'Outward Entry'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Outward Entry</h1>
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
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Dispatch Date/Time<span class="text-danger">*</span></label>
                                            <Datepicker
                                                :is24="false"
                                                format="dd-MM-yyyy hh:mm a"
                                                required
                                                :placeholder="'Dispatch Date/Time'"
                                                v-model="dispatch_date_time"
                                                :month-change-on-scroll="false"
                                                auto-apply
                                            ></Datepicker>
                                            <span v-if="v$.dispatch_date_time.$error" class="text-danger">Dispatch Date field required</span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Invoice Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="invoice_number" placeholder="Invoice Number">
                                            <span v-if="v$.invoice_number.$error" class="text-danger">Invoice Number field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Dealer Name<span class="text-danger">*</span></label>
                                            <select
                                                id="select-dealer"
                                                v-model="dealerSelected"
                                                class="form-control"
                                                name="select-dealer"
                                                placeholder="Select a dealer"
                                                @change="setDealer"
                                                >
                                                <option
                                                    v-for="(option,i) in dealerList"
                                                    :key="'dealer_'+i"
                                                    :value="option.name"
                                                >
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                            <span v-if="v$.dealerSelected.$error" class="text-danger">Dealer Name field required</span>
                                        </div>
                                         <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Ship to party<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="ship_to_party" placeholder="Ship to party">
                                             <span v-if="v$.ship_to_party.$error" class="text-danger">Dealer Name field required</span>
                                        </div>
                                         <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Bill to party<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="bill_to_party" placeholder="Bill to party">
                                            <span v-if="v$.bill_to_party.$error" class="text-danger">Bill to party field required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Vehicle Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="vehicle_number" placeholder="Vehicle Number">
                                            <span v-if="v$.vehicle_number.$error" class="text-danger">Vehicle Number field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Destination Code<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="destination_code" placeholder="Destination Code">
                                            <span v-if="v$.destination_code.$error" class="text-danger">Destination code field required</span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">LR Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required v-model="lr_number" placeholder="LR Number">
                                            <span v-if="v$.lr_number.$error" class="text-danger">LR Number field required</span>
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
                            <template :key="key" v-for="(each, key) in outwardEntries">
                                <outward-entry-items
                                    :item="each"
                                    :entries="outwardEntries"
                                    @item-added="itemAdded"
                                    @remove-item="removeNewItem(each.id)"
                                />
                            </template>
                             <div class="card-footer">
                                <div class="col-md-12 d-md-flex">
                                    <div class="col-12 col-md-12 mx-auto">
                                        <button class="btn btn-primary me-3 float-end" type="button" @click="addNewItem"> + Add Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 d-md-flex">
                        <div class="">
                            <button class="btn btn-primary pe-3" type="button" @click="submitOutwardEntry">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import OutwardEntryItems from './OutwardEntryItems.vue';
import { email, numeric, required, helpers } from '@vuelidate/validators';
import { useVuelidate } from '@vuelidate/core';
export default {
    components: {
        OutwardEntryItems,
    },
    props: ['dealerList'],
    setup() {
		return {v$: useVuelidate({ $scope: false })};
	},
    data() {
        return {
            outwardEntries: [],
            savedItems: [],
            dispatch_date_time: '',
            invoice_number: '',
            dealerSelected: '',
            ship_to_party: '',
            bill_to_party: '',
            vehicle_number: '',
            destination_code: '',
            lr_number: '',
        }
    },
    validations() {
        return {
            dispatch_date_time: { required },
            invoice_number: { required },
            dealerSelected: { required },
            ship_to_party: { required },
            bill_to_party: { required },
            vehicle_number: { required },
            destination_code: { required },
            lr_number: { required },
        };
	},
    methods: {
        addNewItem() {
            var increment =false;
             let array = this.outwardEntries.filter(node=>{
                 if(node.id ===this.outwardEntries.length) {
                        increment=true;
                        return this.outwardEntries;
                 }
                  return this.outwardEntries;

             });
            this.outwardEntries.push({
                id: increment ? array.length+1 : array.length,
            })
        },
        removeNewItem(id) {
            this.outwardEntries.splice(id, 1);
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
            this.outwardEntries = [];
            this.dispatch_date_time = '';
            this.invoice_number = '';
            this.dealerSelected = '';
            this.ship_to_party = '';
            this.bill_to_party = '';
            this.vehicle_number = '';
            this.destination_code = '';
            this.lr_number = '';
            this.v$.$reset();
        },
        async submitOutwardEntry() {
            const result = await this.v$.$validate();
            if(!result) {
                this.$swal({
                    title: 'Error',
                    text: "Required field can not be empty.",
                    customClass: 'swal-wide',
                });
                return;
            }
            if (this.savedItems.length < this.outwardEntries.length) {
                this.removeNewItem();
            }
            if(result) {
                this.$axios.post('/api/save-outward-entry',{
                    dispatch_date_time: this.$moment(this.dispatch_date_time).format('DD-MM-YYYY hh:mm a'),
                    invoice_number: this.invoice_number,
                    dealer_name: this.dealerSelected,
                    ship_to_party: this.ship_to_party,
                    bill_to_party: this.bill_to_party,
                    vehicle_number: this.vehicle_number,
                    destination_code: this.destination_code,
                    lr_number: this.lr_number,
                    items: this.savedItems,
                }).then(() => {
                    this.$swal('Outward entry added');
                    this.resetData();
                });
            }
        },
        setDealer() {
            this.ship_to_party = this.dealerList.find(i => i.name === this.dealerSelected).ship_to_party;
            this.bill_to_party = this.dealerList.find(i => i.name === this.dealerSelected).bill_to_party;
        }
    }
}

</script>

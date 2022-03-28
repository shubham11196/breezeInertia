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
                                            <label class="form-label">Dispatch Date/Time</label>
                                            <Datepicker
                                                :is24="false"
                                                format="dd-MM-yyyy hh:mm a"
                                                required
                                                :placeholder="'Dispatch Date/Time'"
                                                v-model="dispatch_date_time"
                                                :month-change-on-scroll="false"
                                                auto-apply
                                            ></Datepicker>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 pe-2">
                                            <label class="form-label">Invoice Number</label>
                                            <input type="text" class="form-control" required v-model="invoice_number" placeholder="Invoice Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Dealer Name</label>
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
                                        </div>
                                         <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Ship to party</label>
                                            <input type="text" class="form-control" required v-model="ship_to_party" placeholder="Ship to party">
                                        </div>
                                         <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Bill to party</label>
                                            <input type="text" class="form-control" required v-model="bill_to_party" placeholder="Bill to party">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-md-flex">
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Vehicle Number</label>
                                            <input type="text" class="form-control" required v-model="vehicle_number" placeholder="Vehicle Number">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">Destination Code</label>
                                            <input type="text" class="form-control" required v-model="destination_code" placeholder="Destination Code">
                                        </div>
                                        <div class="col-12 col-md-4 mb-2 pe-2">
                                            <label class="form-label">LR Number</label>
                                            <input type="text" class="form-control" required v-model="lr_number" placeholder="LR Number">
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
                                />
                            </template>
                             <div class="card-footer">
                                <div class="col-md-12 d-md-flex">
                                    <div class="col-12 col-md-12 mx-auto">
                                        <button class="btn btn-primary me-3 float-end" type="button" @click="addNewItem"> + Add Item</button>
                                        <button class="btn btn-danger me-3 float-end" type="button" v-if="outwardEntries.length" @click="removeNewItem">Remove Item</button>
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
import OutwardEntryItems from './OutwardEntryItems.vue';

export default {
    components: {
        OutwardEntryItems,
    },
    props: ['dealerList'],
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
            this.outwardEntries.push({
                id: this.outwardEntries.length,
            })
        },
        removeNewItem() {
            this.outwardEntries.pop()
        },
        itemAdded(itemData) {
            let getItem = this.savedItems.filter(i => i.id === itemData.id);
            if(getItem.length) {
                this.savedItems.splice(this.savedItems.findIndex(i => i.id === itemData.id), 1);
            }
            this.savedItems.push(itemData);
            this.addNewItem();
        },
        submitOutwardEntry() {
            if (this.savedItems.length < this.outwardEntries.length) {
                this.removeNewItem();
            }
            this.$inertia.post('/api/save-outward-entry', {
                dispatch_date_time: this.$moment(this.dispatch_date_time).format('DD-MM-YYYY hh:mm a'),
                invoice_number: this.invoice_number,
                dealer_name: this.dealerSelected,
                ship_to_party: this.ship_to_party,
                bill_to_party: this.bill_to_party,
                vehicle_number: this.vehicle_number,
                destination_code: this.destination_code,
                lr_number: this.lr_number,
                items: this.savedItems,
            })
        },
        setDealer() {
            this.ship_to_party = this.dealerList.find(i => i.name === this.dealerSelected).ship_to_party;
            this.bill_to_party = this.dealerList.find(i => i.name === this.dealerSelected).bill_to_party;
        }
    }
}

</script>

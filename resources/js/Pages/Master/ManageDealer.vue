<template>
    <Head :title="'Manage dealer'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Manage dealer</h1>
        </div>
 <div class="row">
                    <div class="col-md-4 col-12">
                        <div :class="['d-flex mt-2', uSearchBy ? '':'mb-2']">
                        <input
                          v-model="uSearchBy"
                          autocomplete="off"
                          placeholder="Search product by Name"
                          type="text"
                          class="form-control bg-white  border-radius-0"
                            @keyup.enter="getDealers"
                        >
                         <span
                          id="search"
                          role="button"
                          class="input-group-text border-radius-0 btn-primary"
                          @click="getDealers"
                        >Search
                        </span>
                       </div>
                        <button
                        v-if="uSearchBy"
                        class="ms-0 btn mt-0 pt-0  ps-0 btn-link mb-0"
                        @click="clearFitler"
                      >
                       Clear Filter
                      </button>
                    </div>
                    </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <vue-table-component
                        :key="refershKey"
                        :columns="Columns"
                        :rows="getdealerList"
                        :sort-by-api="false"
                      >
                     <template
                          #table-row="slotProps"
                        >
                          <span v-if="slotProps.column.field==='actions'">
                            <div class="d-flex">
                                
                               <button type="button" class="btn btn-primary me-2" @click="editdealer(slotProps.row)">
                                   <vue-feather type="edit-2"></vue-feather>
                                    </button>
                                    <button type="button" class="btn btn-danger" @click="deletedealer(slotProps.row)">
                                        <vue-feather type="trash-2"></vue-feather>
                                    </button>
                            </div>
                          </span>
                          <span v-else>{{ slotProps.row[slotProps.column.field] }}</span>
                        </template>
                 </vue-table-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueTableComponent from './table-component';
export default {
    components: {
    VueTableComponent
    },
    props:['dealers'],
    data() {
        return {
            getdealerList: [],
            uSearchBy: '',
            Columns:[
            {
                label: 'Name',
                field: 'name'
            },
            {
                label: 'Location',
                field: 'location'
            },
            {
                label: 'Ship to Party',
                field: 'ship_to_party',
            },
            {
                label: 'Bill to Party',
                field: 'bill_to_party',
            },
            {
                label: 'Address',
                field: 'address',
            },
            {
                label: 'City',
                field: 'city',
            },
            {
                label: 'State',
                field: 'state',
            },
              {
                label: 'Zipcode',
                field: 'zipcode',
            },
              {
                label: 'Phone',
                field: 'phone',
            },
              {
                label: 'Email',
                field: 'email',
            },
              {
                label: 'GST Details',
                field: 'gst_details',
            },
              {
                label: 'Actions',
                field: 'actions',
            },
			],
        }
    },
     mounted(){
        this.getDealers();
    },
    methods: {
       clearFitler() {
            this.uSearchBy='';
            this.getDealers();
        },
        getDealers() {
            this.$axios.get('/api/master/get-dealer-list?searchBy='+this.uSearchBy).then(resp => {
            this.getdealerList = resp.data.success.dealer;
        });
        },
        editdealer(each) {
            this.$inertia.get('/master/edit/dealer/' + each.id);
        },
        deletedealer(each) {
            this.$inertia.delete('/api/master/delete/dealer/' + each.id);
            this.getDealers();
        }
    }
}

</script>

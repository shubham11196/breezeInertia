<template>
    <Head :title="'Manage Supplier'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Manage Supplier</h1>
        </div>
                    <div class="row">
                    <div class="col-md-4 col-12">
                        <div :class="['d-flex mt-2', uSearchBy ? '':'mb-2']">
                        <input
                          v-model="uSearchBy"
                          autocomplete="off"
                          placeholder="Search product by name"
                          type="text"
                          class="form-control bg-white  border-radius-0"
                            @keyup.enter="getSuppliers"
                        >
                         <span
                          id="search"
                          role="button"
                          class="input-group-text border-radius-0 btn-primary"
                          @click="getSuppliers"
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
                        :rows="getSupplierList"
                        :sort-by-api="false"
                      >
                     <template
                          #table-row="slotProps"
                        >
                          <span v-if="slotProps.column.field==='actions'">
                            <div class="d-flex">
                                
                               <button type="button" class="btn btn-primary me-2" @click="editSupplier(slotProps.row)">
                                   <vue-feather type="edit-2"></vue-feather>
                                    </button>
                                    <button type="button" class="btn btn-danger" @click="deleteSupplier(slotProps.row)">
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
    data() {
        return {
            getSupplierList: [],
            uSearchBy:'',
            Columns:[
            {
                label: 'Name',
                field: 'name'
            },
            {
                label: 'Country',
                field: 'country'
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
                label: 'Actions',
                field: 'actions',
                sorting: false
            },
			],
        }
    },
     mounted(){
        this.getSuppliers();
    },
    methods: {
        clearFitler() {
            this.uSearchBy='';
            this.getSuppliers();
        },
        getSuppliers() {
            this.$axios.get('/api/master/get-supplier-list?searchBy='+this.uSearchBy).then(resp => {
            this.getSupplierList = resp.data.success.supplier;
        });
        },
        editSupplier(each) {
            this.$inertia.get('/master/edit/supplier/' + each.id);
        },
        deleteSupplier(each) {
            this.$inertia.delete('/api/master/delete/supplier/' + each.id);
            this.getSuppliers();
        }
    }
}

</script>
<style scoped>
.border-radius-0 {
    border-radius: 0 !important;
} 
</style>
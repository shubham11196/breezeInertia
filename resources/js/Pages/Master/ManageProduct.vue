<template>
    <Head :title="'Manage Product'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Manage Product</h1>
        </div>
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div :class="['d-flex mt-2', uSearchBy ? '':'mb-2']">
                        <input
                          v-model="uSearchBy"
                          autocomplete="off"
                          placeholder="Search product by SKU"
                          type="text"
                          class="form-control bg-white  border-radius-0"
                            @keyup.enter="getProduct"
                        >
                         <span
                          id="search"
                          role="button"
                          class="input-group-text border-radius-0 btn-primary"
                          @click="getProduct"
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
                        :columns="productColumns"
                        :rows="getProductList"
                        :sort-by-api="false"
                      >
                     <template
                          #table-row="slotProps"
                        >
                          <span v-if="slotProps.column.field==='actions'">
                            <div class="d-flex">
                                
                               <button type="button" class="btn btn-primary me-2" @click="editProduct(slotProps.row)">
                                   <vue-feather type="edit-2"></vue-feather>
                                    </button>
                                    <button type="button" class="btn btn-danger" @click="deleteProduct(slotProps.row)">
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
    props:['products'],
    data() {
        return {
            getProductList: [],
            uSearchBy:'',
            sortBy:'',
            sortType:'',
            productColumns:[
            {
                label: 'SKU',
                field: 'sku'
            },
            {
                label: 'Short Name',
                field: 'short_name',
                sorting: false
            },
            {
                label: 'Description	Model',
                field: 'description',
                sorting: false
            },
            {
                label: 'Description	Box',
                field: 'description_on_box',
                sorting: false
            },
            {
                label: 'Size',
                field: 'size',
                sorting: false
            },
            {
                label: 'Marine Code',
                field: 'marin_code',
                sorting: false
            },
              {
                label: 'Barcode Color',
                field: 'barcode_color',
                sorting: false
            },
              {
                label: 'Type',
                field: 'type',
                sorting: false
            },
              {
                label: 'Insera Code',
                field: 'insera_code',
                sorting: false
            },
              {
                label: 'Fork',
                field: 'fork',
                sorting: false
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
        this.getProduct()
    },
    methods: {
        clearFitler() {
            this.uSearchBy='';
            this.getProduct();
        },
        getProduct() {
            this.$axios.get('/api/master/get-product-list?searchBy='+this.uSearchBy).then(resp => {
            this.getProductList = resp.data.success.products;
        });
        },
        editProduct(each) {
            this.$inertia.get('/master/edit/product/' + each.id);
        },
        deleteProduct(each) {
            this.$inertia.delete('/api/master/delete/product/' + each.id);
            this.getProduct();
        }
    }
}

</script>
<style>
.border-radius-0 {
    border-radius: 0 !important;
} 
</style>

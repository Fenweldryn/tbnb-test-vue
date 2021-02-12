<template>
<div>
    <div class="pt-4 flex">
        <h1 class="text-3xl">
            Products
        </h1>
    </div>
    <div v-if="success !== false" class="text-green-600 bg-white shadow-md rounded-md p-5 mb-5 w-1/2 mt-2">
        <font-awesome-icon icon="check"/>        
        <span class='text-lg font-bold'>{{ success }}</span></i>
    </div>  
    <div v-if="error !== false" class="text-red-700 bg-white shadow-md rounded-md p-5 mb-5 w-1/2 mt-2">
        <font-awesome-icon icon="exclamation-triangle"/>        
        <span class='text-lg font-bold'>{{ error.data.message }}</span></i>
        <ul class='list-disc ml-5'>
            <li v-for="errorMessage in error.data.errors"> {{ errorMessage[0] }} </li>
        </ul>
    </div>  
    <div class='pt-4 flex'>
        <router-link
            :to="{ name: 'products.create' }"
            class="mr-2 w-1/6 col-span-1 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500">
            <font-awesome-icon icon="plus"/>
            <span class="inline-block mr-2">New Product</span>
        </router-link> 

        <button @click="bulkEdit()" v-show="!isBulkEdit"
            class="mr-2 w-1/6 col-span-1 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="pencil-alt"/>
            <span class="inline-block mr-2">Bulk Edit</span>
        </button> 

        <button @click="saveBulkEdit()" v-show="isBulkEdit"
            class="mr-2 w-1/6 col-span-1 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="save"/>
            <span class="inline-block mr-2">Bulk Save</span>
        </button> 
        <button @click="cancelBulkEdit()" v-show="isBulkEdit"
            class="mr-2 w-1/6 col-span-1 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="times"/>
            <span class="inline-block mr-2">Cancel</span>
        </button> 
    </div>
    <div class="py-4 flex justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Name</th>
                    <th class="text-left p-3 px-5">Price</th>
                    <th class="text-left p-3 px-5">Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id" class="border-b hover:bg-orange-100 bg-gray-100">
                    <td class="p-3 px-5" v-show="!isBulkEdit"> {{ product.name }} </td>
                    <td class="p-3 px-5" v-show="!isBulkEdit"> {{ product.price }} </td>
                    <td class="p-3 px-5" v-show="!isBulkEdit"> {{ product.quantity }} </td>

                    <td class="p-3 px-5 " v-show="isBulkEdit"><input type="text" v-model.lazy="product.name" @change="changeProperty(product)" class="p-3 w-full"></td>
                    <td class="p-3 px-5" v-show="isBulkEdit"><input type="text" v-model.lazy="product.price" @change="changeProperty(product)" class="p-3"></td>
                    <td class="p-3 px-5" v-show="isBulkEdit"><input type="text" v-model.lazy="product.quantity" @change="changeProperty(product)" class="p-3"></td>     

                    <td class="p-3 px-5 flex justify-end">
                        <router-link :to="{ name: 'products.show', params: {product: product.slug} }" type="button" class="mr-2 w-full transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-yellow-500 hover:bg-yellow-600 focus-yellow-700 focus:ring-yellow-500">
                            <font-awesome-icon icon="history"/>
                            History
                        </router-link>
                        <router-link :to="{ name: 'products.edit', params: {product: product.slug} }" type="button" class="mr-2 w-full transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500">
                            <font-awesome-icon icon="pencil-alt"/>
                            Edit
                        </router-link>
                        <button type="button" class="w-full transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block  bg-red-500 hover:bg-red-600 focus-red-700 focus:ring-red-500" @click="deleteProduct(product)">
                            <font-awesome-icon icon="trash"/>
                            Delete
                        </button>
                    </td>                        
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>

export default {

    data() {
        return {
            teste: 'batata',
            isLoading: false,
            products: [],
            changedProducts: [],
            error: false,
            success: false,
            isBulkEdit: false,
            beginWatching: false
        };
    },
    created() {        
        this.getProducts()
    },    
    methods: {
        getProducts() {
            axios.get('/api/products').then(response => {
                this.isLoading = false;
                this.products = response.data;            
            })
        },
        bulkEdit() {
            this.isBulkEdit = true;
            this.beginWatching = true;
        },
        cancelBulkEdit() {
            this.isBulkEdit = false;
        },
        saveBulkEdit() {
            axios.put('/api/products/bulk-update', { 'products' : this.products })
                .then(response => {this.success = response.data; this.isBulkEdit = false})
                .catch(error => this.error = error.response)
                .then(this.getProducts())
        },
        changeProperty(product) {
            this.success = false
            this.error = false
            this.changedProducts = this.changedProducts.filter(storedProduct => storedProduct.id !== product.id)
            this.changedProducts.push(product)
            console.log(this.changedProducts)
        },
        deleteProduct(productToDelete) {
            if (confirm('Are you sure you want to delete?')) {                
                axios.delete('/api/products/'+productToDelete.slug)
                    .then(response => {this.success = response.data; this.isBulkEdit = false})
                    .catch(error => this.error = error.response)
                    .then(this.products = this.products.filter(product => product.id !== productToDelete.id))
            }
        }
    }
}
</script>
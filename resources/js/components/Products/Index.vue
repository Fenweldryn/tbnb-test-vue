<template>
<div>
    <div class="pt-4 flex">
        <h1 class="text-3xl">
            Products
        </h1>
    </div>
    <div v-if="success !== false" class="text-green-600 bg-white shadow-md rounded-md p-5 mb-5 w-full mt-2">
        <font-awesome-icon icon="check"/>        
        <span class='text-lg font-bold'>{{ success }}</span></i>
    </div>  
    <div v-if="error !== false" class="text-red-700 bg-white shadow-md rounded-md p-5 mb-5 w-full mt-2">
        <font-awesome-icon icon="exclamation-triangle"/>        
        <span class='text-lg font-bold'>{{ error.data.message }}</span></i>       
    </div>  
    <div class='pt-4 flex space-x-3'>
        <router-link
            v-show="!isBulkEdit"
            :to="{ name: 'products.create' }"
            class="w-1/2 md:w-1/6 col-span-1 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500">
            <font-awesome-icon icon="plus"/>
            <span class="inline-block mr-2">New Product</span>
        </router-link> 

        <button 
            @click="bulkEdit()" 
            v-show="!isBulkEdit"
            class="w-1/2 md:w-1/6 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="pencil-alt"/>
            <span class="inline-block mr-2">Bulk Edit</span>
        </button> 

        <button 
            @click="seedProducts()" 
            v-show="!isBulkEdit"
            class="w-1/2 md:w-1/6 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-pink-500 hover:bg-pink-600 focus-pink-700 focus:ring-pink-500">
            <font-awesome-icon icon="pencil-alt"/>
            <span class="inline-block mr-2">Seed Products</span>
        </button> 

        <button 
            @click="saveBulkEdit()" 
            v-show="isBulkEdit"
            class="mr-2 w-1/2 md:w-1/6 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="save"/>
            <span class="inline-block mr-2">Bulk Save</span>
        </button> 
        <button @click="cancelBulkEdit()" v-show="isBulkEdit"
            class="mr-2 w-1/2 md:w-1/6 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-gray-500 hover:bg-gray-600 focus-gray-700 focus:ring-gray-500">
            <font-awesome-icon icon="times"/>
            <span class="inline-block mr-2">Cancel</span>
        </button> 
    </div>
    <div class="py-4 flex justify-center">
        <table class="w-full text-md bg-gray-200 md:bg-white md:shadow-md rounded mb-4 border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5 hidden lg:table-cell">Name</th>
                    <th class="text-left p-3 px-5 hidden lg:table-cell">Price</th>
                    <th class="text-left p-3 px-5 hidden lg:table-cell">Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>                
                <tr v-for="product in products" :key="product.id" class="flex border-b hover:bg-orange-100 bg-gray-200 md:bg-white  lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-5">
                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:text-left md:mt-3" v-show="!isBulkEdit"> 
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Name</span>
                        {{ product.name }} 
                    </td>
                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:text-left md:mt-3" v-show="!isBulkEdit"> 
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Price</span>
                        {{ product.price }} 
                    </td>
                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:text-left md:mt-3" v-show="!isBulkEdit"> 
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Quantity</span>
                        {{ product.quantity }} 
                    </td>

                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:text-left md:mt-3 " v-show="isBulkEdit">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Name</span>
                        <input type="text" v-model.lazy="product.name" @change="changeProperty(product)" class="p-3 w-full mt-4 border-2">                    
                    </td>
                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:text-left md:mt-3" v-show="isBulkEdit">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Price</span>
                        <input type="text" v-model.lazy="product.price" @change="changeProperty(product)" class="p-3 w-full mt-4 border-2">                    
                    </td>
                    <td class="p-3 px-5 w-full lg:w-auto lg:table-cell relative lg:static bg-white text-center md:mt-3" v-show="isBulkEdit">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Quantity</span>
                        <input type="text" v-model.lazy="product.quantity" @change="changeProperty(product)" class="p-3 w-full mt-4 border-2">                    
                    </td>     

                    <td class="p-3 px-5 w-full lg:w-1/3 lg:table-cell relative lg:static bg-white text-center md:mt-3 flex justify-end">
                        <router-link :to="{ name: 'products.show', params: {product: product.slug} }" type="button" class="mr-2 w-full md:w-auto md:px-4 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-yellow-500 hover:bg-yellow-600 focus-yellow-700 focus:ring-yellow-500">
                            <font-awesome-icon icon="history"/>
                            History
                        </router-link>
                        <router-link :to="{ name: 'products.edit', params: {product: product.slug} }" type="button" class="mr-2 w-full md:w-auto md:px-4 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500">
                            <font-awesome-icon icon="pencil-alt"/>
                            Edit
                        </router-link>
                        <button type="button" class="w-full md:w-auto md:px-4 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block  bg-red-500 hover:bg-red-600 focus-red-700 focus:ring-red-500" @click="deleteProduct(product)">
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
            this.isLoading = true;
            axios.get('/api/products').then(response => {
                this.isLoading = false;
                this.products = response.data;            
                console.log(this.products);
            }).catch(error => this.error = error.response)
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
                    .then(response => this.success = response.data)
                    .catch(error => this.error = error.response)
                    .then(this.products = this.products.filter(product => product.id !== productToDelete.id))
            }
        },
        seedProducts() {
            axios.get('/api/products/seed').then(response => {
                console.log(response.data);          
                success = "Database seeded successfully.";
                this.getProducts();
            }).catch(error => this.error = error.response)
        }
    }
}
</script>
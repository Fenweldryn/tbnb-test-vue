<template>
<div>
    <div class="p-4 pl-0 flex">
        <h1 class="text-3xl">
            Product History
        </h1>
    </div>

    <router-link :to="{ name: 'products' }" class="px-4 py-2 border border-transparent bg-transparent text-gray-500 hover:text-black font-bold rounded-md mr-3">
        <font-awesome-icon icon="arrow-left"/>
        Back
    </router-link>           
    
    <div class="flex space-x-4 mt-3">
        <div class="flex-grow border-r">    
            <div class="shadow-md rounded-md bg-white p-5 mb-5 sticky top-5">
                 
                <div class="">
                    <label>Name</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.name" disabled>
                </div>

                <div class=" mt-5">
                    <label>Price</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.price" disabled>
                </div>

                <div class=" mt-5">
                    <label>Quantity</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.quantity" disabled>
                </div>

            </div>                 
        </div>    

        <div class="flex-grow">        
            <h1 class="text-xl mb-3 ">
                History ({{ logsSize }})
            </h1>    
            <div v-if="logsSize > 0">
                <div v-for="log in logs" :key="log.id">
                    <div class="shadow-md rounded-md bg-white p-5 mb-5 w-full">    
                        <h1 class="text-xl font-bold">
                            {{ moment(log.created_at).format('MM/DD/YYYY H:mm:ss') }}
                        </h1>                 
                        <div class="mt-5">
                            <label>Name</label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="log.properties.attributes.name" disabled>
                        </div>

                        <div class="mt-5">
                            <label>Price</label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="log.properties.attributes.price" disabled>
                        </div>

                        <div class=" mt-5">
                            <label>Quantity</label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="log.properties.attributes.quantity" disabled>
                        </div>
                    </div>   
                    <div class="block w-full h-0"></div>                
                </div>                
            </div>
            <div v-else>
                <div class="w-full bg-white p-5 shadow-md rounded-lg">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        No records found.
                    </h3>
                    <router-link class="px-4 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500" :to="{ name: 'products.edit', params: {product: product.slug} }"> 
                        <font-awesome-icon icon="pencil-alt"/>
                        Make some changes
                    </router-link>
                </div>
            </div>
        </div>

    </div>
    
</div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                product: [],
                logs: []
            }
        },
        created() {     
            axios.get('/api/products/'+this.$route.params.product).then(response => {
                this.isLoading = false
                this.product = response.data.product
                this.logs = response.data.logs
            });
        },
        computed: {
            logsSize: function () {
                return this.logs.length;
            }
        },
        methods: {
            
        }
    }
</script>

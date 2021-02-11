<template>
<div>
    <div class="p-4 pl-0 flex">
        <h1 class="text-3xl">
            Product History
        </h1>
    </div>

    <router-link :to="{ name: 'products' }" class="px-4 py-2 border border-transparent bg-transparent text-gray-500 hover:text-black font-bold rounded-md mr-3">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left fa-w-14 mr-2"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path></svg> Back
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
                History
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
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">No records found.</h3>
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

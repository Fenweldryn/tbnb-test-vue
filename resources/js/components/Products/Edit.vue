<template>
<div>
    <div class="p-4 pl-0 flex">
        <h1 class="text-3xl">
            Edit Product
        </h1>
    </div>

    <form class='flex flex-wrap mx-5 md:mx-0' @submit.prevent="submit">        
            
        <div v-if="success !== false" class="text-green-600 bg-white shadow-md rounded-md p-5 mb-5 w-1/2">
            <font-awesome-icon icon="check"/>
            <span class='text-lg font-bold'>{{ success }}</span></i>
        </div>  
        <div v-if="error !== false" class="text-red-700 bg-white shadow-md rounded-md p-5 mb-5 w-1/2">
            <font-awesome-icon icon="exclamation-triangle"/>
            <span class='text-lg font-bold'>{{ error.data.message }}</span></i>
            <ul class='list-disc ml-5'>
                <li v-for="errorMessage in error.data.errors"> {{ errorMessage[0] }} </li>
            </ul>
        </div>  

        <div class="block w-full h-0"></div>

        <div class="my-1 shadow-md rounded-md bg-white p-5 mb-5 w-1/2">  
                
            <div class="">
                <label>Name</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.name" placeholder="">
            </div>

            <div class=" mt-5">
                <label>Price</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.price" placeholder="">
            </div>

            <div class=" mt-5">
                <label>Quantity</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" v-model="product.quantity" placeholder="">
            </div>
        </div>    
        <div class="block w-full h-0"></div>

        <div class="w-1/2 mt-5 text-right mb-5">   
            <router-link :to="{ name: 'products' }" class="px-4 py-2 border border-transparent bg-transparent text-gray-500 hover:text-black font-bold rounded-md mr-3">
                <font-awesome-icon icon="arrow-left"/>
                Back
            </router-link>          
           
            <button type="submit" 
                class="disabled:cursor-not-allowed px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-50 transition ease-in-out duration-150 ">
                    <font-awesome-icon icon="save"/>
                    Save Changes
            </button>  
        </div>
    </form>
</div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                numberOfForms: 1,
                product: [],
                success: false,
                error: false,
            }
        },
        created() {     
            axios.get('/api/products/'+this.$route.params.product+'/edit').then(response => {
                this.isLoading = false
                this.product = response.data
            });
        },
        methods: {
            submit() {
                this.success = false;
                this.error = false;
                axios.put('/api/products/'+this.product.slug, this.product)
                .then(response => this.success = response.data)
                .catch(error => this.error = error.response)
            },
        }
    }
</script>

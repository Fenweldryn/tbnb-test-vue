<template>
<div>
    <div class="p-4 pl-0 flex">
        <h1 class="text-3xl">
            New Product
        </h1>
    </div>

    <form class='flex flex-wrap mx-5 md:mx-0'>        
        <div v-for="item in numberOfForms" :key="item" class="my-1 w-1/2 shadow-md rounded-md bg-white p-5 mb-5">              
            <div class="">
                <label>Name</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" :v-model="products[item-1].name" placeholder="">
            </div>

            <div class=" mt-5">
                <label>Price</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" :v-model="products[item-1].price" placeholder="">
            </div>

            <div class=" mt-5">
                <label>Quantity</label>
                <input class="form-input rounded-md shadow-sm mt-1 block w-full p-3 border-2" type="text" :v-model="products[item-1].quantity" placeholder="">
            </div>
        </div>              
        <div class="block w-full h-0"></div>
        <div class="w-1/2 mt-5 text-right">   
            <router-link :to="{ name: 'products' }" class="px-4 py-2 border border-transparent bg-transparent text-gray-500 hover:text-black font-bold rounded-md mr-3">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left fa-w-14 mr-2"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path></svg> Back
            </router-link>           
            <button type="button" 
                class="mr-3 px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-plus fa-w-14 mr-2"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" class=""></path></svg> Add More
            </button>    
            <button type="submit" 
                class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-save fa-w-14 mr-2"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z" class=""></path></svg> Save
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
                products: [
                    {"name": "", "price": 0, "quantity": 0}
                ]
            }
        },
        methods: {
            submit() {
                axios.post('/api/products', this.products).then(response => {
                    this.$router.push({name: 'products'});                    
                }).catch(error => error);
            }
        }
    }
</script>

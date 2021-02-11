<template>
<div>
    <div class="p-4 pl-0 flex">
        <h1 class="text-3xl">
            Edit Product
        </h1>
    </div>

    <form class='flex flex-wrap mx-5 md:mx-0' @submit.prevent="submit">        
            
        <div v-if="success !== false" class="text-green-600 bg-white shadow-md rounded-md p-5 mb-5 w-1/2">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" class=""></path></svg> <span class='text-lg font-bold'>{{ success }}</span></i>
        </div>  
        <div v-if="error !== false" class="text-red-700 bg-white shadow-md rounded-md p-5 mb-5 w-1/2">
           <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-exclamation-triangle fa-w-18"><path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" class=""></path></svg> <span class='text-lg font-bold'>{{ error.data.message }}</span></i>
           <ul class='list-disc ml-5'>
               <li v-for="errorMessage in error.data.errors"> {{ errorMessage[0] }} </li>
           </ul>
        </div>  

        <div class="block w-full h-0"></div>

        <div class="my-1 shadow-md rounded-md bg-white p-5 mb-5 w-1/2">  
            
            <button v-if="index > 0" class='float-right mb-2' @click="removeProductForm(index)">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="svg-inline--fa fa-times fa-w-11"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" class=""></path></svg>    
            </button>          
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
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left fa-w-14 mr-2"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path></svg> Back
            </router-link>          
           
            <button type="submit" 
                class="disabled:cursor-not-allowed px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-50 transition ease-in-out duration-150 ">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-save fa-w-14 mr-2"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z" class=""></path></svg> Save Changes
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
                axios.put('/api/products/'+this.product.slug, this.product, {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => this.success = response.data)
                .catch(error => this.error = error.response)
            },
        }
    }
</script>

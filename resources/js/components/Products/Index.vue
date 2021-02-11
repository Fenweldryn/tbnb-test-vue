<template>
<div>
    <div class="p-4 flex">
        <h1 class="text-3xl">
            Products
        </h1>
    </div>
    <div class='p-4 pb-0 grid grid-cols-5'>
        <router-link
            :to="{ name: 'products.create' }"
            class="transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white w-full py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500"
        >
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-plus fa-w-14"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" class=""></path></svg>
            <span class="inline-block mr-2">New Product</span>
        </router-link>        
    </div>
    <div class="px-3 py-4 flex justify-center">
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
                    <td class="p-3 px-5"><input type="text" :value="product.name" class="bg-transparent p-3 w-full"></td>
                    <td class="p-3 px-5"><input type="text" :value="product.price" class="bg-transparent p-3"></td>
                    <td class="p-3 px-5"><input type="text" :value="product.quantity" class="bg-transparent p-3"></td>                        
                    <td class="p-3 px-5 flex justify-end">
                        <btn type="button" color="blue" class="mr-2">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="save" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-save fa-w-14"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z" class=""></path></svg>
                            Save
                        </btn>
                        <btn type="button" color="red">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash fa-w-14"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z" class=""></path></svg>
                            Delete
                        </btn>
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
            error: null,
        };
    },
    created() {        
        axios.get('/api/products').then(response => {
            this.isLoading = false;
            this.products = response.data;
        });
    },
    methods: {

    }
}
</script>
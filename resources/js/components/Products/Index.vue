<template>
    <div>     
        <h1>Products</h1>
        <router-link :to="{ name: 'products.create'}" tag='button' type="button" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
            <span class="inline-block mr-2">New Product</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </router-link> 
        
        <div class="vld-parent" id='products'>
            <h4>Cadastrados</h4>
            <loading 
                :active.sync="isLoading" 
                :is-full-page="false"
                :z-index="123"
                :opacity="0"
            ></loading>
            <ul v-if="products"  >
                <li v-for="local in products" v-bind:key="local.id">
                    <router-link :to="{ path: 'products/edit' + local.id }" tag='p'>{{ local.nome }}</router-link>
                    <div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
            isLoading: false,
            condominio: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.condominios = null;
            this.isLoading = true;
            axios.get('/api/condominios').then(response => {
                this.isLoading = false;
                this.condominios = response.data;
            });
        }
    }
}
</script>
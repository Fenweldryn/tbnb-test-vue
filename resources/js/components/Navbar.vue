<template>
    <nav class="bg-white px-8 pt-2 shadow-md mb-5" v-if="this.$route.name !== 'index'">
        <div class="-mb-px flex">
            <router-link :to="{ name: 'index' }" tag='button' class="no-underline uppercase tracking-wide font-bold text-xs py-3 mr-8">
                Home
            </router-link> 
            <router-link :to="{ name: 'products' }" tag='button' class="no-underline uppercase tracking-wide font-bold text-xs py-3 mr-8">
                Products
            </router-link> 
                      
        </div>
    </nav>
</template>
<script>
export default {
   
}
</script>
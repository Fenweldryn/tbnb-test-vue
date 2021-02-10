<template>
    <div class="navbar">      
        <router-link :to="{ name: 'home' }" tag='span' class='home'><font-awesome-icon icon="home" size="lg"/> </router-link>        

        <router-link :to="{ name: 'search' }" tag='span' class='search'><font-awesome-icon icon="search" size="lg"/> </router-link>  

        <router-link :to="{ name: 'notifications' }" tag='span' class='notification'><font-awesome-icon icon="bell" size="lg"/> </router-link>    

        <router-link :to="{ name: 'user' }" tag='span' class='user'><font-awesome-icon icon="user" size="lg"/> </router-link>        
    </div>
</template>
<script>
export default {
    props: ["active"],

    mounted() {
        // console.log('navbar mounted.')
    }
}
</script>
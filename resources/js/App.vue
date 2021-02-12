<template>
    <div class='container'>
        <Navbar></Navbar>
        <div class="px-3 md:px-0">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        // console.log('App mounted.')
    }
}
</script>

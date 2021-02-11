<template>
    <button 
        :type="type" 
        class="transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white w-full py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block"
        :class="coloring"
    >
        <slot></slot>
    </button>
</template>
<script>
export default {
    props: {
        color: String,
        route: String,
        type: String
    },    
    computed: {
        coloring: function() {
            return 'bg-'+this.color+'-500 hover:bg-'+this.color+'-600 focus-'+this.color+'-700 focus:ring-'+this.color+'-500';
        }
    }
}
</script>
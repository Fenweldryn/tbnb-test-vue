<template>
    <div class="min-h-screen flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <h1 class="font-bold text-center text-2xl mb-5">TurnoverBnb Test</h1>  
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
            
            <form class="px-5 py-7" id='login' @submit.prevent="login" method='post'>
                <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                <router-link :to="{ name: 'products' }" type="button" class="transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white w-full py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500">>
                    <span class="inline-block mr-2">Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </router-link>
                
            </form>

            <div class="py-5">
                <div class="grid grid-cols-1 gap-1">
                <div class="text-center sm:text-right whitespace-nowrap">
                    <button class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                        <span class="inline-block ml-1">Register</span>
                    </button>
                </div>               
                </div>
            </div>
            </div>            
        </div>
        <v-dialog />
    </div>    
</template>
<script>

export default {
    mounted() {
        
    },
    data() {
        return {
            email: null,
            password: null,
        };
    },
    components: {
    },
    methods: {
        login: function () {
            axios.post('/api/auth/login', {"email":this.email, "password": this.password}).then(response => {                
                localStorage.setItem('access_token', response.data.access_token);
                this.$router.push({name: 'home'});                
            }).catch((error) => {                   
                let errorMessagesFormatted = '';
                var errorResponse = error.response.data
                console.log(error.response.status);
                for (var key in errorResponse) {
                    if (errorResponse.hasOwnProperty(key)) {
                        errorMessagesFormatted += errorResponse[key]+'<br>';                        
                        console.log(key);
                    }
                }
                if (error.response.status == 401) {
                    errorMessagesFormatted = 'Access denied.<br>Incorrect email or password.';
                }

                this.show(errorMessagesFormatted);
            });
        },
        show (message) {
            this.$modal.show('dialog', {
            title: 'Error!',
            text: message,
            buttons: [                
                {
                title: 'OK'
                }
            ]
            })
        },
        hide () {
            this.$modal.hide('hello-world');
        }
    }
}
</script>
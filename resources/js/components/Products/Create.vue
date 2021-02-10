<template>
    <div>
        <div class="header">
            <a @click="$router.go(-1)"><font-awesome-icon icon="chevron-left" class='back-button'/></a>            
            <h1>Novo Condominio</h1>
        </div>
        <form class="" @submit.prevent="submit">
        
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" v-model='condominio.nome' placeholder="" required>
            </div>

            <div class="form-group vertical">
                <label for="">CNPJ</label>
                <input type="text" v-model='condominio.cnpj' placeholder="" required>
            </div>

            <div class="form-group vertical">
                <label for="">Endereço</label>
                <textarea type="text" v-model='condominio.endereco' placeholder="" required/>
            </div>
            
            <button class="">Criar</button>

        </form>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                condominio: {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/condominios', this.condominio).then(response => {
                    this.$router.push({name: 'condominios'});                    
                }).catch(error => error);
            }
        }
    }
</script>

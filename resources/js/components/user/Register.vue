<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Usuario Nuevo</h4>
                </div>
                <div class="form-group">
                    <input v-model="user.name" placeholder="Nombre Usuario" />
                    <input v-model="user.email" placeholder="EMAIL" />
                    <input v-model="user.password" placeholder="password" type='password' minlength="8" required/>
                    <input v-model="user.c_password" placeholder="confirme password" type='password' minlength="8" required/>
                  
                    <button type="button" @click="saveUser(user)" class="btn btn-danger">Guardar</button>
                        
                
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"register",
    data(){
        return {
            user: {
                name: "",
                email: "",
                password: "",
                c_password: ""
            }
        }
    },
    mounted(){
        
    },
    methods:{
        saveUser(user){
            this.$store.commit('setUser', user);
            this.$store
            .dispatch("createUser", user)
            .then(response => {
                console.log("response save user:", response)
                // this.$router.push({ name: "/" });
            }).catch(error => {
                console.log("error save user:", error)
            });
        }
    },
    computed: {
        
    }
}
</script>
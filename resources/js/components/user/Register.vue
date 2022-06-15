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
                        
                    <p>{{message}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { resolve } from 'path'

export default {
    name:"register",
    data(){
        return {
            flag1: false,
            flag2: false,
            message: "",
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
        checkemail(email) {
            this.$store.dispatch("checkemail").then(response => {
                this.flag2 = response.data.data
            })
        },
        checkuser() {
            this.$store.dispatch("checkuser").then(response => {
                this.flag1 = response.data.data
            })
        },
        saveUser(user){
            this.$store.commit('setUser', user)
            if (this.user.name === '' || this.user.name === null || this.user.name.value === 0 ){
                this.message = "Ingrese un nombre de usuario"
            } else {
                this.checkuser()
                if (!this.flag1){ 
                    this.message = "Ya existe el nombre de usuario"
                } else { 
                    this.message = ""
                    if( this.user.email === '' || this.user.email === null || this.user.email.value === 0 && cname){
                        this.message = "Ingrese un email de usuario"
                    } else {
                        this.message = ""
                        this.checkemail()
                        if (!this.flag2){ 
                            this.message = "Ya existe el email de usuario"
                        } else {  
                            if (this.user.password === this.user.c_password ) {
                                this.$store
                                .dispatch("createUser")
                                .then(response => {
                                    console.log("response save user2:", typeof(response))
                                    if (typeof(response) === "undefined"){
                                        this.$router.push({ name: "register" })
                                    } else {
                                        this.$router.push({ name: "login" })
                                    }
                                }).catch(error => {
                                    console.log("error save user:", error)
                                });
                            } else {
                                this.message = "la clave de acceso no coincide"
                            }
                        }
                    }
                } 
            }
            
        
       
                        




        }
    },
    computed: {
        
    }
}
</script>
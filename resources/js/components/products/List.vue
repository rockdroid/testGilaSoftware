<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            
            <router-link :to='{name:"newProduct"}' class="btn btn-primary">Agregar Nuevo</router-link>
            
            <router-link :to='{name:"logout"}' class="btn btn-primary">Cerrar Sesion</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de Productos</h4>
                </div>
                <br></br>
                <br></br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>SKU</th>
                                    <th>Marca</th>
                                    <th>Costo</th>
                                    <th>Precio Publico</th>
                                    <th>Tamano</th>
                                    <th>Tipo</th>
                                    <th>Caracteristicas</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="products.length > 0">
                                <tr v-for="(products,key) in products" :key="key">
                                    <td>{{ products.id }}</td>
                                    <td>{{ products.name }}</td>
                                    <td>{{ products.sku }}</td>
                                    <td>{{ products.brand }}</td>
                                    <td>{{ products.cost }}</td>
                                    <td>{{ products.finalPrice }}</td>
                                    <td>{{ products.size }}</td>
                                    <td>{{ products.type.name }}</td>
                                    <td>{{ products.charactetistics[0].name }}</td>
                                    <td>
                                        <button type="button" @click="deleteProduct(products.id)" class="btn btn-danger">Borrar</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No products Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"products",
    data(){
        return {
            productId: null,
            productsList:[]
        }
    },
    mounted(){
        this.getproducts()
    },
    methods:{
        async getproducts(){
            this.$store.dispatch("getProducts")
        },
        deleteProduct(id){
            
            this.$store.commit('setProductId', id);
            this.$store
            .dispatch("deleteProduct")
            .then(response => {
            
            })
            .catch(error => {
            this.error = error.response.data;
            });
        },
    },
    computed: {
        products() {
            return this.$store.state.products
        }
    }
}
</script>
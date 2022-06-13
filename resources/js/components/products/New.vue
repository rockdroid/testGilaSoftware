<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Producto Nuevo</h4>
                </div>
                <div class="form-group">
                    <input v-model="product.name" placeholder="Nombre Producto" />
                    <input v-model="product.sku" placeholder="SKU" />
                    <input v-model="product.brand" placeholder="Marca" />
                    <input v-model="product.size" placeholder="Tamano" type='number'/>
                    <input v-model="product.cost" placeholder="Costo" type='number' precision="2"/>
                    <input v-model="finalPrice" placeholder="Precio Final" type='number' disabled precision="2"/>

                    <div>Tipo:</div>
                    <select v-model="product.product_type_id">
                    <option disabled value="">Please select one</option>
                            <option v-for="type in types" :value="type.id" v-text="type.name"> 
                                {{type.name}}
                            </option>
                    </select>

                    <div>Otra Caracteristica:</div>
                    <select v-model="product.product_characteristic_id">
                    <option disabled value="">Please select one</option>
                            <option v-for="char in chars" :value="char.id" v-text="char.name"> 
                                {{char.name}}
                            </option>
                    </select>

                  
                    <button type="button" @click="saveProduct(product)" class="btn btn-danger">Guardar</button>
                        
                
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"product",
    data(){
        return {
            product: {
                "name" : "",
                "sku" : "",
                "brand" : "",
                "cost" : 0.0,
                "finalPrice" : 0.0,
                "size" : "",
                "product_type_id" : null,
                "product_characteristic_id" : null,
            }
        }
    },
    mounted(){
        this.getTypes()
        this.getChars()
    },
    methods:{
       async getTypes(){
           this.$store.dispatch("getTypes")
       },
       async getChars(){
           this.$store.dispatch("getChars")
       },
       saveProduct(product){
           console.log("product: ", product)
           this.$store.commit('setProduct', product);
           this.$store
            .dispatch("saveProduct", product)
            .then(response => {
            this.$router.push({ name: "productList" });
            })
            .catch(error => {
            this.error = error.response.data;
            });
       }
    },
    computed: {
        finalPrice(){
            let type = this.product.product_type_id
            
            if (type == 1){
                return this.product.finalPrice = this.product.cost * 1.35
            } else if(type == 2){
                return this.product.finalPrice = this.product.cost * 1.40
            } else if (type == 3){
                return this.product.finalPrice = this.product.cost * 1.30
            }
        },
        types() {
            return this.$store.state.types
        },
        chars() {
            return this.$store.state.chars
        }
    }
}
</script>
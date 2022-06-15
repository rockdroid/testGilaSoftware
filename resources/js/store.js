import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    checkuser: null,
    checkemail: null,
    token: localStorage.getItem('access_token') || null,
    products: [],
    types: [],
    chars: [],
    productId: "",
    user: {
        "name": "",
        "email": "",
        "password": "",
        "c_password": ""
    },
    product: {
        "name" : "",
        "sku" : "",
        "brand" : "",
        "size" : 0,
        "cost" : 0.0,
        "finalPrice" : 0.0,
        "product_type_id" : null,
        "product_characteristic_id" : null,
    },
  },
  getters: {
    loggedIn(state) {
      return state.token !== null
    }
  },
  mutations: {
    setProductId(state, payload){
        state.productId = payload
    },
    setUser(state, payload){
        state.user = payload
    },
    setProduct(state, payload){
        state.product = payload
    },
    getProducts(state, response){
        state.products = response
    },
    retrieveToken(state, token) {
      state.token = token
    },
    destroyToken(state) {
      state.token = null
    },
    types(state, payload){
        state.types = payload
    },
    chars(state, payload){
        state.chars = payload
    },
    checkuser(state, payload){
      state.checkuser = payload
    },
    checkemail(state, payload){
      state.checkemail = payload
    }
  },
  actions: {
    createUser(context){
      return new Promise((resolve, reject) => {
        axios.post(
            'http://localhost:8000/api/admin/register', 
            context.state.user, 
            { "headers" : {
                "Content-Type" : "Application/json"
                }
            }
        ).then( response => {
            resolve(response)
        }).catch(function (error) {
            reject(error)
        })
      })
    },
    deleteProduct(context){
      return new Promise((resolve, reject) => {
        let token = context.state.token
        axios.post(
            'http://localhost:8000/api/pdd', 
            context.state.productId, 
            { "headers" : {
                'Authorization': 'Bearer ' + token,
                "Content-Type" : "Application/json"
                }
            }
        ).then( response => {
            context.dispatch('getProducts')
            resolve(response)
        }).catch(function (error) {
            reject(error)
        })
      })

    },
    saveProduct(context){
        let token = context.state.token
        axios.post(
            'http://localhost:8000/api/product', 
            context.state.product, 
            { "headers" : {
                'Authorization': 'Bearer ' + token,
                "Content-Type" : "Application/json"
                }
            }
        ).then( response => {
            console.log("response post add product: ", response)
        })
        
    },
    checkuser(context) {
      return new Promise((resolve, reject) => {
        axios.post(
          'http://localhost:8000/api/checkuser', 
          context.state.user, 
          { "headers" : {
              "Content-Type" : "Application/json"
              }
          }
        ).then(response => {
            context.commit('checkuser', response.data.data)
            resolve(response)
        })
      })
    },
    checkemail(context) {
      return new Promise((resolve, reject) => {
        axios.post(
          'http://localhost:8000/api/checkemail', 
          context.state.user, 
          { "headers" : {
              "Content-Type" : "Application/json"
              }
          }
        ).then(response => {
            context.commit('checkemail', response.data.data)
            resolve(response)
        })
      })
    },
    getChars(context) {
        const instance = axios.create({
        baseURL: 'http://localhost:8000/api/',
        timeout: 1000
        })
        instance.get('/chars')
        .then(response => {
            context.commit('chars', response.data.data)
            return context.state.chars
        })
    },
    getTypes(context) {
        const instance = axios.create({
        baseURL: 'http://localhost:8000/api/',
        timeout: 1000
        })
        instance.get('/types')
        .then(response => {
            context.commit('types', response.data.data)
            return context.state.types
        })
    },
    getProducts(context) {
        let token = context.state.token
        const instance = axios.create({
        baseURL: 'http://localhost:8000/api/',
        timeout: 1000,
        headers: {'Authorization': 'Bearer '+token}
        })
        instance.get('/products')
        .then(response => {
            context.commit('getProducts', response.data.data)
            return context.state.products
        })
    },
    retrieveToken(context, credentials) {
      return new Promise((resolve, reject) => {
        axios.post('/api/admin/login', {
          email: credentials.email,
          password: credentials.password,
        })
          .then(response => {
            const token = response.data.success.token
            localStorage.setItem('access_token', token)
            context.commit('retrieveToken', token)

            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })

    },
    destroyToken(context) {
      if (context.getters.loggedIn) {
        return new Promise((resolve, reject) => {
          axios.post('/api/logout', '', {
              headers: { Authorization: "Bearer " + context.state.token }
            })
            .then(response => {
              localStorage.removeItem('access_token')
              context.commit('destroyToken')
              resolve(response)
            })
            .catch(error => {
              localStorage.removeItem('access_token')
              context.commit('destroyToken')
              reject(error)
            })
        })

      }
    }
  }
})

export default store
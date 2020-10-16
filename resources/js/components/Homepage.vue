<template>
    <div class="container-fluid">
        <b-modal id="cart-modal" hide-footer>
            <template v-slot:modal-title>
               Cosul tau
            </template>
            <div class="d-block">
                <b-list-group>
                <b-list-group-item v-for="(product, index) in cart" :key="index" class="d-flex justify-content-between align-items-center">
                    {{ product.name }}
                    <b-badge variant="warning"  pill>{{ product.price }} {{ product.currency }}</b-badge>
                  </b-list-group-item>
                  <b-list-group-item class="d-flex justify-content-between align-items-center">
                   <strong>Total</strong>
                    <b-badge variant="primary" pill><strong>{{ sum }} RON</strong></b-badge>
                  </b-list-group-item>
                </b-list-group>
            </div>
            <b-button variant="success" class="mt-3" block>Comanda</b-button>
       </b-modal>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Alege Produse</h1>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" @click="$bvModal.show('cart-modal')">
                  Coș <span class="badge badge-light">{{cart.length}}</span>
                </button>
            </div>
             <div class="col-md-12">
               <table class="table table-bordered" >
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Denumire</th>
                      <th scope="col">Categorie</th>
                      <th scope="col">Producator</th>
                      <th scope="col">An</th>
                      <th scope="col">Capacitate</th>
                      <th scope="col">Tip</th>
                      <th scope="col">Pret</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr v-for="product in products" :key="product.id">
                          <th scope="col" class="text-center"><button type="button" class="btn btn-primary" v-on:click="selectProduct(product)">Selecteaza produs</button></th>
                          <th scope="col">{{product.name }}</th>
                          <th scope="col">{{product.category.category}}</th>
                          <th scope="col">{{product.provider.name}}</th>
                          <th scope="col">{{product.year}}</th>
                          <th scope="col">{{product.capacity}} ml</th>
                          <th scope="col">{{product.type}}</th>
                          <th scope="col">{{product.price}} {{product.currency}}</th>
                     </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import productsService from '../services/products'
    import providersService from '../services/providers'
    import categoriesService from '../services/categories'

    export default {
        data () {
            return {
                products: [], 
                cart:[],
                form: {
                    name: '',
                    product_provider_id: null,
                    product_category_id: null,
                    year: '',
                    type: '',
                    capacity: '',
                    price: '',
                    currency: 'RON',
                },
                providers: [],
                categories: []
            }
        },
        methods: {
            getAllProducts: function() {
                productsService.getAllProducts().then(response => (this.products = response.data))            
            },
            getAllCategories: function() {
                categoriesService.getAllCategories().then(response => (this.categories = response.data))            
            },
            getAllProviders: function() {
                providersService.getAllProviders().then(response => (this.providers = response.data))            
            },
            selectProduct: function (product) {
                this.cart.push(product)
            }
        },
        computed: {
            sum: function () {
                let s = 0
                this.cart.forEach(element => {
                    s += parseFloat(element.price)
                });
                return s
            }
        },
        mounted() {
            this.getAllProducts()
            this.getAllCategories()
            this.getAllProviders()
        }
    }
</script>

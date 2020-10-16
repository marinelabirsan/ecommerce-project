<template>
    <div class="container-fluid">
        <b-modal id="add-product-modal" hide-footer>
            <template v-slot:modal-title>
              Adauga produs nou
            </template>
            <div class="d-block">
                <b-form @submit.prevent="onSubmit">
                    <b-form-group label="Nume">
                        <b-form-input v-model="form.name" type="text" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Producator:">
                        <b-form-select v-model="form.product_provider_id">
                            <b-form-select-option v-for="provider in providers" :value="provider.id" :key="provider.id">{{ provider.name }}</b-form-select-option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Categorie">
                        <b-form-select v-model="form.product_category_id">
                            <b-form-select-option v-for="category in categories" :value="category.id" :key="category.id">{{ category.category }}</b-form-select-option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Capacitate">
                        <b-input-group>
                            <template v-slot:append>
                              <b-input-group-text><strong>ml</strong></b-input-group-text>
                            </template>
                            <b-form-input type="number" v-model="form.capacity" required></b-form-input>
                        </b-input-group>
                    </b-form-group>
                    <b-form-group label="Pret">
                        <b-input-group>
                            <template v-slot:append>
                              <b-input-group-text><strong>RON</strong></b-input-group-text>
                            </template>
                            <b-form-input type="number" v-model="form.price" required></b-form-input>
                        </b-input-group>
                    </b-form-group>
                      <b-form-group label="Tip">
                        <b-form-input v-model="form.type" type="text" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="An">
                        <b-form-input v-model="form.year" type="number" required></b-form-input>
                    </b-form-group>   
                     <b-button class="mt-3" type="submit" variant="primary" block >Save</b-button>
                </b-form>
            </div>
        </b-modal>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1> Products </h1>
            </div>
            <div class="col-md-6 text-right">
                <b-button variant="primary" @click="$bvModal.show('add-product-modal')">Adaugă produs nou</b-button>
            </div>
             <div class="col-md-12">
               <table class="table table-bordered" >
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Denumire</th>
                      <th scope="col">Categorie</th>
                      <th scope="col">Producator</th>
                      <th scope="col">An</th>
                      <th scope="col">Capacitate</th>
                      <th scope="col">Tip</th>
                      <th scope="col">Pret</th>
                      <th scope="col">Actiuni</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr v-for="product in products" :key="product.id">
                          <th scope="col">{{product.name }}</th>
                          <th scope="col">{{product.category.category}}</th>
                          <th scope="col">{{product.provider.name}}</th>
                          <th scope="col">{{product.year}}</th>
                          <th scope="col">{{product.capacity}} ml</th>
                          <th scope="col">{{product.type}}</th>
                          <th scope="col">{{product.price}} {{product.currency}}</th>
                          <th scope="col">
                              <button type="button" class="btn btn-danger" v-on:click="deleteProduct(product.id)">Sterge</button>
                          </th>
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
            addProduct: function(data) {
                productsService.addProduct(data).then(response => {
                    this.getAllProducts()
                    this.$bvModal.hide('add-product-modal')
                })            
            },
            deleteProduct: function(id) {
                console.log(id)
                productsService.deleteProduct(id).then(response => {
                    this.getAllProducts()
                })            
            },
            onSubmit: function () {
                this.addProduct(this.form)
            }
        },
        mounted() {
            this.getAllProducts()
            this.getAllCategories()
            this.getAllProviders()
        }
    }
</script>

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
                     <b-button class="mt-3" type="submit" variant="primary" block >Salveaza</b-button>
                </b-form>
            </div>
        </b-modal>
        <b-modal id="edit-product-modal" hide-footer>
            <template v-slot:modal-title>
              Editeaza produs
            </template>
            <div class="d-block">
                <b-form @submit.prevent="onEditSubmit">
                    <b-form-group label="Nume">
                        <b-form-input v-model="editForm.name" type="text" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Producator:">
                        <b-form-select v-model="editForm.product_provider_id">
                            <b-form-select-option v-for="provider in providers" :value="provider.id" :key="provider.id">{{ provider.name }}</b-form-select-option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Categorie">
                        <b-form-select v-model="editForm.product_category_id">
                            <b-form-select-option v-for="category in categories" :value="category.id" :key="category.id">{{ category.category }}</b-form-select-option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Capacitate">
                        <b-input-group>
                            <template v-slot:append>
                              <b-input-group-text><strong>ml</strong></b-input-group-text>
                            </template>
                            <b-form-input type="number" v-model="editForm.capacity" required></b-form-input>
                        </b-input-group>
                    </b-form-group>
                    <b-form-group label="Pret">
                        <b-input-group>
                            <template v-slot:append>
                              <b-input-group-text><strong>RON</strong></b-input-group-text>
                            </template>
                            <b-form-input type="number" v-model="editForm.price" required></b-form-input>
                        </b-input-group>
                    </b-form-group>
                      <b-form-group label="Tip">
                        <b-form-input v-model="editForm.type" type="text" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="An">
                        <b-form-input v-model="editForm.year" type="number" required></b-form-input>
                    </b-form-group>   
                     <b-button class="mt-3" type="submit" variant="primary" block >Savleaza</b-button>
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
                               <button type="button" class="btn btn-primary" v-on:click="openEditForm(product)">Actualizează</button>
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
                selectedProductId: null,
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
                editForm: {
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
                productsService.deleteProduct(id).then(response => {
                    this.getAllProducts()
                })            
            },
            updateProduct: function(id) {
                productsService.updateProduct(id, this.editForm).then(response => {
                    this.getAllProducts()
                    this.$bvModal.hide('edit-product-modal')
                })            
            },
            openEditForm: function (product) {
                this.selectedProductId = product.id
                this.editForm.name = product.name
                this.editForm.product_category_id = product.product_category_id
                this.editForm.product_provider_id = product.product_provider_id
                this.editForm.price = product.price
                this.editForm.year = product.year
                this.editForm.capacity = product.capacity
                this.editForm.type = product.type
                this.$bvModal.show('edit-product-modal')
            },
            onSubmit: function () {
                this.addProduct(this.form)
            },
            onEditSubmit: function () {
                this.updateProduct(this.selectedProductId)
            }
        },
        mounted() {
            this.getAllProducts()
            this.getAllCategories()
            this.getAllProviders()
        }
    }
</script>

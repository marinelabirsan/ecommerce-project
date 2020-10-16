import axios from 'axios'

const api = axios.create({
  baseURL: '/api/products'
})

function getAllProducts (data) {
  return api.get('/', data)
}

function addProduct(data) {
  return api.post('/', data)
}

function updateProduct (id, data) {
  return api.put(`/${id}`, data);
}

function deleteProduct (id) {
  return api.delete(`/${id}`);
}

export default {
  getAllProducts: (data) => getAllProducts(data),
  addProduct: (data) => addProduct(data),
  updateProduct: (id, data) => updateProduct(id, data),
  deleteProduct: (id) => deleteProduct(id),
}

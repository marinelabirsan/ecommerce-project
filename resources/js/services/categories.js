import axios from 'axios'

const api = axios.create({
  baseURL: '/api/categories'
})

function getAllCategories (data) {
  return api.get('/', data)
}

export default {
  getAllCategories: (data) => getAllCategories(data),
}
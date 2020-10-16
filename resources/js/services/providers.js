import axios from 'axios'

const api = axios.create({
  baseURL: '/api/providers'
})

function getAllProviders (data) {
  return api.get('/', data)
}

export default {
  getAllProviders: (data) => getAllProviders(data),
}

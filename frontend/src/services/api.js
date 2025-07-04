import axios from 'axios'

// Base URL Laravel API
const API_BASE_URL = 'http://127.0.0.1:8000/api'

// Create axios instance
const apiClient = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

// Request interceptor untuk menambahkan token
apiClient.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// Response interceptor untuk handle errors
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token expired atau invalid
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

// Auth API
export const authAPI = {
  async login(credentials) {
    const response = await apiClient.post('/login', credentials)
    return response.data
  },
  
  async register(userData) {
    const response = await apiClient.post('/register', userData)
    return response.data
  },
  
  async logout() {
    const response = await apiClient.post('/logout')
    return response.data
  }
}

// Pegawai API
export const pegawaiAPI = {
  async getAll() {
    const response = await apiClient.get('/pegawai')
    return response.data
  },
  
  async getById(id) {
    const response = await apiClient.get(`/pegawai/${id}`)
    return response.data
  },
  
  async create(pegawaiData) {
    const response = await apiClient.post('/pegawai', pegawaiData)
    return response.data
  },
  
  async update(id, pegawaiData) {
    const response = await apiClient.put(`/pegawai/${id}`, pegawaiData)
    return response.data
  },
  
  async delete(id) {
    const response = await apiClient.delete(`/pegawai/${id}`)
    return response.data
  }
}

export default apiClient

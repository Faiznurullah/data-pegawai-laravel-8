import { defineStore } from 'pinia'
import { authAPI } from '../services/api.js'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null,
    isAuthenticated: false
  }),
  
  getters: {
    isLoggedIn: (state) => !!state.token && !!state.user,
  },
  
  actions: {
    async login(credentials) {
      try {
        // Call Laravel API
        const response = await authAPI.login(credentials)
        
        this.user = response.data
        this.token = response['access-token']
        this.isAuthenticated = true
        
        // Simpan token ke localStorage
        localStorage.setItem('token', response['access-token'])
        localStorage.setItem('user', JSON.stringify(response.data))
        
        return { success: true, data: response }
      } catch (error) {
        console.error('Login error:', error)
        let errorMessage = 'Terjadi kesalahan saat login'
        
        if (error.response?.status === 401) {
          errorMessage = 'Email atau password salah'
        } else if (error.response?.data?.message) {
          errorMessage = error.response.data.message
        }
        
        return { success: false, error: errorMessage }
      }
    },
    
    async register(userData) {
      try {
        const response = await authAPI.register(userData)
        
        this.user = response.data
        this.token = response['access-token']
        this.isAuthenticated = true
        
        // Simpan token ke localStorage
        localStorage.setItem('token', response['access-token'])
        localStorage.setItem('user', JSON.stringify(response.data))
        
        return { success: true, data: response }
      } catch (error) {
        console.error('Register error:', error)
        let errorMessage = 'Terjadi kesalahan saat registrasi'
        
        if (error.response?.data?.errors) {
          // Laravel validation errors
          const errors = error.response.data.errors
          errorMessage = Object.values(errors).flat().join(', ')
        } else if (error.response?.data?.message) {
          errorMessage = error.response.data.message
        }
        
        return { success: false, error: errorMessage }
      }
    },
    
    async logout() {
      try {
        // Call Laravel API logout
        await authAPI.logout()
      } catch (error) {
        console.error('Logout error:', error)
      } finally {
        // Clear local state regardless of API call success
        this.user = null
        this.token = null
        this.isAuthenticated = false
        
        // Hapus dari localStorage
        localStorage.removeItem('token')
        localStorage.removeItem('user')
      }
    },
    
    checkAuth() {
      const token = localStorage.getItem('token')
      const user = localStorage.getItem('user')
      
      if (token && user) {
        this.token = token
        this.user = JSON.parse(user)
        this.isAuthenticated = true
        return true
      }
      return false
    }
  }
})
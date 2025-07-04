import { defineStore } from 'pinia'
import { pegawaiAPI } from '../services/api.js'

export const usePegawaiStore = defineStore('pegawai', {
  state: () => ({
    pegawaiList: [],
    currentPegawai: null,
    loading: false,
    error: null
  }),
  
  getters: {
    totalPegawai: (state) => state.pegawaiList.length,
    maleCount: (state) => state.pegawaiList.filter(p => p.gender === 'Laki-laki').length,
    femaleCount: (state) => state.pegawaiList.filter(p => p.gender === 'Perempuan').length,
  },
  
  actions: {
    async fetchPegawai() {
      this.loading = true
      this.error = null
      try {
        const response = await pegawaiAPI.getAll()
        this.pegawaiList = response.data
        return { success: true, data: response.data }
      } catch (error) {
        console.error('Fetch pegawai error:', error)
        this.error = 'Gagal mengambil data pegawai'
        return { success: false, error: this.error }
      } finally {
        this.loading = false
      }
    },
    
    async fetchPegawaiById(id) {
      this.loading = true
      this.error = null
      try {
        const response = await pegawaiAPI.getById(id)
        this.currentPegawai = response.data
        return { success: true, data: response.data }
      } catch (error) {
        console.error('Fetch pegawai by ID error:', error)
        this.error = 'Gagal mengambil data pegawai'
        return { success: false, error: this.error }
      } finally {
        this.loading = false
      }
    },
    
    async createPegawai(pegawaiData) {
      this.loading = true
      this.error = null
      try {
        const response = await pegawaiAPI.create(pegawaiData)
        this.pegawaiList.push(response.data)
        return { success: true, data: response.data, message: response.msg }
      } catch (error) {
        console.error('Create pegawai error:', error)
        let errorMessage = 'Gagal menambah data pegawai'
        
        if (error.response?.data?.errors) {
          const errors = error.response.data.errors
          errorMessage = Object.values(errors).flat().join(', ')
        }
        
        this.error = errorMessage
        return { success: false, error: errorMessage }
      } finally {
        this.loading = false
      }
    },
    
    async updatePegawai(id, pegawaiData) {
      this.loading = true
      this.error = null
      try {
        const response = await pegawaiAPI.update(id, pegawaiData)
        
        // Update dalam list
        const index = this.pegawaiList.findIndex(p => p.id === id)
        if (index !== -1) {
          this.pegawaiList[index] = response.data
        }
        
        return { success: true, data: response.data, message: response.msg }
      } catch (error) {
        console.error('Update pegawai error:', error)
        let errorMessage = 'Gagal mengupdate data pegawai'
        
        if (error.response?.data?.errors) {
          const errors = error.response.data.errors
          errorMessage = Object.values(errors).flat().join(', ')
        }
        
        this.error = errorMessage
        return { success: false, error: errorMessage }
      } finally {
        this.loading = false
      }
    },
    
    async deletePegawai(id) {
      this.loading = true
      this.error = null
      try {
        const response = await pegawaiAPI.delete(id)
        
        // Remove dari list
        this.pegawaiList = this.pegawaiList.filter(p => p.id !== id)
        
        return { success: true, message: response.msg }
      } catch (error) {
        console.error('Delete pegawai error:', error)
        this.error = 'Gagal menghapus data pegawai'
        return { success: false, error: this.error }
      } finally {
        this.loading = false
      }
    },
    
    clearError() {
      this.error = null
    }
  }
})

<template>
  <div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <i class="fas fa-users"></i> Data Pegawai
        </a>
        <div class="navbar-nav ms-auto">
          <span class="navbar-text me-3">
            <i class="fas fa-user"></i> Selamat datang, {{ user?.name }}!
          </span>
          <button @click="handleLogout" class="btn btn-outline-light btn-sm">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
      <!-- Dashboard Cards -->
      <div class="row mb-4">
        <div class="col-md-3">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5>Total Pegawai</h5>
                  <h2>{{ totalPegawai }}</h2>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-users fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-success text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5>Laki-laki</h5>
                  <h2>{{ maleCount }}</h2>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-male fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-info text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5>Perempuan</h5>
                  <h2>{{ femaleCount }}</h2>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-female fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-warning text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5>Online</h5>
                  <h6>{{ user?.email }}</h6>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-user-check fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Pegawai Table -->
      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header bg-white">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                  <i class="fas fa-table"></i> Aplikasi Pegawai
                </h5>
                <div>
                  <button @click="showAddModal = true" class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-plus"></i> Tambah Data
                  </button>
                  <button @click="downloadPdf" class="btn btn-danger text-white btn-sm">
                    <i class="fas fa-file-pdf"></i> Download PDF
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Loading -->
              <div v-if="loading && !pegawaiList.length" class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data pegawai...</p>
              </div>

              <!-- Error Alert -->
              <div v-if="error" class="alert alert-danger alert-dismissible" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ error }}
                <button @click="refreshData" class="btn btn-sm btn-outline-danger ms-2">
                  <i class="fas fa-sync"></i> Coba Lagi
                </button>
              </div>

              <!-- Success Alert -->
              <div v-if="successMessage" class="alert alert-success alert-dismissible" role="alert">
                <i class="fas fa-check-circle"></i> {{ successMessage }}
                <button @click="successMessage = ''" class="btn-close"></button>
              </div>

              <!-- Search and Filter -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="fas fa-search"></i>
                    </span>
                    <input 
                      type="text" 
                      class="form-control" 
                      placeholder="Cari berdasarkan nama atau alamat..."
                      v-model="searchTerm">
                  </div>
                </div>
                <div class="col-md-3">
                  <select class="form-select" v-model="filterGender">
                    <option value="">Semua Gender</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <button @click="refreshData" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-sync"></i> Refresh
                  </button>
                </div>
              </div>

              <!-- Table -->
              <div v-if="!loading || pegawaiList.length" class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th style="width: 80px;">No</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th style="width: 120px;">Gender</th>
                      <th style="width: 120px;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(pegawai, index) in filteredPegawai" :key="pegawai.id">
                      <td class="text-center">{{ index + 1 }}</td>
                      <td>
                        <strong>{{ pegawai.nama }}</strong>
                      </td>
                      <td>{{ pegawai.alamat }}</td>
                      <td class="text-center">
                        <span :class="pegawai.gender === 'Laki-laki' ? 'badge bg-primary' : 'badge bg-pink'">
                          <i :class="pegawai.gender === 'Laki-laki' ? 'fas fa-male' : 'fas fa-female'"></i>
                          {{ pegawai.gender }}
                        </span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <button @click="editPegawai(pegawai)" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button @click="deletePegawaiConfirm(pegawai)" class="btn btn-sm btn-danger" title="Hapus">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                
                <div v-if="filteredPegawai.length === 0 && !loading" class="text-center py-4">
                  <div class="text-muted">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <p>{{ searchTerm || filterGender ? 'Tidak ada data yang sesuai dengan filter' : 'Belum ada data pegawai' }}</p>
                    <button v-if="!searchTerm && !filterGender" @click="showAddModal = true" class="btn btn-primary">
                      <i class="fas fa-plus"></i> Tambah Pegawai Pertama
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add/Edit Modal -->
    <div v-if="showAddModal || showEditModal" class="modal d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <i :class="showEditModal ? 'fas fa-edit' : 'fas fa-plus'"></i>
              {{ showEditModal ? 'Edit' : 'Tambah' }} Pegawai
            </h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="savePegawai">
              <div class="mb-3">
                <label class="form-label">
                  <i class="fas fa-user"></i> Nama Lengkap
                </label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="formData.nama" 
                  placeholder="Masukkan nama lengkap"
                  required>
              </div>
              <div class="mb-3">
                <label class="form-label">
                  <i class="fas fa-map-marker-alt"></i> Alamat
                </label>
                <textarea 
                  class="form-control" 
                  v-model="formData.alamat" 
                  rows="3"
                  placeholder="Masukkan alamat lengkap"
                  required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">
                  <i class="fas fa-venus-mars"></i> Gender
                </label>
                <select class="form-select" v-model="formData.gender" required>
                  <option value="">Pilih Gender</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="closeModal">
                  <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                  <i v-else :class="showEditModal ? 'fas fa-save' : 'fas fa-plus'"></i>
                  {{ showEditModal ? 'Update' : 'Simpan' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="modal d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger">
              <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
            </h5>
            <button type="button" class="btn-close" @click="showDeleteModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data pegawai:</p>
            <div class="alert alert-warning">
              <strong>{{ deleteTarget?.nama }}</strong><br>
              <small>{{ deleteTarget?.alamat }}</small>
            </div>
            <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showDeleteModal = false">
              <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="btn btn-danger" @click="confirmDelete" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
              <i v-else class="fas fa-trash"></i>
              Hapus
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../stores/auth.js'
import { usePegawaiStore } from '../stores/pegawai.js'

export default {
  name: 'HomeView',
  data() {
    return {
      showAddModal: false,
      showEditModal: false,
      showDeleteModal: false,
      formData: {
        nama: '',
        alamat: '',
        gender: ''
      },
      editingId: null,
      deleteTarget: null,
      successMessage: '',
      searchTerm: '',
      filterGender: ''
    }
  },
  computed: {
    user() {
      const authStore = useAuthStore()
      return authStore.user
    },
    pegawaiList() {
      const pegawaiStore = usePegawaiStore()
      return pegawaiStore.pegawaiList || []
    },
    loading() {
      const pegawaiStore = usePegawaiStore()
      return pegawaiStore.loading
    },
    error() {
      const pegawaiStore = usePegawaiStore()
      return pegawaiStore.error
    },
    totalPegawai() {
      return this.pegawaiList.length
    },
    maleCount() {
      return this.pegawaiList.filter(p => p.gender === 'Laki-laki').length
    },
    femaleCount() {
      return this.pegawaiList.filter(p => p.gender === 'Perempuan').length
    },
    filteredPegawai() {
      let filtered = this.pegawaiList

      // Filter by search term
      if (this.searchTerm) {
        const search = this.searchTerm.toLowerCase()
        filtered = filtered.filter(p => 
          p.nama.toLowerCase().includes(search) || 
          p.alamat.toLowerCase().includes(search)
        )
      }

      // Filter by gender
      if (this.filterGender) {
        filtered = filtered.filter(p => p.gender === this.filterGender)
      }

      return filtered
    }
  },
  async mounted() {
    await this.loadPegawai()
  },
  methods: {
    async loadPegawai() {
      const pegawaiStore = usePegawaiStore()
      await pegawaiStore.fetchPegawai()
    },
    
    async refreshData() {
      const pegawaiStore = usePegawaiStore()
      pegawaiStore.clearError()
      this.successMessage = ''
      await this.loadPegawai()
    },
    
    editPegawai(pegawai) {
      this.formData = {
        nama: pegawai.nama,
        alamat: pegawai.alamat,
        gender: pegawai.gender
      }
      this.editingId = pegawai.id
      this.showEditModal = true
    },
    
    async savePegawai() {
      const pegawaiStore = usePegawaiStore()
      let result
      
      if (this.showEditModal) {
        result = await pegawaiStore.updatePegawai(this.editingId, this.formData)
      } else {
        result = await pegawaiStore.createPegawai(this.formData)
      }
      
      if (result.success) {
        this.closeModal()
        this.successMessage = result.message || 'Data berhasil disimpan'
        setTimeout(() => {
          this.successMessage = ''
        }, 5000)
      }
    },
    
    deletePegawaiConfirm(pegawai) {
      this.deleteTarget = pegawai
      this.showDeleteModal = true
    },
    
    async confirmDelete() {
      const pegawaiStore = usePegawaiStore()
      const result = await pegawaiStore.deletePegawai(this.deleteTarget.id)
      
      if (result.success) {
        this.showDeleteModal = false
        this.deleteTarget = null
        this.successMessage = result.message || 'Data berhasil dihapus'
        setTimeout(() => {
          this.successMessage = ''
        }, 5000)
      }
    },
    
    closeModal() {
      this.showAddModal = false
      this.showEditModal = false
      this.formData = {
        nama: '',
        alamat: '',
        gender: ''
      }
      this.editingId = null
    },
    
    downloadPdf() {
      // Implementasi download PDF
      alert('Fitur download PDF akan segera tersedia!')
    },
    
    async handleLogout() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
        const authStore = useAuthStore()
        await authStore.logout()
        this.$router.push('/login')
      }
    }
  }
}
</script>

<style scoped>
.bg-pink {
  background-color: #e91e63 !important;
}

.card {
  transition: transform 0.2s;
  border: none;
}

.card:hover {
  transform: translateY(-2px);
}

.table th {
  background-color: #343a40;
  color: white;
  border-color: #454d55;
}

.btn-group .btn {
  margin: 0 1px;
}

.navbar-brand {
  font-weight: bold;
}

.alert-dismissible .btn-close {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  padding: 1.25rem 1rem;
}

.modal {
  animation: fadeIn 0.3s;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
</style>

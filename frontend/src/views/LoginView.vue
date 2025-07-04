<template>
    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="row w-100 justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-4 mb-0">Login</h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Alert untuk error -->
                        <div v-if="errorMessage" class="alert alert-danger" role="alert">
                            {{ errorMessage }}
                        </div>
                        
                        <!-- Alert untuk success -->
                        <div v-if="successMessage" class="alert alert-success" role="alert">
                            {{ successMessage }}
                        </div>
                        
                        <form @submit.prevent="handleLogin" id="logForm">
                            <div class="mb-3">
                                <label class="form-label" for="inputEmailAddress">Email</label>
                                <input
                                    class="form-control"
                                    id="inputEmailAddress"
                                    name="email"
                                    type="email"
                                    v-model="loginForm.email"
                                    placeholder="Masukkan email"
                                    required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inputPassword">Password</label>
                                <input
                                    class="form-control"
                                    id="inputPassword"
                                    type="password"
                                    name="password"
                                    v-model="loginForm.password"
                                    placeholder="Masukkan Password"
                                    required/>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                
                            <div class="d-grid gap-2 mt-4 mb-0">
                                <button class="btn btn-primary btn-lg" type="submit" :disabled="isLoading">
                                    <span v-if="isLoading" class="spinner-border spinner-border-sm me-2"></span>
                                    {{ isLoading ? 'Loading...' : 'Login' }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3 bg-light">
                        <div class="small">
                            <a href="#" class="text-decoration-none">Lupa Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from '../stores/auth.js'

export default {
    name: 'LoginView',
    data() {
        return {
            loginForm: {
                email: '',
                password: ''
            },
            isLoading: false,
            errorMessage: '',
            successMessage: ''
        }
    },
    methods: {
        async handleLogin() {
            this.isLoading = true;
            this.errorMessage = '';
            this.successMessage = '';
            
            try {
                const authStore = useAuthStore();
                const result = await authStore.login(this.loginForm);
                
                if (result.success) {
                    this.successMessage = 'Login berhasil! Mengalihkan...';
                    
                    // Redirect ke halaman yang dituju atau home setelah delay kecil
                    setTimeout(() => {
                        const redirectPath = this.$route.query.redirect || '/home';
                        this.$router.push(redirectPath);
                    }, 1000);
                } else {
                    this.errorMessage = result.error || 'Login gagal! Periksa email dan password Anda.';
                }
                
            } catch (error) {
                console.error('Login error:', error);
                this.errorMessage = 'Terjadi kesalahan saat login. Pastikan server Laravel berjalan di http://localhost:8000';
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
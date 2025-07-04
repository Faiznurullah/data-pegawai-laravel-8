import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth.js'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue' 

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/login'
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { requiresGuest: true } // Hanya untuk user yang belum login
    }, 
    {
      path: '/home',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }  
    },
    {
      path: '/dashboard',
      redirect: '/home'
    },
 
  ],
})

// Navigation Guard (Middleware)
router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  
  // Check authentication status
  authStore.checkAuth()
  
  // Jika route memerlukan authentication
  if (to.meta.requiresAuth) {
    if (!authStore.isLoggedIn) {
      // Redirect ke login jika belum authenticated
      next({
        name: 'login',
        query: { redirect: to.fullPath } // Simpan tujuan awal
      })
    } else {
      next() // Lanjutkan ke route tujuan
    }
  }
  // Jika route hanya untuk guest (belum login)
  else if (to.meta.requiresGuest) {
    if (authStore.isLoggedIn) {
      // Redirect ke home jika sudah login
      next({ name: 'home' })
    } else {
      next()
    }
  }
  // Route public
  else {
    next()
  }
})

export default router
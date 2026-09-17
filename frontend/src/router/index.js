import { createRouter, createWebHistory } from 'vue-router'
import Beranda from '@/views/Beranda.vue'
import Profil from '@/views/Profil.vue'
import KompetensiKeahlian from '@/views/KompetensiKeahlian.vue'
import InformasiBerita from '@/views/InformasiBerita.vue'
import Kesiswaan from '@/views/Kesiswaan.vue'
import Kontak from '@/views/Kontak.vue'
import KantinGO from '@/views/KantinGO.vue'
const routes = [
  { path: '/', name: 'Beranda', component: Beranda },
  { path: '/profil', name: 'Profil', component: Profil },
  { path: '/kompetensi-keahlian', name: 'KompetensiKeahlian', component: KompetensiKeahlian },
  { path: '/informasi-berita', name: 'InformasiBerita', component: InformasiBerita },
  { path: '/kesiswaan', name: 'Kesiswaan', component: Kesiswaan },
  { path: '/kontak', name: 'Kontak', component: Kontak },
  { path: '/kantingo', name: 'KantinGO', component: KantinGO }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior() {
    return { top: 0 }
  }
})

export default router

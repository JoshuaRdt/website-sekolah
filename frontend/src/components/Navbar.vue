<template>
  <nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <router-link to="/" class="flex items-center space-x-3">
          <img
            src="https://digilib.smkn1ngawen.sch.id/images/default/logo.png"
            alt="Logo SMKN 1 Ngawen"
            class="h-12 w-12 object-contain"
            @error="logoError = true"
            v-if="!logoError"
          />
          <div v-if="logoError" class="w-12 h-12 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-white font-bold text-lg">S</span>
          </div>
          <div class="hidden sm:block">
            <span class="font-bold text-lg text-black block leading-tight">SMKN 1 NGAWEN</span>
          </div>
        </router-link>

        <!-- Desktop Menu dengan Icon -->
        <div class="hidden md:flex items-center">
          <router-link
            v-for="item in menuItems"
            :key="item.path"
            :to="item.path"
            class="nav-item"
            :class="{ 'active': $route.path === item.path }"
          >
            <img
              :src="item.icon"
              :alt="item.name"
              class="w-5 h-5 object-contain"
            />
            <span>{{ item.name }}</span>
          </router-link>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button @click="menuOpen = !menuOpen" class="text-gray-700 hover:text-blue-800 p-2">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu dengan Icon -->
      <div v-if="menuOpen" class="md:hidden pb-4 border-t border-gray-200">
        <router-link
          v-for="item in menuItems"
          :key="item.path"
          :to="item.path"
          class="block py-3 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-800 rounded-lg my-1 flex items-center gap-3"
          :class="{ 'bg-blue-50 text-blue-800': $route.path === item.path }"
          @click="menuOpen = false"
        >
          <img
            :src="item.icon"
            :alt="item.name"
            class="w-5 h-5 object-contain"
          />
          <span>{{ item.name }}</span>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'

const menuOpen = ref(false)
const logoError = ref(false)

const menuItems = [
  {
    name: 'Beranda',
    path: '/',
    icon: 'https://cdn-icons-png.flaticon.com/512/1946/1946436.png'
  },
  {
    name: 'Profil',
    path: '/profil',
    icon: 'https://cdn-icons-png.flaticon.com/128/3177/3177440.png'
  },
  {
    name: 'Kompetensi Keahlian',
    path: '/kompetensi-keahlian',
    icon: 'https://cdn-icons-png.flaticon.com/128/18224/18224866.png'
  },
  {
    name: 'Informasi & Berita',
    path: '/informasi-berita',
    icon: 'https://cdn-icons-png.flaticon.com/128/5395/5395579.png'
  },
  {
    name: 'Kesiswaan',
    path: '/kesiswaan',
    icon: 'https://cdn-icons-png.flaticon.com/128/7941/7941552.png'
  },
  {
    name: 'Kontak',
    path: '/kontak',
    icon: 'https://cdn-icons-png.flaticon.com/128/8656/8656040.png'
  },
  {
    name: 'KantinGO',
    path: '/kantingo',
    icon: 'https://cdn-icons-png.flaticon.com/128/5161/5161706.png'
  }
]
</script>

<style scoped>
.nav-item {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  margin: 0 0.25rem;
  color: #374151; /* Warna teks default (abu-abu gelap) */
  font-weight: 500;
  border-radius: 0.5rem;
  transition: all 0.3s;
  text-decoration: none;
  white-space: nowrap;
  position: relative;
}

/* Efek garis bawah animasi (Diubah jadi hitam/abu-abu gelap, bukan biru) */
.nav-item::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  bottom: 4px;
  left: 50%;
  background-color: #111827; /* Warna hitam pekat, ganti #1e40af */
  transition: all 0.3s ease-in-out;
  transform: translateX(-50%);
}

/* Garis muncul saat hover atau aktif */
.nav-item:hover::after,
.nav-item.active::after {
  width: 70%;
}

/* Hover tanpa background biru (Diubah jadi abu-abu sangat muda) */
.nav-item:hover {
  color: #111827; /* Teks jadi hitam pekat */
  background-color: #f3f4f6; /* Background abu-abu muda, ganti #eff6ff */
}

/* Icon tetap berwarna normal (tidak dipaksa jadi biru) */
.nav-item:hover img {
  filter: grayscale(0%) brightness(100%);
}

/* State Aktif */
.nav-item.active {
  color: #111827; /* Teks hitam pekat */
  background-color: #f3f4f6; /* Background abu-abu muda */
  font-weight: 600;
}

.nav-item.active img {
  filter: grayscale(0%) brightness(100%);
}
</style>

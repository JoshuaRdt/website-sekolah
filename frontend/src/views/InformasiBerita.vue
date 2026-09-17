<template>
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-800 mb-4">Informasi & Berita</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        <p class="text-xl text-gray-600 mt-4">Update terbaru dari SMKN 1 Ngawen</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="item in news" :key="item.id" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">

          <!-- BAGIAN GAMBAR (SUDAH DIPERBAIKI) -->
          <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden relative">
            <img
              :src="item.image"
              :alt="item.title"
              class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
              @error="handleImageError(item.id)"
              v-if="!imageErrors[item.id]"
            />

            <!-- Fallback jika gambar gagal dimuat -->
            <div v-if="imageErrors[item.id]" class="text-center p-4 absolute inset-0 flex flex-col items-center justify-center bg-blue-50">
              <div class="text-5xl mb-2">📰</div>
              <p class="text-blue-800 font-semibold">{{ item.category }}</p>
            </div>
          </div>
          <!-- AKHIR BAGIAN GAMBAR -->

          <div class="p-6">
            <div class="flex items-center justify-between mb-3">
              <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ item.category }}</span>
              <span class="text-gray-500 text-sm">{{ formatDate(item.date) }}</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ item.title }}</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">{{ item.excerpt }}</p>
            <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center">
              Baca Selengkapnya
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const news = computed(() => schoolStore.news)

// State untuk menangani error gambar
const imageErrors = ref({})

const handleImageError = (newsId) => {
  imageErrors.value[newsId] = true
  console.warn(`Gagal memuat gambar untuk berita ID: ${newsId}`)
}

const formatDate = (dateString) => {
  if (!dateString) return 'Tanggal tidak tersedia'
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  const date = new Date(dateString)

  // Cek jika tanggal tidak valid
  if (isNaN(date.getTime())) return 'Tanggal tidak valid'

  return date.toLocaleDateString('id-ID', options)
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

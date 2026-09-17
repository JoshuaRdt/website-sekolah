<template>
  <div>
    <!-- Hero Section dengan Slider -->
    <section class="relative h-[600px] overflow-hidden">
      <!-- Slides -->
      <div class="relative h-full">
        <div
          v-for="(slide, index) in slides"
          :key="index"
          class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
          :class="{ 'opacity-100 z-10': currentSlide === index, 'opacity-0 z-0': currentSlide !== index }"
        >
          <!-- Background Image -->
          <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            :style="{ backgroundImage: `url(${slide.image})` }"
          >
            <!-- Overlay -->
            <div class="absolute inset-0 bg-linear-to-r from-blue-900/90 to-blue-700/70"></div>
          </div>

          <!-- Content -->
          <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-2xl">
              <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                {{ slide.title }}
              </h1>
              <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                {{ slide.description }}
              </p>
              <div class="flex flex-wrap gap-4">
                <router-link
                  :to="slide.primaryButton.link"
                  class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition shadow-lg"
                >
                  {{ slide.primaryButton.text }}
                </router-link>
                <router-link
                  :to="slide.secondaryButton.link"
                  class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-800 transition"
                >
                  {{ slide.secondaryButton.text }}
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <button
        @click="prevSlide"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-lg shadow-lg transition-all duration-300 hover:scale-110"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>

      <button
        @click="nextSlide"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-lg shadow-lg transition-all duration-300 hover:scale-110"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      <!-- Dots Indicators -->
      <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex space-x-3">
        <button
          v-for="(slide, index) in slides"
          :key="index"
          @click="goToSlide(index)"
          class="w-3 h-3 rounded-full transition-all duration-300"
          :class="currentSlide === index ? 'bg-yellow-400 w-8' : 'bg-white/50 hover:bg-white'"
        ></button>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-center bg-white p-6 rounded-xl shadow-lg">
            <div class="text-4xl font-bold text-blue-800 mb-2">1000+</div>
            <div class="text-gray-600 font-medium">Siswa</div>
          </div>
          <div class="text-center bg-white p-6 rounded-xl shadow-lg">
            <div class="text-4xl font-bold text-blue-800 mb-2">60+</div>
            <div class="text-gray-600 font-medium">Guru</div>
          </div>
          <div class="text-center bg-white p-6 rounded-xl shadow-lg">
            <div class="text-4xl font-bold text-blue-800 mb-2">5</div>
            <div class="text-gray-600 font-medium">Kompetensi Keahlian</div>
          </div>
          <div class="text-center bg-white p-6 rounded-xl shadow-lg">
            <div class="text-4xl font-bold text-blue-800 mb-2">A</div>
            <div class="text-gray-600 font-medium">Akreditasi</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest News -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
          <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
          <p class="text-gray-600 mt-4">Update informasi dan kegiatan sekolah</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div v-for="item in latestNews" :key="item.id" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
            <div class="h-48 bg-linear-to-br from-blue-100 to-blue-200 flex items-center justify-center overflow-hidden">
              <img
                :src="item.image"
                :alt="item.title"
                class="w-full h-full object-cover"
                @error="handleNewsImageError(item.id)"
                v-if="!newsImageErrors[item.id]"
              />
              <div v-if="newsImageErrors[item.id]" class="text-center">
                <div class="text-5xl mb-2">📰</div>
                <p class="text-blue-800 font-semibold">{{ item.category }}</p>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center justify-between mb-3">
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ item.category }}</span>
                <span class="text-gray-500 text-sm">{{ formatDate(item.date) }}</span>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ item.title }}</h3>
              <p class="text-gray-600 mb-4">{{ item.excerpt }}</p>
              <router-link to="/informasi-berita" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center">
                Baca Selengkapnya →
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Competencies Preview -->
    <section class="py-16 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kompetensi Keahlian</h2>
          <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
          <p class="text-gray-600 mt-4">Program keahlian yang tersedia di SMKN 1 Ngawen</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
          <div v-for="comp in competencies" :key="comp.id" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
            <div class="h-40 bg-linear-to-br from-blue-100 to-blue-200 overflow-hidden">
              <img
                :src="comp.image"
                :alt="comp.name"
                class="w-full h-full object-cover"
                @error="handleCompImageError(comp.id)"
                v-if="!compImageErrors[comp.id]"
              />
              <div v-if="compImageErrors[comp.id]" class="h-full flex items-center justify-center">
                <div class="text-4xl">💻</div>
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-900 mb-2 text-center">{{ comp.name }}</h3>
              <p class="text-gray-600 text-sm text-center">{{ comp.description }}</p>
            </div>
          </div>
        </div>

        <div class="text-center mt-10">
          <router-link to="/kompetensi-keahlian" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg">
            Lihat Semua Kompetensi
          </router-link>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Bergabung Bersama Kami?</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
          Mari bergabung dan raih masa depan gemilang bersama SMKN 1 Ngawen
        </p>
        <div class="flex flex-wrap justify-center gap-4">
          <router-link to="/kontak" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition shadow-lg">
            Daftar Sekarang
          </router-link>
          <router-link to="/profil" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-900 transition">
            Tentang Sekolah
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const latestNews = computed(() => schoolStore.news.slice(0, 3))
const competencies = computed(() => schoolStore.competencies)

// Slider State
const currentSlide = ref(0)
let autoPlayInterval = null

// Daftar Slide - Ganti URL gambar di sini
const slides = ref([
  {
    image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2023/02/baner-depan.png',
    title: 'Selamat Datang di SMKN 1 NGAWEN',
    description: 'Mencetak generasi unggul, kompeten, dan berkarakter untuk menghadapi tantangan global',
    primaryButton: {
      text: 'Selengkapnya',
      link: '/profil'
    },
    secondaryButton: {
      text: 'Hubungi Kami',
      link: '/kontak'
    }
  },
  {
    image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2023/02/kepala-sekolah.png',
    title: 'Sekolah Berkarakter Integritas, Excellent dan Care',
    description: 'SMKN 1 Ngawen berusaha terus-menerus meningkatkan layanan pendidikan untuk menghasilkan lulusan yang mampu berprestasi, berkarya dan mandiri',
    primaryButton: {
      text: 'Profil Sekolah',
      link: '/profil'
    },
    secondaryButton: {
      text: 'Kompetensi',
      link: '/kompetensi-keahlian'
    }
  },
  {
    image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2023/02/page-depan-web.png',
    title: '5 Kompetensi Keahlian Unggulan',
    description: 'TKJ, TKR, TAB, Tata Busana, dan DPIB - Siap menghasilkan lulusan kompeten dan siap kerja',
    primaryButton: {
      text: 'Lihat Kompetensi',
      link: '/kompetensi-keahlian'
    },
    secondaryButton: {
      text: 'Daftar Sekarang',
      link: '/kontak'
    }
  },
  {
    image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2023/02/karir.png',
    title: 'Prestasi Gemilang Siswa-Siswi',
    description: 'Berbagai prestasi tingkat provinsi dan nasional telah diraih oleh siswa-siswi SMKN 1 Ngawen',
    primaryButton: {
      text: 'Lihat Prestasi',
      link: '/kesiswaan'
    },
    secondaryButton: {
      text: 'Berita',
      link: '/informasi-berita'
    }
  },
  {
    image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2024/08/WhatsApp-Image-2023-11-09-at-09.33.17-e1722820170948.jpeg',
    title: 'Fasilitas Modern dan Lengkap',
    description: 'Dilengkapi dengan fasilitas pembelajaran modern dan laboratorium yang representatif',
    primaryButton: {
      text: 'Tur Virtual',
      link: '/profil'
    },
    secondaryButton: {
      text: 'Hubungi Kami',
      link: '/kontak'
    }
  }
])

// Auto Play Slider
const startAutoPlay = () => {
  autoPlayInterval = setInterval(() => {
    nextSlide()
  }, 5000) // Ganti slide setiap 5 detik
}

const stopAutoPlay = () => {
  if (autoPlayInterval) {
    clearInterval(autoPlayInterval)
  }
}

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slides.value.length
}

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + slides.value.length) % slides.value.length
}

const goToSlide = (index) => {
  currentSlide.value = index
}

// Lifecycle Hooks
onMounted(() => {
  startAutoPlay()
})

onUnmounted(() => {
  stopAutoPlay()
})

// Image Error Handling
const newsImageErrors = ref({})
const compImageErrors = ref({})

const handleNewsImageError = (newsId) => {
  newsImageErrors.value[newsId] = true
}

const handleCompImageError = (compId) => {
  compImageErrors.value[compId] = true
}

const formatDate = (dateString) => {
  if (!dateString) return 'Tanggal tidak tersedia'
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  const date = new Date(dateString)
  if (isNaN(date.getTime())) return 'Tanggal tidak valid'
  return date.toLocaleDateString('id-ID', options)
}
</script>

<style scoped>
/* Smooth transitions */
.transition-opacity {
  transition-property: opacity;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

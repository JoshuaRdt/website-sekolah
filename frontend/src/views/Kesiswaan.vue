<template>
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-800 mb-4">Kesiswaan</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        <p class="text-xl text-gray-600 mt-4">Kegiatan dan organisasi siswa</p>
      </div>

      <!-- Banner LMS -->
      <div class="mb-12">
        <a
          href="https://lms.smkn1ngawen.sch.id/"
          target="_blank"
          rel="noopener noreferrer"
          class="block group"
        >
          <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-blue-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex flex-col md:flex-row items-center p-8 md:p-12">
              <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8">
                <div class="w-24 h-24 md:w-32 md:h-32 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                  <div class="text-center">
                    <div class="text-5xl md:text-6xl mb-1">🎓</div>
                    <div class="text-white text-xs font-bold">LMS</div>
                  </div>
                </div>
              </div>

              <div class="flex-1 text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">
                  Learning Management System
                </h2>
                <p class="text-blue-100 text-lg mb-4">
                  Akses materi pembelajaran, tugas, dan kelas online SMKN 1 Ngawen
                </p>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                  <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                    📚 Materi Pembelajaran
                  </span>
                  <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                    📝 Tugas & Kuis
                  </span>
                  <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                     Diskusi Online
                  </span>
                </div>
              </div>

              <div class="flex-shrink-0 mt-6 md:mt-0 md:ml-8">
                <div class="bg-white text-blue-700 px-6 py-3 rounded-xl font-bold shadow-lg group-hover:bg-yellow-400 group-hover:text-blue-900 transition-all duration-300 flex items-center">
                  <span class="mr-2">Buka LMS</span>
                  <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>

      <!-- Ekstrakurikuler dengan Gambar -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
          <span class="mr-2">🎯</span> Ekstrakurikuler
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
          <div
            v-for="(item, index) in extracurriculars"
            :key="index"
            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group"
          >
            <!-- Gambar Ekstrakurikuler -->
            <div class="h-32 bg-gradient-to-br from-blue-100 to-blue-200 overflow-hidden">
              <img
                :src="item.image"
                :alt="item.name"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                @error="handleEkskulImageError(index)"
                v-if="!ekskulImageErrors[index]"
              />
              <!-- Fallback jika gambar error -->
              <div
                v-if="ekskulImageErrors[index]"
                class="h-full flex items-center justify-center bg-blue-100"
              >
                <span class="text-4xl"></span>
              </div>
            </div>

            <!-- Nama Ekstrakurikuler -->
            <div class="p-4 text-center">
              <h3 class="font-semibold text-gray-900 text-sm">{{ item.name }}</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Prestasi Siswa -->
      <div class="mb-12">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
          <span class="mr-2">🏆</span> Prestasi Siswa
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 p-6 rounded-xl shadow-lg text-white">
            <div class="text-4xl font-bold mb-2">🥇</div>
            <h3 class="font-semibold mb-2">Juara 1</h3>
            <p class="text-sm opacity-90">Kejuaraan Pencak Silat Piala Bupati Sukoharjo Cup</p>
          </div>
          <div class="bg-gradient-to-br from-gray-400 to-gray-600 p-6 rounded-xl shadow-lg text-white">
            <div class="text-4xl font-bold mb-2">🥈</div>
            <h3 class="font-semibold mb-2">Juara 2</h3>
            <p class="text-sm opacity-90">Festival Lomba Seni Siswa Nasional (FLS2N) Tingkat Provinsi DIY Tahun 2026 - Bidang Fotografi</p>
          </div>
          <div class="bg-gradient-to-br from-orange-500 to-orange-700 p-6 rounded-xl shadow-lg text-white">
            <div class="text-4xl font-bold mb-2">🥉</div>
            <h3 class="font-semibold mb-2">Juara 3</h3>
            <p class="text-sm opacity-90">Lomba Kompetensi Siswa (LKS) Tingkat Nasional - Bidang Heavy Vehicle Technology</p>
          </div>
        </div>
      </div>

      <!-- Upload Gambar Prestasi -->
      <div class="mb-12">
        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
            <span class="mr-2">📸</span>
            Upload Gambar Anda Saat Lomba atau Mendapatkan Prestasi
          </h3>
          <p class="text-gray-600 mb-6">Bagikan momen pencapaian Anda bersama SMKN 1 Ngawen!</p>

          <div
            class="border-2 border-dashed border-blue-300 rounded-xl p-8 text-center hover:border-blue-500 transition cursor-pointer"
            @click="triggerFileInput"
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop"
            :class="{ 'border-blue-500 bg-blue-50': isDragging }"
          >
            <input
              ref="fileInput"
              type="file"
              accept="image/*"
              class="hidden"
              @change="handleFileSelect"
            />

            <div v-if="!uploadedImage" class="space-y-4">
              <div class="text-6xl">📤</div>
              <div>
                <p class="text-lg font-semibold text-gray-700 mb-2">Klik atau drag & drop gambar di sini</p>
                <p class="text-sm text-gray-500">Format: JPG, PNG, WebP (Max. 5MB)</p>
              </div>
              <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Pilih Gambar
              </button>
            </div>

            <div v-else class="space-y-4">
              <div class="relative inline-block">
                <img
                  :src="uploadedImage"
                  alt="Preview prestasi"
                  class="max-w-full h-64 object-contain rounded-lg shadow-md"
                />
                <button
                  @click.stop="removeImage"
                  class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition shadow-lg"
                  title="Hapus gambar"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <div class="flex justify-center gap-4">
                <button
                  @click.stop="triggerFileInput"
                  class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
                >
                  Ganti Gambar
                </button>
                <button
                  @click.stop="uploadImage"
                  class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition"
                >
                  Upload Prestasi
                </button>
              </div>
            </div>
          </div>

          <div class="mt-6 bg-blue-50 p-4 rounded-lg">
            <h4 class="font-semibold text-blue-800 mb-2"> Ketentuan Upload:</h4>
            <ul class="text-sm text-gray-700 space-y-1">
              <li>• Format gambar: JPG, PNG, atau WebP</li>
              <li>• Ukuran maksimal: 5MB</li>
              <li>• Gambar harus jelas dan relevan dengan prestasi/lomba</li>
              <li>• Sertakan nama dan keterangan prestasi</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Organisasi Siswa -->
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
          <span class="mr-2">🏛️</span> Organisasi Siswa
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="border-l-4 border-blue-600 pl-6 bg-blue-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2"></span> OSIS
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Organisasi Siswa Intra Sekolah</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Mewadahi aspirasi dan kreativitas siswa</li>
              <li>• Mengembangkan kepemimpinan dan organisasi</li>
              <li>• Menyelenggarakan kegiatan sekolah</li>
              <li>• Membina kerukunan antar siswa</li>
            </ul>
          </div>

          <div class="border-l-4 border-green-600 pl-6 bg-green-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2">📋</span> MPK
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Majelis Perwakilan Kelas</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Menampung aspirasi siswa dari setiap kelas</li>
              <li>• Mengawasi kinerja OSIS</li>
              <li>• Memberikan masukan dan evaluasi</li>
              <li>• Menjembatani komunikasi siswa-guru</li>
            </ul>
          </div>

          <div class="border-l-4 border-yellow-600 pl-6 bg-yellow-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2">⚜️</span> DA
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Dewan Ambalan (Pramuka)</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Melaksanakan kegiatan kepramukaan</li>
              <li>• Membina karakter dan kedisiplinan</li>
              <li>• Mengikuti lomba kepramukaan</li>
              <li>• Mengajarkan keterampilan survival</li>
            </ul>
          </div>

          <div class="border-l-4 border-red-600 pl-6 bg-red-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2">🚑</span> PMR
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Palang Merah Remaja</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Memberikan pertolongan pertama</li>
              <li>• Menjaga kesehatan di kegiatan sekolah</li>
              <li>• Melakukan aksi donor darah</li>
              <li>• Menyosialisasikan hidup sehat</li>
            </ul>
          </div>

          <div class="border-l-4 border-purple-600 pl-6 bg-purple-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2">🕌</span> ROHIS
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Rohani Islam</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Membina keimanan dan ketaqwaan</li>
              <li>• Mengadakan kajian keislaman</li>
              <li>• Memperingati hari besar Islam</li>
              <li>• Mengelola masjid sekolah</li>
            </ul>
          </div>

          <div class="border-l-4 border-indigo-600 pl-6 bg-indigo-50 p-4 rounded-r-lg">
            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
              <span class="mr-2">🚦</span> PKS
            </h3>
            <p class="text-gray-700 mb-2"><strong>Kepanjangan:</strong> Patroli Keamanan Sekolah</p>
            <p class="text-gray-700 mb-3"><strong>Tugas:</strong></p>
            <ul class="text-gray-700 space-y-1 text-sm">
              <li>• Menjaga ketertiban dan keamanan sekolah</li>
              <li>• Mengatur lalu lintas di area sekolah</li>
              <li>• Melakukan patroli lingkungan sekolah</li>
              <li>• Membina kedisiplinan siswa</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const extracurriculars = computed(() => schoolStore.extracurriculars)

// Track gambar ekstrakurikuler yang error
const ekskulImageErrors = ref({})

const handleEkskulImageError = (index) => {
  ekskulImageErrors.value[index] = true
  console.warn(`Gagal memuat gambar untuk: ${extracurriculars.value[index].name}`)
}

// Upload Image State
const fileInput = ref(null)
const uploadedImage = ref(null)
const selectedFile = ref(null)
const isDragging = ref(false)

const triggerFileInput = () => {
  fileInput.value?.click()
}

const handleFileSelect = (event) => {
  const file = event.target.files[0]
  if (file) {
    processFile(file)
  }
}

const handleDrop = (event) => {
  isDragging.value = false
  const file = event.dataTransfer.files[0]
  if (file && file.type.startsWith('image/')) {
    processFile(file)
  } else {
    alert('Mohon upload file gambar (JPG, PNG, WebP)')
  }
}

const processFile = (file) => {
  if (file.size > 5 * 1024 * 1024) {
    alert('Ukuran file terlalu besar! Maksimal 5MB')
    return
  }

  const validTypes = ['image/jpeg', 'image/png', 'image/webp']
  if (!validTypes.includes(file.type)) {
    alert('Format file tidak didukung! Gunakan JPG, PNG, atau WebP')
    return
  }

  selectedFile.value = file

  const reader = new FileReader()
  reader.onload = (e) => {
    uploadedImage.value = e.target.result
  }
  reader.readAsDataURL(file)
}

const removeImage = () => {
  uploadedImage.value = null
  selectedFile.value = null
  if (fileInput.value) {
    fileInput.value.value = ''
  }
}

const uploadImage = () => {
  if (!selectedFile.value) {
    alert('Pilih gambar terlebih dahulu!')
    return
  }

  alert('Terima kasih! Gambar prestasi Anda berhasil diupload dan akan ditinjau oleh admin.')
  removeImage()
}
</script>

<template>
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-800 mb-4">Kompetensi Keahlian</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        <p class="text-xl text-gray-600 mt-4">Program keahlian yang tersedia di SMKN 1 Ngawen</p>
      </div>

      <!-- Daftar Kompetensi -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <div v-for="comp in competencies" :key="comp.id" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
          <div class="h-64 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center overflow-hidden">
            <img
              :src="comp.image"
              :alt="comp.name"
              class="w-full h-full object-cover"
              @error="handleImageError(comp.id)"
              v-if="!imageErrors[comp.id]"
            />
            <div v-if="imageErrors[comp.id]" class="text-center">
              <div class="text-6xl mb-2"></div>
              <p class="text-blue-800 font-semibold">{{ comp.name }}</p>
            </div>
          </div>
          <div class="p-8">
            <h2 class="text-2xl font-bold text-blue-800 mb-3">{{ comp.name }}</h2>
            <p class="text-gray-700 mb-6">{{ comp.description }}</p>
            <div class="border-t pt-6">
              <h3 class="font-semibold text-gray-900 mb-3">Prospek Karir:</h3>
              <ul class="space-y-2">
                <li v-for="(career, index) in getCareers(comp.id)" :key="index" class="flex items-center text-gray-700">
                  <span class="text-green-600 mr-2">✓</span> {{ career }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Download Materi Section -->
      <div class="bg-white rounded-xl shadow-lg p-6 mb-12">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-blue-800 flex items-center">
            <span class="mr-2">📚</span> Download Materi Pembelajaran
          </h2>
          <div class="text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg">
            Total: <strong>{{ getTotalMateri() }}</strong> materi tersedia
          </div>
        </div>

        <!-- Tabs Jurusan -->
        <div class="mb-6">
          <div class="flex flex-wrap gap-2 border-b border-gray-200 overflow-x-auto">
            <button
              v-for="comp in competencies"
              :key="comp.id"
              @click="activeTab = comp.id; activeKelas = 'X'"
              class="px-4 py-2 font-medium text-sm rounded-t-lg transition-all whitespace-nowrap flex items-center gap-2"
              :class="activeTab === comp.id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
            >
              <span>{{ getShortName(comp.name) }}</span>
            </button>
          </div>
        </div>

        <!-- Content untuk setiap jurusan -->
        <div v-for="comp in competencies" :key="comp.id" v-show="activeTab === comp.id">
          <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4 mb-4">
            <h3 class="font-bold text-lg text-blue-800">{{ comp.name }}</h3>
            <p class="text-sm text-gray-600 mt-1">Pilih materi pembelajaran berdasarkan kelas</p>
          </div>

          <!-- Tabs Kelas (X, XI, XII) -->
          <div class="mb-6">
            <div class="flex gap-2">
              <button
                v-for="kelas in ['X', 'XI', 'XII']"
                :key="kelas"
                @click="activeKelas = kelas"
                class="px-6 py-2 font-semibold rounded-lg transition-all"
                :class="activeKelas === kelas
                  ? 'bg-blue-600 text-white shadow-lg'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
              >
                Kelas {{ kelas }}
                <span class="ml-1 text-xs opacity-75">
                  ({{ getMateriByKelas(comp.id, kelas).length }} materi)
                </span>
              </button>
            </div>
          </div>

          <!-- List Materi per Kelas -->
          <div class="space-y-3">
            <div
              v-for="(materi, idx) in getMateriByKelas(comp.id, activeKelas)"
              :key="idx"
              class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg hover:shadow-md transition-all hover:border-blue-300"
            >
              <div class="flex items-center flex-1 min-w-0 mr-4">
                <!-- Icon berdasarkan tipe file -->
                <div class="flex-shrink-0 mr-3">
                  <div
                    class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl"
                    :class="getFileIconClass(materi.type)"
                  >
                    {{ getFileIcon(materi.type) }}
                  </div>
                </div>

                <!-- Info Materi -->
                <div class="flex-1 min-w-0">
                  <h4 class="font-semibold text-gray-900 truncate">{{ materi.name }}</h4>
                  <div class="flex items-center gap-3 mt-1 text-xs text-gray-500 flex-wrap">
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                      Kelas {{ materi.kelas }}
                    </span>
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-medium">
                      {{ materi.semester }}
                    </span>
                    <span class="flex items-center">
                      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                      {{ materi.type.toUpperCase() }}
                    </span>
                    <span class="flex items-center">
                      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                      </svg>
                      {{ formatFileSize(materi.size) }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Tombol Download -->
              <div class="flex items-center gap-2 flex-shrink-0">
                <button
                  @click="downloadMateri(materi, comp.name)"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all flex items-center gap-2 shadow-sm hover:shadow-md"
                  :title="`Download ${materi.name}`"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                  <span class="hidden sm:inline">Download</span>
                </button>
              </div>
            </div>

            <!-- Empty State -->
            <div v-if="getMateriByKelas(comp.id, activeKelas).length === 0" class="text-center py-12 text-gray-500">
              <div class="text-6xl mb-4">📭</div>
              <p class="text-lg font-medium">Belum ada materi untuk Kelas {{ activeKelas }}</p>
              <p class="text-sm mt-2">Materi akan segera ditambahkan</p>
            </div>
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
const competencies = computed(() => schoolStore.competencies)

const imageErrors = ref({})
const activeTab = ref(1)
const activeKelas = ref('X')

// Data Materi: 2 materi per kelas (X, XI, XII) untuk setiap jurusan
const materiData = {
  1: { // TKJ - Teknik Komputer dan Jaringan
    name: 'Teknik Komputer dan Jaringan (TKJ)',
    materi: [
      // Kelas X
      { name: 'Dasar-Dasar Jaringan Komputer', kelas: 'X', semester: 'Ganjil', type: 'pdf', size: 2500000 },
      { name: 'Instalasi Sistem Operasi Windows & Linux', kelas: 'X', semester: 'Genap', type: 'pdf', size: 3200000 },
      // Kelas XI
      { name: 'Konfigurasi Router Cisco & Subnetting', kelas: 'XI', semester: 'Ganjil', type: 'pdf', size: 3800000 },
      { name: 'Administrasi Server Linux', kelas: 'XI', semester: 'Genap', type: 'pdf', size: 4100000 },
      // Kelas XII
      { name: 'Keamanan Jaringan & Firewall Configuration', kelas: 'XII', semester: 'Ganjil', type: 'pdf', size: 4500000 },
      { name: 'Troubleshooting & Network Management', kelas: 'XII', semester: 'Genap', type: 'pdf', size: 3900000 }
    ]
  },
  2: { // TKR - Teknik Kendaraan Ringan
    name: 'Teknik Kendaraan Ringan (TKR)',
    materi: [
      // Kelas X
      { name: 'Pengantar Otomotif & K3 Bengkel', kelas: 'X', semester: 'Ganjil', type: 'pdf', size: 2800000 },
      { name: 'Dasar-Dasar Mesin Kendaraan', kelas: 'X', semester: 'Genap', type: 'pdf', size: 3100000 },
      // Kelas XI
      { name: 'Sistem Bahan Bakar Injeksi (EFI)', kelas: 'XI', semester: 'Ganjil', type: 'pdf', size: 3500000 },
      { name: 'Sistem Rem & ABS pada Kendaraan', kelas: 'XI', semester: 'Genap', type: 'pdf', size: 3200000 },
      // Kelas XII
      { name: 'Overhaul Engine & Transmisi', kelas: 'XII', semester: 'Ganjil', type: 'pdf', size: 4200000 },
      { name: 'Diagnosa Kerusakan dengan Scanner', kelas: 'XII', semester: 'Genap', type: 'pdf', size: 3800000 }
    ]
  },
  3: { // TAB - Teknik Alat Berat
    name: 'Teknik Alat Berat (TAB)',
    materi: [
      // Kelas X
      { name: 'Pengenal Alat Berat & Komponen Utama', kelas: 'X', semester: 'Ganjil', type: 'pdf', size: 2600000 },
      { name: 'K3 Operasional Alat Berat', kelas: 'X', semester: 'Genap', type: 'pdf', size: 2200000 },
      // Kelas XI
      { name: 'Sistem Hidrolik pada Excavator', kelas: 'XI', semester: 'Ganjil', type: 'pdf', size: 3400000 },
      { name: 'Sistem Transmisi Wheel Loader', kelas: 'XI', semester: 'Genap', type: 'pdf', size: 3100000 },
      // Kelas XII
      { name: 'Maintenance & Service Bulldozer', kelas: 'XII', semester: 'Ganjil', type: 'pdf', size: 4000000 },
      { name: 'Troubleshooting Engine Heavy Equipment', kelas: 'XII', semester: 'Genap', type: 'pdf', size: 3700000 }
    ]
  },
  4: { // Tata Busana
    name: 'Tata Busana (TB)',
    materi: [
      // Kelas X
      { name: 'Dasar-Dasar Pola & Pengenalan Alat Jahit', kelas: 'X', semester: 'Ganjil', type: 'pdf', size: 2400000 },
      { name: 'Teknik Menjahit Dasar & Jenis Jahitan', kelas: 'X', semester: 'Genap', type: 'pdf', size: 2900000 },
      // Kelas XI
      { name: 'Pembuatan Pola Dasar Rok & Blus', kelas: 'XI', semester: 'Ganjil', type: 'pdf', size: 3200000 },
      { name: 'Fashion Illustration & Desain Mode', kelas: 'XI', semester: 'Genap', type: 'pdf', size: 3500000 },
      // Kelas XII
      { name: 'Teknik Draping & Pembuatan Gaun Pesta', kelas: 'XII', semester: 'Ganjil', type: 'pdf', size: 4100000 },
      { name: 'Produksi Busana & Quality Control', kelas: 'XII', semester: 'Genap', type: 'pdf', size: 3600000 }
    ]
  },
  5: { // DPIB
    name: 'Desain Pemodelan dan Informasi Bangunan (DPIB)',
    materi: [
      // Kelas X
      { name: 'Pengantar Gambar Teknik & AutoCAD 2D', kelas: 'X', semester: 'Ganjil', type: 'pdf', size: 2900000 },
      { name: 'Menggambar Denah & Tampak Rumah', kelas: 'X', semester: 'Genap', type: 'pdf', size: 3300000 },
      // Kelas XI
      { name: '3D Modeling dengan SketchUp', kelas: 'XI', semester: 'Ganjil', type: 'pdf', size: 4800000 },
      { name: 'Struktur Bangunan Beton Bertulang', kelas: 'XI', semester: 'Genap', type: 'pdf', size: 3700000 },
      // Kelas XII
      { name: 'BIM dengan Revit Architecture', kelas: 'XII', semester: 'Ganjil', type: 'pdf', size: 5100000 },
      { name: 'RAB (Rencana Anggaran Biaya) Bangunan', kelas: 'XII', semester: 'Genap', type: 'pdf', size: 2800000 }
    ]
  }
}

const handleImageError = (compId) => {
  imageErrors.value[compId] = true
}

const getShortName = (fullName) => {
  const shortNames = {
    'Teknik Komputer dan Jaringan (TKJ)': 'TKJ',
    'Teknik Kendaraan Ringan (TKR)': 'TKR',
    'Teknik Alat Berat (TAB)': 'TAB',
    'Tata Busana (TB)': 'Tata Busana',
    'Desain Pemodelan dan Informasi Bangunan (DPIB)': 'DPIB'
  }
  return shortNames[fullName] || fullName.split(' ')[0]
}

const getCareers = (compId) => {
  const careers = {
    1: ['Network Administrator', 'System Administrator', 'IT Support', 'Cyber Security Analyst', 'Cloud Engineer'],
    2: ['Mekanik Otomotif', 'Service Advisor', 'Quality Control', 'Technical Trainer', 'Wirausaha Bengkel'],
    3: ['Operator Alat Berat', 'Mekanik Alat Berat', 'Quality Control', 'Technical Trainer', 'Wirausaha'],
    4: ['Fashion Designer', 'Pattern Maker', 'Tailor', 'Quality Control', 'Wirausaha Fashion'],
    5: ['Drafter/Draftsman', 'BIM Modeler', 'Estimator/Quantity Surveyor', 'Surveyor Tanah', 'Supervisor Lapangan', 'Kontraktor/Wirausahawan Konstruksi']
  }
  return careers[compId] || []
}

const getMateriByKelas = (compId, kelas) => {
  if (!materiData[compId]) return []
  return materiData[compId].materi.filter(m => m.kelas === kelas)
}

const getTotalMateri = () => {
  return Object.values(materiData).reduce((total, data) => total + data.materi.length, 0)
}

const getFileIcon = (type) => {
  const icons = {
    pdf: '',
    doc: '📘',
    ppt: '📙',
    zip: '️',
    rar: '🗜️'
  }
  return icons[type] || '📄'
}

const getFileIconClass = (type) => {
  const classes = {
    pdf: 'bg-red-100',
    doc: 'bg-blue-100',
    ppt: 'bg-orange-100',
    zip: 'bg-yellow-100',
    rar: 'bg-yellow-100'
  }
  return classes[type] || 'bg-gray-100'
}

const downloadMateri = (materi, compName) => {
  const message = `📥 Download Materi\n\nNama: ${materi.name}\nJurusan: ${compName}\nKelas: ${materi.kelas} - ${materi.semester}\nUkuran: ${formatFileSize(materi.size)}\n\n(Dalam implementasi nyata, file akan didownload dari server)`
  alert(message)
}

const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i]
}
</script>

<style scoped>
.overflow-x-auto::-webkit-scrollbar {
  height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

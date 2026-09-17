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
              <div class="text-6xl mb-2">💻</div>
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

      <!-- Upload Materi Section -->
      <div class="bg-white rounded-xl shadow-lg p-6 mb-12">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
          <span class="mr-2"></span> Upload Materi Pembelajaran
        </h2>

        <!-- Tabs untuk setiap jurusan -->
        <div class="mb-6">
          <div class="flex flex-wrap gap-2 border-b border-gray-200 overflow-x-auto">
            <button
              v-for="comp in competencies"
              :key="comp.id"
              @click="activeTab = comp.id"
              class="px-4 py-2 font-medium text-sm rounded-t-lg transition-all whitespace-nowrap"
              :class="activeTab === comp.id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
            >
              {{ getShortName(comp.name) }}
            </button>
          </div>
        </div>

        <!-- Upload Form untuk setiap jurusan -->
        <div v-for="comp in competencies" :key="comp.id" v-show="activeTab === comp.id" class="p-4 bg-gray-50 rounded-lg">
          <h3 class="font-bold text-lg text-blue-800 mb-4">{{ comp.name }}</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Upload Area -->
            <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer"
                 @click="triggerFileInput(comp.id)"
                 @dragover.prevent="draggingComp = comp.id"
                 @dragleave.prevent="draggingComp = null"
                 @drop.prevent="handleDrop($event, comp.id)"
                 :class="{ 'border-blue-500 bg-blue-50': draggingComp === comp.id }">

              <input
                :ref="el => fileInputs[comp.id] = el"
                type="file"
                accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar"
                class="hidden"
                @change="handleFileSelect($event, comp.id)"
              />

              <div v-if="!uploadedFiles[comp.id]" class="space-y-2">
                <div class="text-4xl mb-2">📁</div>
                <p class="text-sm font-medium text-gray-700">Klik atau drag file ke sini</p>
                <p class="text-xs text-gray-500">PDF, DOC, PPT, ZIP, RAR (Max. 10MB)</p>
              </div>

              <div v-else class="space-y-2">
                <div class="text-4xl mb-2">📄</div>
                <p class="text-sm font-medium text-gray-700 truncate px-2">{{ uploadedFiles[comp.id].name }}</p>
                <p class="text-xs text-gray-500">{{ formatFileSize(uploadedFiles[comp.id].size) }}</p>
                <button
                  @click.stop="removeFile(comp.id)"
                  class="text-xs text-red-600 hover:text-red-800 underline font-medium"
                >
                  Hapus File
                </button>
              </div>
            </div>

            <!-- Upload Button & List -->
            <div class="flex flex-col space-y-3">
              <button
                @click="uploadMateri(comp.id)"
                :disabled="!uploadedFiles[comp.id]"
                class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed font-medium shadow-md"
              >
                <span v-if="!uploading[comp.id]">📤 Upload Materi</span>
                <span v-else>⏳ Mengupload...</span>
              </button>

              <!-- Info -->
              <div class="bg-blue-50 border border-blue-200 rounded p-3">
                <p class="text-xs text-blue-800">
                  <strong>💡 announcement:</strong> PDF, DOC, PPT, ZIP, RAR (Max. 10MB)
                </p>
              </div>

              <!-- List Materi yang Sudah Diupload -->
              <div v-if="materiList[comp.id] && materiList[comp.id].length > 0" class="mt-2">
                <h4 class="font-semibold text-sm text-gray-700 mb-2 flex items-center">
                  <span class="mr-2">📚</span> Materi Tersedia ({{ materiList[comp.id].length }}):
                </h4>
                <ul class="space-y-2 max-h-48 overflow-y-auto">
                  <li v-for="(materi, idx) in materiList[comp.id]" :key="idx"
                      class="flex items-center justify-between text-xs bg-white p-3 rounded border hover:shadow-md transition">
                    <div class="flex items-center flex-1 min-w-0 mr-2">
                      <span class="mr-2 text-lg">📄</span>
                      <span class="truncate font-medium text-gray-700">{{ materi.name }}</span>
                    </div>
                    <div class="flex items-center space-x-2 flex-shrink-0">
                      <span class="text-gray-500 text-xs">{{ formatFileSize(materi.size) }}</span>
                      <button @click="downloadMateri(materi, comp.id)"
                              class="text-blue-600 hover:text-blue-800 p-1 hover:bg-blue-50 rounded transition"
                              title="Download">
                        ⬇️
                      </button>
                      <button @click="deleteMateri(materi, comp.id)"
                              class="text-red-600 hover:text-red-800 p-1 hover:bg-red-50 rounded transition"
                              title="Hapus">
                        🗑️
                      </button>
                    </div>
                  </li>
                </ul>
              </div>

              <div v-else class="text-center py-4 text-gray-500 text-sm">
                Belum ada materi yang diupload
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const competencies = computed(() => schoolStore.competencies)

const imageErrors = ref({})
const activeTab = ref(1)
const draggingComp = ref(null)
const uploadedFiles = ref({})
const materiList = ref({})
const fileInputs = reactive({})
const uploading = ref({})

// Initialize materiList for each competency
competencies.value.forEach(comp => {
  if (!materiList.value[comp.id]) {
    materiList.value[comp.id] = []
  }
  if (!uploading.value[comp.id]) {
    uploading.value[comp.id] = false
  }
})

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

const handleImageError = (compId) => {
  imageErrors.value[compId] = true
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

const triggerFileInput = (compId) => {
  if (fileInputs[compId]) {
    fileInputs[compId].click()
  }
}

const handleFileSelect = (event, compId) => {
  const file = event.target.files[0]
  if (file) validateAndSetFile(file, compId)
}

const handleDrop = (event, compId) => {
  draggingComp.value = null
  const file = event.dataTransfer.files[0]
  if (file) validateAndSetFile(file, compId)
}

const validateAndSetFile = (file, compId) => {
  const maxSize = 10 * 1024 * 1024 // 10MB
  const validTypes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'application/zip',
    'application/x-rar-compressed'
  ]

  const validExtensions = ['.pdf', '.doc', '.docx', '.ppt', '.pptx', '.zip', '.rar']
  const fileExtension = '.' + file.name.split('.').pop().toLowerCase()

  if (file.size > maxSize) {
    alert('❌ Ukuran file terlalu besar! Maksimal 10MB')
    return
  }

  if (!validTypes.includes(file.type) && !validExtensions.includes(fileExtension)) {
    alert('❌ Format file tidak didukung!\nGunakan format: PDF, DOC, DOCX, PPT, PPTX, ZIP, atau RAR')
    return
  }

  uploadedFiles.value[compId] = file
}

const removeFile = (compId) => {
  uploadedFiles.value[compId] = null
  if (fileInputs[compId]) {
    fileInputs[compId].value = ''
  }
}

const uploadMateri = async (compId) => {
  if (!uploadedFiles.value[compId]) {
    alert(' Pilih file terlebih dahulu!')
    return
  }

  uploading.value[compId] = true

  // Simulate upload delay
  await new Promise(resolve => setTimeout(resolve, 1500))

  if (!materiList.value[compId]) {
    materiList.value[compId] = []
  }

  materiList.value[compId].push({
    name: uploadedFiles.value[compId].name,
    size: uploadedFiles.value[compId].size,
    uploadedAt: new Date().toISOString(),
    id: Date.now()
  })

  alert('✅ Materi berhasil diupload untuk ' + getShortName(competencies.value.find(c => c.id === compId).name))

  uploadedFiles.value[compId] = null
  uploading.value[compId] = false

  if (fileInputs[compId]) {
    fileInputs[compId].value = ''
  }
}

const downloadMateri = (materi, compId) => {
  // Simulate download
  alert(` Downloading: ${materi.name}\n\n(Dalam implementasi nyata, file akan didownload dari server)`)
}

const deleteMateri = (materi, compId) => {
  if (confirm(`🗑️ Yakin ingin menghapus materi "${materi.name}"?`)) {
    const index = materiList.value[compId].findIndex(m => m.id === materi.id)
    if (index > -1) {
      materiList.value[compId].splice(index, 1)
      alert('✅ Materi berhasil dihapus')
    }
  }
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
/* Smooth transitions */
.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

/* Custom scrollbar for materi list */
.max-h-48::-webkit-scrollbar {
  width: 6px;
}

.max-h-48::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.max-h-48::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 3px;
}

.max-h-48::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

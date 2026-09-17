<template>
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-800 mb-4">Hubungi Kami</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        <p class="text-xl text-gray-600 mt-4">Silakan hubungi kami untuk informasi lebih lanjut</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
          <div class="bg-white p-8 rounded-xl shadow-lg mb-8">
            <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
              <span class="mr-2"></span> Informasi Kontak
            </h2>
            <div class="space-y-6">
              <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">📍</span>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                  <p class="text-gray-700">{{ schoolInfo.address }}</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">📞</span>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                  <p class="text-gray-700">{{ schoolInfo.phone }}</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">✉️</span>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                  <p class="text-gray-700">{{ schoolInfo.email }}</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">🌐</span>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">Website</h3>
                  <p class="text-gray-700">{{ schoolInfo.website }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Google Maps Iframe -->
          <div class="bg-white p-2 rounded-xl shadow-lg overflow-hidden">
            <iframe
              src="https://www.google.com/maps?q=-7.8012437,110.6757556&hl=id&z=17&output=embed"
              width="100%"
              height="450"
              style="border:0; border-radius: 0.5rem;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Lokasi SMKN 1 Ngawen"
            ></iframe>
          </div>

          <!-- Tombol Buka di Google Maps -->
          <div class="mt-4">
            <a
              href="https://maps.app.goo.gl/MbFYueF3WoGbGKcZ8"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-md"
            >
              <span class="mr-2">🗺️</span>
              Buka di Google Maps
            </a>
          </div>
        </div>

        <!-- Form Kirim Pesan -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
            <span class="mr-2">✉️</span> Kirim Pesan
          </h2>
          <form @submit.prevent="submitForm" class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
              <input
                type="text"
                v-model="form.name"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Masukkan nama lengkap"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input
                type="email"
                v-model="form.email"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="email@example.com"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
              <input
                type="text"
                v-model="form.subject"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Subjek pesan"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
              <textarea
                v-model="form.message"
                required
                rows="5"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Tulis pesan Anda di sini..."
              ></textarea>
            </div>
            <button
              type="submit"
              class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg"
            >
              Kirim Pesan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const schoolInfo = schoolStore.schoolInfo

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: ''
})

const submitForm = () => {
  alert('Terima kasih! Pesan Anda telah terkirim.')
  form.name = ''
  form.email = ''
  form.subject = ''
  form.message = ''
}
</script>

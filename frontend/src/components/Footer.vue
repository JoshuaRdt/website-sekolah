<template>
  <footer class="bg-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- School Info -->
        <div>
          <h3 class="text-xl font-bold mb-4 flex items-center">
            <img
              src="https://digilib.smkn1ngawen.sch.id/images/default/logo.png"
              alt="Logo SMKN 1 Ngawen"
              class="h-10 w-10 object-contain mr-2"
              @error="logoError = true"
              v-if="!logoError"
            />
            <div v-if="logoError" class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-2 shrink-0">
              <span class="text-blue-900 font-bold text-sm">S</span>
            </div>
            SMKN 1 NGAWEN
          </h3>
          <div class="space-y-3 text-gray-300">
            <p class="flex items-start">
              <span class="mr-2 mt-1">📍</span>
              <span>{{ schoolInfo.address }}</span>
            </p>
            <p class="flex items-center">
              <span class="mr-2">📞</span>
              <span>{{ schoolInfo.phone }}</span>
            </p>
            <p class="flex items-center">
              <span class="mr-2">✉️</span>
              <span>{{ schoolInfo.email }}</span>
            </p>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
          <ul class="space-y-2">
            <li>
              <router-link to="/profil" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center">
                <span class="mr-2">→</span> Profil Sekolah
              </router-link>
            </li>
            <li>
              <router-link to="/kompetensi-keahlian" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center">
                <span class="mr-2">→</span> Kompetensi Keahlian
              </router-link>
            </li>
            <li>
              <router-link to="/informasi-berita" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center">
                <span class="mr-2">→</span> Berita Terbaru
              </router-link>
            </li>
            <li>
              <router-link to="/kontak" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center">
                <span class="mr-2">→</span> Hubungi Kami
              </router-link>
            </li>
          </ul>
        </div>

        <!-- Social Media dengan Icon Flaticon -->
        <div>
          <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
          <div class="flex flex-col space-y-3">

            <!-- Facebook -->
            <a
              href="https://www.facebook.com/smkn1ngawenofficial/about?locale=id_ID"
              target="_blank"
              rel="noopener noreferrer"
              class="bg-white-800 hover:bg-blue-700 px-4 py-2.5 rounded-lg transition-all duration-300 flex items-center w-fit group"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/733/733547.png"
                alt="Facebook"
                class="w-5 h-5 mr-2.5 object-contain group-hover:scale-110 transition-transform duration-300"
              />
              <span>Facebook</span>
            </a>

            <!-- Instagram -->
            <a
              href="https://www.instagram.com/smkn1ngawen.official/"
              target="_blank"
              rel="noopener noreferrer"
              class="bg-white-600 hover:bg-pink-500 px-4 py-2.5 rounded-lg transition-all duration-300 flex items-center w-fit group"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
                alt="Instagram"
                class="w-5 h-5 mr-2.5 object-contain group-hover:scale-110 transition-transform duration-300"
              />
              <span>Instagram</span>
            </a>

            <!-- YouTube -->
            <a
              href="https://www.youtube.com/channel/UCLOkc52enB4_l8-jeWYV6cw"
              target="_blank"
              rel="noopener noreferrer"
              class="bg-white-600 hover:bg-pink-500 px-4 py-2.5 rounded-lg transition-all duration-300 flex items-center w-fit group"
            >
              <img
                src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png"
                alt="YouTube"
                class="w-5 h-5 mr-2.5 object-contain group-hover:scale-110 transition-transform duration-300"
              />
              <span>YouTube</span>
            </a>

          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t border-blue-800 mt-8 pt-8 text-center">
        <p class="text-gray-300">
          &copy; {{ currentYear }} {{ schoolInfo.name }}. All rights reserved.
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const schoolInfo = schoolStore.schoolInfo
const currentYear = computed(() => new Date().getFullYear())
const logoError = ref(false)
</script>

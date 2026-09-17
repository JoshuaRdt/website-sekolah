<template>
  <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-800 mb-4">Profil Sekolah</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        <p class="text-xl text-gray-600 mt-4">Mengenal lebih dekat SMKN 1 Ngawen</p>
      </div>

      <!-- Visi & Misi -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
            <span class="mr-2">🎯</span> Visi
          </h2>
          <p class="text-gray-700 leading-relaxed">
            MENJADI SEKOLAH VOKASI YANG BERKARAKTER MULIA, BERINTEGRITAS, UNGGUL, DAN BERBUDAYA
          </p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
            <span class="mr-2">🚀</span> Misi
          </h2>
          <ul class="text-gray-700 space-y-2">
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">1.</span>
              Menyelenggarakan pendidikan yang berbasis penguatan nilai-nilai karakter mulia dan budaya luhur
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">2.</span>
              Melaksanakan proses pembelajaran dengan pendekatan Project Based Learning dan Production Based Learning
              melalui Teaching Factory dan kelas industri
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">3.</span>
              Menyediakan layanan pendidikan berwawasan wirausaha
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">4.</span>
              Melaksanakan kegiatan intra dan ekstra kurikuler untuk mengembangkan bakat, minat, dan kemampuan teknis
              siswa
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">5.</span>
              Meningkatkan mutu pendidik dan tenaga kependidikan melalui pelatihan kompetensi sehingga mampu menyajikan
              dan melayani proses pembelajaran secara professional
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">6.</span>
              Menjalin kemitraan dengan DUDIKA
            </li>
            <li class="flex items-start">
              <span class="text-blue-600 mr-2 font-bold">7.</span>
              Mengembangkan sarana prasarana sekolah sesuai dengan perkembangan industri dan IPTEK
            </li>
          </ul>
        </div>
      </div>

      <!-- Informasi Sekolah -->
      <div class="bg-white p-8 rounded-xl shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
          <span class="mr-2">📋</span> Informasi Sekolah
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <!-- Nama Sekolah dengan Logo -->
          <div class="flex items-start">
            <div
              class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 overflow-hidden">
              <img
                src="https://digilib.smkn1ngawen.sch.id/images/default/logo.png"
                alt="Logo SMKN 1 Ngawen" class="w-10 h-10 object-contain" @error="logoError = true" v-if="!logoError" />
              <!-- Fallback jika logo error -->
              <span v-if="logoError" class="text-2xl">🏫</span>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Nama Sekolah</h3>
              <p class="text-gray-700">{{ schoolInfo.name }}</p>
            </div>
          </div>

          <!-- Alamat -->
          <div class="flex items-start">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
              <span class="text-2xl">📍</span>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
              <p class="text-gray-700">{{ schoolInfo.address }}</p>
            </div>
          </div>

          <!-- Telepon -->
          <div class="flex items-start">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
              <span class="text-2xl">📞</span>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
              <p class="text-gray-700">{{ schoolInfo.phone }}</p>
            </div>
          </div>

          <!-- Email -->
          <div class="flex items-start">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
              <span class="text-2xl">✉️</span>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
              <p class="text-gray-700">{{ schoolInfo.email }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Sejarah Singkat -->
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
          <span class="mr-2">📖</span> Sejarah Singkat
        </h2>
        <p class="text-gray-700 leading-relaxed mb-4">
          SMK Negeri 1 Ngawen berdiri sejak tahun 2006 . Pada saat itu dipimpin oleh Bapak Basuki, S.Pd, M.Pd dengan
          masa jabatan Dari Tahun 2006 s.d Tahun 2018. Kemudian digantikan oleh Bapak Rakhmad Basuki, S.Pd dengan masa
          jabatan Dari Tahun 2019. Kepala Sekolah berikutnya adalah Ibu Supiningsih, S.Pd M.Pd dengan masa jabatan dari
          tahun 2020 s.d 2022. Sedangkan Pada Tahun ini yaitu tahun 2023 pucuk pimpinan kepala sekolah adalah Bapak Drs.
          Sriyono, M.Ds.
        </p>
        <p class="text-gray-700 leading-relaxed">
          SMK Negeri 1 Ngawen yang semula hanya terdiri dari 2 jurusan yaitu jurusan Teknik Kendaraan Ringan dan Tata
          Busana kemudian menambah lagi 3 jurusan yaitu Teknik Komputer dan Jaringan didirikan pada Tahun 2007, Teknik
          Alat Berat didirikan pada tahun 2013 dan Desain Pemodelan dan Informasi Bangunan didirikan pada tahun 2019.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useSchoolStore } from '@/stores/school'

const schoolStore = useSchoolStore()
const schoolInfo = schoolStore.schoolInfo
const logoError = ref(false)
</script>

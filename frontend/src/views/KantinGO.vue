<script setup>
import { computed, ref } from 'vue'

const search = ref('')
const kategoriAktif = ref('Semua')
const showCart = ref(false)
const selectedMenu = ref(null)

const kategori = [
  'Semua',
  'Makanan',
  'Minuman',
  'Snack',
  'Paket Hemat'
]

const menu = ref([
  {
    id: 1,
    nama: 'Soto Kantin',
    kategori: 'Makanan',
    harga: 4000,
    rating: 4.8,
    terjual: 124,
    gambar:
      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6EoVEfuiC0popmi5kR5T9Daci2eHROQcRvFjdUMkl-eHRnB7y0Nf9U8Q&s=10',
    deskripsi:
      'Soto khas dengan kuah yang lezat dan bahan-bahan segar.'
  },
  {
    id: 2,
    nama: 'Ayam Geprek',
    kategori: 'Makanan',
    harga: 13000,
    rating: 4.9,
    terjual: 156,
    gambar:
      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSarp1yB9_fSJ2Xcr4vgVQbDQnFzGC6IZrYugZcarIkvw&s=10',
    deskripsi:
      'Ayam crispy dengan sambal geprek yang gurih dan pedas, cocok untuk makan siang.'
  },
  {
    id: 3,
    nama: 'Mie Goreng Jawa',
    kategori: 'Makanan',
    harga: 10000,
    rating: 4.7,
    terjual: 98,
    gambar:
      'https://asset.kompas.com/crops/j_TbujltYD08I6UY35zeQHBs7FU=/28x12:996x657/1200x800/data/photo/2022/07/12/62ccdc61ccd88.jpg',
    deskripsi:
      'Mie goreng dengan cita rasa khas Jawa dilengkapi telur dan sayuran.'
  },
  {
    id: 4,
    nama: 'Es Teh Manis',
    kategori: 'Minuman',
    harga: 4000,
    rating: 4.8,
    terjual: 230,
    gambar:
      'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=900&q=80',
    deskripsi:
      'Es teh manis segar dengan rasa manis yang pas untuk menemani makanan.'
  },
  {
    id: 5,
    nama: 'Es Jeruk',
    kategori: 'Minuman',
    harga: 5000,
    rating: 4.7,
    terjual: 142,
    gambar:
      'https://images.unsplash.com/photo-1621263764928-df1444c5e859?auto=format&fit=crop&w=900&q=80',
    deskripsi:
      'Minuman jeruk segar dengan perpaduan rasa manis dan sedikit asam yang menyegarkan.'
  },
  {
    id: 6,
    nama: 'Kopi Susu',
    kategori: 'Minuman',
    harga: 8000,
    rating: 4.6,
    terjual: 76,
    gambar:
      'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=900&q=80',
    deskripsi:
      'Perpaduan kopi dan susu dengan rasa creamy untuk menemani waktu istirahat.'
  },
  {
    id: 7,
    nama: 'Roti Coklat',
    kategori: 'Snack',
    harga: 6000,
    rating: 4.7,
    terjual: 87,
    gambar:
      'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=900&q=80',
    deskripsi:
      'Roti lembut dengan isian coklat yang cocok sebagai camilan saat istirahat.'
  },
  {
    id: 8,
    nama: 'Kentang Goreng',
    kategori: 'Snack',
    harga: 8000,
    rating: 4.8,
    terjual: 112,
    gambar:
      'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&w=900&q=80',
    deskripsi:
      'Kentang goreng renyah dengan bumbu gurih dan cocok untuk berbagi dengan teman.'
  },
  {
    id: 9,
    nama: 'Paket Ayam + Es Teh',
    kategori: 'Paket Hemat',
    harga: 16000,
    rating: 4.9,
    terjual: 189,
    gambar:
      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa5jCVgIMPLg5ZGt3SjPWHYOWKAxEfiB7whvmoATILZg&s=10',
    deskripsi:
      'Paket hemat berisi nasi, ayam crispy, sambal, dan es teh manis.'
  },
  {
    id: 10,
    nama: 'Paket Mie + Es Teh',
    kategori: 'Paket Hemat',
    harga: 13000,
    rating: 4.8,
    terjual: 134,
    gambar:
      'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/c716d3c2-4cdf-4831-8fed-bf8450cfd3f1_Go-Biz_20241009_143514.jpeg',
    deskripsi:
      'Paket praktis berisi mie goreng dan es teh manis dengan harga hemat.'
  }
])

const keranjang = ref([])

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0
  }).format(angka)
}

const menuFiltered = computed(() => {
  return menu.value.filter((item) => {
    const cocokKategori =
      kategoriAktif.value === 'Semua' ||
      item.kategori === kategoriAktif.value

    const cocokSearch = item.nama
      .toLowerCase()
      .includes(search.value.toLowerCase())

    return cocokKategori && cocokSearch
  })
})

const jumlahKeranjang = computed(() => {
  return keranjang.value.reduce(
    (total, item) => total + item.jumlah,
    0
  )
})

const totalHarga = computed(() => {
  return keranjang.value.reduce(
    (total, item) => total + item.harga * item.jumlah,
    0
  )
})

const tambahKeranjang = (item) => {
  const sudahAda = keranjang.value.find(
    (produk) => produk.id === item.id
  )

  if (sudahAda) {
    sudahAda.jumlah++
  } else {
    keranjang.value.push({
      ...item,
      jumlah: 1
    })
  }
}

const tambahJumlah = (item) => {
  item.jumlah++
}

const kurangiJumlah = (item) => {
  if (item.jumlah > 1) {
    item.jumlah--
  } else {
    hapusKeranjang(item.id)
  }
}

const hapusKeranjang = (id) => {
  keranjang.value = keranjang.value.filter(
    (item) => item.id !== id
  )
}

const bukaDetail = (item) => {
  selectedMenu.value = item
}

const checkout = () => {
  if (keranjang.value.length === 0) {
    alert('Keranjang masih kosong.')
    return
  }

  alert(
    `Pesanan berhasil dibuat!\nTotal: ${formatRupiah(
      totalHarga.value
    )}`
  )

  keranjang.value = []
  showCart.value = false
}
</script>

<template>
  <main class="min-h-screen bg-slate-50">

    <!-- HERO -->
    <section class="bg-blue-900 text-white">
      <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-16 md:grid-cols-2">

        <div>
          <div class="mb-5 inline-block rounded-full bg-white/10 px-4 py-2 text-sm">
            🍴 Kantin Digital SMKN 1 Ngawen
          </div>

          <h1 class="text-4xl font-extrabold leading-tight md:text-6xl">
            KantinGO
            <br />
            <span class="text-yellow-400">
              Jajan Lebih Mudah!
            </span>
          </h1>

          <p class="mt-5 max-w-xl text-lg leading-relaxed text-blue-100">
            Temukan berbagai makanan, minuman, snack,
            dan paket hemat favorit warga sekolah dalam
            satu tempat.
          </p>

          <div class="mt-7 flex gap-4">
            <a href="#menu"
              class="rounded-xl bg-yellow-400 px-6 py-3 font-bold text-blue-950 transition hover:bg-yellow-300">
              🍔 Lihat Menu
            </a>

            <button @click="showCart = true"
              class="rounded-xl border border-white/30 px-6 py-3 font-bold transition hover:bg-white/10">
              🛒 Keranjang
              <span v-if="jumlahKeranjang">
                ({{ jumlahKeranjang }})
              </span>
            </button>
          </div>
        </div>

        <div>
          <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=85"
            alt="Makanan KantinGO" class="h-[360px] w-full rounded-3xl object-cover shadow-2xl md:h-[440px]" />
        </div>

      </div>
    </section>


    <!-- INFO -->
    <section class="bg-white">
      <div class="mx-auto grid max-w-7xl grid-cols-2 gap-5 px-5 py-8 md:grid-cols-4">

        <div class="rounded-2xl bg-blue-50 p-5 text-center">
          <div class="text-3xl">🍔</div>
          <h3 class="mt-2 font-bold text-slate-900">
            Menu Beragam
          </h3>
          <p class="mt-1 text-sm text-slate-500">
            Banyak pilihan makanan
          </p>
        </div>

        <div class="rounded-2xl bg-yellow-50 p-5 text-center">
          <div class="text-3xl">💰</div>
          <h3 class="mt-2 font-bold text-slate-900">
            Harga Pelajar
          </h3>
          <p class="mt-1 text-sm text-slate-500">
            Ramah untuk kantong siswa
          </p>
        </div>

        <div class="rounded-2xl bg-green-50 p-5 text-center">
          <div class="text-3xl">⚡</div>
          <h3 class="mt-2 font-bold text-slate-900">
            Praktis
          </h3>
          <p class="mt-1 text-sm text-slate-500">
            Pilih menu dengan mudah
          </p>
        </div>

        <div class="rounded-2xl bg-purple-50 p-5 text-center">
          <div class="text-3xl">⭐</div>
          <h3 class="mt-2 font-bold text-slate-900">
            Menu Favorit
          </h3>
          <p class="mt-1 text-sm text-slate-500">
            Rating terbaik dari siswa
          </p>
        </div>

      </div>
    </section>


    <!-- MENU -->
    <section id="menu" class="mx-auto max-w-7xl px-5 py-14">

      <div class="mb-8 flex flex-col justify-between gap-5 md:flex-row md:items-end">

        <div>
          <p class="font-bold text-blue-700">
            MENU KANTINGO
          </p>

          <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
            Mau Makan Apa Hari Ini?
          </h2>

          <p class="mt-2 text-slate-500">
            Pilih makanan dan minuman favoritmu.
          </p>
        </div>

        <!-- SEARCH -->
        <div class="relative w-full md:w-80">
          <span class="absolute left-4 top-1/2 -translate-y-1/2">
            🔎
          </span>

          <input v-model="search" type="text" placeholder="Cari menu..."
            class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100" />
        </div>

      </div>


      <!-- KATEGORI -->
      <div class="mb-8 flex gap-3 overflow-x-auto pb-2">
        <button v-for="item in kategori" :key="item" @click="kategoriAktif = item"
          class="whitespace-nowrap rounded-full px-5 py-2.5 font-semibold transition" :class="kategoriAktif === item
              ? 'bg-blue-800 text-white'
              : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-blue-50'
            ">
          {{ item }}
        </button>
      </div>


      <!-- PRODUCT -->
      <div v-if="menuFiltered.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        <article v-for="item in menuFiltered" :key="item.id"
          class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

          <div class="relative">
            <img :src="item.gambar" :alt="item.nama" class="h-52 w-full object-cover" />

            <span class="absolute left-3 top-3 rounded-full bg-white px-3 py-1 text-xs font-bold text-blue-800 shadow">
              {{ item.kategori }}
            </span>
          </div>

          <div class="p-5">

            <h3 class="font-bold text-slate-900">
              {{ item.nama }}
            </h3>

            <div class="mt-2 text-sm">
              <span class="font-semibold text-yellow-500">
                ⭐ {{ item.rating }}
              </span>

              <span class="ml-2 text-slate-400">
                {{ item.terjual }} terjual
              </span>
            </div>

            <p class="mt-3 line-clamp-2 text-sm text-slate-500">
              {{ item.deskripsi }}
            </p>

            <div class="mt-4 flex items-center justify-between">
              <span class="text-lg font-extrabold text-blue-800">
                {{ formatRupiah(item.harga) }}
              </span>

              <button @click="tambahKeranjang(item)"
                class="rounded-xl bg-blue-800 px-4 py-2 font-bold text-white transition hover:bg-blue-900">
                + Tambah
              </button>
            </div>

            <button @click="bukaDetail(item)"
              class="mt-3 w-full rounded-xl border border-slate-200 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">
              Lihat Detail
            </button>

          </div>

        </article>

      </div>


      <!-- TIDAK ADA MENU -->
      <div v-else class="rounded-2xl bg-white py-20 text-center">
        <div class="text-5xl">🔍</div>

        <h3 class="mt-4 text-xl font-bold text-slate-900">
          Menu tidak ditemukan
        </h3>

        <p class="mt-2 text-slate-500">
          Silakan coba pencarian atau kategori lain.
        </p>
      </div>

    </section>


    <!-- TENTANG -->
    <section class="bg-white py-16">
      <div class="mx-auto max-w-7xl px-5">

        <div class="grid items-center gap-12 md:grid-cols-2">

          <div>
            <p class="font-bold text-blue-700">
              TENTANG KANTINGO
            </p>

            <h2 class="mt-3 text-3xl font-extrabold text-slate-900 md:text-4xl">
              Kantin Sekolah
              <br />
              Jadi Lebih Digital.
            </h2>

            <p class="mt-5 leading-relaxed text-slate-600">
              KantinGO merupakan konsep kantin digital
              SMKN 1 Ngawen yang menyediakan informasi
              menu makanan dan minuman secara lebih
              terstruktur dan mudah diakses oleh siswa,
              guru, dan warga sekolah.
            </p>

            <div class="mt-7 space-y-4">

              <div class="flex gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100">
                  🔎
                </div>

                <div>
                  <h3 class="font-bold">
                    Cari Menu
                  </h3>

                  <p class="text-sm text-slate-500">
                    Temukan makanan favorit dengan cepat.
                  </p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-yellow-100">
                  🛒
                </div>

                <div>
                  <h3 class="font-bold">
                    Masukkan Keranjang
                  </h3>

                  <p class="text-sm text-slate-500">
                    Atur jumlah makanan sebelum memesan.
                  </p>
                </div>
              </div>

              <div class="flex gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-100">
                  🍱
                </div>

                <div>
                  <h3 class="font-bold">
                    Nikmati Pesanan
                  </h3>

                  <p class="text-sm text-slate-500">
                    Pesanan siap dinikmati saat jam istirahat.
                  </p>
                </div>
              </div>

            </div>
          </div>

          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW_GuO90r8tYlYd6MH9e7Do1X2tR-rCgZ6iIpoPSUpk8hFeGd7MRQQjpK6&s=10"
            alt="Kantin sekolah" class="h-[420px] w-full rounded-3xl object-cover shadow-xl" />

        </div>

      </div>
    </section>


    <!-- CTA -->
    <section class="bg-blue-900 py-16 text-center text-white">
      <div class="mx-auto max-w-3xl px-5">

        <div class="text-5xl">🍔</div>

        <h2 class="mt-5 text-3xl font-extrabold md:text-4xl">
          Lapar Saat Jam Istirahat?
        </h2>

        <p class="mt-4 text-blue-100">
          Yuk pilih menu favoritmu di KantinGO!
        </p>

        <a href="#menu"
          class="mt-7 inline-block rounded-xl bg-yellow-400 px-7 py-3 font-bold text-blue-950 hover:bg-yellow-300">
          Lihat Menu
        </a>

      </div>
    </section>


    <!-- DETAIL MODAL -->
    <div v-if="selectedMenu" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 p-5"
      @click.self="selectedMenu = null">

      <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl">

        <img :src="selectedMenu.gambar" :alt="selectedMenu.nama" class="h-64 w-full object-cover" />

        <div class="p-6">

          <div class="flex justify-between gap-4">

            <div>
              <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-800">
                {{ selectedMenu.kategori }}
              </span>

              <h2 class="mt-3 text-2xl font-extrabold">
                {{ selectedMenu.nama }}
              </h2>
            </div>

            <button @click="selectedMenu = null" class="h-9 w-9 rounded-full bg-slate-100">
              ✕
            </button>

          </div>

          <div class="mt-4">
            ⭐ {{ selectedMenu.rating }}
            <span class="ml-2 text-slate-400">
              • {{ selectedMenu.terjual }} terjual
            </span>
          </div>

          <p class="mt-5 leading-relaxed text-slate-600">
            {{ selectedMenu.deskripsi }}
          </p>

          <div class="mt-6 flex items-center justify-between">

            <span class="text-2xl font-extrabold text-blue-800">
              {{ formatRupiah(selectedMenu.harga) }}
            </span>

            <button @click="
              tambahKeranjang(selectedMenu);
            selectedMenu = null;
            " class="rounded-xl bg-blue-800 px-6 py-3 font-bold text-white">
              + Tambah
            </button>

          </div>

        </div>

      </div>
    </div>


    <!-- CART -->
    <div v-if="showCart" class="fixed inset-0 z-[100] bg-black/60" @click.self="showCart = false">

      <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl">

        <div class="flex items-center justify-between border-b p-5">

          <div>
            <h2 class="text-xl font-extrabold">
              🛒 Keranjang
            </h2>

            <p class="text-sm text-slate-500">
              {{ jumlahKeranjang }} item
            </p>
          </div>

          <button @click="showCart = false" class="rounded-full bg-slate-100 px-3 py-2">
            ✕
          </button>

        </div>


        <div class="h-[calc(100%-190px)] overflow-y-auto p-5">

          <div v-if="keranjang.length" class="space-y-4">

            <div v-for="item in keranjang" :key="item.id" class="flex gap-3 rounded-2xl border p-3">

              <img :src="item.gambar" :alt="item.nama" class="h-20 w-20 rounded-xl object-cover" />

              <div class="flex-1">

                <h3 class="font-bold">
                  {{ item.nama }}
                </h3>

                <p class="mt-1 text-sm font-semibold text-blue-800">
                  {{ formatRupiah(item.harga) }}
                </p>

                <div class="mt-2 flex items-center justify-between">

                  <div class="flex items-center rounded-lg border">
                    <button @click="kurangiJumlah(item)" class="px-3 py-1">
                      −
                    </button>

                    <span class="px-2 font-bold">
                      {{ item.jumlah }}
                    </span>

                    <button @click="tambahJumlah(item)" class="px-3 py-1">
                      +
                    </button>
                  </div>

                  <button @click="hapusKeranjang(item.id)" class="text-sm text-red-500">
                    Hapus
                  </button>

                </div>

              </div>

            </div>

          </div>


          <div v-else class="flex h-full flex-col items-center justify-center text-center">
            <div class="text-6xl">🛒</div>

            <h3 class="mt-5 text-xl font-bold">
              Keranjang Kosong
            </h3>

            <p class="mt-2 text-sm text-slate-500">
              Yuk pilih makanan favoritmu!
            </p>
          </div>

        </div>


        <div v-if="keranjang.length" class="absolute bottom-0 left-0 right-0 border-t bg-white p-5">

          <div class="mb-4 flex justify-between">
            <span class="text-slate-500">
              Total
            </span>

            <span class="text-2xl font-extrabold text-blue-800">
              {{ formatRupiah(totalHarga) }}
            </span>
          </div>

          <button @click="checkout" class="w-full rounded-xl bg-blue-800 py-3.5 font-bold text-white hover:bg-blue-900">
            Pesan Sekarang →
          </button>

        </div>

      </div>
    </div>

  </main>
</template>

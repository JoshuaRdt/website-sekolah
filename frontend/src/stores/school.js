import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useSchoolStore = defineStore('school', () => {
  const schoolInfo = ref({
    name: 'SMKN 1 NGAWEN',
    address: 'Jono, Tancep, Kec. Ngawen, Kab. Gunung Kidul, D.I. Yogyakarta 55853',
    phone: ' 0811-266-227',
    email: 'smkngawen2006@gmail.com',
    website: 'www.smkn1ngawen.sch.id'
  })

  const competencies = ref([
    {
      id: 1,
      name: 'Teknik Komputer dan Jaringan (TKJ)',
      description: 'Mempelajari tentang hardware, software, networking, dan sistem operasi',
      image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE-W2FdUPHW73f2huD2RN0n3RYtUA2V5So-hXG4rr5DA&s=10'
    },
    {
      id: 2,
      name: 'Teknik Kendaraan Ringan (TKR)',
      description: 'Mempelajari perbaikan dan pemeliharaan kendaraan',
      image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGvbQLP8HwRiHGSI41iPaJFafnpR7Khr7JnAFGCBirDw&s=10'
    },
    {
      id: 3,
      name: 'Teknik Alat Berat (TAB)',
      description: 'mempelajari pemeliharaan, perawatan, diagnosis kerusakan, hingga perbaikan mesin-mesin berat',
      image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQP5XfB3gojX-7NzWShnqaz2_l1NaP9j0-CR_AC_EQntA&s=10'
    },
    {
      id: 4,
      name: 'Tata Busana (TB)',
      description: 'Tata Busana mempelajari seluruh proses pembuatan pakaian dari nol, mulai dari menggambar sketsa desain mode, mengenali jenis bahan kain, membuat pola dasar pakaian, teknik menjahit tingkat dasar hingga industri (tailoring)',
      image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_NtqiePo8V4Sn1LOEiYCTT7tISvaVbXe5-MgLsPeVig&s=10'
    },
    {
      id: 5,
      name: 'Desain Pemodelan dan Informasi Bangunan (DPIB)',
      description: 'mempelajari cara merancang, menggambar, dan memodelkan konstruksi bangunan serta sistem informasinya.',
      image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6a3UCvsbehiRyHHUybjjrbNGktio2rWpJ4rFlcY4Qkg&s=10'
    }
  ])

  const news = ref([
    {
      id: 1,
      title: 'SMKN 1 NGAWEN UKIR PRESTASI JUARA NASIONAL',
      date: '',
      category: 'Prestasi',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/08/DSC02250-768x435.jpg',
      excerpt: 'M. Nadzarel Deviansyah, siswa Kelas XII TAB, berhasil menorehkan prestasi gemilang dengan meraih Juara III pada Lomba Kompetensi Siswa (LKS) Tingkat Nasional dalam bidang lomba Heavy Vehicle Technology.'
    },
    {
      id: 2,
      title: 'SMKN 1 NGAWEN UKIR PRESTASI JUARA NASIONAL',
      date: '',
      category: 'Prestasi',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/08/DSC02191-768x435.jpg',
      excerpt: 'Muhammad Ilham Putra Pamungkas, siswa Kelas XII TKJ, sukses mengukir prestasi membanggakan dengan meraih Juara II pada Festival Lomba Seni Siswa Nasional (FLS2N) Tingkat Provinsi DIY Tahun 2026 untuk bidang lomba Fotografi.'
    },
    {
      id: 3,
      title: 'SMKN 1 NGAWEN UKIR PRESTASI JUARA NASIONAL',
      date: '',
      category: 'Prestasi',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/08/DSC02215-768x435.jpg',
      excerpt: 'Riska Rachmalia Ariani, siswi Kelas XI TAB, sukses menorehkan prestasi membanggakan dengan meraih Juara I pada Kejuaraan Pencak Silat Piala Bupati Sukoharjo Cup.'
    },
    {
      id: 4,
      title: 'PT HEXINDO ADI PERKASA TBK KEGIATAN INSPIRASI SMKN 1 NGAWEN',
      date: '',
      category: '',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/08/DSC03092-1536x869.jpg',
      excerpt: 'SMK Negeri 1 Ngawen kembali menerima kunjungan industri yang sangat bernilai bagi pengembangan wawasan peserta didik. Pada Kamis, 13 Agustus 2026, PT Hexindo Adiperkasa Tbk menggelar kegiatan Corporate Social Responsibility (CSR) bertajuk “Kegiatan Kelas Inspirasi” yang berlangsung sukses dan penuh antusiasme.'
    },
    {
      id: 5,
      title: 'SMKN 1 NGAWEN MELAKSANAKAN MASIK HAJI',
      date: '',
      category: '',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/04/DSC06070-1536x869.jpg',
      excerpt: 'Pada hari Jumat, 24 April 2026, SMKN 1 Ngawen sukses menyelenggarakan kegiatan Praktik Manasik Haji Tahun 2026. Kegiatan yang mengusung tema “Manasik Haji: Belajar Ibadah, Menguatkan Akhlak” ini dilaksanakan dengan khidmat dimulai di lapangan upacara, kemudian untuk miqotnya bertempat di Masjid Jono setelah itu  semua peserta manasik melaksanakan kegiatan manasik haji  di lapangan Jono,Tancep,Ngawen, Gunungkidul.'
    },
    {
      id: 6,
      title: 'NFORMASI KELULUSAN SMK NEGERI 1 NGAWEN TAHUN 2026',
      date: '',
      category: '',
      image: 'https://www.smkn1ngawen.sch.id/wp-content/uploads/2026/05/PLENO-KELULUSAN-1-scaled-e1777878029614.png',
      excerpt: 'Pihak sekolah secara resmi merilis informasi kelulusan sehubungan dengan berakhirnya masa pembelajaran bagi siswa kelas XII tahun pelajaran 2025/2026, di mana berdasarkan hasil rapat pleno dewan guru, pengumuman kelulusan akan dilaksanakan pada hari Senin, 4 Mei 2026 pukul 15.18 WIB secara daring (online).'
    }
  ])

  const extracurriculars = ref([
  {
    name: 'Desain Pemrograman Web',
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-qGdokzCD9U0aMeYPTGE6JguNGYp2aJ6971tO5XfdfBBfr1tSj5RM2gsD&s=10'
  },
  {
    name: 'Cabling TKJ',
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&h=300&fit=crop'
  },
  {
    name: 'Karawitan',
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpR3E5eaC2BYVl04WjclAR35INBQEm1p9hRH372R0RZPR14gN-4ar5UJg&s=10'
  },
  {
    name: 'LABORA TKJ',
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQskCqrW9-gyIuyIzSlMH3rJtaeFcrc8HTwfKP0dMi2WXSnK_ejKHt5xTK&s=10'
  },
  {
    name: 'Basket',
    image: 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=400&h=300&fit=crop'
  },
  {
    name: 'Futsal',
    image: 'https://meettfit.com/wp-content/uploads/2025/05/futsal-court-with-players-in-action.jpg'
  },
  {
    name: 'Badminton',
    image: 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=400&h=300&fit=crop'
  },
  {
    name: 'Bahasa Jepang',
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPpDSsq6ytDl3p8tGKBLYbGaQfEIdhShCiwJJ0nEy4IaD4xQ-qwoVqgAOO&s=10'
  },
  {
    name: 'Tari',
    image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSij7Ql1-AIvxYd2rfb56DMNo6qDAfJXUEkUSCtvCMNJXHFPrnAk8MO85c&s=10'
  },
  {
    name: 'Voli',
    image: 'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=400&h=300&fit=crop'
  }
])
  return { schoolInfo, competencies, news, extracurriculars }
})

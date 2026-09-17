import axios from 'axios'

const api = axios.create({
    import axios from 'axios'

const api = axios.create({
        baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        timeout: 10000
    })

// Request interceptor - otomatis nempel token kalau ada (misal untuk login admin)
api.interceptors.request.use(
        (config) => {
            const token = localStorage.getItem('token')
            if (token) {
                config.headers.Authorization = `Bearer ${token}`
            }
            return config
        },
        (error) => Promise.reject(error)
    )

// Response interceptor - handle error terpusat, jadi tiap komponen gak perlu try/catch verbose
api.interceptors.response.use(
        (response) => response,
        (error) => {
            if (error.response) {
                switch (error.response.status) {
                    case 401:
                        console.error('Unauthorized - token invalid atau expired')
                        break
                    case 404:
                        console.error('Endpoint tidak ditemukan (404)')
                        break
                    case 422:
                        console.error('Validasi gagal:', error.response.data.errors)
                        break
                    case 500:
                        console.error('Server error (500)')
                        break
                    default:
                        console.error('API error:', error.response.data)
                }
            } else if (error.request) {
                console.error('Tidak ada respons dari server. Pastikan backend (php artisan serve) sudah jalan.')
            } else {
                console.error('Error:', error.message)
            }
            return Promise.reject(error)
        }
    )
)}
export default api

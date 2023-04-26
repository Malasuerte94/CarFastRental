import axios from 'axios'

//const url = process.env.VUE_APP_PORTAL_ENDPOINT
const url = '/api/'
let http = null

const ApiService = {
  http: null,

  init: function () {
    if (http) {
      return
    }
    http = axios.create({
      baseURL: url,
      headers: {
        'Content-Type': 'application/json'
      },
      withCredentials: true
    })

    http.interceptors.request.use(async function (config) {
      if (config.method === 'post') {
        await http.get('/sanctum/csrf-cookie')
      }
      return config
    }, function (error) {
      return Promise.reject(error)
    })

    http.interceptors.response.use(function (response) {
      return response
    }, function (error) {
      if (error.response.status === 419) {
      }
      return Promise.reject(error)
    })

    this.http = http
  },

  withAuth: function (token = '') {
    this.init()

    if (!token) {
      token = store.getters['user/token']
    }

    let http = this.http

    http.defaults.headers.common.Authorization = `Bearer ${token}`

    return http
  },

  withoutAuth () {
    this.init()

    let http = this.http

    http.defaults.headers.common.Authorization = ``

    return http
  }
}

export default ApiService

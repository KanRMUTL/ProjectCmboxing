import axios from 'axios'

const baseDomain = 'http://cnxstadium.com'
const baseURL = `${baseDomain}/api`

export default axios.create({
     baseURL
})
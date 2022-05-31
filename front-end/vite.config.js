import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'

const env = loadEnv('', process.cwd(), '');

// https://vitejs.dev/config/
export default defineConfig({
  base: process.env.NODE_ENV === 'production'
  ? `${env.VITE_SUBDIR}`
  : '/',
  plugins: [vue()]
});

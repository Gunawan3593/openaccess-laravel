import { createRouter, createWebHistory } from "vue-router";
import ProductList from '../views/Product/List.vue';
import ProductForm from '../views/Product/Form.vue';

const routes = [
  {
    path: '/',
    redirect: '/product'
  },
  {
    path: '/product',
    name: 'ProductList',
    component: ProductList
  },
  {
    path: '/product/add',
    name: 'ProductAdd',
    component: ProductForm
  },
  {
    path: '/product/edit/:id',
    name: 'ProductEdit',
    component: ProductForm
  }
];

const subdir = import.meta.env.VITE_SUBDIR;

const router = createRouter({
  history: createWebHistory(subdir),
  routes
});

export default router;
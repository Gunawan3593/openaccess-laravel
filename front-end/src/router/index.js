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

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
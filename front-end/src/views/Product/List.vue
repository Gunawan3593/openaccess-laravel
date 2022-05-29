<template>
  <div class="container">
    <div class="flex mt-10 justify-center">
      <div class="w-full max-w-4xl">
        <div class="flex justify-between items-center">
          <h1 class="text-3xl font-semibold text-slate-700">Product List</h1>
          <router-link class="text-base bg-sky-500 text-white px-3 py-2 rounded-lg hover:bg-opacity-60 font-semibold" :to="{ name: 'ProductAdd'}">New Product</router-link>
        </div>
        <div class="mt-10">
          <table class="table w-full">
            <thead class="font-semibold text-slate-700 border border-slate-400 border-x-0 border-t-0 leading-8">
              <td>#</td>
              <td>Name</td>
              <td>Description</td>
              <td>Price</td>
              <td class="text-center">Qty</td>
              <td class="text-center">Action</td>
            </thead>
            <tbody class="text-slate-700">
              <tr v-if="products.loading" class="border border-slate-400 border-x-0 border-t-0 leading-8">
                <td colspan="5" class="text-center text-base">Loading ...</td>
              </tr>
              <tr  v-else v-for="(product, index) in products.data" :key="product.id" class="border border-slate-400 border-x-0 border-t-0 leading-8">
                <td>{{ index+1 }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td class="text-center">{{ product.qty }}</td>
                <td class="text-center">
                  <a class="text-sky-400 mr-5" :href="`/product/edit/${product.id}`">Edit</a>

                  <button type="button" @click="deleteProduct(product.id)" class="text-red-500">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { computed } from "vue";
  import store from "../../store";
  import { useRouter } from "vue-router";

  const router = useRouter();
  const products = computed(() => store.state.products);

  store.dispatch('getProducts');


  function deleteProduct(id) {
    if (
      confirm(`Are you sure want to delete this product ? Opration can't be undone`)
    ) {
      store.dispatch('deleteProduct', id).then(() => {
        store.dispatch('getProducts');
      });
    }
  }
</script>
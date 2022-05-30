<template>
  <div class="container">
    <div class="flex mt-10 justify-center">
      <div v-if="!productLoading" class="w-full max-w-4xl">
        <div class="flex justify-between items-center">
          <h1 class="text-3xl font-semibold text-slate-700">{{ (fields.id) ? 'Edit Product' : 'New Product' }}</h1>
          <router-link class="text-base bg-sky-500 text-white px-3 py-2 rounded-lg hover:bg-opacity-60 font-semibold" :to="{ name: 'ProductList'}">Back to List</router-link>
        </div>
        <div class="mt-10">
          <form @submit.prevent="saveProduct" class="text-slate-600 text-base flex flex-col gap-5">
            <label class="font-medium">
              Name
              <input type="text" v-model="fields.name" placeholder="Name" class="block w-full p-1 mt-1 border-2 border-slate-300 rounded-md outline-none focus:border-indigo-500 focus:ring-indigo-500" />
              <div v-for="error in errors.name" :key="error">
                <span class="text-sm text-red-500 font-normal">{{ error  }}</span>
              </div>
            </label>

            <label class="font-medium">
              Description
              <textarea v-model="fields.description" rows="3" placeholder="Description" class="block w-full p-1 mt-1 border-2 border-slate-300 rounded-md outline-none focus:border-indigo-500 focus:ring-indigo-500 overflow-hidden"></textarea>
              <div v-for="error in errors.description" :key="error">
                <span class="text-sm text-red-500 font-normal">{{ error  }}</span>
              </div>
            </label>

            <label class="font-medium">
              Price
              <input type="number" v-model="fields.price" placeholder="Price" class="block w-full p-1 mt-1 border-2 border-slate-300 rounded-md outline-none focus:border-indigo-500 focus:ring-indigo-500" />
              <div v-for="error in errors.price" :key="error">
                <span class="text-sm text-red-500 font-normal">{{ error  }}</span>
              </div>
            </label>

            <label class="font-medium">
              Qty
              <input type="number" v-model="fields.qty" placeholder="Qty" class="block w-full p-1 mt-1 border-2 border-slate-300 rounded-md outline-none focus:border-indigo-500 focus:ring-indigo-500" />
              <div v-for="error in errors.qty" :key="error">
                <span class="text-sm text-red-500 font-normal">{{ error  }}</span>
              </div>
            </label>

            <div class="text-right">
              <button type="submit" :disabled="saveLoading" class="text-base border-2 border-sky-500 px-3 py-2 rounded-md font-semibold hover:bg-sky-500 hover:text-white">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <div v-else>
        <div class="w-full">
          <h1 class="text-xl text-slate-700 font-semibold">Loading ...</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, watch, ref } from 'vue';
import store from "../../store";
import { useRoute, useRouter } from "vue-router";


const route = useRoute();
const router = useRouter();
const saveLoading = ref(false);
const errors = ref([]);

const productLoading = computed(() => store.state.currentProduct.loading);

const fields = ref({
  name: '',
  description: '',
  price: '',
  qty: ''
});

watch(
  () => store.state.currentProduct.data, (newVal, oldVal) => {
    delete newVal.created_at;
    delete newVal.updated_at;
    errors.value = [];
    fields.value = newVal;
  }
);

if(route.params.id) {
  store.dispatch('getProduct', route.params.id);
}

function saveProduct() {
  saveLoading.value = true;
  store.dispatch('saveProduct', fields.value).then(({ data }) => {
    saveLoading.value = false;
    router.push({
      name: 'ProductEdit',
      params: { id: data.data.id }
    });
    store.commit('notify', {
      type: 'success',
      message: 'Product was successfully updated.'
    });
  }).catch((err) => {
    saveLoading.value = false;
    errors.value = err.response.data.errors;
  });
}

</script>
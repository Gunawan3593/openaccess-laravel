import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
      products: {
        loading: false,
        data: []
      },
      currentProduct: {
        loading: false,
        data: {}
      }
    },
    getters: {},
    actions: {
      saveProduct({ commit }, product) {
        let response;
        if(product.id) {
          response = axiosClient
            .put(`/product/update/${product.id}`, product)
            .then((res) => {
              commit("setCurrentProduct", res.data);
              return res;
            });
        } else {
          response = axiosClient.post('/product/add', product)
            .then((res) => {
              commit("setCurrentProduct", res.data);
              return res;
            });
        }
        return response;
      },
      getProduct({ commit }, id) {
        commit('setCurrentProductLoading', true);
        return axiosClient
          .get(`/product/show/${id}`)
          .then((res) => {
            commit('setCurrentProduct', res.data);
            commit('setCurrentProductLoading', false);
            return res;
          }).catch((err) => {
            commit('setCurrentProductLoading', false);
            throw err;
          });
      },
      getProducts({ commit }, {url = null} = {}) {
        url = url || '/product';
        commit('setProductsLoading', true);
        return axiosClient.get(url).then((res) => {
          commit('setProductsLoading', false);
          commit('setProducts', res.data);
          return res;
        });
      },
      deleteProduct({}, id) {
        return axiosClient.delete(`/product/${id}`);
      }
    },
    mutations: {
      setCurrentProductLoading: (state, loading) => {
        state.currentProduct.loading = loading;
      },
      setCurrentProduct: (state, product) => {
        state.currentProduct.data = product.data;
      },
      setProductsLoading: (state, loading) => {
        state.products.loading = loading;
      },
      setProducts: (state, products) => {
        state.products.data = products.data;
      }
    },
    modules: {}
  });
  
  export default store;
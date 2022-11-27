import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export const store = new Vuex.Store({
  state () {
    return {
      category: null,
      animals: []
    }
  },
  actions: {
    RESET({ commit }) {
      commit('reset');
    },
    SET_CATEGORY({ commit }, data) {
      commit('setCategory', data);
    },
    ADD_ANIMAL({ commit }, data) {
      commit('addAnimal', data);
    }
  },
  mutations: {
    reset(state) {
      state.category = null;
    },
    addAnimal(state, payload) {
      state.animals.push(payload);
    },
    setCategory(state, payload) {
      if(!payload) state.category = null;
      state.category = {
        ...payload
      };
    }
  },
  getters: {
    category(state) {
      return state.category;
    }
  }
});


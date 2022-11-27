import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export const store = new Vuex.Store({
  state () {
    return {
      category: null
    }
  },
  actions: {
    CLOSE_FORM({ commit }) {
      commit('closeForm');
    },
    CREATE_ANIMAL({ commit }, data) {
      commit('createAnimal', data);
    }
  },
  mutations: {
    closeForm(state) {
      state.category = null;
    },
    createAnimal(state, payload) {
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


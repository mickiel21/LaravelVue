import axios from "../axios";

const state = {
    is_authenticated: false,
    user: {}
};

const mutations = {
    LOG_OUT() {
        localStorage.removeItem("SUNTECH_USER");
    },
    LOG_OUT(state,data) {
        state.user = data.data;
    },

};

const getters = {
    user(state) {
        return state.user;
    },
};

const actions = {
    async login({ commit }, payload) {
        const { data } = await axios.post('/login', payload);
        commit("LOG_IN", data);
        return data.data
    },
    async logout({ commit }) {
        commit("LOG_OUT");
    },
};

export default {
    state,
    mutations,
    getters,
    actions
};

import axios from "../axios";

const state = {
    is_authenticated: false,
    auth_user: {}
};

const mutations = {
    LOG_OUT() {
        localStorage.removeItem("SUNTECH_USER");
    },
    LOG_OUT(state,data) {
        state.auth_user = data.data;
    },

};

const getters = {
    auth_user(state) {
        return state.auth_user;
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

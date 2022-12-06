import axios from "../axios";

const state = {
    is_authenticated: false,
    auth_user: {}
};

const mutations = {
    LOG_OUT() {
        localStorage.removeItem("SUNTEC_TOKEN");
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
        const { data } = await axios.post('/logout');
        commit("LOG_OUT",data);
        return data
    },
};

export default {
    state,
    mutations,
    getters,
    actions
};

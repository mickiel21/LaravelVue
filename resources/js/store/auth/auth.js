import axios from "../axios";

const state = {
    is_authenticated: false,
    login_loading: false,
};

const mutations = {
    SET_LOGIN_LOADING(state, data) {
        state.login_loading = data;
    },
    LOG_OUT() {
        localStorage.removeItem("SUNTECH_USER");
    },
};

const getters = {
    is_login_loading(state) {
        return state.login_loading;
    }
};

const actions = {
    async login({ commit }, payload) {
        const val = axios.post("/login", payload);
        return val;
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

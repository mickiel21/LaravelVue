const baseURL = "/user";
import axios from "../axios";
const apiResource = {
    index: "getUsers"
};
const state = {
    user_fields:[
        { key: "id", label: "No" },
        { key: "first_name", label: "Name" },
        { key: "email", label: "Email" },
        { key: "contact_number", label: "Contact No" },
        { key: "birthday", label: "Birthday" },
        { key: "actions", label: "ACTION" }
    ],
    users: [],
    user: {},
    signup_user:{},
    user_loading:false

};

const actions = {
    async getUsers({ commit }, payload) {
        commit("SET_USER_LOADING", true);
        const { data } = await axios
            .get(`${baseURL}`)
            .then(data => {
                commit("SET_USER_LOADING", false);
                return data;
            });
        commit("SET_GET_USERS", data);
    },
    async getUser({ commit, dispatch }, payload) {
        const { data } = await axios.get(`${baseURL}/user/${payload}`);
        dispatch("getUsers");
        commit("GET_USER", data);
        return data;
    },
    async createUser({ commit,dispatch }, payload) {
        const { data } = await axios.post(baseURL, payload);
        commit("SET_SAVE_USER", data);
        dispatch(apiResource.index);
        return data.message;
    },
    async updateUser({ commit,dispatch }, payload) {
        const { data } = await axios.put(`${baseURL}/${payload.id}`, payload);
        commit("SET_UPDATE_USER", data);
        dispatch(apiResource.index);
        return data.message;
        
    },
    async deleteUser({ commit, dispatch }, payload) {
        const { data } = await axios.delete(`${baseURL}/${payload}`, payload);
        commit("SET_DELETE_USER", data);
        dispatch(apiResource.index);
        return data.message;
    },
    async restoreUser({ commit, dispatch }, payload) {
        const { data } = await axios.get(`${baseURL}/restore/${payload}`);
        commit("SET_RESTORE_USER", data);
        dispatch("getArchivedUsers");
        return data.message;
    },

    async signUp({ commit}, payload) {
        const { data } = await axios.post(`/register`, payload);
        commit("SET_SIGN_UP_USER", data);
        return data.message;
    },

   
   
};

const mutations = {
    SET_GET_USERS(state, data) {
        state.users = data.data;
    },
    GET_USER(state, data) {
        state.user = data.data;
    },
    SET_SAVE_USER(state, data) {
        state.user = data;
    },
    SET_UPDATE_USER(state, data) {
        state.user = data.data;
    },
  
    SET_DELETE_USER(state, data) {
        state.user = data;
    },
    SET_RESTORE_USER(state, data) {
        state.user = data;
    },
    SET_USER_LOADING(state, data) {
        state.user_loading = data;
    },
    SET_SIGNUP_USER(state,data){
        state.signup_user = data
    }

};

const getters = {
    users(state) {
        return state.users;
    },
    user(state) {
        return state.user;
    },
    archivedUsers(state) {
        return state.users;
    },
    user_loading(state) {
        return state.user_loading;
    },
    user_fields(state) {
        return state.user_fields;
    },
    signup_user(state) {
        return state.signup_user;
    },
    

};

export default {
    state,
    mutations,
    getters,
    actions
};

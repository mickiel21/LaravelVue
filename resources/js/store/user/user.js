const baseURL = "/user";

const apiResource = {
    index: "getUsers"
};
const state = {
    users:[
        { key: "id", label: "No" },
        { key: "first_name", label: "Name" },
        { key: "email_address", label: "Email" },
        { key: "contact_no", label: "Contact No" },
        { key: "birthday", label: "Birthday" },
        { key: "actions", label: "ACTION" }
    ],
    users: [],
    user: {},

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
        commit("GET_USER", data);
    },
    async getUser({ commit, dispatch }, payload) {
        const { data } = await axios.get(`${baseURL}/user/${payload}`);
        dispatch("getUsers");
        commit("SET_GET_USERS", data);
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
   
   
};

const mutations = {
    SET_GET_USERS(state, data) {
        state.user = data.data;
    },
    GET_USER(state, data) {
        state.users = data.data;
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
    

};

export default {
    state,
    mutations,
    getters,
    actions
};

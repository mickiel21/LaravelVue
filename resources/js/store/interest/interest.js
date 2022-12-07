const baseURL = "/interest";
import axios from "../axios";
const apiResource = {
    index: "getUsers"
};
const state = {
   
    intesrests: [],
   

};

const actions = {
    async getInterests({ commit }, payload) {
        commit("SET_USER_LOADING", true);
        const { data } = await axios
            .get(`${baseURL}`)
            .then(data => {
                commit("SET_USER_LOADING", false);
                return data;
            });
        commit("SET_GET_INTERESTS", data);
    },
    

   
   
};

const mutations = {
    SET_GET_INTERESTS(state, data) {
        state.intesrests = data.data;
    },
   

};

const getters = {
    interests(state) {
        return state.intesrests;
    },
 
    

};

export default {
    state,
    mutations,
    getters,
    actions
};

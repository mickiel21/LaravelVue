import Vue from "vue";
import Vuex from "vuex";

import User from "./user/user";
import Auth from "./auth/auth";

Vue.use(Vuex);
export default new Vuex.Store({
    modules: {
        User ,
        Auth,
    }
});


const state = {
    users:[
        { key: "id", label: "No" },
        { key: "first_name", label: "Name" },
        { key: "email_address", label: "Email" },
        { key: "contact_no", label: "Contact No" },
        { key: "birthday", label: "Birthday" },
        { key: "actions", label: "ACTION" }
    ]

};

const actions = {

};

const mutations = {


};

const getters = {
  users(state){
    return state.users;
  }

};

export default {
    state,
    mutations,
    getters,
    actions
};

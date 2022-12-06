<template>
  <BaseContainer>
    Manage Client
    <template v-slot:table>
      <add-button buttonText="Add New Client" @create="create" />
      <DataTable
        :fields="user_fields"
        :items="users"
        :view="true"
        :remove="true"
      />
    </template>
  </BaseContainer>
</template>



<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "",
  props: {},
  data() {
    return {
      mode: "CREATE",
    };
  },
  methods: {
    ...mapActions({
      store: "createUser",
      update: "updateUser",
      index: "getUsers",
      destroy: "deleteUser",
    }),
    create() {
      this.$router.push("/user/create");
    },
  },
  computed: {
    ...mapGetters(["users", "user_fields"]),
  },

  mounted() {
    this.index();
  },
};
</script>




<style scoped>
</style>
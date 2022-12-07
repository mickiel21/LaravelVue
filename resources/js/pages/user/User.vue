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
        :isBusy="user_loading"
        @remove="remove"
        @view="view"
        @update="update"
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
    view(data) {
      this.$router.push(`/user/view/` + data.id);
    },
    edit(data) {
      this.$router.push(`/user/edit/` + data.id);
    },
    remove(data) {
      this.$swal({
        title: "Delete",
        text: `Do you really want to Delete User ${data.first_name}?`,
        icon: "question",
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        confirmButtonColor: "#3098D5",
        cancelButtonColor: "#F4C014",
      }).then((response) => {
        if (response.value == true) {
          this.destroy(data.id).then(
            (response) => {
              this.$swal({
                title: "Success",
                text: response,
                icon: "success",
                confirmButtonText: "OK",
              });
            },
            (errors) => {
              this.$swal({
                title: "Error",
                text: errors.response.data.message,
                icon: "error",
                confirmButtonText: "OK",
              });
            }
          );
        }
      });
    },
  },
  computed: {
    ...mapGetters(["users", "user_fields", "user_loading"]),
  },

  mounted() {
    this.index();
  },
};
</script>




<style scoped>
</style>
<template>
  <BaseContainer>
    Manage Client
    <template v-slot:table>
      <add-button buttonText="Add New Client" @create="create" />
      <DataTable :fields="users" />
    </template>
  </BaseContainer>
</template>



<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "",
  props: {},
  data() {
    return {};
  },
  methods: {
    ...mapActions({
      create() {
        console.log("create client");
      },
    }),
  },
  computed: {
    ...mapGetters(["users"]),
  },

  mounted() {},
};
</script>




<style scoped>
</style>
<template>
  <BaseContainer>
    HEADER DATA
    <template v-slot:table>
      <add-button buttonText="BUTTON TITLE" @create="create" />
      <DataTable :fields="data_table_state" />
    </template>
  </BaseContainer>
</template>



<script>
import BaseContainer from "../../container/BaseContainer.vue";
import DataTable from "../components/table/DataTable.vue";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "",
  components: { BaseContainer, DataTable },
  props: {},
  data() {
    return {};
  },
  methods: {
    ...mapActions({}),
  },
  computed: {
    ...mapGetters({}),
  },

  mounted() {},
};
</script>




<style scoped>
</style>
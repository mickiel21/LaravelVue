<template>
  <BaseContainer> HEADER DATA </BaseContainer>
</template>



<script>
import BaseContainer from "../../container/BaseContainer.vue";
import DataTable from "../components/table/DataTable.vue";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Standard",
  components: { BaseContainer, DataTable },
  props: {},
  data() {
    return { data_table_state: [] };
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
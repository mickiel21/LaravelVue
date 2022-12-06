<template>
  <div>
    <Navbar>
      <template v-slot:logout>
        <span @click="logout" class="dropdown-item dropdown-header"
          >Logout</span
        >
      </template>
    </Navbar>
    <Sidebar />

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><slot></slot></h1>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!--table-->
      <slot name="table"></slot>
    </div>
  </div>
</template>



<script>
export default {
  name: "",
  props: {},
  data() {
    return {};
  },
  methods: {
    logout() {
      console.log("logout");
    },
  },
  computed: {},

  mounted() {},
};
</script>




<style scoped>
</style>
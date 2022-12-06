<template>
  <div>
    <NewSidebar />
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
import NewSidebar from "../components/layouts/Navbar";
import Sidebar from "../components/layouts/Sidebar";
export default {
  name: "",
  components: { NewSidebar, Sidebar },
  props: {},
  data() {
    return {};
  },
  methods: {},
  computed: {},

  mounted() {},
};
</script>




<style scoped>
</style>
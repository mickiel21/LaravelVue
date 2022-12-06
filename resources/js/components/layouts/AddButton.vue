<template>
  <b-row>
    <b-col class="text-right mr-22">
      <b-button :variant="variant" @click="$emit('create')">
        <i class="fas fa-plus-circle"></i>
        {{ buttonText }}
      </b-button>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: "AddButton",
  props: {
    variant: {
      type: String,
      default: "success",
    },
    buttonText: {
      type: String,
      default: "Add",
    },
  },
};
</script>

<style scoped>
.mr-22 {
  margin-right: 22px;
}
</style>

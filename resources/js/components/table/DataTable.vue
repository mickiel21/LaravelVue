<template>
  <div class="p-20">
    <b-row class="mb-3">
      <b-col class="form-inline">
        <span class="pr-2"> {{ notice }} </span>
      </b-col>
    </b-row>
    <b-row class="mb-3" v-if="search">
      <b-col class="form-inline">
        <span class="pr-2">Display </span>
        <b-form-select
          v-model="form.limit"
          size="sm"
          :options="[15, 25, 50, 100]"
          @input="$emit('refresh', form)"
        ></b-form-select>
        <span class="pl-2"> Records</span>
      </b-col>

      <b-col v-show="visible">
        <b-form-group
          label="Search"
          label-cols-sm="5"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-2"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="form.search"
              type="text"
              @input="isTyping = true"
            ></b-form-input>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
    <b-table
      hover
      :items="items.data"
      :fields="fields"
      show-empty
      :busy="isBusy"
    >
      <template v-slot:cell(actions)="{ item }">
        <b-button
          size="sm"
          @click="$emit('view', item)"
          class="mr-1"
          v-if="view"
          >{{ viewText }}</b-button
        >

        <b-button
          size="sm"
          variant="warning"
          @click="$emit('update', item)"
          class="mr-1"
          v-if="update"
        >
          {{ updateText }}
        </b-button>

        <b-button
          size="sm"
          :variant="deleteColor"
          @click="$emit('remove', item)"
          class="mr-1"
          v-if="remove"
          >{{ deleteText }}</b-button
        >
      </template>

      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    </b-table>

    <div class="d-flex justify-content-between align-items-center">
      <p class="mt-3">
        Showing {{ items.from || 0 }} to {{ items.to || 0 }} of
        {{ items.total || 0 }} entries
      </p>
      <b-pagination
        v-model="form.page"
        :total-rows="items.total"
        :per-page="items.per_page"
        prev-text="Previous"
        next-text="Next"
        hide-goto-end-buttons
        @input="$emit('refresh', form)"
      ></b-pagination>
    </div>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  name: "data_table",
  props: {
    items: {
      type: [Object, Array],
      default: function () {
        return {
          data: [],
        };
      },
    },
    isBusy: {
      type: Boolean,
      default: false,
    },
    fields: {
      type: Array,
      default: () => [],
    },
    visible: {
      type: Boolean,
      default: true,
    },
    search: {
      type: Boolean,
      default: true,
    },
    view: {
      type: Boolean,
      default: false,
    },
    update: {
      type: Boolean,
      default: true,
    },
    remove: {
      type: Boolean,
      default: false,
    },
    updateText: {
      type: String,
      default: "Update",
    },
    viewText: {
      type: String,
      default: "View",
    },
    deleteText: {
      type: String,
      default: "Delete",
    },
    deleteColor: {
      type: String,
      default: "danger",
    },
    notice: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      searchForm: {},
      isTyping: false,
      form: {
        limit: 15,
        search: null,
        page: 1,
      },
    };
  },
  methods: {
    filter() {
      this.$emit("filter", this.searchForm);
    },
  },
  computed: {
    searchQuery() {
      return this.form.search;
    },
  },
  watch: {
    searchQuery: _.debounce(function () {
      this.isTyping = false;
    }, 500),
    isTyping: function (value) {
      if (!value) {
        this.$emit("refresh", this.form);
      }
    },
  },
};
</script>
<style scoped>
.p-20 {
  padding: 20px;
}
</style>

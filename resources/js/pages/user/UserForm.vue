<template>
  <BaseContainer>
    Manage Client
    <div class="card-body">
      <b-row>
        <b-col sm="6">
          <b-form-group label="Email">
            <b-form-input
              type="email"
              v-model="user.email"
              placeholder="Email"
              :disabled="disabled"
              :state="validateState('email')"
            />
            <div class="invalid-feedback">Email Required.</div>
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="First Name">
            <b-form-input
              type="text"
              v-model="user.first_name"
              placeholder="First Name"
              :disabled="disabled"
              :state="validateState('first_name')"
            />
            <div class="invalid-feedback">First Name Required.</div>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col sm="6">
          <b-form-group label="Last Name">
            <b-form-input
              type="text"
              v-model="user.last_name"
              placeholder="Last Name"
              :disabled="disabled"
              :state="validateState('last_name')"
            />
            <div class="invalid-feedback">Last Name Required.</div>
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="Contact Number">
            <b-form-input
              type="number"
              v-model="user.contact_number"
              placeholder="Contact Number"
              :disabled="disabled"
              :state="validateState('contact_number')"
            />
            <div class="invalid-feedback">Contact Number Required.</div>
          </b-form-group>
        </b-col>
      </b-row>
      <br />
      <b-row>
        <b-col sm="6">
          <b-form-group label="Birthday">
            <b-form-input
              type="date"
              v-model="user.birthday"
              placeholder="Birthday"
              :disabled="disabled"
              :state="validateState('birthday')"
            />
            <div class="invalid-feedback">Birthday Required.</div>
          </b-form-group>
        </b-col>
      </b-row>
      <br />
      <b-form-group
        label="Select the interest(s) of this client"
        v-slot="{ ariaDescribedby }"
      >
        <b-form-checkbox-group
          v-model="user.interests"
          :options="interests"
          :aria-describedby="ariaDescribedby"
          name="flavour-2a"
          value-field="id"
          text-field="name"
          :disabled="disabled"
          stacked
        ></b-form-checkbox-group>
      </b-form-group>

      <br />
      <b-button
        class="action-button submitButton"
        @click="save"
        v-if="mode == 'CREATE'"
        ><i class="fa fa-check-circle"></i>Submit</b-button
      >
      <b-button
        class="action-button submitButton"
        @click="updateForm"
        v-if="mode == 'EDIT'"
        ><i class="fa fa-check-circle"></i>Update</b-button
      >
      <b-button class="action-button cancelButton" @click="cancel"
        ><i class="fa fa-check-circle"></i>Cancel</b-button
      >
    </div>
  </BaseContainer>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
export default {
  name: "UserForm",

  props: {
    id: {
      type: String,
      required: false,
    },
  },
  data() {
    return {
      mode: "",
      disabled: false,
      user: {
        email: "",
        first_name: "",
        last_name: "",
        contact_number: "",
        birthday: "",
        interests: [],
      },
      errors: "",
    };
  },
  validations: {
    user: {
      email: {
        required,
      },
      first_name: {
        required,
      },
      last_name: {
        required,
      },
      contact_number: {
        required,
      },
      birthday: {
        required,
      },
    },
  },
  mixins: [validationMixin],
  methods: {
    ...mapActions({
      store: "createUser",
      update: "updateUser",
      show: "getUser",
      index: "getUsers",
      interest_index: "getInterests",
    }),

    save() {
      this.$v.$touch();
      if (this.$v.$invalid) return;
      this.$swal({
        title: "Saving",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });
      this.store(this.user)
        .then((response) => {
          this.$swal({
            title: "Success",
            text: response,
            icon: "success",
            confirmButtonText: "OK",
          }).then((response) => {
            this.$router.push(`/user`);
          });
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
          this.$swal({
            title: "Error",
            text: errors.message,
            icon: "error",
            confirmButtonText: "OK",
          });
        });
    },
    updateForm() {
      this.$v.$touch();
      if (this.$v.$invalid) return;
      this.$swal({
        title: "Updating...",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });
      this.update(this.user)
        .then((response) => {
          this.$swal({
            title: "Success",
            text: response,
            icon: "success",
            confirmButtonText: "OK",
          }).then((response) => {
            this.$router.push(`/user`);
          });
        })
        .catch((errors) => {
          this.$swal({
            title: "Error",
            text: errors.response.data.errors,
            icon: "error",
            confirmButtonText: "OK",
          });
        });
    },
    cancel() {
      this.$router.push(`/user`);
    },
    validateState(field) {
      const { $dirty, $error } = this.$v.user[field];
      return $dirty ? !$error : null;
    },
  },
  computed: {
    ...mapGetters({
      users: "users",
      interests: "interests",
    }),
  },
  mounted() {
    this.index();
    this.interest_index();
    // this.allProductCategories();
    if (this.$route.path.includes("view")) {
      this.disabled = true;
      this.mode = "VIEW";
    }
    if (this.$route.path.includes("create")) {
      this.disabled = false;
      this.mode = "CREATE";
    }
    if (this.$route.path.includes("edit")) {
      this.mode = "EDIT";
    }
    if (this.id) {
      this.show(this.id)
        .then((response) => {
          this.user = response.data;
          const interest = response.data.client_interests.map(function (obj) {
            return obj.interest_id;
          });
          this.user.interests = interest;
        })
        .catch((error) => {});
    }
  },
};
</script>


<template>
  <LoginContainer>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin">
            <div class="card-body">
              <h5 class="login-title text-center" id="login">Sign Up</h5>

              <form class="form-signin">
                <div class="form-label-group">
                  <b-form-input
                    type="email"
                    v-model="user.email"
                    placeholder="Email"
                    :state="validateState('email')"
                  />
                  <label for="inputEmail">Email</label>
                  <div class="invalid-feedback">Email Required.</div>
                </div>

                <div class="form-label-group">
                  <b-form-input
                    type="password"
                    v-model="user.password"
                    placeholder="Password"
                    :state="validateState('password')"
                  />
                  <label for="password">Password</label>
                  <div class="invalid-feedback">Password Required.</div>
                </div>

                <div class="form-label-group">
                  <b-form-input
                    type="password"
                    id="confirm_password"
                    class="form-control"
                    placeholder="Confirm Password"
                    v-model="user.confirm_password"
                    :state="validateState('confirm_password')"
                  />
                  <label for="password">Confirm Password</label>
                  <div class="invalid-feedback">Confirm Password Required.</div>
                </div>
                <div class="form-label-group">
                  <b-form-input
                    type="text"
                    v-model="user.first_name"
                    placeholder="First Name"
                    :state="validateState('first_name')"
                  />
                  <label for="inputEmail">First Name</label>
                  <div class="invalid-feedback">First Name Required.</div>
                </div>
                <div class="form-label-group">
                  <b-form-input
                    type="text"
                    v-model="user.last_name"
                    placeholder="Last Name"
                    :state="validateState('last_name')"
                  />
                  <label for="last_name">Last name</label>
                  <div class="invalid-feedback">Last Name Required.</div>
                </div>
                <div class="form-label-group">
                  <b-form-input
                    type="number"
                    v-model="user.contact_number"
                    placeholder="Contact Number"
                    :state="validateState('contact_number')"
                  />
                  <label for="contact_number">Contact Number</label>
                  <div class="invalid-feedback">Contact Number Required.</div>
                </div>
                <div class="form-label-group">
                  <b-form-input
                    type="date"
                    v-model="user.birthday"
                    placeholder="Birthday"
                    :state="validateState('birthday')"
                  />
                  <label for="birthday">Birthday</label>
                  <div class="invalid-feedback">Birthday Required.</div>
                </div>

                <br />
                <button
                  class="btn btn-lg btn-primary btn-block text-uppercase"
                  type="button"
                  @click="signup"
                >
                  Save
                </button>
                <hr class="my-4" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LoginContainer>
</template>



<script>
import { mapGetters, mapActions } from "vuex";
import { validationMixin } from "vuelidate";
import { required, sameAs } from "vuelidate/lib/validators";
export default {
  name: "Signup",
  computed: {
    ...mapGetters([""]),
  },
  mixins: [validationMixin],
  data() {
    return {
      user: {
        email: "",
        password: "",
        confirm_password: "",
        first_name: "",
        last_name: "",
        contact_number: "",
        birthday: "",
      },
    };
  },
  validations: {
    user: {
      email: {
        required,
      },
      password: {
        required,
      },
      confirm_password: { required, sameAsPassword: sameAs("password") },
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

  methods: {
    ...mapActions(["signUp"]),
    signup() {
      this.$swal({
        title: "Logging in...",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });

      this.signUp(this.user)
        .then((response) => {
          console.log(response);

          this.$swal({
            title: "Sign Up",
            text: `Signup Success`,
            icon: "success",
            showCloseButton: true,
            showCancelButton: false,
          });
          window.location.href = "/login";
        })
        .catch((error) => {
          this.$swal({
            title: "Sign Up",
            text: error.message,
            icon: "error",
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: "OK",
          });
        });
    },

    validateState(field) {
      const { $dirty, $error } = this.$v.user[field];
      return $dirty ? !$error : null;
    },
  },
};
</script>
<style lang="scss" scoped>
.row {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
}
.container {
  height: 100vh;
}
.returning-text {
  font-size: 16px;
}
.btn-success {
  margin: 0px !important;
  background-color: #ba920d !important;
  border: #ba920d;
}
.login-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}
.left {
  margin: 30px;
}
</style>
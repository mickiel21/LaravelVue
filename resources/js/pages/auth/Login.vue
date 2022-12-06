<template>
  <LoginContainer>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin">
            <div class="card-body">
              <h5 class="login-title text-center" id="login">Log In</h5>

              <form class="form-signin">
                <div class="form-label-group">
                  <input
                    type="email"
                    id="inputEmail"
                    class="form-control"
                    placeholder="Username"
                    v-model="user.email"
                    required
                    autofocus
                  />
                  <label for="inputEmail">Email</label>
                </div>

                <div class="form-label-group">
                  <input
                    type="password"
                    id="inputPassword"
                    class="form-control"
                    placeholder="Password"
                    v-model="user.password"
                    required
                  />
                  <label for="inputPassword">Password</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="customCheck1"
                  />
                  <label class="custom-control-label" for="customCheck1"
                    >Remember password</label
                  >
                  <a class="left" href="signup"> Signup </a>
                  <!-- <a href="#" class="sign-up">Sign Up</a> -->
                </div>
                <button
                  class="btn btn-lg btn-primary btn-block text-uppercase"
                  type="button"
                  @click="doLogin"
                >
                  Sign in
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
export default {
  name: "Login",
  computed: {
    ...mapGetters(["is_login_loading"]),
  },
  data() {
    return {
      user: {
        email: null,
        password: null,
      },
    };
  },

  methods: {
    ...mapActions(["login"]),
    doLogin() {
      this.$swal({
        title: "Logging in...",
        html: '<img src="/images/loading.png" style="width: 8rem"/>',
        showConfirmButton: false,
        allowOutsideClick: false,
      });

      this.login(this.user)
        .then((response) => {
          window.localStorage.setItem("SUNTEC_TOKEN", response.data.token);

          this.$swal({
            title: "Login",
            text: `Login Success, Welcome ${response.data.user.first_name}`,
            icon: "success",
            showCloseButton: true,
            showCancelButton: false,
          });
          window.location.href = "/user";
        })
        .catch((error) => {
          console.log(error);
          this.$swal({
            title: "Login",
            text: error.response.data.message,
            icon: "error",
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: "OK",
          });
        });
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
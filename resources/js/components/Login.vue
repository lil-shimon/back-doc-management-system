<template>
  <div class="content-wrapper is-add_style">
    <div class="main_content p-login">
      <div class="is-body_content">
        <h1 class="is-body_content__title">ログイン</h1>
        <p v-show="isError">認証に失敗しました。</p>
        <div class="is-body_content__main">
          <div class="p-login__content">
            <form @submit.prevent="login">
              <div class="o-form">
                <div class="o-form__title">メールアドレス</div>
                <input type="text" name value placeholder="メールアドレス" v-model="email" />
              </div>
              <div class="o-form">
                <div class="o-form__title">パスワード</div>
                <input type="password" name value placeholder="パスワード" v-model="password" />
              </div>
              <button type="submit" class="o-btn">ログイン</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isError: false,
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      axios
        .post("/api/auth/login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          const token = res.data.access_token;
          axios.defaults.headers.common["Authorization"] = "Bearer " + token;
          state.isLogin = true;
          user_info.token = token;
          localStorage.setItem("jwt-token", token);
          this.$router.push({ name: "list" });
        })
        .catch(error => {
          this.isError = true;
        });
    }
  }
};
</script>

<style>
input:focus,
textarea:focus {
	background-color: #d9f6ff;
}
</style>

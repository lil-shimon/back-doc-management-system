<template>
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini">
        <b>A</b>LT 
      </span> 
      <span class="logo-lg">
        <b>Admin</b>LTE 
      </span>
    </a>

    <nav class="navbar navbar-static-top" style="display: flex; justify-content: flex-end; align-items: center; padding-right: 10px;">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <div class="pull-right" @click="logout">
              <a class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>

</template>

<script>
export default {
  name: "Header",
  methods: {
    logout() {
      axios.post("/api/auth/logout").then(res => {
        axios.defaults.headers.common["Authorization"] = "";
        state.isLogin = false;
        localStorage.removeItem("jwt-token");
        this.$router.push({ name: "login" });
      });
    }
  }
};
</script>

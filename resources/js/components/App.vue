<template>
  <div class="wrapper">
    <Header></Header>
    <Aside></Aside>
    <router-view></router-view>
  </div>
</template>

<script>
import Header from "./Header.vue";
import Aside from "./Aside.vue";

export default {
  components: {
    Header,
    Aside
  }
};
</script>

<style>
</style>
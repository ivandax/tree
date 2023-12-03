<template>
  <UserInfo />
</template>

<script>
import UserInfo from "./components/UserInfo.vue";

export default {
  name: "App",
  components: {
    UserInfo,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  background-color: #74da9e;
  height: 100vh;
}

body  {
  padding: 0 !important;
  margin: 0 !important;
}
</style>

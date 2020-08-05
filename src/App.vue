<template>
  <router-view 
    v-bind:authentication="authentication"
    @AuthenticateUser="authenticateUser" 
  />
</template>

<script>

export default {
  data: () => {
    return ({
      authentication: {
        is_authenticated: false,
        user: { default: "default" },
      },
    });
  },
  methods: {
    authenticateUser: function (userObject) {
      this.authentication.is_authenticated = true;
      this.authentication.user = userObject;

      this.$router.push("Chat");
    }
  }
}
 
</script>

<style>
@import './assets/stylesheets/feather.v2.1.1.css';
</style>

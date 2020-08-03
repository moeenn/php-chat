<template>
  <router-view />
</template>

<script>

export default {
  data: function () {
    return ({
      authentication: {
        is_authenticated: false,
        user: {},
      },
    });
  },
}
 
</script>

<style>
@import './assets/stylesheets/feather.v2.1.1.css';
</style>

<template>
  <div id="background">
    <div id="registerWindow" class="border rounded-corners shadow">
      <div v-if="error.loginError">
        <AlertMessage v-bind:msg="error.errorMessage" type="negative" />
      </div>

      <div class="p-2">
        <form>
          <h1>Register</h1>

          <fieldset>
            <label for="username">User</label>
            <input type="text" v-model="username" name="username" required="required">
          </fieldset>

          <fieldset>
            <label for="password">Password</label>
            <input type="password" v-model="password" required="required" minlength="8">
          </fieldset>

          <fieldset>
            <label>Re-enter Password</label>
            <input type="password" v-model="retypePassword" required="required" minlength="8">
          </fieldset>

          <fieldset>
            <input type="submit" value="Login" class="button-primary">
          </fieldset>
        </form>

        <span class="fg-size-small mt-3">
          Already Have an Account? 
          <router-link to="/">Login</router-link>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import AlertMessage from '@/components/AlertMessage.vue'

export default {
  name: 'Login',
  data: () => {
    return {
      username: "",
      password: "",
      retypePassword: "",
      error: {
        loginError: true,
        errorMessage: "Passwords Dont Match", 
      },
    };
  },
  components: {
    AlertMessage,
  }
}
</script>

<style scoped>

#background {
  height: 100vh;
  width: 100vw;
  background-color: var(--bg-color-dull);
}

#registerWindow { 
  --width: 45rem; 
  background-color: white;
  width: var(--width);
  position: absolute;
  left: calc((100% - var(--width)) / 2);
  top: 4%;
}

#registerWindow fieldset {
  margin: var(--spacing-3) 0;
}

#registerWindow a {
  font-weight: var(--fg-weight-normal);
}

@media only screen and (max-width: 800px) {
  #registerWindow {
    width: 100%;
    height: 100%;
    position: relative;
    left: 0;
    top: 0;
  }
}

</style>

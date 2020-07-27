<template>
  <div id="background">
    <div id="loginWindow" class="border rounded-corners shadow">
      <div v-if="loginError">
        <Message msg="Incorrect Username or Password" type="alert" />
      </div>

      <div class="p-2">
        <form>
          <h1>Login</h1>
          
          <fieldset>
            <label for="username">User</label>
            <input type="text" v-model="username" name="username" required="required">
          </fieldset>
          
          <fieldset>
            <label for="phone">Password</label>
            <input type="password" v-model="password" required="required" minlength="8">
          </fieldset>
          
          <fieldset>
            <input type="submit" value="Login" class="button-primary">
          </fieldset>
        </form>

        <span class="fg-size-small mt-3">
          Don't Have an Account? 
          <router-link to="/register">Create New Account</router-link>
          <router-link to="/chat"> Chat</router-link>
        </span>
      </div> 
    </div>
  </div>
</template>

<script>
import Message from '@/components/Message.vue'

export default {
  name: 'Login',
  data: () => {
    return {
      username: "",
      password: "",
      loginError: false,
    };
  },
  components: {
    Message,
  },
}
</script>

<style scoped>

#background {
  height: 100vh;
  width: 100vw;
  background-color: var(--bg-color-dull);
}

#loginWindow { 
  --width: 45rem; 
  background-color: white;
  width: var(--width);
  position: absolute;
  left: calc((100% - var(--width)) / 2);
  top: 12%;
}

#loginWindow fieldset {
  margin: var(--spacing-3) 0;
}

#loginWindow a {
  font-weight: var(--fg-weight-normal);
}

@media only screen and (max-width: 800px) {
  #loginWindow {
    width: 100%;
    height: 100%;
    position: relative;
    left: 0;
    top: 0;
  }
}

</style>

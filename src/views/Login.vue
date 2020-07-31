<template>
  <div id="background">
    <div id="loginWindow" class="border rounded-corners shadow">
      <div v-if="error.formError">
        <AlertMessage v-bind:msg="error.errorMessage" type="alert" />
      </div>

      <div class="p-2">
        <form>
          <h1>Login</h1>
          
          <fieldset>
            <label for="userName">Username</label>
            <input type="text" v-model="userName" name="userName" required="required">
          </fieldset>
          
          <fieldset>
            <label for="phone">Password</label>
            <input type="password" v-model="password" required="required" minlength="8">
          </fieldset>
          
          <fieldset>
            <input type="submit" value="Login" class="button-primary" v-on:click.prevent="handleSubmit">
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
import AlertMessage from '@/components/AlertMessage.vue'

export default {
  name: 'Login',
  data: () => {
    return {
      userName: "",
      password: "",
      error: { 
        formError: false,
        errorMessage: "",
      },
    };
  },
  components: {
    AlertMessage,
  },
  methods: {
    handleSubmit: async function () {
      const body = { 
        userName: this.userName, 
        password: this.password 
      };

      const headers = {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(body),
      };

      const res = await fetch('http://localhost:8000/users/validate.php', headers);
      const json = await res.json();

      if (res.status !== 200) {
        this.error.formError = true;
        this.error.errorMessage = "Incorrect Username or Password";
      } else {
        this.error.formError = false;
      }

      console.log(json);      
    }
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

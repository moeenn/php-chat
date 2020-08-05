<template>
  <div id="background">
    <div id="registerWindow" class="border rounded-corners shadow">
      <div v-if="error.formError">
        <AlertMessage v-bind:msg="error.errorMessage" type="negative" />
      </div>

      <div class="p-2">
        <form>
          <h1>Register</h1>

          <fieldset>
            <label for="userName">Username</label>
            <input type="text" v-model="userName" name="userName" required="required">
          </fieldset>

          <fieldset>
            <label>Full Name</label>
            <input type="text" v-model="fullName" name="fullName" required="required">
          </fieldset>

          <fieldset>
            <label for="password">Password</label>
            <input type="password" v-model="password" required="required" minlength="8">
          </fieldset>

          <fieldset>
            <label for="password">Re-type Password</label>
            <input type="password" v-model="retypePassword" required="required" minlength="8">
          </fieldset>

          <fieldset>
            <input type="submit" value="Create Account" class="button-primary" v-on:click.prevent="handleSubmit">
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
  props: {
    authentication: Object,
  },
  data: () => {
    return {
      userName: "",
      fullName: "",
      password: "",
      retypePassword: "",
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
    handleSubmit: function () {
      const isMatch = this.handleMatchPasswords();
      if (isMatch) this.handleSendUserCreationRequest();
    },

    handleMatchPasswords: function () {
      if (this.password !== this.retypePassword) {
        this.error.formError = true;
        this.error.errorMessage = "Passwords Dont Match";
        return false;
      }
      
      this.error.formError = false;
      return true;
    },

    handleSendUserCreationRequest: async function () {
      const body = { 
        userName: this.userName, 
        fullName: this.fullName, 
        password: this.password 
      };

      const headers = {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(body),
      };

      const res = await fetch('http://localhost:8000/users/create.php', headers);
      const json = await res.json();

      if (res.status !== 200) {
        this.error.formError = true;
        this.error.errorMessage = "Failed to Create User";
      }

      console.log(json);
    }
  },
}
</script>

<style scoped>

#background {
  height: 110vh;
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

<template>
  <div id="background">
    <div id="selectUser" class="border rounded-corners shadow d-flex flex-v">
      <h3 class="fg-align-center mh-3 mt-2">Select User</h3>
      <hr class="m-0">
      <div id="users">
        <div v-for="user in allUsers" :key="user.userID">
          <User 
            v-bind:user="user" 
            v-bind:selected="false"
            @ChangeSelectedUser="changeCurrentUser"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import User from '@/components/User.vue'

export default {
  name: 'SelectUser',
  props: {
    allUsers: Array,
  },
  components: {
    User,
  },
  methods: {
    changeCurrentUser: function (userID) {
      this.$emit("ChangeCurrentUser", userID);
    }
  }
}
</script>

<style scoped>

#background {
  position: absolute;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background-color: #f7f7f7;
  z-index: 9;
}

#selectUser { 
  --width: 45rem; 
  background-color: white;
  width: var(--width);
  position: absolute;
  height: 50rem;
  left: calc((100% - var(--width)) / 2);
  top: 12%;

}

#users {
  overflow-y: auto;
}

</style>

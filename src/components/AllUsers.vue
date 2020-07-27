<template>
  <div>
    <div v-for="user in allUsers" :key="user.id">
      <User 
        v-bind:userName="user.name" 
        v-bind:selected="user.id === selectedUserID"
        v-on:click="selectUser(user.id)"
      />
    </div>
  </div>  
</template>

<script>
import User from '@/components/User.vue'

export default {
  name: 'AllUsers',
  components: {
    User,
  },
  props: {
    allUsers: Array,
    selectedUserID: Number,
  },
  methods: {
    selectUser: (userID) => {
      console.log(userID);
      this.selectedUserID = userID;
    },
  },
}
</script>
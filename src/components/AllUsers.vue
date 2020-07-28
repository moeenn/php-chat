<template>
  <div>
    <div v-for="user in allUsers" :key="user.id">
      <User 
        v-bind:user="user" 
        v-bind:selected="user.id === selectedUserID"
        @ChangeSelectedUser="changeSelectedUser"
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
    changeSelectedUser: function (userID) {
      this.$emit('ChangeSelectedUser', userID);
    },
  },
}
</script>
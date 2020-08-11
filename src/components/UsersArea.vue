<template>
  <div id="usersArea">
    <div id="userMenu">
      <UserMenu v-bind:currentUser="currentUser.name" @Logout="logout"/>
    </div>
    <div id="allUsers">
      <AllUsers 
        v-bind:allUsers="allUsers" 
        v-bind:selectedUserID="selectedUserID" 
        @ChangeSelectedUser="changeSelectedUser" 
      />
    </div>
  </div>  
</template>

<script>
import UserMenu from '@/components/UserMenu.vue'
import AllUsers from '@/components/AllUsers.vue'

export default {
  name: 'UsersArea',
  props: {
    currentUser: Object,
    selectedUserID: Number,
    allUsers: Array,
  },
  components: {
    UserMenu,
    AllUsers,
  },
  methods: {
    changeSelectedUser: function (userID) {
      this.$emit('ChangeSelectedUser', userID);
    },

    logout: function () {
      this.$emit("Logout");
    }
  }
}
</script>

<style scoped>

#usersArea {
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 7rem calc(100vh - 7rem);
  grid-template-areas: 
    "userMenu"
    "allUsers";
}

#usersArea #userMenu {
  grid-area: userMenu;
}

#usersArea #allUsers {
  grid-area: allUsers;
}

</style>
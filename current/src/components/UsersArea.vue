<template>
  <div id="usersArea">
    <div id="userMenu">
      <UserMenu v-bind:currentUser="currentUser.name" />
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
  data: () => {
    return ({
      allUsers: [],
    });
  },
  props: {
    currentUser: Object,
    selectedUserID: Number,
  },
  components: {
    UserMenu,
    AllUsers,
  },
  methods: {
    changeSelectedUser: function (userID) {
      this.$emit('ChangeSelectedUser', userID);
    },

    getAllUsers: async function () {
      const res = await fetch("http://localhost:8000/users/all.php");
      const allUsers = await res.json();
      
      if(!res.ok) {
        console.warn("Unable to Get Users");
        console.log(allUsers);
        return;
      }
      // console.log(allUsers);

      // filter out current user
      let filteredUsers = [];
      for(const user of allUsers.users) {
        user.userID = parseInt(user.userID);

        if(user.userID !== this.currentUser.id) {
          filteredUsers.push(user);
        }
      }

      this.allUsers = filteredUsers;
    }
  },
  created: function () {
    this.getAllUsers();
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
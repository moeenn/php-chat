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
      allUsers: [
        { 
          id: 1,
          name: "Asad Ullah", 
        },
        { 
          id: 2,
          name: "Shah Nawaz", 
        },
        { 
          id: 3,
          name: "Zahid Sheikh", 
        },
        { 
          id: 5,
          name: "Raheel Faiz", 
        },
      ],
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
      const headers = {
        method: 'GET',
        headers: new Headers({"Connection": "keep-alive", "Accept": "application/json"}),
      };

      const res = await fetch("http://localhost:8000/users/all.php", headers);
      const allUsers = await res.json();
      
      if(!res.ok) {
        console.warn("Unable to Get Users");
        console.log(allUsers);
        return;
      }

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
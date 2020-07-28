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
      selectedUserID: 1,
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
  },
  components: {
    UserMenu,
    AllUsers,
  },
  methods: {
    changeSelectedUser: function (userID) {
      this.selectedUserID = userID;
    }
  },
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
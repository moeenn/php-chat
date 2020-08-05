<template>
  <div id="chatWindow">
    <div id="usersArea">
      <UsersArea 
        v-bind:currentUser="currentUser"
        v-bind:selectedUserID="selectedUserID"
        v-bind:allUsers="filteredUsers"
        @Logout="logout"
        @ChangeSelectedUser="changeSelectedUser"  
      />
    </div>

    <div id="chatArea">
      <ChatArea 
        v-bind:currentUser="currentUser" 
        v-bind:selectedUserID="selectedUserID" 
        v-bind:chats="chats" 
        @SendMessage="sendMessage"
      />
    </div>

    <div id="selectUser" v-if="!currentUser.is_selected">
      <SelectUser 
        v-bind:allUsers="allUsers" 
        @ChangeCurrentUser="changeCurrentUser" 
      />
    </div>
  </div>
</template>

<script>
import UsersArea from '@/components/UsersArea.vue'
import ChatArea from '@/components/ChatArea.vue'
import SelectUser from '@/components/SelectUser.vue'

export default {
  name: 'Chat',
  data: () => {
    return {
      currentUser: {
        is_selected: false,
        id: 0,
        name: "",
      },
      selectedUserID: 0,
      chats: [],
      allUsers: [],
      filteredUsers: [],
    };
  },
  components: {
    UsersArea,
    ChatArea,
    SelectUser,
  },
  methods: {
    getAllUsers: async function () {
      const res = await fetch("http://localhost:8000/users/all.php");
      const allUsers = await res.json();
      
      if(!res.ok) {
        console.warn("Unable to Get Users");
        console.log(allUsers);
        return;
      }

      // convert userIDs to int
      let users = [];
      for(const user of allUsers.users) {
        user.userID = parseInt(user.userID);
        users.push(user);
      }
      this.allUsers.users = users;
      this.allUsers = allUsers.users;
    },

    changeSelectedUser: function (userID) {
      this.selectedUserID = userID;
      this.getSelectedUserChats(); 
    },

    changeCurrentUser: function (userID) {
      this.currentUser.is_selected = true;
      this.currentUser.id = userID;

      // set user name
      for(const user of this.allUsers) {
        if (user.userID == this.currentUser.id) {
          this.currentUser.name = user.fullName;
        }
      }

      // console.log(this.currentUser);
      this.filterCurrentUser();
      // console.log(this.filteredUsers);
    },

    filterCurrentUser: function () {
      for(const user of this.allUsers) {
        if (user.userID != this.currentUser.id) {
          this.filteredUsers.push(user);
        }
      }
    },

    getSelectedUserChats: async function () {
      const body = {
        uid_1: this.currentUser.id,
        uid_2: this.selectedUserID
      }

      const headers = {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(body),
      };

      const res = await fetch("http://localhost:8000/messages/conversation.php", headers);
      const chats = await res.json();

      if(!res.ok) {
        console.warn("Unable to get conversations");
        return;
      }

      this.chats = chats;
    },

    sendMessage: async function (newMessage) {
      const headers = {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(newMessage),
      };

      const res = await fetch('http://localhost:8000/messages/send.php', headers);
      const messageID = await res.json();

      if(!res.ok) {
        console.warn("Unable to send Message");
        return;
      }

      newMessage.messageID = messageID.messageID;
      this.chats.push(newMessage);
    },

    logout: function () {
      this.currentUser.is_selected = false;
      this.currentUser.id = 0;
      this.currentUser.name = "";
    }
  },
  created: function () {
    this.getAllUsers();
  }
}
</script>

<style scoped>

#chatWindow {
  display: grid;
  grid-gap: none;
  grid-template-columns: 30rem calc(100vw - 30rem);
  grid-template-rows: 100vh;
  grid-template-areas: 
    "usersArea  chatArea";
}

#usersArea {
  grid-area: usersArea;
  background-color: rgba(0,0,0,0.02);
  overflow-y: auto;
  color: black;
}

#chatArea {
  grid-area: chatArea;
  overflow-y: auto;
  background-color: white;
}

#selectUser {
  display: absolute;
  z-index: 10;
  top: 0;
  left: 0;
}

</style>

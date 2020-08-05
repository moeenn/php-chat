<template>
  <div id="chatWindow">
    <div id="usersArea">
      <UsersArea 
        v-bind:currentUser="currentUser"
        v-bind:selectedUserID="selectedUserID"
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
  </div>
</template>

<script>
import UsersArea from '@/components/UsersArea.vue'
import ChatArea from '@/components/ChatArea.vue'

export default {
  name: 'Chat',
  data: () => {
    return {
      currentUser: {
        id: 1,
        name: "Moeen",
      },
      selectedUserID: 1,
      chats: [],
    };
  },
  components: {
    UsersArea,
    ChatArea,
  },
  methods: {
    changeSelectedUser: function (userID) {
      this.selectedUserID = userID;
      this.getSelectedUserChats();
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
    }
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

</style>

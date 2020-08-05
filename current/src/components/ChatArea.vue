<template>
  <div id="chatArea">

    <div id="chatBubbles">
      <ChatBubbles 
        v-bind:chats="chats"
        v-bind:currentUser="currentUser"
      />
    </div>

    <div id="newMessage">
      <NewMessage 
        @CreateMessage="createMessage"
      />
    </div>

  </div>  
</template>

<script>
import ChatBubbles from '@/components/ChatBubbles.vue'
import NewMessage from '@/components/NewMessage.vue'


export default {
  name: 'ChatArea',
  props: {
    currentUser: Object,
    selectedUserID: Number,
    chats: Array,
  },
  components: {
    ChatBubbles,
    NewMessage,
  },
  methods: {
    createMessage: function (messageText) {
      const newMessage = {
        senderID: this.currentUser.id,
        recipientID: this.selectedUserID, 
        messageText: messageText,
      };
      this.$emit("SendMessage", newMessage);
    },
  }
}
</script>

<style scoped>

#chatArea {
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: calc(100vh - 7rem) 7rem;
  grid-template-areas: 
    "chatBubbles"
    "newMessage";
}

#chatBubbles {
  grid-area: chatBubbles;
  overflow-y: auto;
}

#newMessage {
  grid-area: newMessage;
}

</style>
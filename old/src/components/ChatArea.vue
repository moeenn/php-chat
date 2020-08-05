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
  },
  data: () => {
    return ({
      chats: [
        // only chats involving current user
        { 
          id: 1,
          senderID: 2,
          recipientID: 4,
          messageText: "This is the first message sent through system",
        },
        { 
          id: 2,
          senderID: 4,
          recipientID: 2,
          messageText: "This is the reply of the first message sent through system",
        },
        { 
          id: 3,
          senderID: 4,
          recipientID: 2,
          messageText: "Another message sent to Kamran",
        },
        { 
          id: 4,
          senderID: 2,
          recipientID: 4,
          messageText: "Shah sending message to current User",
        },        
      ],
    });
  },
  components: {
    ChatBubbles,
    NewMessage,
  },
  methods: {
    createMessage: function (messageText) {
      const newMessage = {
        id: 200,
        senderID: this.currentUser.id,
        recipientID: this.selectedUserID, 
        messageText: messageText,
      };
      this.chats.push(newMessage);
    },
  },
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
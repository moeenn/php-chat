<template>
  <div id="chatWindow">
    <div id="user">
      <UserMenu v-bind:currentUser="currentUser" />
    </div>

    <div id="prevChats">
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
      <PrevChatUser userName="Sana Ullah" />
    </div>

  
    <div id="currentChat" class="pv-2 ph-5">
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" v-bind:right="true" />
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" />
      <ChatMessage msg="This is a simple Message" v-bind:right="true" />
      <ChatMessage msg="qwkcjqwbcqklwjbcqlkwjbcqkwjbckqwjbcqkjwbcqkjwbckqwjbqlkbcqlkjbckqjwbclkqjbw qwkcjqwbcqklwjbcqlkwjbcqkwjbckqwjbcqkjwbcqkjwbckqwjbqlkbcqlkjbckqjwbclkqjbw" />
    </div>

    <div id="newMessage">
      <NewMessage />
    </div>

  </div>
</template>

<script>
import UserMenu from '@/components/UserMenu.vue'
import PrevChatUser from '@/components/PrevChatUser.vue'
import NewMessage from '@/components/NewMessage.vue'
import ChatMessage from '@/components/ChatMessage.vue'

export default {
  name: 'Chat',
  data: () => {
    return {
      currentUser: "Shah Nawaz",
      prevChatUsers: [
        { id: 1, name: "Asad Ullah" },
        { id: 2, name: "Shah Nawaz" },
        { id: 3, name: "Kamran Bhatti" },
      ],
    };
  },
  components: {
    UserMenu,
    PrevChatUser,
    NewMessage,
    ChatMessage,
  },
}
</script>

<style scoped>

#chatWindow {
  display: grid;
  grid-gap: none;
  grid-template-columns: 30rem calc(100vw - 30rem);
  grid-template-rows: 7rem calc(100vh - 14rem) 7rem;
  grid-template-areas: 
    "user       currentChat"
    "prevChats  currentChat"
    "prevChats  newMessage";
}

#user {
  grid-area: user;
}

#prevChats {
  grid-area: prevChats;
  background-color: rgba(0,0,0,0.02);
  overflow-y: auto;
  color: black;
}

#currentChat {
  grid-area: currentChat;
  overflow-y: auto;
}

</style>

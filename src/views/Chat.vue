<template>
  <div id="chatWindow">
    <div id="usersArea">
      <UsersArea 
        v-bind:currentUser="currentUser" 
      />
    </div>

    <div id="chatArea">
      <ChatArea v-bind:currentUser="currentUser" />
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
        id: 4,
        name: "Shah Alam",
      },
    };
  },
  components: {
    UsersArea,
    ChatArea,
  },
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

<template>
  <div id="chatBubbles" class="pv-2 ph-5">
    <div v-for="message in chats" :key="message.messageID">
      <ChatMessage 
        v-bind:msg="message.messageText"
        v-bind:alignRight="message.senderID == currentUser.id"
      />
    </div>
  </div>  
</template>

<script>
import ChatMessage from '@/components/ChatMessage.vue'

export default {
  name: 'ChatBubbles',
  props: {
    chats: Array,
    currentUser: Object,
  },
  components: {
    ChatMessage,
  }
}
</script>
<template>
  <div id="chatMessage" v-bind:class="{'right-align': alignRight}">
    <div class="bubble mb-2 p-1 rounded-corners" v-bind:class="{'bg-dull': (!alignRight)}">
      <span class="mb-1 ph-1" id="msg">{{ msg }}</span>
      <br>
      <span class="fg-size-small fg-align-right" id="sendingTime">{{ sendingTime }}</span>
    </div>
  </div>  
</template>

<script>
export default {
  name: 'ChatMessage',
  props: {
    msg: String,
    alignRight: Boolean,
    sendingTime: String,
  }
}
</script>

<style scoped>

.right-align {
  justify-content: flex-end;
}  

.bg-dull {
  background-color: rgba(101,138,181,1.0) !important;
}

#chatMessage {
  display: flex;
}

#chatMessage .bubble {
  background-color: var(--accent-color-primary);
  color: white;
  width: 45rem;
  overflow-wrap: break-word;
  line-height: var(--fg-line-height);
}

#chatMessage #sendingTime {
  display: flow-root;
  color: rgba(255,255,255,0.7);
}

#chatMessage #msg {
  display: inline-block;
}

@media only screen and (max-width: 950px) {
  #chatMessage .bubble {
    width: 85%;
  }
}

</style>
<template>
  <div id="chatMessage" v-bind:class="{'right-align': right}">
    <div class="bubble mb-2 p-2 rounded-corners" v-bind:class="{'bg-dull': (!right)}">
      <span>{{ msg }}</span>
    </div>
  </div>  
</template>

<script>
export default {
  name: 'ChatMessage',
  props: {
    msg: String,
    right: Boolean,
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

@media only screen and (max-width: 950px) {
  #chatMessage .bubble {
    width: 85%;
  }
}

</style>
<template>
  <div id="NewMessage" class="bg-color-dark">
    <div class="d-flex pv-1 ph-5">
      <textarea class="flex-6"></textarea>
      <button id="sendButton" title="Send Message">
        <img id="sendIcon" src="../assets/images/send.svg">
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NewMessage',
}
</script>

<style scoped>

#newMessage textarea {
  background-color: rgba(255,255,255,0.8);
  min-height: auto;
  resize: none;
  border: none;
  border-radius: 0;
}

#newMessage textarea:focus {
  border: var(--border-size-normal) solid var(--accent-color-primary);
}

#newMessage #sendIcon {
  width: 2rem;
  height: 2rem;
}

#newMessage #sendButton {
  border-radius: 0;
  max-width: 3rem;
  border: none;
  background-color: rgba(255,255,255,0.8);
  padding: var(--spacing-1) var(--spacing-4);
}

</style>
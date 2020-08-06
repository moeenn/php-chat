<template>
  <div id="NewMessage" class="bg-color-dark">
    <div class="d-flex pv-1 ph-5">
      <textarea class="flex-6" v-model="messageText" v-bind:maxlength="maxLength"></textarea>
      <button id="sendButton" title="Send Message" v-on:click="createMessage" v-bind:disabled="submitDisabled"> 
        <img id="sendIcon" src="../assets/images/send.svg">
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NewMessage',
  data: function () {
    return ({
      messageText: "",
      maxLength: 256,
      submitDisabled: false,
    });
  },
  methods: {
    checkMessageLength: function () {
      if(this.messageText.length >= this.maxLength) {
        this.submitDisabled = true;
      }
    },

    getCurrentTime: function () {
      const date = new Date();
      const pad = (n) => {
        return n < 10 ? '0'+n : n;
      };

      const fullDate = `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDay())}`;
      const time = `${pad(date.getHours())}-${pad(date.getMinutes())}-${pad(date.getSeconds())}`;

      return `${fullDate} ${time}`;
    },

    createMessage: function () {
      const msg = {
        messageText: this.messageText,
        sendingTime: this.getCurrentTime(),
      };
      this.$emit('CreateMessage', msg);
      this.messageText = "";
    },
  },
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
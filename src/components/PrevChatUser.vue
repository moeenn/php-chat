<template>
  <div id="prevChatUser" class="d-flex p-2">
    <img id="userIcon" src="../assets/images/user.svg">
    <span id="userName">{{ userName }}</span>
  </div>  
</template>

<script>
export default {
  name: 'PrevChatUser',
  props: {
    userName: String,
  }
}
</script>


<style scoped>

#prevChatUser {
  cursor: pointer;
}

#prevChatUser:active {
  background-color: rgba(0,0,0,0.06);
  color: white;
}

#userIcon {
  height: 4rem;
  width: 4rem;
  margin: auto var(--spacing-2) auto 0;
}

#userName {
  display: inline;
  vertical-align: bottom;
  color: rgba(0,0,0,0.55);
  margin: auto 0;
}

</style>
<template>
  <div id="user" 
    class="d-flex p-2" 
    v-bind:class="{'active': selected}" 
    v-on:click="changeSelectedUser(user.id)"
  >
    <img id="userIcon" src="../assets/images/user.svg">
    <span id="userName">{{ user.name }}</span>
  </div>  
</template>

<script>
export default {
  name: 'User',
  props: {
    user: Object,
    selected: Boolean,
  },
  methods: {
    changeSelectedUser: function (userID) {
      this.$emit('ChangeSelectedUser', userID);
    },
  },
}
</script>


<style scoped>

#user {
  cursor: pointer;
}

#user:hover {
  background-color: rgba(0,0,0,0.02);
}

.active {
  background-color: rgba(0,0,0,0.04);
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
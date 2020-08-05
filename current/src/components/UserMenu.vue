<template>
  <div id="userMenu">
    <img src="../assets/images/user.svg" alt="user icon" id="userIcon" />
    <h5 id="userName">{{ currentUser }}</h5>
  </div>  
</template>

<script>
export default {
  name: 'UserMenu',
  props: {
    currentUser: String,
  }
}
</script>

<style scoped>

#userMenu {
  display: flex;
  background-color: rgba(0,0,0,0.08);
  width: 100%;
  height: 100%; 
  padding: var(--spacing-1) var(--spacing-2);
}  

#userMenu:hover {
  filter: brightness(0.9);
}

#userMenu #userIcon {
  height: 4rem;
  width: 4rem;
  margin: auto var(--spacing-2) auto 0;
}

#userMenu #userName {
  display: inline;
  vertical-align: bottom;
  color: rgba(0,0,0,0.55);
  margin: auto 0;
}

#userMenu #logout {
  margin: auto 0;  
}

#userMenu #logoutIcon {
  height: 2rem;
  width: 2rem;
}

#userMenu #logoutIcon:hover {
  filter: brightness(0.1);
}

</style>
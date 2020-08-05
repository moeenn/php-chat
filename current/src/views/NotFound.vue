<template>
  <div id="notFound">
    <section class="p-0">
      <div id="message">
        <h1 class="fg-color-dull mb-2">Page Not Found</h1>
        <p>Looks like you are trying to access a Page that doesn't exist!</p>
        <br>
        <router-link to="/">Return Home</router-link>
      </div>
    </section>
  </div>
</template>

<style scoped>

#notFound {
  display: flex;
  height: 100vh;
  width: 100vw;
  background-color: var(--bg-color-dull);
}

#notFound section {
  display: flex;
  width: 100%;
  text-align: center;
}

#notFound section #message {
  width: 50rem;
  margin: auto;
}

a {
  font-weight: normal;
}

</style>

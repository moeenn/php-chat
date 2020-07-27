<template>
  <div class="flash-message" :class="type">
    <span class="ph-2">{{ msg }}</span>
  </div>  
</template>

<script>
export default {
  name: 'Message',
  props: {
    msg: String,
    type: String,
  }
}
</script>

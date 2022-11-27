<template>
  <div class="container">
    <animals-popover />
    <animal-form v-if="category" />
    <animal-aviary />
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "App",
  computed: {
    ...mapState({
      category: 'category'
    })
  }
}
</script>

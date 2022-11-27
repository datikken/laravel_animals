<template>
  <div class="container">
    <animals-popover />
    <animal-form v-if="category" />
  </div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "App",
  watch: {
    category(newVal, oldVal) {
      console.log(newVal, 'newVal')
    }
  },
  computed: {
    ...mapState({
      category: 'category'
    })
  }
}
</script>

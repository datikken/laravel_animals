<template>
  <div class="container">
    <animals-popover/>
    <animal-form v-if="category"/>
    <animal-aviary/>
  </div>
</template>

<script>
import {mapState} from "vuex";
import {ENV} from "./app";

export default {
  name: "App",
  computed: {
    ...mapState({
      category: 'category'
    })
  },
  mounted() {
    if (ENV === 'development') {
      window.addEventListener('beforeunload', async () => {
        await axios.post('/kill_em_all');
      });
    }
  }
}
</script>

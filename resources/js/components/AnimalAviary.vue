<template>
<div class="aviary">
  {{ animals }}
</div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "AnimalAviary",
  computed: {
    ...mapState(['animals'])
  }
}
</script>

<style>
.aviary {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

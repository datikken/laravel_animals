<template>
<div class="aviary">
  <div class="aviary_item" v-if="summoned.length > 0" v-for="animal in summoned">
    <Animal :animal="animal" />
  </div>
</div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "AnimalAviary",
  data: () => ({
    summoned: []
  }),
  computed: {
    ...mapState(['animals'])
  },
  watch: {
    animals(newVal) {
      if(this.summoned.length === 0) {
        this.summoned = [...newVal];
      } else {
        const diff = _.differenceWith(newVal.map(el => el.kind), this.summoned.map(el => el.kind));
        const newbie = newVal.find(el => el.kind === diff[0]);
        this.summoned.push(newbie);
      }
    }
  }
}
</script>

<style>
.aviary {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
}
</style>

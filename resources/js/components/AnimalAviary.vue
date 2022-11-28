<template>
<div class="aviary">
  <div class="aviary_item" v-if="summonedCategories.length > 0" v-for="animal in summonedCategories">
    <Animal :animal="animal" />
  </div>
</div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "AnimalAviary",
  data: () => ({
    summonedCategories: []
  }),
  computed: {
    ...mapState(['animals'])
  },
  watch: {
    animals(newVal) {
      if(this.summonedCategories.length === 0) {
        newVal.map(el => this.fetchCategoryByCategory(el));
      } else {
        const diff = _.differenceWith(newVal, this.summonedCategories.map(el => el.kind));
        this.fetchCategoryByCategory(diff);
      }
    }
  },
  methods: {
    async fetchCategoryByCategory(cat) {
      const { data } = await axios.get(`/animals/${cat}`);
      this.summonedCategories.push(data[0]);
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
  gap: 10px;
}
</style>

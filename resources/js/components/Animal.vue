<template>
<div
    v-if="pet"
    class="animal"
    @click="growOld()"
>
  <img
      :class="{ shake: please }"
      :style="{
        width: `${pet.size}px`
      }"
      :src="`/images/pets/${animal.kind}.svg`"
      :alt="animal.kind"
  >
</div>
</template>

<script>
export default {
  name: "Animal",
  data: () => ({
    please: false,
    pet: null,
    ivl: 0,
    speed: 500,
  }),
  props: {
    animal: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.startToGrow();
  },
  methods: {
    async growOld() {
      const name = this.$props.animal.name;
      const { data: { data } } = await axios.post('animals/age', {
        name
      });
      return data;
    },
    async startToGrow() {
      clearInterval(this.ivl);
      let stopFlag = false;
      this.ivl = setInterval(async () => {
        if(this.pet && this.pet.age === parseInt(this.pet.category.max_age)) {
          stopFlag = true;
        }

        if(stopFlag) {
          clearInterval(this.ivl);
          this.please = true;
        }

        this.pet = await this.growOld();
      }, this.speed);
    }
  },
}
</script>

<style>
.shake {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  transform: translate3d(0, 0, 0);
  opacity: 50%;
}

@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }

  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>

<template>
<div class="animal">
  <img
      :style="{
        width: `${width}px`
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
    age: 1,
    size: Math.floor(Math.random() * 6) + 1,
    ivl: 0,
    speed: 100,
  }),
  props: {
    animal: {
      type: Object,
      required: true
    }
  },
  computed: {
    width() {
      const animal = this.$props.animal;
      if (this.ivl === 0) {
        this.updateTimer();
      }

      console.log(this.size, this.age, animal.kind)

      return this.size;
    }
  },
  methods: {
    updateTimer() {
      clearInterval(this.ivl);

      const maxSize = this.$props.animal.max_size;
      const maxAge = this.$props.animal.max_age;
      const factor = this.$props.animal.grow_factor;

      this.ivl = setInterval(() => {
        if(this.age < maxAge) {
          this.age = this.age + 1;

          if(this.size < maxSize) {
            this.size = this.size + 1 * factor;
          }
        }
      }, this.speed * factor);
    }
  },
}
</script>

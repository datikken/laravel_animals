<template>
  <div
      class="popover"
      :class="{
        'popover--open': state
      }"
  >
    <img
        class="popover_icon"
        src="/images/icons/plus_black.svg"
        alt="+"
        @click="togglePopover"
    />
    <ul class="popover_list">
      <li
          class="popover_btn"
          :class="`popover_btn--${item}`"
          v-for="item in available"
          @click="createAnimal(item)"
      >
        <img class="popover_btn_icon" :src="`/images/icons/${item}.svg`" alt="">
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "AnimalsPopover",
  data: () => ({
    state: false,
    available: ['python', 'dog', 'elephant', 'cat']
  }),
  methods: {
    togglePopover() {
      this.state = !this.state;
    },
    createAnimal(type) {

    }
  }
}
</script>
<style lang="scss">
$gray: #D7CCC8;

.popover {
  display: flex;
  align-items: center;
  padding: 4px 0;
  border-radius: 30px 8px 8px 30px;
  position: absolute;
  top: 50px;
  left: 50px;
  width: 48px;
  height: 48px;
  max-width: 256px;
  transition: all .1s ease-in-out;
  overflow: hidden;

  &--open {
    background: $gray;
    width: 100%;
  }
}

.popover_icon {
  position: absolute;
  height: 48px;
}
.popover_list {
  list-style: none;
  align-items: center;
  padding: 0;
  margin: 0;
  transition: width 1s;
  display: flex;
}

.popover_btn {
  display: inline-flex;
  margin-right: 6px;

  &:first-child {
    margin-left: 58px;
  }

  &:last-child {
    margin-right: 12px;
  }
}

.popover_btn_icon {
  width: 40px;
  height: 40px;
}
</style>

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
          :class="`popover_btn--${item.kind} ${summoned.includes(item.kind) ? 'popover_btn--disabled' : ''}`"
          v-for="item in categories"
          @click="createAnimal(item)"
      >
        <img class="popover_btn_icon" :src="`/images/icons/animals/${item.kind}.svg`" alt="">
      </li>
    </ul>
  </div>
</template>

<script>
import {mapActions, mapState} from 'vuex';

export default {
  name: "AnimalsPopover",
  data: () => ({
    state: false,
    categories: [],
    summoned: []
  }),
  computed: {
    ...mapState({
      category: state => state.category
    }),
  },
  methods: {
    ...mapActions([
      'SET_CATEGORY'
    ]),
    togglePopover() {
      this.state = !this.state;
    },
    createAnimal(animal) {
      if (this.summoned.includes(animal.kind) || this.category) {
        return;
      }
      this.summoned.push(animal.kind);
      this.SET_CATEGORY(animal);
    },
    async fetchCategories() {
      try {
        const {data} = await axios.get('/animal_kinds');
        this.categories = data;
      } catch (err) {
        console.warn(err);
      }
    }
  },
  async mounted() {
    this.fetchCategories();
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
  max-width: 249px;
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
  cursor: pointer;
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
  cursor: pointer;

  &:first-child {
    margin-left: 58px;
  }

  &:last-child {
    margin-right: 12px;
  }

  &--disabled {
    opacity: 50%;
  }
}

.popover_btn_icon {
  width: 40px;
  height: 40px;
}
</style>

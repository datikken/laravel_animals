<template>
  <form class="animal_form">
    <div class="animal_form_text">
      <p v-if="!error" class="animal_form_suggest">Type your pet's name:</p>
      <p v-else class="animal_form_err">{{ error }}</p>
      <span class="animal_form_close" @click="closeForm"></span>
    </div>
    <input type="text" class="animal_form_name" ref="input" v-model="name"/>
    <button class="animal_form_button" @click="submitForm">Send</button>
  </form>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
  name: "AnimalForm",
  data: () => ({
    name: '',
    error: false
  }),
  computed: {
    ...mapState({
      category: state => state.category
    }),
    kind() {
      return this.category.kind;
    }
  },
  methods: {
    ...mapActions(['RESET', 'ADD_ANIMAL']),
    closeForm() {
      this.RESET()
    },
    submitForm(e) {
      e.preventDefault();
      axios.post('/animals', {
        name: this.name,
        kind: this.kind
      })
          .then(({ data }) => {
            if(data.error) {
              this.error = data.data;
              return;
            }
            this.ADD_ANIMAL(this.name);
            this.RESET();
          })
          .catch(function (error) {
            console.log(error);
          });
    }
  },
  mounted() {
    this.$refs.input.focus();
  }
}
</script>

<style>
.animal_form {
  display: flex;
  flex-direction: column;
  position: absolute;
  top: 25%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.animal_form_suggest, .animal_form_err {
  margin: 0;
}

.animal_form_err {
  color: red;
}

.animal_form_text {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.animal_form_close {
  width: 24px;
  height: 24px;
  margin-bottom: 10px;
  transform: rotate(45deg);
  background-image: url('/images/icons/plus_black.svg');
  background-size: cover;
  background-repeat: no-repeat;
  align-self: flex-end;
  cursor: pointer;
}

.animal_form_name {
  font-size: 36px;
  width: 550px;
  height: 50px;
  background-color: transparent;
  border: 2px solid black;
  border-radius: 5px;
  margin-bottom: 10px;
}
.animal_form_button {
  height: 40px;
  width: 100px;
  border-radius: 10px;
  border: 2px solid;
  font-weight: 600;
  cursor: pointer;
}
</style>

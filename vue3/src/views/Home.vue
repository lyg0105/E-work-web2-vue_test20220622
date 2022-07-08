<template>
  <h1>Home Page</h1>
  {{ counter }}
  <button @click="inc">inc</button>
  {{m_count}}
</template>
<script>
import { computed } from "vue";
import { useStore } from "vuex";
export default {
  name: 'MyHome',
  computed:{
    m_count(){
      return this.$store.state.counter
    }
  },
  setup() {
    const store = useStore();
    const counter = computed(() => store.state.counter);
    const time2 = computed(() => store.getters);
    const inc = () => store.commit("setCounter", counter.value + 1);

    return { counter, inc, time2 };
  }
}
</script>
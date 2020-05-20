<template>
  <div class="pref">
    <section class="content">
      <p class="question">都道府県を選択</p>
      <select class="list pref" v-model="selectPref">
        <option value="">選択してください</option>
        <option :value="list.id" v-for="list in prefList" :key="list.id">{{ list.name }}</option>
      </select>

      <btn name="つぎへ" className="btn" to="Town" :prefId="(selectPref)? selectPref : '0'" :isDisabled="(selectPref)? false : true"></btn>
    </section>

    <btn name="&lt; もどる" className="btn back" to="Home"></btn>
  </div>
</template>

<script>
import btn from '@/components/btn.vue'

export default {
  name: 'Pref',
  components: {
    btn
  },
  data() {
    return {
      prefList: [],
      selectPref: '',
    }
  },
  mounted: function() {
    let that = this;
    this.axios.get('http://127.0.0.1//water-rank/php/getPref.php')
    .then( function(response) {
      that.prefList = response.data;
    })
    .catch(function (error) {
      console.log(error);
    })
  },
}
</script>

<style scoped lang="scss">


</style>

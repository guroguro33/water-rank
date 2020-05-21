<template>
  <div class="pref">
    <section class="content">
      <p class="question">市町村等を選択</p>
      <select class="list pref" v-model="selectTown">
        <option value="">選択してください</option>
        <option :value="list.id" v-for="list in townList" :key="list.id">{{ list.org_name }}</option>
      </select>

      <btn name="結果へ" className="btn" to="Result" :townId="selectTown" :isDisabled="(selectTown)? false : true"></btn>
    </section>

    <btn name="&lt; もどる" className="btn back" to="Pref"></btn>
  </div>
</template>

<script>
import btn from '@/components/btn.vue'

export default {
  name: 'Town',
  components: {
    btn
  },
  data() {
    return {
      prefId: this.$route.params.pid,
      townList: [],
      selectTown: '',
    }
  },
  mounted: function() {
    let that = this;
    this.axios.get('https://kurosuke-web.com/water-rank/getTown.php', {
      params: {
        prefId: this.prefId,
      }
    })
    .then( function(response) {
      that.townList = response.data;
    })
    .catch(function (error) {
      console.log(error);
    })
  },
}
</script>

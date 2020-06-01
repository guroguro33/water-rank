<template>
  <div class="pref">
    <section class="content result">
      <p class="rank">
        あなたに水を送っている
        <br />
        <span class="bold f-l">{{ resultData.org_name }}</span
        >の <br />全国水道料金ランキング(安さ)は
        <br />
        <span class="bold f-l">
          <animated-number
            :value="valueNational"
            :formatValue="formatToRank"
            :duration="duration1"
          /> </span
        >／1263団体です！
      </p>
      <p class="rank">
        都道府県内では
        <br />
        <span class="bold f-l">
          <animated-number
            :value="valueGroup"
            :formatValue="formatToRank"
            :duration="duration2"
          />
        </span>
        ／{{ resultData.group_count }}団体です！
      </p>
      <p class="rank">
        月額使用料金(20m
        <sup>3</sup>使用時)は
        <br />
        <span class="bold f-l">
          <animated-number
            :value="valueFee"
            :formatValue="formatToPrice"
            :duration="duration3"
          /> </span
        >です！
      </p>

      <p class="msg">
        現在、人口減少と節水機器の普及により水道の売り上げは右肩下がりです。
        <br />また、高度経済成長期に普及した水道施設の耐用年数は超過し、更新費用は右肩上がりです。
      </p>

      <p class="msg">
        料金の値上げは避けられません。
        <br />
        <span class="line"
          >しかし仮に３０％上がったとしても、家庭のスマホ月額料金より安いと思いませんか？</span
        >
      </p>

      <p class="msg">
        自分の町の未来の水道について、
        <br />少しでも考えてもらえたら幸いです。
      </p>

      <p class="msg f-sm">※順位・料金などは2016年度データ</p>

      <p class="msg f-sm">
        出典：週間ダイヤモンド
        <br />
        <a href="https://diamond.jp/articles/-/190843" target="_blank"
          >https://diamond.jp/articles/-/190843</a
        >
      </p>
    </section>

    <btn name="&lt; TOPへもどる" className="btn back" to="Home"></btn>
  </div>
</template>

<script>
import btn from "@/components/btn.vue";
import AnimatedNumber from "animated-number-vue";

export default {
  name: "Result",
  components: {
    btn,
    AnimatedNumber
  },
  data() {
    return {
      townId: this.$route.params.pid,
      resultData: [],
      valueNational: 0,
      valueGroup: 0,
      valueFee: 0,
      duration1: 1500,
      duration2: 2500,
      duration3: 3500
    };
  },
  methods: {
    formatToRank(value) {
      return `第${Number(value).toFixed(0)}位`;
    },
    formatToPrice(value) {
      return `${Number(value).toFixed(0)}円`;
    }
  },
  created: function() {
    let that = this;
    this.axios
      .get("https://kurosuke-web.com/water-rank/getResult.php", {
        params: {
          townId: this.townId
        }
      })
      .then(function(response) {
        that.resultData = response.data;
        that.valueNational = that.resultData.national_rank;
        that.valueGroup = that.resultData.group_rank;
        that.valueFee = that.resultData.water_fee;
      })
      .catch(function(error) {
        console.log(error);
      });
  }
};
</script>

<style scoped lang="scss">
// ==================================
// result
// ==================================
.result {
  padding: $space_xxl 0;
  justify-content: start;
}
.bold {
  font-weight: 700;
}
.f-sm {
  font-size: $font-size-s;
}
.f-l {
  font-size: $font-size-l;
}
.rank {
  margin-bottom: $space_xl;
  line-height: 2;
}
.msg {
  margin-bottom: $space_xl;
  width: 80%;
  line-height: inherit;
  text-align: left;
  word-wrap: break-word;
}
.line {
  background: linear-gradient(transparent 70%, #ffff00 0%);
}
</style>

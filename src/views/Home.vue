<template>
  <div class="home">
    <section class="content">
    </section>

    <btn name="さっそく調べる" className="btn" to="Pref"></btn>
  </div>
</template>

<script>
import btn from '@/components/btn.vue'

export default {
  name: 'Home',
  components: {
    btn
  }
}
</script>

<style scoped lang="scss">
.content{
  background: none;
  @include mq(){
    min-height: 340px;
  }
}

</style>


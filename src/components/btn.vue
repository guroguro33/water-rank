<template>
  <div class="hello">
    <router-link :to="{ name: to, params: { pid: (townId)? townId : prefId} }" :class="className" tag="button" :disabled="isDisabled">{{ name }}</router-link>
  </div>
</template>

<script>
export default {
  name: 'Btn',
  props: {
    name: String,
    to: String,
    className: String,
    prefId: String,
    townId: String,
    isDisabled: Boolean,
  },
}
</script>

<style scoped lang="scss">
.btn{
  margin: 0 auto;
  width: 150px;
  height: 50px;
  background-color: #004BB1;
  border-radius: 20px;
  border: none;
  line-height: 50px;
  font-size: inherit;
  color: $color_w;
  cursor: pointer;
  transition: transform .5s ease;
  &:hover{
    transform: scale(1.05);
    transition: transform .5s ease;
  }
  &:active{
    opacity: .7;
  }
  &:disabled{
    background-color: #4f4f4f;
  }
}
.back{
  background: none;
  font-weight: 500;
  color: $font-color-default;
}
</style>

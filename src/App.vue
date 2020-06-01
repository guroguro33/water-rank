<template>
  <div id="app">
    <transition name="fadeIn" mode="out-in">
      <router-view />
    </transition>
  </div>
</template>

<style lang="scss">
// SPAアニメーション
.fadeIn-enter-active,
.fadeIn-leave-active {
  transition: opacity 0.3s;
}
.fadeIn-enter,
.fadeIn-leave-to {
  opacity: 0;
}
.fadeIn-enter-to,
.fadeIn-leave {
  opacity: 1;
}
</style>

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

// Modal components
import Modal from './components/Modal'

Vue.config.productionTip = false

// Register global modal components
Vue.component('modal', Modal)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})

Vue.directive('click-outside', {
  bind: function (el, binding, vnode) {
    el.event = function (event) {
      // Check if click is outside specified element
      if (!(el === event.target || el.contains(event.target))) {
        vnode.context[binding.expression](event)
      }
    }
    document.body.addEventListener('click', el.event)
  },
  unbind: function (el) {
    document.body.removeEventListener('click', el.event)
  }
})

// Start Vue instance
new Vue({
  components: {App},

  router

})

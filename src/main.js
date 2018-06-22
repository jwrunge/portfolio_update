// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import $ from 'jquery'

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

  // Globally accessible methods
  methods: {
    // Processing text
    addLineBreaks: function (text) {
      var newstring = '<p>'
      var brokentext = text.split('\n')
      newstring += brokentext.join('</p><p>') + '</p>'
      return newstring
    },

    // Staggering item entry
    beforeEnter: function (el) {
      el.style.opacity = 0
      el.style.left = '-5em'
    },
    enter: function (el, done) {
      var delay = (el.dataset.index * 150) + 500
      setTimeout(function () {
        $(el).animate(
          {opacity: 1, left: 0},
          {complete: done}
        )
      }, delay)
    },
    leave: function (el, done) {
      $(el).css({
        position: 'absolute',
        width: '100%'
      })

      $(el).animate(
        {opacity: 0}, //, left: '5em'},
        {complete: done}
      )
    }
  },

  router

})

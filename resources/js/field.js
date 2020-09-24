Nova.booting((Vue, router, store) => {
  Vue.component('index-prefiller-field', require('./components/IndexField'))
  Vue.component('detail-prefiller-field', require('./components/DetailField'))
  Vue.component('form-prefiller-field', require('./components/FormField'))
})

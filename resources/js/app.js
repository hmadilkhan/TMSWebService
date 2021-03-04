require('./bootstrap');
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.prototype.$route = route
Vue.use(plugin)

const app = document.getElementById('app')

if(app){
    new Vue({
        render: h => h(App, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default,
            },
        }),
    }).$mount(app)
}
import Vue from 'vue'
import VueRouter from "vue-router"
import ProjectComponent from "./components/ProjectComponent";

Vue.use(VueRouter)

export default new VueRouter( {
    mode: 'history',

    routes: [
        {
            path: '/post', component: ProjectComponent
        }
    ]
})

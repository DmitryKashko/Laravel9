import Vue from 'vue'
import VueRouter from "vue-router"

Vue.use(VueRouter)

export default new VueRouter( {
    mode: 'history',

    routes: [
        {
            path: '/projects', component: () => import('./components/Project/Index'),
            name: 'project.index'
        },
        {
            path: '/projects/create', component: () => import('./components/Project/Create'),
            name: 'project.create'
        },
        {
            path: '/projects/:id/edit', component: () => import('./components/Project/Edit'),
            name: 'project.edit'
        },
        {
            path: '/projects/:id', component: () => import('./components/Project/Show'),
            name: 'project.show'
        },
    ]
})

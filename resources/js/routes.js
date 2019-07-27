import Vue from 'vue'
import VueRouter from 'vue-router'
import HomePage from './pages/HomePage'
import AddPage from './pages/AddPage'
import EditPage from './pages/EditPage'
import StatusPage from "./pages/StatusPage";

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/add',
            name: 'add',
            component: AddPage
        },
        {
            path: '/edit/:id',
            name: 'edit',
            component: EditPage
        },
        {
            path: '/status',
            name: 'status',
            component: StatusPage
        },
    ]
})

export {router};

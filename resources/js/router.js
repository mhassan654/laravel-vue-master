import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import methods from './components/pages/methods'
import secondPage from './components/pages/secondPage'
import hooks from './components/pages/basics/hooks.vue'


// project pages
import Home from './admin/pages/home';
import Tags from './admin/pages/tags';
import Category from './admin/pages/category';
import AdminUsers from './admin/pages/adminUsers';
import Login from './admin/pages/login';
import Roles from './admin/pages/roles';
import assignRoles from './admin/pages/assignRoles';
import Blog from './admin/pages/blog';
import blogData from './admin/pages/blogdata';

const routes = [{
        // project routes
        path: '/home',
        component: Home
    },
    {
        // project routes
        path: '/tags',
        component: Tags
    },
    {
        // project routes
        path: '/blog',
        component: Blog
    },
    {
        // project routes
        path: '/category',
        component: Category
    },
    {
        // project routes
        path: '/admin-users',
        component: AdminUsers
    },
    {
        // project routes
        path: '/login',
        component: Login
    }, ,
    {
        // project routes
        path: '/roles',
        component: Roles
    },
    {
        // project routes
        path: '/assignRoles',
        component: assignRoles
    },
    {
        // project routes
        path: '/blogdata',
        component: blogData
    },






















































    {
        // testing routes
        path: '/methods',
        component: methods,
        // name: 'home',
        // meta: {

        // }

    },
    {
        path: '/second-page',
        component: secondPage

    },

    // vue hooks
    {
        path: '/hooks',
        component: hooks
    }
]

export default new Router({
    mode: 'history',
    routes
})
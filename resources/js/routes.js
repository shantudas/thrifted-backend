import Dashboard from "./components/pages/Dashboard.vue";
import Users from "./components/pages/UserList.vue";

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard
    }, {
        path: '/admin/users',
        name: 'admin.users',
        component: Users
    }
]

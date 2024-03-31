import Dashboard from "./components/pages/Dashboard.vue";
import UserList from "./components/pages/users/UserList.vue";
import UserCreate from "./components/pages/users/UserCreate.vue";

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard
    }, {
        path: '/admin/users/list',
        name: 'admin.users.list',
        component: UserList
    },
    {
        path: '/admin/users/create',
        name: 'admin.users.create',
        component: UserCreate
    },
]

import Dashboard from "./components/pages/Dashboard.vue";
import UserList from "./components/pages/users/UserList.vue";
import UserCreate from "./components/pages/users/UserCreate.vue";
import CategoryList from "./components/pages/Category/CategoryList.vue";
import ChildCategoryList from "./components/pages/Category/ChildCategoryList.vue";
import ParentCategoryList from "./components/pages/Category/ParentCategoryList.vue";
import CategoryCreate from "./components/pages/Category/CategoryCreate.vue";

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
    // categories
    {
        path: '/admin/categories/list',
        name: 'admin.categories.list',
        component: CategoryList
    },
    {
        path: '/admin/categories/create',
        name: 'admin.categories.create',
        component: CategoryCreate
    },
    // child categories
    {
        path: '/admin/child-categories/list',
        name: 'admin.child-categories.list',
        component: ChildCategoryList
    },
    // parent categories
    {
        path: '/admin/parent-categories/list',
        name: 'admin.parent-categories.list',
        component: ParentCategoryList
    },
]

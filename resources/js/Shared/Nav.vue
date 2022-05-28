<template>
    <nav class="flex flex-row justify-between mb-6 p-3 text-l">
        <div class="flex items-center">
            <div class="logo space-x-2 ml-5 mr-6">
                <span class="font-bold">My App</span>

                <span class="text-sm" v-if="$page.props.auth">Welcome back, {{ $page.props.auth.user.username }}</span>
            </div>
            <ul class="flex space-x-2">
                <li class="p-2">
                    <NavLink href="/" text="Home" :active="$page.url === '/'">Home 2</NavLink>
                </li>
                <li class="p-2">
                    <NavLink href="/users" :active="$page.component === 'Users/Index'">Users</NavLink>
                </li>
                <li class="p-2">
                    <NavLink href="/settings" :active="$page.component === 'Settings'">Settings</NavLink>
                </li>

            </ul>
        </div>
        <div>
            <ul class="flex space-x-2">
                <li class="p-2">
                    <NavLink method="post" href="/logout" as="button">Log out</NavLink>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import NavLink from "./NavLink";
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
        NavLink
    }
}
</script>

<style scoped>

</style>

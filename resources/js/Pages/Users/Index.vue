<template>
    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>

            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">New user</Link>
        </div>

        <input v-model="search" type="search" placeholder="search..." class="border px-2 rounded-lg" />
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">State</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="user in users.data" :key="user.id">
            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 font-medium">{{user.name}}</td>
            <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                <Link v-if="user.can.edit" :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
            </td>
        </tr>
        </tbody>
    </table>

    <Paginator :links="users.links" />

    <div style="margin-top: 200px;">
        <p>The current time is {{ time }}</p>

        <Link href="/users" preserve-scroll>Refresh</Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import Paginator from "../../Shared/Paginator";
    import {ref, watch} from "vue";
    import {Inertia} from "@inertiajs/inertia";
    import {debounce, throttle} from "lodash";

    let props = defineProps({ users: Object, time: String, filters: Object, can: Object })

    let search = ref(props.filters.search ?? '');

    watch(search, debounce(value => {
        console.log('changed: ', value);
        Inertia.get('/users', {
            search: value
        }, {
            preserveState: true,
            replace: true
        })
    }, 300));
</script>

<style scoped>

</style>

<template>
    <Head title="Login" />

    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded border">
            <div class="mx-auto">
                <h1 class="text-3xl">Login</h1>

                <form @submit.prevent="submit" method="POST" action="/" class="mt-8">
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="email">
                            Email
                        </label>
                        <input v-model="form.email" class="border p-2 w-full"
                               type="email"
                               name="email"
                               id="email"
                               required
                        />
                        <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-s"></div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="password">
                            Password
                        </label>
                        <input v-model="form.password" class="border p-2 w-full"
                               type="password"
                               name="password"
                               id="password"
                               required
                        />
                        <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-s"></div>
                    </div>

                    <div class="mb-6">
                        <button :disabled="form.processing" type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Login</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    layout: null,
}
</script>
<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

let form = useForm({
    email: '',
    password: ''
});

let submit = () => {
    form.post('/login');
}
</script>

<style scoped>

</style>

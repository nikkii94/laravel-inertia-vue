<template>
    <header class="bg-gray-200">
        <Nav />
    </header>

    <main class="p-6 max-w-7xl mx-auto">
        <slot />
    </main>

</template>

<script>
import Nav from "./Nav";
export default {
    components: {
        Nav
    }
}
</script>

<style scoped>

</style>

<script setup>
import Header from '@/Components/app/Header.vue';
</script>

<template>
    <div>
        <Header/>
    </div>
    <main class="max-w-[1366px] mx-auto pt-20">
        <slot/>
    </main>
</template>
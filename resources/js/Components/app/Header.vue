<script setup>
import UserSettingsDropdown from '@/Components/app/UserSettingsDropdown.vue';
</script>

<template>
    <header class="bg-white border-b relative z-20">
        <nav class="flex justify-between items-center max-w-[1366px] mx-auto py-5">
            <Link :href="route('home')" class="uppercase">Store</Link>

            <div v-if="$page.props.auth.user" class="flex gap-x-8 items-center">
                <UserSettingsDropdown/>
            </div>
            <div v-else class="flex items-center gap-x-5 ">
                <Link class="px-3 py-1" :class="{ 'active': $page.props.route.name === 'login' }" :href="route('login')" >Login</Link>            
                <Link class="px-3 py-1" :class="{ 'active': $page.props.route.name === 'register' }" :href="route('register')" >Register</Link>
            </div>
        </nav>
    </header>
</template>
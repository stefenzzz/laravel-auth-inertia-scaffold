<script setup>
import { useForm } from '@inertiajs/vue3';



defineProps({
    status:Boolean
});

const form = useForm({});

const sendEmailVerification = ()=>{

    form.post(route('verify-email'))
}




</script>

<template>

    <section class="">
        <form @submit.prevent="!form.processing && sendEmailVerification()" :class="['w-1/3 bg-white shadow-md py-6 px-4 rounded-md mx-auto space-y-6', { 'opacity-50':form.processing } ]">
            <p class="text-gray-500 text-sm leading-6">Thanks for signing up! Before getting started, please Verify Your Email or click the button below if you haven't received a request for verification in your email <span class="text-blue-500">{{ $page.props.auth.user.email }}</span></p>
            <p v-if="status" class="text-sm text-green-600 leading-5">A new verification link has been sent to the email address you provided during registration.</p>
            <button :disabled="form.processing" :class="{'opacity-60': form.processing}" class="bg-slate-700 px-4 py-2 rounded-md text-sm text-white font-medium">RESEND VERIFICATION EMAIL</button>
            
        </form>
    </section>
</template>
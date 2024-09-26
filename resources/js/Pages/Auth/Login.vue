<script setup>
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';



const form = useForm({
    email:'',
    password:'',
});

const submit = ()=>{
    form.post(route('login'),{
        onError: ()=> form.reset('password'),
    });
}

</script>

<template>
    
    <section>
        <form @submit.prevent="!form.processing && submit()"
         :class="['space-y-6 bg-white mx-white max-w-96 mx-auto p-6 rounded-md shadow-around', {'opacity-50':form.processing} ]">

            <h1 class="text-center text-2xl font-semibold">Sign In</h1>
            <div>
                <TextInput type="text" v-model="form.email" name="email" placeholder="Email"/>
                 <InputError :message="$page.props.errors.email"/>
            </div>
            
            <div>
                <TextInput type="password" v-model="form.password" name="password" placeholder="Password" :message="$page.props.errors.password"/>
                <InputError :message="$page.props.errors.password"/>
            </div>
            
            <div>
                <p class="text-sm">Don't have an account yet? <Link :href="route('register')" class="text-blue-500 font-semibold">Register</Link></p>
            </div>
            <button class="button-gray" :disable="form.processing">Login</button>
        </form>
    </section>
    

</template>
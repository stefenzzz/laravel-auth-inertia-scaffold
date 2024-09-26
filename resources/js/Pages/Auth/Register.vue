<script setup>
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';


const form = useForm({
    name:'',
    email:'',
    password:'',
    password_confirmation:'',
});

const submit = ()=>{
    form.post(route('register'),{
        onError: ()=> form.reset('password','password_confirmation'),
    });
}

</script>

<template>

    <section>
        <form @submit.prevent="!form.processing && submit()" 
        :class="['space-y-6 bg-white mx-white max-w-96 mx-auto p-6 rounded-md shadow-around', {'opacity-50':form.processing}]">

            <h1 class="text-center text-2xl font-semibold">Register</h1>

            <div>               
                <TextInput type="text" v-model="form.name" name="email" placeholder="Name"/>
                <InputError :message="$page.props.errors.name" />
            </div>

            <div>
                <TextInput type="text" v-model="form.email" name="email" placeholder="Email" />
                <InputError :message="$page.props.errors.email" />
            </div>

            <div>
                <TextInput type="password" v-model="form.password" name="password" placeholder="Password" />
                <InputError :message="$page.props.errors.password" />
            </div>

            <div> 
                <TextInput type="password" v-model="form.password_confirmation" name="password_confirmation" placeholder="Retype Password"/>
                <InputError :message="$page.props.errors.password_confirmation" />
            </div>
            
            <div>
                <p class="text-sm">Already have an account? <Link :href="route('login')" class="text-blue-500 font-semibold">Login</Link></p>
            </div>
            <button class="button-gray" :disable="form.processing">Submit</button>
        </form>
    </section>
    
</template>
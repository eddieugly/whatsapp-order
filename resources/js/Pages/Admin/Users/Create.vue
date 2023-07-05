<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue';
import SelectGroup from '@/Components/SelectGroup.vue';

let props = defineProps({
    routeResourceName: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    roles: {
        type: Array,
        required: true,
    },
    create: {
        type: Boolean,
        default: false,
    },
})

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    roleId: null,
});

const submit = () => {
    form.post(route(`admin.${props.routeResourceName}.store`), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Card>
            <div class="items-center p-5 lg:p-10 mx-auto max-w-4xl">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white mb-5">{{ title }}</h5>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <Input v-model="form.name" name="name" id="name" placeholder="Enter Name" label="Name">
                            <template #helper v-if="form.errors.name" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.email" type="email" name="email" id="email" placeholder="Enter Email"
                                label="Email">
                            <template #helper v-if="form.errors.email" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.email }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.password" name="password" type="password" id="password"
                                placeholder="Enter Password" label="Password">
                            <template #helper v-if="form.errors.password" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.password }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.password_confirmation" name="password_confirmation" type="password"
                                id="password_confirmation" placeholder="Enter Password" label="Password Confirmation">
                            <template #helper v-if="form.errors.password_confirmation" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                                    form.errors.password_confirmation }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <SelectGroup label="Role" v-model="form.roleId" :items="roles"
                                :error-message="form.errors.roleId" required />
                        </div>
                    </div>
                    <div class="mb-4">
                        <Button color="default" type="submit" :disabled="form.processing">Submit</Button>
                    </div>
                </form>
            </div>
        </Card>
    </AuthenticatesLayout>
</template>

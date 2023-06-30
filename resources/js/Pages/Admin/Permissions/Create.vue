<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue'

let props = defineProps({
    routeResourceName: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    create: {
        type: Boolean,
        default: false,
    },
})

const form = useForm({
    name: null,
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
        <Section>
            <Card>
                <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl">
                    <h5 class="text-xl font-medium text-gray-900 dark:text-white mb-5">{{ title }}</h5>
                    <form @submit.prevent="submit">

                        <div class="mb-4">
                            <Input v-model="form.name" name="name" id="name" placeholder="Enter Name" label="Name">
                            <template #helper v-if="form.errors.name" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Button color="default" type="submit" :disabled="form.processing">Submit</Button>
                        </div>
                    </form>
                </div>
            </Card>
        </Section>
    </AuthenticatesLayout>
</template>

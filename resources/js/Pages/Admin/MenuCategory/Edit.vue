<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm, router } from '@inertiajs/vue3';

let props = defineProps({
    routeResourceName: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    item: {
        type: Object,
    }
});

const form = useForm({
    name: props.item.name,
    description: props.item.description,
    thumbnail: null,
});

const submit = () => {
    router.post(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
        _method: 'put',
        name: form.name,
        description: form.description,
        thumbnail: form.thumbnail
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
                <div class="items-center sm:p-8 lg:p-10 mx-auto max-w-2xl rounded bg-gray-50 dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <Input v-model="form.name" name="name" id="name" placeholder="Enter Name" label="Name">
                                <template #helper v-if="form.errors.name" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
                                </template>
                            </Input>
                        </div>

                        <div class="mb-4">
                            <Input v-model="form.description" name="description" id="description" placeholder="Enter Description" label="Description">
                                <template #helper v-if="form.errors.description" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.description }}</p>
                                </template>
                            </Input>
                        </div>

                        <div class="mb-4">
                            <Input @input="form.thumbnail = $event.target.files[0]" type="file" name="thumbnail" id="thumbnail" label="Thumbnail">
                                <template #helper v-if="form.errors.thumbnail" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.thumbnail }}</p>
                                </template>
                            </Input>
                        </div>

                        <div class="mb-4">
                            <Button color="default" type="submit" :disabled="form.processing">Submit</Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatesLayout>
</template>

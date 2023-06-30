<script setup>
import { watch } from 'vue';
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm, router } from '@inertiajs/vue3';
import kebabCase from 'lodash/kebabCase';
import replace from 'lodash/replace';
import ToogleGroup from '@/Components/ToogleGroup.vue';

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
    slug: props.item.slug,
    description: props.item.description,
    thumbnail: null,
    status: props.item.status,
    featured: props.item.featured,
});

watch(() => form.name, (name) => {
    form.slug = kebabCase(replace(name, /&./, "and"));
})

const submit = () => {
    router.post(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
        _method: 'put',
        name: form.name,
        slug: form.slug,
        description: form.description,
        thumbnail: form.thumbnail,
        status: form.status,
        featured: form.featured,
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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <Input v-model="form.name" name="name" id="name" placeholder="Enter Category Name"
                                    label="Category Name">
                                <template #helper v-if="form.errors.name" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
                                </template>
                                </Input>
                            </div>
                            <div class="mb-4">
                                <Input v-model="form.slug" name="slug" id="slug" placeholder="Enter Slug"
                                    label="Category Slug">
                                <template #helper v-if="form.errors.slug" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.slug }}</p>
                                </template>
                                </Input>
                            </div>
                            <div class="mb-4">
                                <Input v-model="form.description" name="description" id="description"
                                    placeholder="Enter Category Description" label="Category Description">
                                <template #helper v-if="form.errors.description" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.description }}</p>
                                </template>
                                </Input>
                            </div>
                            <div class="mb-4">
                                <Input @input="form.thumbnail = $event.target.files[0]" type="file" name="thumbnail"
                                    id="thumbnail" label="Category Thumbnail">
                                <template #helper v-if="form.errors.thumbnail" class="text-red-500">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.thumbnail }}</p>
                                </template>
                                </Input>
                            </div>
                            <div class="mb-4">
                                <ToogleGroup label="Status" v-model:checked="form.status" :error-message="form.errors.status" />
                            </div>
                            <div class="mb-4">
                                <ToogleGroup label="Featured" v-model:checked="form.featured" :error-message="form.errors.featured" />
                            </div>
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

<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { watch } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3';
import kebabCase from 'lodash/kebabCase';
import replace from 'lodash/replace';
import ToogleGroup from '@/Components/ToogleGroup.vue';
import Card from '@/Components/Card/Card.vue';
import TextAreaGroup from '@/Components/TextAreaGroup.vue';
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
    create: {
        type: Boolean,
        default: false,
    },
    blogcategories: Array,
})

const form = useForm({
    title: "",
    blogcategory_id: null,
    slug: "",
    description: "",
    thumbnail: null,
    status: false,
    featured: false,
    slider: false,
});

watch(() => form.title, (title) => {
    form.slug = kebabCase(replace(title, /&./, "and"));
})

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
            <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded">
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="mb-4">
                            <Input v-model="form.title" name="title" id="title" placeholder="Enter Blog Title"
                                label="Blog Title" required>
                            <template #helper v-if="form.errors.title" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.title }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.slug" name="slug" id="slug" placeholder="Slug" label="Menu Slug" required>
                            <template #helper v-if="form.errors.slug" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.slug }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4 sm:col-span-2">
                            <TextAreaGroup label="Menu Description" :error-message="form.errors.description" v-model="form.description" />
                        </div>
                        <div class="mb-4 sm:col-span-2">
                            <Input @input="form.thumbnail = $event.target.files[0]" type="file" name="thumbnail"
                                id="thumbnail" label="Menu Thumbnail">
                            <template #helper class="text-red-500">
                                <small>Image will be resized into 500x500 px. Supported Files: .jpg, .png, .jpeg, .webp</small>
                                <p v-if="form.errors.thumbnail" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.thumbnail }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <SelectGroup label="Blog Category" v-model="form.blogcategory_id" :items="blogcategories"
                                :error-message="form.errors.blogcategory_id" select-value="Select Category" required />
                        </div>
                        <div class="mb-4">
                            <ToogleGroup label="Status" v-model:checked="form.status" :error-message="form.errors.status" />
                        </div>
                        <div class="mb-4">
                            <ToogleGroup label="Featured" v-model:checked="form.featured"
                                :error-message="form.errors.featured" />
                        </div>
                        <div class="mb-4">
                            <ToogleGroup label="Show On Slider" v-model:checked="form.slider"
                                :error-message="form.errors.slider" />
                        </div>
                    </div>

                    <div class="my-5">
                        <Button class="w-full" color="default" type="submit" :disabled="form.processing">Submit</Button>
                    </div>
                </form>
            </div>
        </Card>
    </AuthenticatesLayout>
</template>

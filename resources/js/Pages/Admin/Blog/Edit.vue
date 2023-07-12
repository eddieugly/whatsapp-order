<script setup>
import { watch } from 'vue';
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm, router } from '@inertiajs/vue3';
import kebabCase from 'lodash/kebabCase';
import replace from 'lodash/replace';
import ToogleGroup from '@/Components/ToogleGroup.vue';
import Card from '@/Components/Card/Card.vue';
import SelectGroup from '@/Components/SelectGroup.vue';
import ImageUpload from '@/Components/ImageUpload.vue';
import Close from '@/Components/Icons/Close.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

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
    },
    blogcategories: Array,
});

const form = useForm({
    _method: 'PATCH',
    blogcategory_id: props.item.blogcategory.id,
    title: props.item.title,
    slug: props.item.slug,
    description: props.item.description,
    thumbnail: null,
    status: props.item.status,
    featured: props.item.featured,
    slider: props.item.slider,
});

watch(() => form.title, (title) => {
    form.slug = kebabCase(replace(title, /&./, "and"));
});

const submit = () => {
    form.post(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
        forceFormData: true,
    });
};

const deleteImage = (imageID) => {
    if (!confirm('Are You Sure You Want To Delete This Image?') ) return;

    router.post(route('admin.images.destroy', { id: imageID }));
}

const maxUploadImageCount = 4;


</script>

<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Card>
            <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded">
                <form @submit.prevent="submit">
                    <div v-if="item.images.length > 0" class="grid grid-cols-2 gap-4 my-3">
                        <div v-for="image in item.images" :key="image.id" class="bg-gray-50 p-4 rounded-md relative">
                            <button class="absolute right-4 top-4 p-0.5 text-sm font-medium text-center text-red-500 transition-colors duration-200 hover:bg-red-500 hover:text-white rounded-full focus:outline-none dark:text-gray-400 dark:hover:text-white-100"
                                type="button"
                                @click.prevent="deleteImage(image.id)">
                                <Close />
                            </button>
                            <div v-html="image.html" class="[&_img]:h-48 [&_img]:w-full [&_img]:object-conver"></div>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="mb-4 sm:col-span-2">
                            <ImageUpload v-if="item.images.length < maxUploadImageCount" :model-id="item.id"
                                :maxFiles="maxUploadImageCount - item.images.length" model-type="blog" />
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.title" name="title" id="title" placeholder="Enter Blog Title" label="Blog Title"
                                required>
                            <template #helper v-if="form.errors.title" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.title }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.slug" name="slug" id="slug" placeholder="Slug" label="Menu Slug">
                            <template #helper v-if="form.errors.slug" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.slug }}</p>
                            </template>
                            </Input>
                        </div>
                        
                        <div class="mb-20 sm:col-span-2">
                            <InputLabel class="mb-2" value="Description" />
                            <QuillEditor v-model:content="form.description" content-type="html" theme="snow" />
                            <InputError v-if="form.errors.description" :message="form.errors.description" />
                        </div>
                        <div class="mb-4 sm:col-span-2">
                            <Input @input="form.thumbnail = $event.target.files[0]" type="file" name="thumbnail"
                                id="thumbnail" label="Menu Thumbnail">
                            <template #helper class="text-red-500">
                                <small>Image will be resized into 500x500 px. Supported Files: .jpg, .png, .jpeg,
                                    .webp</small>
                                <p v-if="form.errors.thumbnail" class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                                    form.errors.thumbnail }}</p>
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
                        <Button class="w-full" color="default" type="submit" :disabled="form.processing">Update</Button>
                    </div>
                </form>
            </div>
        </Card>
    </AuthenticatesLayout></template>

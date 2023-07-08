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
import TextAreaGroup from '@/Components/TextAreaGroup.vue';
import SelectGroup from '@/Components/SelectGroup.vue';
import ImageUpload from '@/Components/ImageUpload.vue';

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
    categories: Array,
});

const form = useForm({
    _method: 'PATCH',
    category_id: props.item.category.id,
    name: props.item.name,
    slug: props.item.slug,
    description: props.item.description,
    price: props.item.price,
    thumbnail: null,
    status: props.item.status,
    featured: props.item.featured,
    slider: props.item.slider,
});

watch(() => form.name, (name) => {
    form.slug = kebabCase(replace(name, /&./, "and"));
});

const submit = () => {
    form.post(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
        forceFormData: true,
    });
};

const maxUploadImageCount = 4;


</script>

<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Card>
            <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded">
                <form @submit.prevent="submit">
                    <div v-if="item.images.length > 0" class="grid md:grid-cols-2 gap-4">
                        <div v-for="image in item.images" :key="image.id">
                            <div v-html="image.html" class="[&_img]:h-64 [&_img]:w-full [&_img]:object-contain"></div>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="mb-4 sm:col-span-2">
                            <ImageUpload v-if="item.images.length < maxUploadImageCount" :model-id="item.id"
                                :maxFiles="maxUploadImageCount - item.images.length" model-type="menu" />
                        </div>
                        <div class="mb-4">
                            <Input v-model="form.name" name="name" id="name" placeholder="Enter Menu Name" label="Menu Name"
                                required>
                            <template #helper v-if="form.errors.name" class="text-red-500">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
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
                        <div class="mb-4">
                            <Input v-model="form.price" name="price" id="price" type="number" placeholder="Enter Menu Price"
                                label="Menu Price">
                            <template #helper v-if="form.errors.price">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.price }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <SelectGroup label="Category" v-model="form.category_id" :items="categories"
                                :error-message="form.errors.category_id" select-value="Select Category" required />
                        </div>
                        <div class="mb-4 sm:col-span-2">
                            <TextAreaGroup label="Menu Description" :error-message="form.errors.description"
                                v-model="form.description" />
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

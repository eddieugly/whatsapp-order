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
import SelectGroup from '@/Components/SelectGroup.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select2 from '@/Components/Select2.vue';

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
    categories: Array,
    extras: Array,
})

const form = useForm({
    name: "",
    category_id: null,
    slug: "",
    description: "",
    price: "",
    thumbnail: null,
    images: null,
    status: false,
    featured: false,
    slider: false,
    has_extras: false,
    extras: [],

});

watch(() => form.name, (name) => {
    form.slug = kebabCase(replace(name, /&./, "and"));
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
                            <Input v-model="form.name" name="name" id="name" placeholder="Enter Menu Name"
                                label="Menu Name">
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
                            <Input v-model="form.price" name="price" id="price" type="numeric" pattern="[0-9]*"
                                placeholder="Enter Menu Price" label="Menu Price">
                            <template #helper v-if="form.errors.price">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.price }}</p>
                            </template>
                            </Input>
                        </div>
                        <div class="mb-4">
                            <SelectGroup label="Category" v-model="form.category_id" :items="categories"
                                :error-message="form.errors.category_id" select-value="Select Category" required />
                        </div>
                        <div class=" mb-20 sm:col-span-2">
                            <InputLabel class="mb-2" value="Menu Description" />
                            <QuillEditor v-model:content="form.description" content-type="html" theme="snow" />
                            <InputError v-if="form.errors.description" :message="form.errors.description" />
                        </div>
                        <div class="mb-4 sm:col-span-2">
                            <Input @input="form.thumbnail = $event.target.files[0]" type="file" name="thumbnail"
                                id="thumbnail" label="Menu Thumbnail">
                            <template #helper class="text-red-500">
                                <small>Image will be resized into 500x375 px. Supported Files: .jpg, .png, .jpeg,
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
                        <div class="mb-4">
                            <ToogleGroup label="Has Extras?" v-model:checked="form.has_extras"
                                :error-message="form.errors.has_extras" />
                        </div>
                        <div v-show="form.has_extras" class="mb-4 sm:col-span-2">
                            <InputLabel class="mb-2" value="Select Extras" />
                            <Select2 tokenizer="tokenizer" v-model="form.extras"
                                :options="extras"
                                :settings="{ data: extras, multiple: true }" />
                            <InputError v-if="form.errors.extras"
                                :message="form.errors.extras" />
                        </div>
                    </div>

                    <div class="my-5">
                        <Button class="w-full" color="default" type="submit" :disabled="form.processing">Submit</Button>
                    </div>
                </form>
            </div>
    </Card>
</AuthenticatesLayout></template>

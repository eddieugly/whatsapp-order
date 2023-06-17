<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    description: null,
    thumbnail: null
})

let submit = () => {
    form.post('/admin/category')
};
</script>

<template>
    <Head title="Menu Category List" />

    <AuthenticatesLayout>

        <div class="p-4 sm:ml-64">
            <div class="p-4 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
                <div class="items-center sm:p-8 lg:p-10 mx-auto max-w-2xl rounded bg-gray-50 dark:bg-gray-800">
                    <form @submit.prevent="submit">
                    
                    <div class="mb-4">
                        <Input v-model="form.name" name="name" id="name" placeholder="Enter Category Name" label="Category Name">
                            <template #helper v-if="form.errors.name" class="text-red-500">
                                {{ form.errors.name }}
                            </template>
                        </Input>
                    </div>
                    

                    <div class="mb-4">
                        <Input v-model="form.description" type="textarea" name="description" id="description" placeholder="Enter Category Description" label="Category Description">
                            <template #helper v-if="form.errors.description" class="text-red-500">
                                {{ form.errors.description }}
                            </template>
                        </Input>
                    </div>

                    

                    <div class="mb-4">
                        <Input v-model="form.thumbnail" type="file" name="thumbnail" id="thumbnail" placeholder="Enter Category Thumbnail" label="Category Thumbnail">
                            <template #helper v-if="form.errors.thumbnail" class="text-red-500">
                                {{ form.errors.thumbnail }}
                            </template>
                        </Input>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                        </progress>
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

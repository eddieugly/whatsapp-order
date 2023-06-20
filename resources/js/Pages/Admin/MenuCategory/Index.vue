

<template>
    <Head title="Menu Category List" />

    <AuthenticatesLayout>

        <div class="p-4 sm:ml-64">
            <div class="p-4 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
                <div class="items-center sm:p-8 lg:p-10 mx-auto max-w-4xl rounded bg-gray-50 dark:bg-gray-800">
                    <div class="lg:flex items-center justify-between pb-4 my-7">
                        <div>
                            <Link
                                class=" items-center text-blue-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 hover:underline"
                                as="button" :href="'/admin/category/create'">
                            Add New Category
                            </Link>
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input v-model="search" type="text" id="table-search"
                                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Category" name="search">
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 shadow">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 shadow-md border border-rounded dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Category Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Thumbnail
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="menuCategory in menuCategories" :key="menuCategory.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                                <td class="px-6 py-4">
                                    {{ menuCategory.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ menuCategory.description }}
                                </td>
                                <td class="px-6 w-10 py-4">
                                    <img :src="`/assets/img/categoryThumbnail/${menuCategory.thumbnail}`" :width="75"
                                        alt="Category Thumbnail">
                                    {{ menuCategory.thumbnail }}
                                </td>
                                <td class="px-6 py-4 text-right gap-4">
                                    <div class="flex justify-end gap-4">
                                        <Link class="text-blue-600 dark:text-blue-500 hover:underline" as="button"
                                            :href="'/admin/category/' + menuCategory.id + '/edit'">
                                        Edit
                                        </Link>
                                        <Link class="text-red-600 dark:text-red-500 hover:underline" method="delete"
                                            as="button" :href="'/admin/category/' + menuCategory.id + '/destroy'">
                                        Delete
                                        </Link>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatesLayout>
</template>
<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

let props = defineProps({
    menuCategories: {
        type: Object,
    },
    filters: Object,
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
    router.get('/admin/category', { search: value }, { preserveState: true, replace: true })
}, 500));


</script>


<template>
    <Head title="Menu Category List" />

    <AuthenticatesLayout>

        <Section>
            <Card>

                <SearchAddButton :href="route('admin.category.create')" :search-link="route('admin.category.index')">
                    Add Category
                </SearchAddButton>

                <Table :headers="headers" :items="menuCategories">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>

                        <Td>
                            {{ item.description }}
                        </Td>
                        <Td>
                            {{ item.thumbnail }}
                        </Td>
                        <Td class="">
                            <Actions @deleteClicked="showModal(item)"
                                :edit-link="route('admin.category.edit', { id: item.id })" :drop-key="item.id" />
                        </Td>
                    </template>
                </Table>
            </Card>

        </Section>

        <Modal :size="size" v-if="isShowModal" @close="closeModal">
            <template #header>
                <div class="flex items-center text-lg">
                    Delete Role - {{ itemToDelete.name }}
                </div>
            </template>
            <template #body>
                <p class="text-base leading-relaxed text-red-500 dark:text-red-400">
                    Are You Sure You Want To Delete This Category?
                </p>
            </template>
            <template #footer>
                <div class="flex justify-between">
                    <Button @click="closeModal" color="light">Cancel</Button>
                    <Button @click="handleDeleteItem" color="red" :disabled="isDeleting">
                        <span v-if="isDeleting">Deleting..</span>
                        <span v-else>Delete</span>
                    </Button>
                </div>
            </template>
        </Modal>

        
    </AuthenticatesLayout>
</template>
<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import Pagination from '@/Components/Pagination.vue';
import SearchAddButton from '@/Components/Table/SearchAddButton.vue';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue';
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import { Modal, Button } from 'flowbite-vue';

let props = defineProps({
    menuCategories: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Object,
        default: () => [],
    },
});


const deleteModal = ref(false);
const itemToDelete = ref({});
const isDeleting = ref(false);

function handleDeleteItem() {
    router.delete(route('admin.category.destroy', {id: itemToDelete.value.id}), {
        onBefore: () => {
            isDeleting.value = true;
        },
        onSuccess: () => {
            isShowModal.value = false;
            itemToDelete.value = {};
        },
        onFinish: () => {
            isDeleting.value = false;
        }
    })
}

const isShowModal = ref(false)
function closeModal() {
    isShowModal.value = false
}
function showModal(item) {
    isShowModal.value = true;
    itemToDelete.value = item;
}


</script>
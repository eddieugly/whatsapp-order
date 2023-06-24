

<template>
    <Head title="Roles List" />

    <AuthenticatesLayout>

        <Section>
            <Card>
                <SearchAddButton :href="route('admin.roles.create')" :search-link="route('admin.roles.index')">
                    Add Roles
                </SearchAddButton>

                <Table :headers="headers" :items="roles">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>

                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td class="flex items-center">
                            <Actions @deleteClicked="showModal(item)"
                                :edit-link="route('admin.roles.edit', { id: item.id })" :drop-key="item.id" />
                        </Td>
                    </template>
                </Table>

                <Pagination :link="roles.links" />
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
                    Are You Sure You Want To Delete This Role?
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
import { ref } from 'vue';
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue'
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import { Button, Modal } from 'flowbite-vue';
import { router } from '@inertiajs/vue3';
import SearchAddButton from '@/Components/Table/SearchAddButton.vue'

defineProps({
    roles: {
        type: Object,
        default: () => [],
    },
    headers: {
        type: Object,
        default: () => [],
    },
});

const deleteModal = ref(false);
const itemToDelete = ref({});
const isDeleting = ref(false);

function showDeleteModal(item) {
    deleteModal.value = true;
    itemToDelete.value = item;
}

function handleDeleteItem() {
    router.delete(route('admin.roles.destroy', {id: itemToDelete.value.id}), {
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
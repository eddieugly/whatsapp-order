import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

export default function (params) {

    const { routeResourceName } = params;

    const itemToDelete = ref({});
    const isDeleting = ref(false);

    const isShowModal = ref(false)
    function closeModal() {
        isShowModal.value = false
    }
    function showModal(item) {
        isShowModal.value = true;
        itemToDelete.value = item;
    }

    function handleDeleteItem() {
        router.delete(route(`admin.${routeResourceName}.destroy`, { id: itemToDelete.value.id }), {
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

    return {
        itemToDelete,
        isDeleting,
        isShowModal,
        closeModal,
        showModal,
        handleDeleteItem,
    }

}
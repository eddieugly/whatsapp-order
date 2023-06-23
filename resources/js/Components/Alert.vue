<template>
  <div class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">
    <Toast v-if="success" :type="'success'" closable divide>
    {{ success }}
    </Toast>

    <Toast v-if="error" :type="'danger'" closable divide>
    {{ error }}
    </Toast>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Toast } from 'flowbite-vue';

let success = ref(usePage().props.flash?.success);
let error = ref(usePage().props.flash?.error);

onMounted(() => {
  setTimeout(() => {
    success.value = '';
    error.value = '';
  }, 5000);
});


</script>

<style lang="scss" scoped></style>
<template>
  <div class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">
    <Toast v-if="success" :type="'success'" closable divide>
      {{ success }}
    </Toast>

    <Toast v-if="error" :type="'danger'" closable divide>
      {{ error }}
    </Toast>

    <Toast
      v-if="errors"
      v-for="error in errors"
      :key="error"
      :type="'danger'"
      closable
      divide
    >
      {{ error }}
    </Toast>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Toast } from "flowbite-vue";

const success = ref("");
const error = ref([]);
const errors = ref([]);
const timeoutHandler = ref(null);

onMounted(() => {
  setTimeout(() => {
    success.value = "";
    error.value = "";
  }, 5000);
});

watch(
  () => usePage().props.flash?.success,
  (successMessage) => {
    success.value = successMessage;
    if (successMessage) {
      clearTimeout(timeoutHandler.value);
      timeoutHandler.value = setTimeout(() => {
        success.value = "";
        usePage().props.flash.success = "";
      }, 5000);
    }
  },
  {
    immediate: true,
  }
);

watch(
  () => usePage().props.flash?.error,
  (errorMessage) => {
    error.value = errorMessage;
    if (errorMessage) {
      clearTimeout(timeoutHandler.value);
      timeoutHandler.value = setTimeout(() => {
        error.value = "";
        usePage().props.flash.error = "";
      }, 5000);
    }
  },
  {
    immediate: true,
  }
);

watch(
  () => usePage().props.errors,
  (errorMessages) => {
    if (errorMessages) {
      errors.value = errorMessages;
      clearTimeout(timeoutHandler.value);
      timeoutHandler.value = setTimeout(() => {
        errors.value = "";
        usePage().props.flash.errors = "";
      }, 5000);
    }
  },
  {
    immediate: true,
  }
);
</script>

<style lang="scss" scoped></style>

<script setup>
import { onMounted, ref } from 'vue';
import FileUpload from './Icons/FileUpload.vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const dropdown = ref(null);

onMounted(() => {
  if (dropdown.value.hasAttribute('autofocus')) {
    dropdown.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <div class="flex flex-col items-center justify-center pt-5 pb-6">
    <FileUpload />
    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag
      and drop</p>
    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG or WEBP (MAX. 10MB)</p>
  </div>
  <input id="dropzone-file" @input="form.images = $event.target.files[0]" ref="dropdown" type="file"
    class="absolute top-0 left-0 opacity-0 cursor-pointer" />
</template>

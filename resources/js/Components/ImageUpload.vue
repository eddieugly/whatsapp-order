<script setup>
import { onMounted, ref } from 'vue';
import FileUpload from './Icons/FileUpload.vue';
import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';

const props = defineProps({
  maxFilesize: {
    type: Number,
    default: 1024
  },
  maxFiles: {
    type: Number,
    default: 5,
  },
})

onMounted(() => {
  let dropzone = new Dropzone("#image-upload", {
    url: "/admin/upload-images",
    headers: {
      "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.content,
    },
    maxFilesize: props.maxFilesize,
    maxFiles: props.maxFiles,
    acceptedFiles: ".jpeg,.jpg,.png,.webp",
    addRemoveLinks: true,
  });
});
</script>

<template>

  <div class="dropzone" id="image-upload">
    <div class="dz-message flex flex-col items-center justify-center" data-dz-message>
      <FileUpload />
      <div><p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag
      and drop</p></div>
      <div><p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG or WEBP (MAX. 10MB)</p></div>
    </div>
  </div>
</template>

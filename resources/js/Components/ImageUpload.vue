<script setup>
import { onMounted, ref } from 'vue';
import FileUpload from './Icons/FileUpload.vue';
import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';

const props = defineProps({
  maxFilesize: {
    type: Number,
    default: 10240
  },
  maxFiles: {
    type: Number,
    default: 4,
  },
  modelType: {
    type: String,
    required: true
  },
  modelId: {
    type: String,
    required: true,
  }
})

onMounted(() => {
  let dropzone = new Dropzone("#image-upload", {
    url: route('admin.images.store'),
    headers: {
      "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.content,
    },
    paramName: 'image',
    maxFilesize: props.maxFilesize,
    maxFiles: props.maxFiles,
    acceptedFiles: ".jpeg,.jpg,.png,.webp",
    addRemoveLinks: true,
  });

  dropzone.on('sending', (file, xhr, fd) => {
    fd.append('modelType', props.modelType);
    fd.append('modelId', props.modelId);
  });
});
</script>

<template>

  <div class="dropzone" id="image-upload">
    <div class="dz-message flex flex-col items-center justify-center" data-dz-message>
      <FileUpload />
      <div><p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload or drag
      and drop</span></p></div>
      <div v-if="maxFiles >= 1">
        <p class="text-xs text-gray-500 dark:text-gray-400">
          You can only upload {{ maxFiles }} image<span v-if="maxFiles > 1" >s</span>
        </p>
      </div>
      <div><p class="text-xs text-gray-500 dark:text-gray-400">Supported Files .png, .jpg, .jpeg or .webp (MAX. 10MB)</p></div>
    </div>
  </div>
</template>

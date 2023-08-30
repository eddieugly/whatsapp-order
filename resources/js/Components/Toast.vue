<template>
    <div class="toast" v-for="toast in toasts" :key="toast.id">
      <div class="toast-header">
        <strong>{{ toast.type }}</strong>
        <button class="ml-auto close" @click="toasts.splice(toasts.indexOf(toast), 1)">
          <span>&times;</span>
        </button>
      </div>
      <div class="toast-body">
        {{ toast.message }}
      </div>
    </div>
    
  </template>
  
  <script setup>
  import useToasters from '@/Composables/useToasters';

  
  const { toasts, showToast } = useToasters();
  </script>
<template>
  <TransitionGroup
    tag="div"
    enter-from-class="translate-x-full opacity-0"
    enter-active-class="duration-500"
    leave-active-class="duration-500"
    leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">
    <ToastListItem v-for="(item, index) in toast.items" :key="index" :message="item.message" :duration="3000" @removeItem="deleteItem(index)" />
  </TransitionGroup>

</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { ref, computed, onUnmounted } from 'vue';
import ToastListItem from '@/Components/ToastListItem.vue';

import toast from '@/Composables/toast';

const page = computed(() => usePage().props);
const successe = computed(() => usePage().props.flash.success);
const errore = computed(() => usePage().props.flash.error);

let removeFinishEventListener = router.on('finish', () => {
  if (successe) {
    toast.add({
      message: successe
    });
  }

  if (errore) {
    toast.add({
      message: errore
    });
  }
});

onUnmounted(() => removeFinishEventListener());

  function deleteItem(index) {
    console.log(index);
    toast.removeItem(index);
    
  }

</script>

<style lang="scss" scoped>

</style>
<script setup>
import { Toast } from 'flowbite-vue';
import { computed, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import useAlerts from '@/Composables/alert';

const success = computed(() => usePage().props.flash.success);
const error = computed(() => usePage().props.flash.error);
const errorer = computed(() => usePage().props.errors);

const { addAlert, alerts } = useAlerts();

watch(success, (newVal) => {
  let type = 'success';
  if (newVal) {
    addAlert(newVal, type);
    usePage().props.flash.success = '';
  }
}, { immediate: true });
watch(error, (newVal) => {
  let type = 'danger';
  if (newVal) {
    addAlert(newVal, type);
    usePage().props.flash.error = '';
  }
}, { immediate: true });

watch(errorer, (newVal) => {

  console.log(typeof newVal);

  const errs = [];
  for (const key in newVal) {
    if (newVal.hasOwnProperty(key)) {
      errs.push(newVal[key]);
    }
  }
  if (errs.length > 0) {
    errs.forEach((err) => {
      let type = 'warning';
      addAlert(err, type);
    });
  }
}, { immediate: true });
</script>
<template>
  <TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-500"
    leave-active-class="duration-500" leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">
    <Toast v-for="(alert, index) in alerts" :key="index" :type="alert.type" divide>
      {{ alert.message }}
    </Toast>
  </TransitionGroup>
</template>
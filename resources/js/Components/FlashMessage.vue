<script setup>
import { Toast } from 'flowbite-vue';
import { computed, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import useAlerts from '@/Composables/alert';

const alert = computed(() => usePage().props.value.flash.alert);
const {addAlert, alerts} = useAlerts();

watch(alert, (newVal) => {
    if (newVal) {
        addAlert(newVal);
    }
});
</script>
<template>
  <div v-if="alerts.length" class="fixed w-full top-3 right-3 z-50 flex justify-end">
    <Toast v-for="alert in alerts" :key="alert.id" class="shadow" :type="{'danger': alert.type === 'error', 'success': alert.type === 'success'}" closable>
      {{ alert.message }}
    </Toast>
  </div>
  
</template>
<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import DashnavVue from '@/Components/Dashnav.vue';
import SiderbarVue from '@/Components/Siderbar.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Link } from '@inertiajs/vue3';
import Toast from '@/Components/Toast.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const { errors, flashMessage } = usePage().props;

watch(
  errors,
  (newErrors) => {
    if (newErrors.length) {
      newErrors.forEach((error) => {
        showToast(error, 'error', 3000);
      });
    }
  },
  { immediate: true },
);

watch(
  flashMessage,
  (newFlashMessage) => {
    if (newFlashMessage) {
      if (newFlashMessage.type === 'success') {
        showToast(newFlashMessage.message, 'success', 3000);
      } else {
        showToast(newFlashMessage.message, 'error', 3000);
      }
    }
  },
  { immediate: true },
);

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <DashnavVue />
            

            <SiderbarVue />

            <!-- Page Content -->
            <main>
                
                <slot />
            </main>
            
        </div>
    </div>
</template>

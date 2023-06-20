<script setup>
import { ref } from 'vue';
import DashnavVue from '@/Components/Dashnav.vue';
import SiderbarVue from '@/Components/Siderbar.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, watch, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { Toast } from 'flowbite-vue';
import ToastList from '@/Components/ToastList.vue';


onMounted(() => {
  initFlowbite();
})


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
            <ToastList/>
            
        </div>
    </div>
</template>
